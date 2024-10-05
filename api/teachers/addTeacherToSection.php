<?php

include "../../database/connect.php" ;

include "../../lib/getJsonData.php" ;

include "../../lib/functions.php" ;


$id_subject_teacher  = $input['id_subject_teacher'];
$id_section  = $input['id_section'];

    
$stmt = $con ->prepare("SELECT * FROM `section-teacher` WHERE id_section = '$id_section' AND id_subject_teachers = '$id_subject_teacher'") ;
$stmt ->execute();

$count = $stmt -> rowCount() ;

if($count > 0) {

    printFailure("المدرس يقوم بتدريس هذه المادة في هذه الشعبة بالفعل!!");
                                                    
}
else {
            $stmt = $con ->prepare("
                SELECT * FROM `section-teacher` 
                                WHERE id_subject_teachers in (SELECT id FROM `subject-teachers` 
								        WHERE id_subject in (SELECT id_subject FROM `subject-teachers`
         						    			WHERE id_subject = (select id_subject from `subject-teachers` WHERE id = '$id_subject_teacher')))     
                                     ") ;
            $stmt ->execute();
            
            $count = $stmt -> rowCount() ;
            
            if($count > 0) {

                printFailure("هذه المادة يتم تدريسها بالفعل في هذه الشعبة !!");
                                                                
            }
            else{
                $stmt = $con ->prepare("INSERT INTO `section-teacher`(`id`, `id_section`, `id_subject_teachers`) 
                VALUES (null , '$id_section' , '$id_subject_teacher')") ;
            $stmt ->execute();
            $count  = $stmt ->rowCount();

            if($count > 0){
                printSuccess() ;
            }
            else {
                printFailure() ;
            }

            }

           
}





   



