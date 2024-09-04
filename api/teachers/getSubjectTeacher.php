<?php

include "../../database/connect.php";
include "../../lib/functions.php";
include "../../lib/getJsonData.php" ;


$id_teacher = $input['id_teacher'];


$stmt = $con->prepare("
SELECT st.* , t.name as teacherName , s.name as subjectName , s.class
FROM `subject-teachers` st 
JOIN `teachers` t on st.id_teacher = t.id
JOIN `subject` s on st.id_subject = s.id
where st.id_teacher = '$id_teacher'
");


$stmt->execute();
$count = $stmt->rowCount();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($count > 0) {
    echo json_encode(array("status" => "success", "data" => $data));
} else {
    echo json_encode(array("status" => "failure"));
}
