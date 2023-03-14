<?php

namespace FileUploader\Api\Src\Model;

abstract class BaseModel
{
    /**
     * Database table name for model data.
     */
    public const TABLE_NAME = '';

    /**
     * @return array
     */
    abstract public static function getTableDefinition(): array;

    /**
     * @return array
     */
    abstract public function toArray(): array;
}