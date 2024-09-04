<?php

include "../../database/connect.php";
include "../../lib/getJsonData.php";
include "../../lib/functions.php";

$class = $input['class'];

$stmt = $con->prepare("
   SELECT * FROM `information_bank` WHERE class = '$class'
");

$stmt->execute();
$count = $stmt->rowCount();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($count > 0) {
    echo json_encode(array("status" => "success", "data" => $data));
} else {
    echo json_encode(array("status" => "failure"));
}
