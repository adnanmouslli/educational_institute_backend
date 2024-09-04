<?php

include "../../database/connect.php" ;

include "../../lib/getJsonData.php" ;

include "../../lib/functions.php" ;


$id_student = $input['id_student'];
$id_subject = $input['id_subject'];




$stmt = $con ->prepare("INSERT INTO `registration_records`(`id`, `id_student`, `id_subject`) 
                        VALUES (null , '$id_student' , '$id_subject')");

$stmt ->execute() ;
$count  = $stmt ->rowCount() ;

result($count) ;
