
<?php
/***
 * @author xpavel39@stud.fit.vutbr.cz
 */
    chdir('../..'); // root
    include './bussiness_layer/authentication/check_login.php';
    $res = check_login();
?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="./register.css"/>
</head>
    <nav>
        <h3 class="back"><a href = "../../index.php">Späť</a></h2>
    </nav> 
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

<?php
    if( isset($_POST['email']) )
    {
        if($res == 0)
        {
            echo "Prihlásenie úspešné";
            header("refresh:0.5; ../../bussiness_layer/redirect.php");

        } else if($res == 1)
        {
            echo "<div class='err_msg'>Zly email!</div>";
        } else if($res == 2)
        {
            echo "<div class='err_msg'>Zle heslo!</div>";
        }
    }
?>

