<?php 
chdir('..'); // ---> root
include_once('./bussiness_layer/checks.php');
include_once("./bussiness_layer/manager_ticket_print.php");

session_start();
if(! is_manager() )
    header('Location: ../index.php');

function print_user_from_email($email){ 
    $pos = strpos($email,"@",0);
    return substr($email,0,$pos);
}

function get_ID_by_submitVALUE($submit_value)
{
    $pos = strpos($submit_value,"_",0);
    $id_char = substr($submit_value,$pos+1,strlen($submit_value));

    return intval($id_char);
}

function select_output($mode)
{
    if($mode == 0) {
        echo "
        <option selected='selected' value=0>0000000</option>
        <option value=1>1111111</option>
        <option value=2>2222222</option>";
    }
    else if($mode == 1) {
        echo "
        <option value=0>0000000</option>
        <option selected='selected' value=1>1111111</option>
        <option value=2>2222222</option>";
    }
    else if($mode == 2) {
        echo "
        <option value=0>0000000</option>
        <option value=1>1111111</option>
        <option selected='selected' value=2>2222222</option>";
    }
}

if (isset($_POST['contains_ticket_id']))
{
    $ticket_id = get_ID_by_submitVALUE($_POST['contains_ticket_id']);

    //update_state_ticket($ticket_id, 1);

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

    function Expand($row_num)
    {
        var elem;

        // Last hiding
        if(RowNested_last_num != null && RowNested_last_num != $row_num )
        {
            elem = document.getElementsByClassName("RowNested" + RowNested_last_num);
            if(elem[0].style.display == "table-row")
                elem[0].style.display="none";
        }
        
        // Actual opening
        RowNested_last_num = $row_num;
        elem = document.getElementsByClassName("RowNested" + $row_num);

        if (elem[0].style.display == "none")
            elem[0].style.display="table-row";
        else
            elem[0].style.display="none";
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

        <!-- all output TODO -->
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

        <table>
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Position(Street)</th>
                <th>Status</th>
                <th>Message from manager</th>
                <th>Creation time</th>
                <th>Photo</th>
                <th>Action</th>
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
