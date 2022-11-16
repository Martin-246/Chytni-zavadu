
<?php
    include '../bussiness_layer/check_login.php';

    if( isset($_POST['email']) )
    {
        $res = check_login();
        if($res == 0)
        {
            echo "Prihlásenie úspešné";
            header("refresh:0.5; ../bussiness_layer/redirect.php");

        } else if($res == 1)
        {
            echo "Zly email!\n";
        } else if($res == 2)
        {
            echo "Zle heslo!\n";
        }
    }
?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="./register.css"/>
</head>
    <h2> Prihláste sa</h2>
    <form action='<? $_SERVER['PHP_SELF']?>' method='post'>
        <label for='email'> E-mail: </label>
        <input type='text' name='email' id='email' value=

            <?php echo(isset($_SESSION['filled_email'])?$_SESSION['filled_email']:"" );?>

        > <br>

        <label for='password'> Heslo: </label>
        <input type='password' name='password' id='password'> <br>

        <input type='submit' value='Odoslať'>
    </form>
</html>

