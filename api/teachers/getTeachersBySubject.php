<?php

include "../../database/connect.php";
include "../../lib/functions.php";
include "../../lib/getJsonData.php" ;

$id_sub = $input['id_sub'];

$stmt = $con->prepare("
SELECT t.* FROM `subject-teachers`  st
JOIN `teachers` t on st.id_teacher = t.id
WHERE st.id_subject = '$id_sub' 
");
$stmt->execute();
$count = $stmt->rowCount();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($count > 0) {
    echo json_encode(array("status" => "success", "data" => $data));
} else {
    echo json_encode(array("status" => "failure"));
}
