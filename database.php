<?php

use FileUploader\Api\Src\Database\Database;

require 'vendor/autoload.php';

try {
    $database = new Database([
        'type'     => $_ENV['DATABASE_DRIVER'],
        'host'     => $_ENV['DATABASE_HOST'],
        'database' => $_ENV['DATABASE_NAME'],
        'username' => $_ENV['DATABASE_USER'],
        'password' => $_ENV['DATABASE_PASSWORD'],
    ]);
    $database->createTables();
} catch (Exception $exception) {
    die("Could not connect to the database!\n");
}