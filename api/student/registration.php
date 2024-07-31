<?php

include "../../database/connect.php" ;

header('Content-Type: application/json');

$inputJSON = file_get_contents('php://input');

$input = json_decode($inputJSON, true);

if (json_last_error() !== JSON_ERROR_NONE) {

    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON']);
    exit;
}

$full_name = $input['full_name'];
$username = $input['username'];
$password = $input['password'];
$school = $input['school'];
$phone = $input['phone'];
$gender = $input['gender'];
$class = $input['class'];
$id_image_url = $input['id_image_url'];


$stmt = $con -> prepare("SELECT * FROM `students` WHERE phone = '$phone';");

$stmt->execute() ;
$count = $stmt -> rowCount();

if ($count > 0) {
    echo     json_encode(array("status" => "failure" , "message" => "Phone number already exists"));
    exit ;
} 


$studentNumber = '';
if ($class === 'T') {
    $studentNumber = 'TA-'; // رمز للصف التاسع
} elseif ($class === 'B') {
    $studentNumber = 'BA-'; // رمز للبكالوريا
}

$unique_number = mt_rand(10000, 99999);

$studentNumber = $studentNumber . $unique_number;


$stmt = $con -> prepare("INSERT INTO 
`students`(`id`, `full_name`, `username`, `password`, `school`, `phone`, `gender`, `class`, `id_image_url` , `studentNumber`) 
    VALUES (null , '$full_name' , '$username' , '$password' , '$school' ,'$phone' , '$gender' , '$class' , '$id_image_url' , '$studentNumber')");

$stmt->execute() ;
$count = $stmt -> rowCount();

if ($count > 0) {
    echo     json_encode(array("status" => "success"));
} else {
    echo     json_encode(array("status" => "failure"));
}


