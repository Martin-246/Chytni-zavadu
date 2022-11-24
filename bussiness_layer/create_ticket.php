<?php
if(session_id() == "")
  session_start();
//default anonymous user for tickets registred by non registred users
$author = "user@user.com";
//if user is logged, use his email
if (isset($_SESSION["email"])){
  $author = $_SESSION["email"];
}
include_once("../data_layer/db_tickets.php");
//handling of upload of image:
$target_dir = "../img/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//if no image was posted, use placeholdeer
if($target_file=="../img/"){
  echo "<h2>Nový tiket je nahratý bez obrázku.</h2><br><h3>Presmerujeme vás na hlavnú stránku...</h3>";
  upload_new_ticket($_POST["category"],$_POST["lng"],$_POST["lat"],$target_file."placeholder-image.png",$author);
  header("refresh:1;redirect.php");
  exit();
}
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "Súbor je obrázok - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "<h1>Súbor nieje obrázok.</h1>";
    $uploadOk = 0;
  }
}

// Check if file already exists, if it exists create unique name for file
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
  echo "<h1>Osprapravedlňujem sa ale váš súbor je príliš veľký.</h1>";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
  echo "<h1>Povolené su iba formáty jpg, ong, a jpeg.</h1>";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<h2>Ospravedlňujeme sa, ale nepodarilo sa nahrať váš súbor.</h2><br><h3>Presmerujeme vás na hlavnú stránku...<h3>";
    header("refresh:3;redirect.php");
// if everything is ok, try to upload file, else redirect
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    chmod($target_file, 0755);
    echo "<h2>Nový tiket je nahratý s obrákom ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). ".</h2>";
    upload_new_ticket($_POST["category"],$_POST["lng"],$_POST["lat"],$target_file,$author);
    header("refresh:1;redirect.php");
  } else {
    echo "<h2>Ospravedlňujeme sa nastala chyba s vaším súborom.</h2><br><h3>Presmerujeme vás na hlavnú stránku...<h3>";
    header("refresh:3;redirect.php");
  }
}

?>