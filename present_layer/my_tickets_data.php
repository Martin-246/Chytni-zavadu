<?php
chdir('..'); // ---> root
include_once("./bussiness_layer/get_ticket.php");
include_once("./data_layer/db_user.php");
session_start();
if(isset($_SESSION["email"])){
}else {
    echo "fatal error";
    exit();
}
echo "
<table>
<tr>
    <th>ID</th>
    <th>Kategoria</th>
    <th>Pozicia</th>
    <th>Status</th>
    <th>Sprava od manazera</th>
    <th>Cas vytvorenia</th>
    <th>Cas modifikacie</th>
    <th>Fotka problemu</th>
    <th>Akcia</th>
</tr>";
echo my_ticket_rows();
echo "</table>";
?>