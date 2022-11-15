<?php
include_once("../data_layer/db_tickets.php");
$target_dir = "../img/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
if($target_file=="../img/"){
    echo "The new tiket without file has been uploaded.";
    upload_new_ticket($_POST["category"],$_POST["lng"],$_POST["lat"],$target_file."placeholder-image.png");
    header("refresh:5;redirect.php");
    exit();
}
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
    $tmpFile = $target_file;
    $pos = strlen($target_file) - strlen($imageFileType) -1;
    for($i=0;file_exists($tmpFile);$i++){
        $tmpFile = substr_replace($target_file,$i,$pos,0);
    }
    $target_file = $tmpFile;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
  echo "Sorry, only JPG, JPEG & PNG files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded. Redirecting to main page...";
    header("refresh:5;redirect.php"); 
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    chmod($target_file, 0755);
    echo "The new tiket with file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    upload_new_ticket($_POST["category"],$_POST["lng"],$_POST["lat"],$target_file);
    header("refresh:5;redirect.php"); 
  } else {
    echo "Sorry, there was an error uploading your file.";
    header("refresh:5;redirect.php");
  }
}

?>