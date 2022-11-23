<?php
/***
 * Logout the current user
 * @author xpavel39@stud.fit.vutbr.cz
 */
    if (session_id() == "")
        session_start();
    session_destroy();
    echo("Odhlasujem...");
    header("refresh:0.5; ../../bussiness_layer/redirect.php");
 
?>