<?php

include "../../database/connect.php" ;

include "../../lib/getJsonData.php" ;

include "../../lib/functions.php" ;


$id_student = $input['id_student'];
$id_subjects = $input['id_subjects']; // for example: $id_subjects = "1,2,3" , معرف المواد المراد تنزيلها

$listIdSubjects = explode("," , $id_subjects) ;

foreach($listIdSubjects as $id_sub) {

    $stmt = $con ->prepare("INSERT INTO `registration_records`(`id`, `id_student`, `id_subject`) 
                            VALUES (null , '$id_student' , '$id_sub')");
    
    $stmt ->execute() ;

}

$count  = $stmt ->rowCount() ;

result($count) ;
