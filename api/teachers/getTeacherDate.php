<?php

include "../../database/connect.php";
include "../../lib/functions.php";
include "../../lib/getJsonData.php" ;


$id_subject_teacher = $input['id_subject_teacher'] ;


$stmt = $con->prepare("
SELECT * FROM `subject_dates` WHERE id_subject_teacher = '$id_subject_teacher' ;
");

$stmt->execute();
$count = $stmt->rowCount();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($count > 0) {
    echo json_encode(array("status" => "success", "data" => $data));
} else {
    echo json_encode(array("status" => "failure"));
}
