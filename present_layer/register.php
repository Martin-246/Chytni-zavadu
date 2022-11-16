<?php
	include '../bussiness_layer/check_register.php';

	$res = check_registration();

	switch($res)
	{
		case 0:
			echo("Úspešná registrácia");
			header("refresh:0.5; ../bussiness_layer/redirect.php");
			break;
		case 1:
			echo("Zadajte heslo!");
			break;
		case 2:
			echo("Zadajte email!");
			break;
		case 3:
			echo("Email uz existuje!");
			break;
		case 4:
			echo("Zly email!");
			break;
	}

?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="./register.css"/>
</head>

	<nav>
        <h3 class="back"><a href = "../index.php">Späť</a></h2>
    </nav> 

	<h2>Registrácia</h2>

	<form action='<? $_SERVER['PHP_SELF']?>' method='post'>
		<label for="f_name">Krstné meno:</label>
		<input type="text" name="f_name" id="f_name" value=
			<?php echo(isset($_SESSION['filled_f_name'])?$_SESSION['filled_f_name']:"" );?>
		>
		<br>

		<label for="l_name">Priezvisko:</label>
		<input type="text" name="l_name" id="l_name" value =
			<?php echo(isset($_SESSION['filled_l_name'])?$_SESSION['filled_l_name']:"" );?>
		>
		<br>

		<label for="email" class="email">Email: *</label>
		<input type="email" name="email" id="email" value=
			<?php echo(isset($_SESSION['filled_email'])?$_SESSION['filled_email']:"" );?>
		>
		<br>

		<label for="password"  class="password" >Heslo: *</label>
		<input type="password" name="password" id="password">
		<br>

		<label for="phone">Telefónne číslo:</label>
		<input type="tel" name="phone" id="phone" value=
			<?php echo(isset($_SESSION['filled_phone'])?$_SESSION['filled_phone']:"" );?>
		>

		<input type="submit">
	</form>

</html>



