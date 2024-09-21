<?php

include "../../database/connect.php" ;

include "../../lib/getJsonData.php" ;

include "../../lib/functions.php" ;


$id_student = $input['id_student'];
$id_supervisor = $input['id_supervisor'];
$paid_quantity = $input['paid_quantity'];
$date = $input['date'];


$stmt = $con ->prepare("INSERT INTO `financial_disclosure`(`id`, `id_student`, `id_supervisor`, `paid_quantity`, `date`)
             VALUES (null , $id_student , $id_supervisor , $paid_quantity , $date)");

$stmt ->execute() ;
$count  = $stmt ->rowCount() ;

result($count) ;
