<?php
    session_start();
    unset($_SESSION["email"]);
    echo("Odhlasujem...");
    header("refresh:0.5; ../bussiness_layer/redirect.php");

?>