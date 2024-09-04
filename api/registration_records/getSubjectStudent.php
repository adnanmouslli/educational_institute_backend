<?php

include "../../database/connect.php";
include "../../lib/getJsonData.php";
include "../../lib/functions.php";

$id_student = $input['id_student'];

$stmt = $con->prepare("SELECT rr.id , s.full_name , sub.name FROM `registration_records` rr 
JOIN `students` s on rr.id_student = s.id
JOIN `subject` sub ON rr.id_subject = sub.id
WHERE rr.id_student = '$id_student'
");

$stmt->execute();
$count = $stmt->rowCount();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($count > 0) {
    echo json_encode(array("status" => "success", "data" => $data));
} else {
    echo json_encode(array("status" => "failure"));
}
