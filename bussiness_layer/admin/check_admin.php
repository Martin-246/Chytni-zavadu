<?php
    chdir('.'); // root
    include_once('./data_layer/db_user.php');
    include_once('./bussiness_layer/constants.php');
    include_once('./bussiness_layer/authentication/check_register.php');
    include_once('./bussiness_layer/constants.php');


    if (session_id() == "")
        session_start();

    function is_admin()
    {
        if(isset($_SESSION['email']))
        {
            $role = get_user_by_email($_SESSION["email"])["role"];
            if($role == ADMIN)
                return true;
        }
        
        return false;
    }

    function check_add_manager()
    {
        return check_registration(MANAGER,false);
    }

?>