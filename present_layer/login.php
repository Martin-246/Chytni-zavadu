<head><style>
h2 {text-align: center;}
form {text-align: center;}
</style></head>

<html>
    <h2> Prihláste sa</h2>
    <form action="<? $_SERVER['PHP_SELF'] ?>" method='post'>
        <label for='mail'> E-mail: </label>
        <input type='text' name='mail' id='mail'> <br>

        <label for='pwd'> Heslo: </label>
        <input type='password' name='pwd' id='pwd'> <br>

        <input type='submit' value='Odoslať'>
    </form>
</html>