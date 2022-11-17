<?php
include_once("../data_layer/db_user.php");
include_once("../bussiness_layer/worker_ticket_print.php");
session_start();
if(isset($_SESSION["email"])){
}else {
    echo "fatal error";
    exit();
}
echo "
<table>
<tr>
    <th>Ticket ID</th>
    <th>Kategoria</th>
    <th>Pozicia(Ulica)</th>
    <th>Request Status</th>
    <th>Fix date</th>
    <th>Akcia</th>
</tr>";
echo request_ticket_rows();
echo "</table>";
?>