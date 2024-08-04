<?php

include "../../database/connect.php" ;

include "../../lib/getJsonData.php" ;

include "../../lib/functions.php" ;


$id_student = $input['id_student'];
$mark = $input['mark'];
$id_supervisor = $input['id_supervisor'];
$id_subject = $input['id_subject'];


$stmt = $con ->prepare("INSERT INTO `marks`(`id`, `id_student`, `mark`, `id_supervisor`, `id_subject`)
 VALUES ( null , '$id_student' , '$mark'  ,'$id_supervisor'  ,'$id_subject')");

$stmt ->execute() ;
$count  = $stmt ->rowCount() ;

result($count) ;
