<?php
    if (session_id() == "")
        session_start();
    session_destroy();
    echo("Odhlasujem...");
    header("refresh:0.5; ../../bussiness_layer/redirect.php");
 
?>