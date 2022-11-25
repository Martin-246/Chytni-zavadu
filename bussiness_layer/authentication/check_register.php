<?php
/***
 * @author xpavel39@stud.fit.vutbr.cz
 */
    if (session_id() == "")
        session_start();
    include_once('./data_layer/db_user.php');

    # @return   0 if OK
    #           1 if email is not given
    #           2 if password is not given
    #           3 if email already exists
    #           4 if email is not in correct format
    #           5 if nothing was submitted
    function check_registration($role = 0, $also_login = true)
    {
        if( ! registration_submitted() )
            return 5;

        $email = "";
        $pw_hash = "";
        
        // Store inputed data
        $_SESSION['filled_f_name'] = isset($_POST['f_name'])?$_POST['f_name']:"";
        $_SESSION['filled_l_name'] = isset($_POST['l_name'])?$_POST['l_name']:"";
        $_SESSION['filled_phone'] = isset($_POST['phone'])?$_POST['phone']:"";

        if(isset($_POST['email']))
        {
            if( ! email_ok($_POST['email']))
                return 4;
            $email = $_POST['email'];
            $_SESSION['filled_email'] = $email;
        }
        else
            return 1;

        if(isset($_POST['password']))
        {
            $pw_hash = hash('sha256',$_POST['password'],);
        }
        else
            return 2;

        // Check if user with given email is already registered
        if(get_user_by_email($email) !== false)
        {
            // email already exists
            return 3;
        }

        // Data is valid
        if($also_login)
            $_SESSION['email'] = $email;

        $f_name = isset($_POST['f_name']) ? $_POST['f_name'] : "";
        $l_name = isset($_POST['l_name']) ? $_POST['l_name'] : "";
        $phone = isset($_POST['phone']) ? $_POST['phone'] : "";

        insert_user($f_name,$l_name,$email,$phone,$pw_hash,$role);

        unset_filled_data();

        return 0;
    }

    /***
     * Check if $email is in the format of an email adress.
     */
    function email_ok($email)
    { 
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /***
     * Determine if the registration form has been submitted yet
     */
    function registration_submitted()
    {
        return (isset($_POST['f_name']) || isset($_POST['l_name']) ||  isset($_POST['email']) || isset($_POST['password']) || isset($_POST['phone']) );
    }

    /***
     * Unset all data filled in froms from session
     */
    function unset_filled_data()
    {
        unset($_SESSION['filled_email']);
        unset($_SESSION['filled_f_name']);
        unset($_SESSION['filled_l_name']);
        unset($_SESSION['filled_phone']);
    }

?>