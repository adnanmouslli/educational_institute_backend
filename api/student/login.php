<?php

include "../../database/connect.php" ;

header('Content-Type: application/json');

$inputJSON = file_get_contents('php://input');

$input = json_decode($inputJSON, true);

if (json_last_error() !== JSON_ERROR_NONE) {

    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON']);
    
}

$username = $input['username'];
$password = $input['password'];

$stmt = $con -> prepare("SELECT * FROM `students` WHERE username = '$username' and password = '$password' ;");

$stmt->execute() ;
$count = $stmt -> rowCount();

if ($count > 0) {
    echo     json_encode(array("status" => "success"));
} else {
    echo     json_encode(array("status" => "failure"));
}