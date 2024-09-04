<?php

include "../../database/connect.php" ;

include "../../lib/getJsonData.php" ;

include "../../lib/functions.php" ;


$name = $input['name'];
$class = $input['class']; // if class = 'T' => "تاسع" else if class = 'B' => 'بكلوريا'



$stmt = $con ->prepare("INSERT INTO `subject`(`id`, `name`, `class`) VALUES (null , '$name' , '$class')");

$stmt ->execute() ;
$count  = $stmt ->rowCount() ;

result($count) ;
