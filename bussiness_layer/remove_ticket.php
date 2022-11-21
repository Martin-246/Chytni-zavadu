<?php 
include_once("../data_layer/db_tickets.php");
if(isset($_POST['remove_ticket'])){
    remove_ticket($_POST['remove_ticket']);
}
?>