
<head><style>
h1 {text-align: center;}
form {text-align: center;}
</style></head>

<?php
session_start();
?>

<html>

    <h1>Chytni závadu!</h1>

    <?php // Allow new user to log in

    include_once("./bussiness_layer/checks.php");

    if( ! is_logged_in())
    {
        echo '
        <form action="present_layer/login.php" class="inline">
            <button>Prihlásenie</button>
        </form>

        <br>

        <form action="present_layer/register.php" class="inline">
            <button>Regristrácia</button>
        </form>

        <br>';
    } 
    ?>

    <form action="present_layer/all_tickets.php" class="inline">
        <button>Vsetky tikety</button>
    </form>

    <br>

    <form action="present_layer/new_ticket.php" class="inline">
        <button>Nový tiket</button>
    </form>

    <br>


    <?php // Allow logged in user to log out
    if( is_logged_in())
    {

        echo '
        <form action="present_layer/my_tickets.php" class="inline">
            <button>Moje tikety</button>
        </form>

        <br>

        <form action="present_layer/logout.php" class="inline">
            <button>Odhlásiť</button>
        </form>

        <br>
        ';


    } 
    ?>


</html>

