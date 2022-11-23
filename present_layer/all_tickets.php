<?php
//page where all tickets are shown
chdir('..'); // ---> root
include_once('./bussiness_layer/get_ticket.php');

?>
<head>
    <title>Vsetky tikety</title>
    <link rel="stylesheet" type="text/css" href="./all_tickets.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="module" src="./all_tickets.js"></script>
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
        <div id="table_to_refresh">
            <table>
                <tr>
                    <th>Kategoria</th>
                    <th>Pozicia</th>
                    <th>Status</th>
                    <th>Sprava od manazera</th>
                    <th>Cas vytvorenia</th>
                    <th>Cas modifikacie</th>
                    <th>Fotka problemu</th>
                </tr>
        </div>
        </table>
    </body>
</html>