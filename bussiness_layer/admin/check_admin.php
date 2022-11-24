<?php
/***
 * @author xpavel39@stud.fit.vutbr.cz
 */
    chdir('.'); // root
    include_once('./data_layer/db_user.php');
    include_once('./bussiness_layer/constants.php');
    include_once('./bussiness_layer/authentication/check_register.php');
    include_once('./bussiness_layer/constants.php');


    if (session_id() == "")
        session_start();

    /***
     * Determine if logged in user has administrator rights
     */
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

    /***
     * Check if data submitted by form to register new manager are correct.
     * If they are, also add the manager to database
     */
    function check_add_manager()
    {
        return check_registration(MANAGER,false);
    }

    /***
     * Check that the logged user is admin. If it isn't redirect to 'index.php'.
     */
    function enforce_admin()
    {
        if (session_id() == "")
            session_start();

        if( ! is_admin() )
        {
            // user needs to be logged in as ADMINISTRATOR
            header('refresh:1; ../../index.php');
            echo("Nie ste administrátor!");
            exit();
        }
    }

?>