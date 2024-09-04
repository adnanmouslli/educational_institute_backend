<?php

include "../../database/connect.php" ;

include "../../lib/getJsonData.php" ;

include "../../lib/functions.php" ;


$name = $input['name'];
$class = $input['class'];
$start_date = $input['start_date'];
$end_date = $input['end_date'];


$stmt = $con ->prepare("INSERT INTO `section`(`id`, `name` , `class`, `start_date`, `end_date`)
                         VALUES (null , '$name' , '$class' , '$start_date' , '$end_date')");

$stmt ->execute() ;
$count  = $stmt ->rowCount() ;

result($count) ;
