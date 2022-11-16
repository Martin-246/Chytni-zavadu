<html>
<head>
	<link rel="stylesheet" type="text/css" href="./register.css"/>
</head>

	<h2>Registrácia</h2>

	<form action='<? $_SERVER['PHP_SELF']?>' method='post'>
		<label for="f_name">Krstné meno:</label>
		<input type="text" name="f_name" id="f_name">
		<br>

		<label for="l_name">Priezvisko:</label>
		<input type="text" name="l_name" id="l_name">
		<br>

		<label for="email">Email:</label>
		<input type="email" name="email" id="email">
		<br>

		<label for="password">Heslo:</label>
		<input type="password" name="password" id="password">

		<input type="submit">
	</form>

</html>



<?php
	include '../bussiness_layer/check_register.php';

	$res = check_registration();

	if($res == 0)
	{
		echo("SI PRIHLASENY");
	}
?>
