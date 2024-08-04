<?php


header('Content-Type: application/json');

$inputJSON = file_get_contents('php://input');

$input = json_decode($inputJSON, true);

if (json_last_error() !== JSON_ERROR_NONE) {

    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON']);
    exit;
}