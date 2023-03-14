<?php

ini_set('display_errors', 0);
ini_set('upload_max_filesize', '5M');
header('Content-type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('HTTP/1.1 405 Method Not Allowed');
    header('Allow: POST');
    echo json_encode('Error: Only POST requests are allowed');

    exit;
}

use FileUploader\Api\Src\Validation\UploadValidator;
use FileUploader\Api\Src\Database\Database;
use FileUploader\Api\Src\Model\Upload;

require '../vendor/autoload.php';

try {
    $database = new Database([
        'type'     => $_ENV['DATABASE_DRIVER'],
        'host'     => $_ENV['DATABASE_HOST'],
        'database' => $_ENV['DATABASE_NAME'],
        'username' => $_ENV['DATABASE_USER'],
        'password' => $_ENV['DATABASE_PASSWORD'],
    ]);
} catch (Exception $exception) {
    http_response_code(500);
    echo json_encode('Could not connect to the database!');
    exit;
}

try {
    if(!isset($_FILES['file'])) {
        throw new Exception('Error: select file for uploading', 422);
    }

    $upload = new Upload($_FILES['file']);

    if (UploadValidator::isValid($upload)) {
        $upload->store();
        echo json_encode($upload->getHash());
    }
} catch (Exception $exception) {
    http_response_code($exception->getCode());
    echo json_encode($exception->getMessage());
}