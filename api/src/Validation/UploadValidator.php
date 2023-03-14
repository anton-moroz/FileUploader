<?php

namespace FileUploader\Api\Src\Validation;

use Exception;
use FileUploader\Api\Src\Model\Upload;

class UploadValidator
{
    /**
     * Only 2 file types are supported: .pdf and .jpeg
     */
    private const ALLOWED_TYPES = ['pdf', 'jpeg'];

    /**
     * Max file size is 5MB.
     */
    public const MAX_FILE_SIZE = 5 * 1024 * 1024;


    /**
     * @param Upload $upload
     *
     * @return bool
     * @throws Exception
     */
    public static function isValid(Upload $upload): bool
    {
        if ($upload->getFileSize() > self::MAX_FILE_SIZE) {
            throw new Exception('Error: File size has exceeded 5MB!', 406);
        }

        if (!in_array($upload->getFileExtension(), self::ALLOWED_TYPES)) {
            throw new Exception('Error: File extension is not allowed!', 406);
        }

        return true;
    }
}