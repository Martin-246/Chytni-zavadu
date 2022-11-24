<?php 
//script which generate table for all tickets
chdir('..'); // ---> root
include_once("./bussiness_layer/checks.php");
session_start();
is_logged();
//function which prints email without domain.
//Takes: string: whole email adress (user@user.com)
//Returns: string: user part of email adress (user)
function print_user_from_email($email){ 
    $pos = strpos($email,"@",0);
    return substr($email,0,$pos);
}
?>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="./my_tickets.css" />
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="module" src="./my_tickets.js"></script>
    <script type="text/javascript" src="../bussiness_layer/remove_ticket.js"></script>
    <script type="text/javascript" src="../bussiness_layer/get_address.js"></script>
    <title>Moje tikety</title>
    </head>
    <body>
       <nav>
            <h2 class="back"><a href = "../index.php">Späť</a></h2>
            <h2 class="main">Moje tikety</h2>
            <h2 class="user">Prihlásený ako:<br><?php echo print_user_from_email($_SESSION["email"]); ?></h2>
        </nav> 
        <div id="table_to_refresh">
        <table >
            <tr>
                <th>Kategoria</th>
                <th class='pos'>Pozicia</th>
                <th>Status</th>
                <th>Sprava od manazera</th>
                <th>Cas vytvorenia</th>
                <th>Cas modifikacie</th>
                <th>Fotka problemu</th>
                <th>Akcia</th>
            </tr>           
        </table>
        </div>
    </body>
</html>