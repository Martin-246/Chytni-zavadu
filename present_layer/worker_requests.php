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
     * Popping up of confirmation window, cancels in case 'No' choice. Then alert window if all fields aren't filled in the form $counter
     */
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

        <!-- all output TODO -->
        <form method="GET" action="">
        <select name="filter" onchange="this.form.submit()">
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
                echo request_ticket_rows(0);
            ?>
        </table>
        
    </body>
</html>
