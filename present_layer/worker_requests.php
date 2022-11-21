<?php 
chdir('..'); // ---> root
include_once('./bussiness_layer/checks.php');
include_once("./bussiness_layer/worker_ticket_print.php");
include_once("./data_layer/db_request.php");

session_start();
is_logged_worker();

function print_user_from_email($email){ 
    $pos = strpos($email,"@",0);
    return substr($email,0,$pos);
}

function get_reqID_by_submitVALUE($submit_value)
{
    $pos = strpos($submit_value,"_",0);
    $id_char = substr($submit_value,$pos+1,strlen($submit_value));

    return intval($id_char);
}

function worker_0_1()
{
    $req_id = get_reqID_by_submitVALUE($_POST['contains_request_id_0_1']);

    $sql_date = date('Y-m-d', strtotime($_POST['expected_date']));
    $price = $_POST['price'];
    $comment = $_POST['comment'];
    
    state_update_0_1($req_id, $sql_date, $price, $comment);
}

function worker_1_2()
{
    $req_id = get_reqID_by_submitVALUE($_POST['contains_request_id_1_2']);

    state_update_1_2($req_id);
}

if (isset($_POST['contains_request_id_0_1'])) // Expected_date & Price sending (0 -> 1 state).
{
    worker_0_1();
}
else if (isset($_POST['contains_request_id_1_2'])) // Request finishing (1 -> 2 state).
{
    worker_1_2();
}
?>

<html>
    <head>
    <link rel="stylesheet" type="text/css" href="./worker_requests.css" />

    <script type="text/javascript">
    function Expand($row_num)
    {
         var elem = document.getElementsByClassName("RowNested" + $row_num);

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

    function clicked(event)
    {
        if(!confirm('Confirm the action.')){
            event.preventDefault();
            return false;
        }
        else
            return true;
    }
    function clicked_0_1(event, $counter)
    {
        if(clicked(event))
        {
            var elem1 = document.forms["form"+$counter]["price"].value;
            var elem2 = document.forms["form"+$counter]["expected_date"].value;
            if (elem1 == "" || elem2 == "") {
                alert("Fill in all the fields!");
                event.preventDefault();
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
