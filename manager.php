<head><style>
h1 {text-align: center;}
form {text-align: center;}
</style></head>

<?php
include_once("./bussiness_layer/checks.php");
if(session_id() == "")
    session_start();
if(! is_manager() )
    header('Location: ./index.php');
?>

<html>
<h1>Chytni závadu!</h1>

<?php echo("Logged in as: ".$_SESSION['email']); ?>

    <form action="present_layer/manager_tickets.php" class="inline">
        <button>All tickets</button>
    </form>

    <br>

    <form action="present_layer/add_worker.php" class="inline">
        <button>Pridať technického pracovníka</button>
    </form>

    <br>

    <form action="present_layer/all_tickets_map.php" class="inline">
        <button>Mapa</button>
    </form>

    <br>

    <form action="present_layer/authentication/logout.php" class="inline">
        <button>Odhlásiť</button>
    </form>

    <br>
</html>