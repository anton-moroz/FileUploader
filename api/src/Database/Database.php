<?php

namespace FileUploader\Api\Src\Database;

use FileUploader\Api\Src\Model\Upload;
use Medoo\Medoo;

class Database
{
    /**
     * List of models that need tables in database.
     */
    private const MODELS_WITH_DB_TABLES = [
        Upload::class,
    ];

    /**
     * @var Medoo
     */
    private static Medoo $database;

    /**
     * @param $connectionParams
     */
    public function __construct($connectionParams)
    {
        self::connect($connectionParams);
    }

    /**
     * @param array $connectionParams
     *
     * @return void
     */
    private static function connect(array $connectionParams): void
    {
        self::$database = new Medoo($connectionParams);
    }

    /**
     * @return void
     */
    public function createTables(): void
    {
        foreach (self::MODELS_WITH_DB_TABLES as $model) {
            self::$database->create($model::TABLE_NAME, $model::getTableDefinition());
        }
    }

    /**
     * @return Medoo
     */
    public static function getDatabase(): Medoo
    {
        return self::$database;
    }
}