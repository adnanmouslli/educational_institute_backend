<?php

include "../../database/connect.php" ;

include "../../lib/getJsonData.php" ;

include "../../lib/functions.php" ;


$id_student = $input['id_student'];
$id_supervisor = $input['id_supervisor'];
$paid_quantity = $input['paid_quantity'];



$stmt = $con ->prepare("SELECT SUM(paid_quantity) as sum FROM `financial_disclosure` WHERE id_student = '$id_student'");
$stmt ->execute() ;
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = 3000000 ;

$dif = $total - (int)$data[0]['sum'] ;

if($dif == 0){
    echo     json_encode(array("status" => "failure", "message" => "تم دفع جميع القسط من قبل الطالب !!"));
}else {

    if($paid_quantity > $dif) {
        $inc = abs($paid_quantity - $dif);
        echo     json_encode(array("status" => "failure", "message" => "يوجد زيادة بالمبلغ بمقدار : $inc!!"));

    }else {
        $stmt = $con ->prepare("INSERT INTO `financial_disclosure`(`id`, `id_student`, `id_supervisor`, `paid_quantity`)
             VALUES (null , $id_student , $id_supervisor , $paid_quantity)");

        $stmt ->execute() ;
        $count  = $stmt ->rowCount() ;

        result($count) ;

    }

}




