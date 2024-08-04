<?php

include "../../database/connect.php" ;

include "../../lib/getJsonData.php" ;

include "../../lib/functions.php" ;


$title = $input['title'];
$body = $input['body'];
$id_supervisor = $input['id_supervisor'];
$id_student = $input['id_student'];


$stmt = $con ->prepare("INSERT INTO `alerts`(`id`, `title`, `body`, `id_supervisor`, `id_student`) 
    VALUES (null , '$title' , '$body' , '$id_supervisor' , '$id_student')");

$stmt ->execute() ;
$count  = $stmt ->rowCount() ;

result($count) ;
