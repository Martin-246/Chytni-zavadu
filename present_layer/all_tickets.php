<?php 
session_start();
include_once('../bussiness_layer/get_ticket.php');

?>
<head><style>
body{font-family: Arial, Helvetica;
    margin:0%;
    font-size: 1rem;
    min-width: 350px;}
h2 {text-align: center;}
table {align-self: center;}
img {width:50px;height:50px;}
td {text-align: center;}
li {display: inline-block;}
li > a {padding: 10px;color: #000000 ;text-decoration: none;border: 1px solid #000000;border-radius: 5px;}
li > a:hover {background-color: #848482;color: #FFFFFFFF}
li > h2 {padding-left: 300px;}
table{border-collapse: collapse;}
th {border: 1px solid #000000;}
td {border-bottom: 1px solid #000000;}
</style>
</head>
<html>
    <body>
        <nav>
            <ul id="navbar">
                <li>
                    <a href = "../index.php">Späť</a>
                </li>
                <li>
                    <h2>Všetky tikety</h2>
                </li>
            </ul>
        </nav>
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
        <script>
            setTimeout(function(){location = ''},5000)
        </script>
    </body>
</html>