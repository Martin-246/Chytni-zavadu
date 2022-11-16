<?php

    include_once('../data_layer/db_user.php');

    # @return   0 if OK
    #           1 if email is not given
    #           2 if password is not given
    function check_registration()
    {
        session_start();

        $email = "";
        $pw_hash = "";
        if(isset($_POST['email']))
        {
            $email = $_POST['email'];
        }
        else
            return 1;

        if(isset($_POST['password']))
        {
            $pw_hash = hash('sha256',$_POST['password'],);
        }
        else
            return 2;

        $_SESSION['email'] = $email;

        $f_name = isset($_POST['f_name']) ? $_POST['f_name'] : "";
        $l_name = isset($_POST['l_name']) ? $_POST['l_name'] : "";

        insert_user($f_name,$l_name,$email,$pw_hash);

        return 0;
    }


?>