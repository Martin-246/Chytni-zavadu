<head><style>
h2 {text-align: center;}
form {text-align: center;}
</style></head>

<html>
    <h2> Prihláste sa</h2>
    <form action='<? $_SERVER['PHP_SELF']?>' method='post'>
        <label for='email'> E-mail: </label>
        <input type='text' name='email' id='email'> <br>

        <label for='password'> Heslo: </label>
        <input type='password' name='password' id='password'> <br>

        <input type='submit' value='Odoslať'>
    </form>
</html>

<?php
    include '../bussiness_layer/check_login.php';

    if( isset($_POST['email']) )
    {
        $res = check_login();
        if($res == 0)
        {
            echo "Prihlaseny\n";
        } else if($res == 1)
        {
            echo "Zly email!\n";
        } else if($res == 2)
        {
            echo "Zle heslo!\n";
        }
    }
?>