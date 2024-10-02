<?php

include "../../database/connect.php" ;

include "../../lib/getJsonData.php" ;

include "../../lib/functions.php" ;

$id_student = $input['id_student'];

$stmt = $con->prepare("
   SELECT type , AVG(mark) as 'avg_mark' , count(*) as 'count' FROM `marks` WHERE id_student = '$id_student' and enable = 1
    GROUP BY type
");
$stmt->execute();
$count  = $stmt -> rowCount();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($count > 0) {
    echo     json_encode(array("status" => "success","data" => $data));
} else {
    echo     json_encode(array("status" => "failure"));
}