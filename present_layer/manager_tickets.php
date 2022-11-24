<?php 
chdir('..'); // ---> root
include_once('./bussiness_layer/checks.php');
include_once("./bussiness_layer/manager_ticket_print.php");
include_once("./bussiness_layer/state_change.php");

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

if (isset($_POST['status']))
{
    $ticket_id = get_ID_by_submitVALUE($_POST['status']);

    $pos = strpos($_POST['status'],"_",0);
    $value = substr($_POST['status'],0,$pos);

    update_state_ticket($ticket_id, $value);
}

if (isset($_POST['contains_ticket_id_comment']))
{
    $ticket_id = get_ID_by_submitVALUE($_POST['contains_ticket_id_comment']);

    $comment = $_POST['comment'];
    update_comment_ticket($ticket_id, $comment);
}

if (isset($_POST['contains_ticket_id']))
{
    $ticket_id = get_ID_by_submitVALUE($_POST['contains_ticket_id']);

    $worker_id = $_POST['worker'];
    $task = $_POST['task'];
    insert_request($worker_id, $ticket_id, $task);
}

?>

<html>
    <head>
    <link rel="stylesheet" type="text/css" href="./manager_tickets.css" />

    <script type="text/javascript">
    var RowNested_last_num = null;

    /***
     * Expending a block of the next data under an item $row_num
     */
    function Expand($row_num)
    {
        var elem;

        // Last hiding
        if(RowNested_last_num != null && RowNested_last_num != $row_num )
        {
            elem = document.getElementsByClassName("RowNested" + RowNested_last_num);
            for(var i = 0; i < elem.length; i++)
            {
                if(elem[i].style.display == "table-row")
                    elem[i].style.display="none";
            }
        }
        
        // Actual opening
        RowNested_last_num = $row_num;
        elem = document.getElementsByClassName("RowNested" + $row_num);
        for(var i = 0; i < elem.length; i++)
        {
            if (elem[i].style.display == "none")
                elem[i].style.display="table-row";
            else
                elem[i].style.display="none";
        }
    }

    /***
     * Popping up of confirmation window, cancels in case 'No' choice
     */
    function clicked(event)
    {
        if(!confirm('Confirm the action.')){
            event.preventDefault();
            return false;
        }
        else
            return true;
    }
    /***
     * Popping up alert window if all fields aren't filled in the form $counter
     */
    function clicked_form(event, $counter)
    {
        if(clicked(event))
        {
            var elem1 = document.forms["form"+$counter]["task"].value;
            var elem2 = document.forms["form"+$counter]["worker"].value;
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
