<?php 
chdir('..'); // ---> root
include_once('./bussiness_layer/checks.php');
session_start();
is_logged_worker();
function print_user_from_email($email){ 
    $pos = strpos($email,"@",0);
    return substr($email,0,$pos);
}

?>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="./my_tickets.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script> 
    setInterval(function () {
        $.ajax({
            url:'worker_requests_content.php',
            success: function(response){
                $('#table_to_refresh').html(response);
            }
        });
    }, 1000); 
    </script>
    
    </head>
    <body>
       <nav>
            <h2 class="back"><a href = "../index.php">Späť</a></h2>
            <h2 class="main">My requests</h2>
            <h2 class="user">Prihlásený ako:<br><?php echo print_user_from_email($_SESSION["email"]); ?></h2>
        </nav> 
        <div id="table_to_refresh">
        <table >
            <tr>
                <th>Ticket ID</th>
                <th>Kategoria</th>
                <th>Pozicia(Ulica)</th>
                <th>Request Status</th>
                <th>Fix date</th>
                <th>Akcia</th>
            </tr>
        </table>
        </div>
    </body>
</html>
