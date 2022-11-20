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
         var elem=document.getElementsByClassName("RowNested" + $row_num);

         for(var i = 0; i < elem.length; i++)
         {
            var hide = elem[i].style.display =="none";
            if (hide) {
                elem[i].style.display="table-row";
            } 
            else {
            elem[i].style.display="none";
            }
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
                <th>Expected/Fixed date</th>
                <th>State</th>
                <th style='border:0px; width:65px'></th>
            </tr>
        <?php echo request_ticket_rows(); ?>
        </table>
        
        </div>
    </body>
</html>
