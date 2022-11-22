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
?>

<html>
    <head>
    <link rel="stylesheet" type="text/css" href="./manager_tickets.css" />

    <script type="text/javascript">
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
