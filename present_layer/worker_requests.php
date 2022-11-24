<?php 
chdir('..'); // ---> root
include_once("./data_layer/db_request.php");
include_once('./bussiness_layer/checks.php');
include_once("./bussiness_layer/worker_ticket_print.php"); //*worker_request_print
include_once("./bussiness_layer/state_change.php");

session_start();
if(! is_worker() )
    header('Location: ../index.php');

/***
 * Parsing email string and extracting first part
 * @return username
 */
function print_user_from_email($email){ 
    $pos = strpos($email,"@",0);
    return substr($email,0,$pos);
}

/***
 * Outputing select options depending on filter $mode
 */
function select_output($mode)
{
    if($mode == 3) {
        echo "
        <option selected='selected' value=3>All</option>
        <option value=0>Zaevidovaný</option>
        <option value=1>Pracujeme na tom</option>
        <option value=2>Vyriešené</option>";
    }
    else if($mode == 0) {
        echo "
        <option value=3>All</option>
        <option selected='selected' value=0>Zaevidovaný</option>
        <option value=1>Pracujeme na tom</option>
        <option value=2>Vyriešené</option>";
    }
    else if($mode == 1) {
        echo "
        <option value=3>All</option>
        <option value=0>Zaevidovaný</option>
        <option selected='selected' value=1>Pracujeme na tom</option>
        <option value=2>Vyriešené</option>";
    }
    else if($mode == 2) {
        echo "
        <option value=3>All</option>
        <option value=0>Zaevidovaný</option>
        <option value=1>Pracujeme na tom</option>
        <option selected='selected' value=2>Vyriešené</option>";
    }
}

// Expected_date & Price sending (0 -> 1 state)
if (isset($_POST['contains_request_id_0_1']))
{
    worker_0_1();
}
// Request finishing (1 -> 2 state)
else if (isset($_POST['contains_request_id_1_2'])) 
{
    worker_1_2();
}
?>

<html>
    <head>
    <link rel="stylesheet" type="text/css" href="./worker_requests.css" />
    <script type="text/javascript" src="./onclick.js"></script>
    </head>
    
    <body>
       <nav>
            <h2 class="back"><a href = "../index.php">Späť</a></h2>
            <h2 class="main">My requests</h2>
            <h2 class="user">Prihlásený ako:<br><?php echo print_user_from_email($_SESSION["email"]); ?></h2>
        </nav> 

        <form method="GET" action="">
        <select style='width:12%; float:right; margin-bottom: 16px;' name="filter" onchange="this.form.submit()">
            <?php 
            if(isset($_GET['filter']))
                select_output($_GET['filter']);
            else
                select_output(3);
            ?>
        </select>
        </form>

        <table cellpadding="0">
            <tr>
                <th>Request ID</th>
                <th>Kategoria</th>
                <th>Pozicia(Ulica)</th>
                <th>Expected/Fixed date</th>
                <th>State</th>
                <th style='border:0px; width:65px'></th>
            </tr>
            <?php 
            if(isset($_GET['filter']))
                echo request_ticket_rows($_GET['filter']);
            else
                echo request_ticket_rows(3);
            ?>
        </table>
        
    </body>
</html>
