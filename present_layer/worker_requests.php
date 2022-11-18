<?php 
chdir('..'); // ---> root
include_once('./bussiness_layer/checks.php');
include_once("./bussiness_layer/worker_ticket_print.php");

session_start();
is_logged_worker();
function print_user_from_email($email){ 
    $pos = strpos($email,"@",0);
    return substr($email,0,$pos);
}

?>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="./worker_requests.css" />

    <script type="text/javascript">
    function Expand($row_num)
    {
         var elem=document.getElementById("RowNested" + $row_num);
         var hide = elem.style.display =="none";
         if (hide) {
             elem.style.display="table-row";
        } 
        else {
           elem.style.display="none";
        }
    }
     </script>   
    </head>
    
    <body>
       <nav>
            <h2 class="back"><a href = "../index.php">Späť</a></h2>
            <h2 class="main">My requests</h2>
            <h2 class="user">Prihlásený ako:<br><?php echo print_user_from_email($_SESSION["email"]); ?></h2>
        </nav> 
        <div id="table_to_refresh">

        <table>
            <tr>
                <th>Request ID</th>
                <th>Kategoria</th>
                <th>Pozicia(Ulica)</th>
                <th>Expected date</th>
                <th>State</th>
                <th>Akcia</th>
            </tr>
        <?php echo request_ticket_rows(); ?>
        </table>
        
        </div>
    </body>
</html>
