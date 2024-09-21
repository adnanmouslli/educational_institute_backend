<?php

include "../../database/connect.php" ;

include "../../lib/functions.php" ;


$titlePdf = $_POST['title'];
$id_supervisor = $_POST['id_supervisor'];
$description = $_POST['description'];
$class = $_POST['class'];

$dir_uploads = "C:/xampp/htdocs/educational_institute/upload-pdf/" ;
$urlFile = fileUpload("filePdf" , $dir_uploads) ;


$stmt = $con ->prepare("INSERT INTO `information_bank`(`id`, `title`, `description`, `id_supervisor`, `class`, `urlPdf`)
 VALUES (null , '$titlePdf' , '$description' , '$id_supervisor' , '$class' , '$urlFile' )");

$stmt ->execute() ;
$count  = $stmt ->rowCount() ;

result($count) ;






