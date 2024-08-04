<?php

include "../../database/connect.php" ;
include "../../lib/functions.php" ;
// include "../../lib/getJsonData.php" ;


$dir_uploads = "C:/xampp/htdocs/educational_institute/upload-Image/" ;

$full_name = $_POST['full_name'];
$username = $_POST['username'];
$password = $_POST['password'];
$school = $_POST['school'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$class = $_POST['class'];
$id_image_url = fileUpload("image" , $dir_uploads) ;

$sub_url = explode("/" , $id_image_url) ;

$stmt = $con -> prepare("SELECT * FROM `students` WHERE phone = '$phone';");

$stmt->execute() ;
$count = $stmt -> rowCount();

if ($count > 0) {
    echo     json_encode(array("status" => "failure" , "message" => "Phone number already exists"));
    deleteFile($dir_uploads . $sub_url[sizeof($sub_url) - 1]) ;
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
    printSuccess();
} else {
    printFailure();
    deleteFile($dir_uploads . $sub_url[3]) ;
}