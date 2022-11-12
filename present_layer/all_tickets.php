<?php 
session_start();
include_once('../bussiness_layer/get_ticket.php');

?>
<head><style>
h2 {text-align: center;}
table {align-self: center;}
img {width:50px;height:50px;}
td {text-align: center;}
</style></head>
<html>
    <body>
        <h2>Všetky tikety</h2><br>
        <table style="width:100%">
            <tr>
                <th>ID</th>
                <th>Kategoria</th>
                <th>Pozicia</th>
                <th>Status</th>
                <th>Sprava od manazera</th>
                <th>Cas vytvorenia</th>
                <th>Cas modifikacie</th>
                <th>Fotka problemu</th>
            </tr>
            <?php print_all_tickets_table_row();?>
        </table>
    </body>
</html>