<?php
    chdir('../..'); // ---> root

    if (session_id() == "")
        session_start();

    include_once('./bussiness_layer/admin/check_admin.php');

    if( ! is_admin() )
    {
        // user needs to be logged in as ADMINISTRATOR
        header('refresh:1; ../../index.php');
        echo("Nie ste administrátor!");
        exit();
    }

?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../../present_layer/admin/admin.css"/>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="module" src="./user_list.js"></script>
    </head>

    <h2 class="main">Správa užívateľov</h2>
    <nav>
        <h3 class="back"><a href = "../../index.php">Späť</a></h2>
    </nav> 

    <table id="table_to_refresh"></table> 

</html>