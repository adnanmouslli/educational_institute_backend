<?php

include "../../database/connect.php" ;

include "../../lib/getJsonData.php" ;

include "../../lib/functions.php" ;


$title = $input['title'];
$body = $input['body'];
$id_supervisor = $input['id_supervisor'];
$studentNumber = $input['studentNumber'];



$stmt = $con ->prepare("SELECT id FROM `students` WHERE studentNumber = '$studentNumber' ");
$stmt ->execute() ;
$id = $stmt -> fetchAll(PDO::FETCH_ASSOC);
$count  = $stmt ->rowCount() ;
$id = isset($id[0]['id'])? $id[0]['id'] : 0 ;

if($count > 0){

    $stmt = $con ->prepare("INSERT INTO `alerts`(`id`, `title`, `body`, `id_supervisor`, `id_student`) 
    VALUES (null , '$title' , '$body' , '$id_supervisor' , $id)");

    $stmt ->execute() ;
    $count  = $stmt ->rowCount() ;
    result($count) ;
}else {
    echo    json_encode(array("status" => "failure", "message" => "Student number not found!!"));
}