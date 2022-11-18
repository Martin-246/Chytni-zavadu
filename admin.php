<?php
    chdir('.');
    include('./bussiness_layer/admin/check_admin.php');

    if( ! is_admin() ) 
        header('Location: ./index.php');
?>

<html>

        <head>
                <link rel="stylesheet" type="text/css" href="./present_layer/admin/admin.css"/>
        </head>

        <h2>Chytni zavadu <br><br> Admin page</h2> <br>


        <form action="./present_layer/admin/add_manager.php" class="inline">
                <button>Pridať správcu mesta</button>
        </form>

        <form action="./present_layer/authentication/logout.php" class="inline">
                <button>Odhlásiť</button>
        </form>
        
</html>