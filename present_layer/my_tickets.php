<?php 
include_once("../bussiness_layer/checks.php");
session_start();
if (is_logged()){
    echo "si prihlaseny";
}
?>