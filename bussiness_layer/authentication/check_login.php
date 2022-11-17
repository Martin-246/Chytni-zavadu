<?php
    include('../../data_layer/db_user.php');
    session_start();


    ## check is email and password are correct
    # @return   0 if OK
    #           1 if email is wrong
    #           2 if password is wrong 
    function check_login() 
    {
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
    
        $user = get_user_by_email($email);
        if($user == null)
            return 1;
    
        if(hash('sha256',$password) == $user['PW_HASH'])
        {
            // User is logged in
            $_SESSION['email'] = $email;
            return 0;
        } else
        {
            $_SESSION['filled_email'] = $email;
            return 2;
        }
    }

?>