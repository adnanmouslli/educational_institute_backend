<?php

include "../../database/connect.php" ;
include "../../lib/functions.php" ;


$stmt = $con->prepare("
  SELECT * FROM `subject` WHERE class = 'B'
");

$stmt->execute();
$count  = $stmt -> rowCount() ;
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
if ($count > 0) {
    echo     json_encode(array("status" => "success","data" => $data));
} else {
    echo     json_encode(array("status" => "failure"));
}