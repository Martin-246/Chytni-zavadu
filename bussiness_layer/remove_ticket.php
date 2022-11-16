<?php 
session_start();
include_once("../data_layer/db_tickets.php");
if(isset($_SESSION['ticket_to_remove'])){
    remove_ticket($_SESSION['ticket_to_remove']);
    $_SESSION['ticket_to_remove'] = "";
    header("Location: redirect.php");
}else {
    echo "fatal error";
    exit();
}
?>