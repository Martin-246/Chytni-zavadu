<?php

    function check_registration()
    {
        $email = "";
        if(isset($_POST['email']))
        {
            $email = $_POST['email'];
            $_SESSION['email'] = $email;
        }
        else
        {
            return 1;
        }

        if(isset($_POST['password']))
        {
            
        }
        else
        {
            return 2;
        }


            return 0;
    }


?>