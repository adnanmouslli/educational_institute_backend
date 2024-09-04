<?php

include "../../database/connect.php" ;

include "../../lib/getJsonData.php" ;

include "../../lib/functions.php" ;


$id_teacher = $input['id_teacher'];


$stmt = $con ->prepare("
DELETE FROM `subject_dates` 
WHERE id_subject_teacher in (SELECT st.id FROM `subject-teachers` st WHERE st.id_teacher = '$id_teacher')") ;
$stmt ->execute() ;

$stmt = $con ->prepare("
DELETE FROM `subject-teachers` WHERE id_teacher = '$id_teacher' ") ;
$stmt ->execute() ;

$stmt = $con ->prepare("
DELETE FROM `teachers` WHERE id = '$id_teacher' ") ;
$stmt ->execute() ;
$count = $stmt -> rowCount() ;

if($count > 0){
   
    printSuccess() ;
}
else {
    printFailure() ;
}



