<?php

include "../../database/connect.php" ;

include "../../lib/getJsonData.php" ;

include "../../lib/functions.php" ;


$id_student = $input['id_student'];


$stmt = $con->prepare("
    SELECT m.mark, sub.name AS subject_name, sp.name AS supervisor_name
    FROM marks m
    INNER JOIN subject sub ON m.id_subject = sub.id
    INNER JOIN supervisors sp ON m.id_supervisor = sp.id
    WHERE m.id_student = $id_student
");

$stmt->execute();
$count  = $stmt -> rowCount() ;
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($count > 0) {
    echo     json_encode(array("status" => "success","data" => $data));
} else {
    echo     json_encode(array("status" => "failure"));
}
