<?php 
include_once("./data_layer/db_user.php");

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

function is_logged_worker()
{
    if (is_logged_in()){
        $role = get_user_by_email($_SESSION["email"])["role"];
        if(!strncmp($role, '1', 1)) // int role?
        {
            return 1;
        }
    }else{
        //$pwd = (dir(getcwd()))->path;
        echo "Na túto akciu musíš mať rolu údržbára! Redirecting to index....";
        header("refresh:5; ../bussiness_layer/redirect.php");
        exit();
    }
}

function worker_index()
{   
include_once("./data_layer/db_user.php");
    if(is_logged_in()){
        $role = get_user_by_email($_SESSION["email"])["role"];
        if(!strncmp($role, '1', 1)) // int role?
        {
            header("Location: ./worker.php");
        }
    }
}

?>