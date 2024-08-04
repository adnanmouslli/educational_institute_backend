<?php

include "../../database/connect.php" ;

include "../../lib/functions.php" ;


$titlePdf = $_POST['title'];

$id_supervisor = $_POST['id_supervisor'];


$dir_uploads = "C:/xampp/htdocs/educational_institute/upload-pdf/" ;
$urlFile = fileUpload("filePdf" , $dir_uploads) ;


$stmt = $con ->prepare("INSERT INTO `information_bank`(`id`, `title`, `urlPdf`, `id_supervisor`)
 VALUES (null , '$titlePdf' , '$urlFile' , '$id_supervisor' )");

$stmt ->execute() ;
$count  = $stmt ->rowCount() ;

result($count) ;






