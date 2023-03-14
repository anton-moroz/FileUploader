<?php

namespace FileUploader\Api\Src\Model;

use Exception;
use FileUploader\Api\Src\Database\Database;

/**
 * @private int|null $upload_id
 * @private string $original_file_name
 * @private int $file_size
 * @private string $file_ext
 * @private string $hash
 * @private string $temp_path
 */
class Upload extends BaseModel
{
    /**
     * @inheritdoc
     */
    public const TABLE_NAME = 'uploads';

    /**
     * @var int|null
     */
    private int|null $upload_id;

    /**
     * @var string|mixed
     */
    private string $original_file_name;

    /**
     * @var int|mixed
     */
    private int $file_size;

    /**
     * @var string
     */
    private string $file_ext;

    /**
     * @var string
     */
    private string $hash;

    /**
     * @var string|mixed
     */
    private string $temp_path;

    /**
     * @param array $fileData
     */
    public function __construct(array $fileData)
    {
        $this->original_file_name = $fileData['name'];
        $this->file_size          = $fileData['size'];
        $this->file_ext           = pathinfo($fileData['name'], PATHINFO_EXTENSION);
        $this->hash               = md5_file($fileData['tmp_name']);
        $this->temp_path          = $fileData['tmp_name'];
    }

    /**
     * @return array[]
     */
    public static function getTableDefinition(): array
    {
        return [
            'upload_id'          => ['INT', 'NOT NULL', 'AUTO_INCREMENT', 'PRIMARY KEY'],
            'original_file_name' => ['VARCHAR(40)', 'NOT NULL'],
            'file_size'          => ['INT', 'NOT NULL'],
            'file_ext'           => ['VARCHAR(10)', 'NOT NULL'],
            'hash'               => ['VARCHAR(255)', 'NOT NULL'],
        ];
    }

    /**
     * @return int|null
     */
    public function getUploadId(): int|null
    {
        return $this->upload_id ?? null;
    }

    /**
     * @return string
     */
    public function getOriginalFileName(): string
    {
        return $this->original_file_name;
    }

    /**
     * @return int
     */
    public function getFileSize(): int
    {
        return $this->file_size;
    }


    /**
     * @return string
     */
    public function getFileExtension(): string
    {
        return $this->file_ext;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @return string
     */
    public function getTempPath(): string
    {
        return $this->temp_path;
    }

    /**
     * @return void
     * @throws Exception
     */
    public function store(): void
    {
        try {
            $database = Database::getDatabase();
            $database->pdo->beginTransaction();

            $database->insert(self::TABLE_NAME, $this->toArray());
            $path = dirname(__DIR__, 2) . '/uploads/' . $this->getHash() . 'Model' . $this->getFileExtension();

            if (!move_uploaded_file($this->getTempPath(), $path)) {
                throw new Exception('Error: Could not save your file!', 500);
            }

            $database->pdo->commit();
        } catch (Exception $exception) {
            $database->pdo->rollback();
            throw $exception;
        }
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'upload_id'          => $this->getUploadId(),
            'original_file_name' => $this->getOriginalFileName(),
            'file_size'          => $this->getFileSize(),
            'file_ext'           => $this->getFileExtension(),
            'hash'               => $this->getHash(),
        ];
    }
}