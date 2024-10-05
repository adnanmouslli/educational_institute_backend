<?php

include "../../database/connect.php" ;

include "../../lib/getJsonData.php" ;

include "../../lib/functions.php" ;


$id_subject_teacher  = $input['id_subject_teacher'];
$day  = $input['day']; // $day = احد | اثنين | ثلاثاء | أربعاء | خميس | سبت
$hour  = $input['hour']; // for example:  $hour = 06:30AM

    
$stmt = $con ->prepare("SELECT id_teacher FROM `subject-teachers` WHERE id = '$id_subject_teacher' ") ;
$stmt ->execute();
$data = $stmt -> fetchAll(PDO::FETCH_ASSOC) ;

$id_teacher = $data[0]['id_teacher'];

$stmt = $con ->prepare("
SELECT * FROM `subject-teachers` st
JOIN `subject_dates` sd on st.id = sd.id_subject_teacher
JOIN `subject` s on st.id_subject = s.id
WHERE id_teacher = '$id_teacher' and sd.day = '$day' and  sd.hour = '$hour'
 ");
$stmt ->execute();
$count = $stmt -> rowCount() ;

if($count > 0) {

    printFailure("Time is busy");
                                                    
}
else {
            $stmt = $con ->prepare("INSERT INTO `subject_dates`(`id`, `id_subject_teacher`, `day`, `hour`) 
                                    VALUES (null , '$id_subject_teacher' , '$day' , '$hour')") ;
            $stmt ->execute();
            $count  = $stmt ->rowCount();

            if($count > 0){
                printSuccess() ;
            }
            else {
                printFailure() ;
            }
}





   



