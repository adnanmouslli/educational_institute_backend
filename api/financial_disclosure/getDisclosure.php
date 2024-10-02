<?php

include "../../database/connect.php";
include "../../lib/getJsonData.php";
include "../../lib/functions.php";

$id_student = $input['id_student'];

// Update the query to join with the supervisors table
$stmt = $con->prepare("
   SELECT fd.* , s.username FROM `financial_disclosure` fd
JOIN `supervisors` s ON fd.id_supervisor = s.id
WHERE id_student = $id_student;
");
$stmt->execute();
$count = $stmt->rowCount();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($count > 0) {
    echo json_encode(array("status" => "success", "data" => $data));
} else {
    echo json_encode(array("status" => "failure"));
}