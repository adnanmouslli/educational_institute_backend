<?php

include "../../database/connect.php" ;

include "../../lib/getJsonData.php" ;

include "../../lib/functions.php" ;


$name = $input['name'];
$specialization = $input['specialization'];
$address = $input['address'];
$phone = $input['phone'];
$class = $input['class'];

$subjects = $input['subjects']; // for example: $subject = "1,2,,7" ; رقم المادة وبعدو رمز الصف تبع هل مادة  

$arr_subjects = explode("," , $subjects) ;

$stmt = $con ->prepare("INSERT INTO `teachers`(`id`, `name`, `specialization`, `address`, `phone`, `class`) 
                VALUES (null , '$name',  '$specialization' , '$address' , '$phone' , '$class')") ;
$stmt ->execute() ;
$count  = $stmt ->rowCount() ;
$id_teacher = $con -> lastInsertId() ;

if($count > 0){
    // add subjects to teacher 
    for($i = 0 ; $i < sizeof($arr_subjects) ; $i++){
        $id_sub = $arr_subjects[$i] ;

        $stmt = $con ->prepare("INSERT INTO `subject-teachers`(`id`, `id_subject`, `id_teacher`) 
            VALUES (null , '$id_sub' , '$id_teacher')") ;
        $stmt ->execute() ;     
    }
    printSuccess() ;
}
else {
    printFailure() ;
}



