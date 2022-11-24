<?php
//script which generate table for all tickets
chdir('..'); // ---> root
include_once('./bussiness_layer/checks.php');
is_logged(); // Allow only authenticated users

include_once("./bussiness_layer/get_ticket.php");
include_once("./data_layer/db_user.php");
echo "
<table>
<tr>
    <th>Kategoria</th>
    <th class='pos'>Pozicia</th>
    <th>Status</th>
    <th>Sprava od manazera</th>
    <th>Cas vytvorenia</th>
    <th>Cas modifikacie</th>
    <th>Fotka problemu</th>
</tr>";
echo all_ticket_rows();
echo "</table>";
?>