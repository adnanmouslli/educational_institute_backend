<?php

include "../../database/connect.php";
include "../../lib/getJsonData.php";
include "../../lib/functions.php";



$id_section = $input['id_section'];

$stmt = $con->prepare("SELECT * FROM `section-teacher` st1 JOIN `subject-teachers` st2 ON st1.id_subject_teachers = st2.id WHERE id_section = '$id_section';");
$stmt->execute();
$sections = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $con->prepare("SELECT * FROM `subject`");
$stmt->execute();
$subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);


$stmt = $con->prepare("SELECT * FROM `teachers`");
$stmt->execute();
$teachers = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $con->prepare("SELECT * FROM `subject_dates`");
$stmt->execute();
$subjectDates = $stmt->fetchAll(PDO::FETCH_ASSOC);


$details = [] ;

for($i = 0 ; $i < sizeof($sections) ; $i++) {

    $details[$i] = [] ;
    foreach($subjects as $subject){
        if($sections[$i]['id_subject'] == $subject['id']){
            $details[$i]['subjectName'] = $subject['name'] ;
            break ;
        }
    }

    foreach($teachers as $teacher){
        if($sections[$i]['id_teacher'] == $teacher['id']){
            $details[$i]['teacherName'] = $teacher['name'] ;
            $details[$i]['dates'] = [] ;
            break ;
        }
    }

    foreach($subjectDates as $subjectDate){

        
        if($sections[$i]['id_subject_teachers'] == $subjectDate['id_subject_teacher']){
           array_push($details[$i]['dates'] , ["day" => $subjectDate['day'] , "hour" => $subjectDate['hour']]);
            
        }
    }


}


if (sizeof($details) > 0) {
    echo json_encode(array("status" => "success", "data" => $details));
} else {
    echo json_encode(array("status" => "failure"));
}
