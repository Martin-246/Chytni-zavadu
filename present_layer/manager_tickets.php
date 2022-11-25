<?php 
chdir('..'); // ---> root
include_once('./bussiness_layer/checks.php');
include_once("./bussiness_layer/manager_ticket_print.php");
include_once("./bussiness_layer/state_change.php");

if(session_id() == "")
    session_start();
if(! is_manager() )
    header('Location: ../index.php');

/***
 * Parsing $email string and extracting first part
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
    if($mode == 0) {
        echo "
        <option selected='selected' value=0>All</option>
        <option value=1>Not assigned</option>
        <option value=2>Assigned</option>
        <option value=3>Fixing</option>
        <option value=4>Fixed</option>";
    }
    else if($mode == 1) {
        echo "
        <option value=0>All</option>
        <option selected='selected' value=1>Not assigned</option>
        <option value=2>Assigned</option>
        <option value=3>Fixing</option>
        <option value=4>Fixed</option>";
    }
    else if($mode == 2) {
        echo "
        <option value=0>All</option>
        <option value=1>Not assigned</option>
        <option selected='selected' value=2>Assigned</option>
        <option value=3>Fixing</option>
        <option value=4>Fixed</option>";
    }
    else if($mode == 3) {
        echo "
        <option value=0>All</option>
        <option value=1>Not assigned</option>
        <option value=2>Assigned</option>
        <option selected='selected' value=3>Fixing</option>
        <option value=4>Fixed</option>";
    }
    else if($mode == 4) {
        echo "
        <option value=0>All</option>
        <option value=1>Not assigned</option>
        <option value=2>Assigned</option>
        <option value=3>Fixing</option>
        <option selected='selected' value=4>Fixed</option>";
    }
}

// Ticket status update
if (isset($_POST['status']))
{
    ticket_state_transition();
}

// The ticket message from manager update
if (isset($_POST['contains_ticket_id_comment']))
{
    ticket_message_update();
}

// Assigning a request to a worker
if (isset($_POST['contains_ticket_id']))
{
    request_assigning();
}

?>

<html>
    <head>
    <link rel="stylesheet" type="text/css" href="./manager_tickets.css" />
    <script type="text/javascript" src="./onclick.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="../bussiness_layer/get_address.js"></script>
    </head>
    
    <body>
       <nav>
            <h2 class="back"><a href = "../index.php">Späť</a></h2>
            <h2 class="main">Tickets</h2>
            <h2 class="user">Prihlásený ako:<br><?php echo print_user_from_email($_SESSION["email"]); ?></h2>
        </nav> 

        <form method="GET" action="">
        <select style='width:12%; float:right; margin-bottom: 16px;' name="filter" onchange="this.form.submit()">
            <?php 
            if(isset($_GET['filter']))
                select_output($_GET['filter']);
            else
                select_output(0);
            ?>
        </select>
        </form>

        <table cellpadding="0">
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th style='width:13%;'>Position(Street)</th>
                <th>Status</th>
                <th>Req</th>
                <th>Message from manager</th>
                <th>Time created</th>
                <th>Time modified</th>
                <th>Photo</th>
                <th style='width:5%;'>Action</th>
            </tr>
            <?php 
            if(isset($_GET['filter']))
                echo ticket_rows($_GET['filter']);
            else
                echo ticket_rows(0);
            ?>
        </table>
        
    </body>
</html>
