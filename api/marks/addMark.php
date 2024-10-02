<?php

include "../../database/connect.php" ;

include "../../lib/getJsonData.php" ;

include "../../lib/functions.php" ;


$id_student = $input['id_student'];
$mark = $input['mark'];
$id_supervisor = $input['id_supervisor'];
$id_subject = $input['id_subject'];
$type = $input['type'];

$stmt = $con ->prepare("SELECT * FROM `marks` WHERE id_student = '$id_student' AND id_subject = '$id_subject' AND type = '$type' ");
$stmt ->execute() ;
$count  = $stmt ->rowCount() ;

if($count > 0) {
    echo     json_encode(array("status" => "failure", "message" => "لديه علامة بهذه المادة بالفعل"));
}else {

    $stmt = $con ->prepare("INSERT INTO `marks`(`id`, `id_student`, `mark`, `id_supervisor`, `id_subject`, `type`) 
    VALUES (null , '$id_student' , '$mark' , '$id_supervisor' , '$id_subject' , '$type' )");

$stmt ->execute() ;
$count  = $stmt ->rowCount() ;
result($count) ;

}



