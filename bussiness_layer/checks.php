<?php 
function is_logged(){
    if (isset($_SESSION["email"])){
        return 1;
    }else{
        echo "Na túto akciu musíš byť prihlasený! Redirecting to index....";
        header("refresh:5; ../bussiness_layer/redirect.php");
        exit();
    }
}

function is_logged_in()
{
    return isset($_SESSION['email']);
}

?>