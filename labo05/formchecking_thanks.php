<?php

	$name = isset($_GET['name']) ? $_GET['name'] : false;
	$age = isset($_GET['age']) ? $_GET['age'] : false;

?><!DOCTYPE html>
<html lang="en">
<head>
	<title>Bedankt!</title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="./styles.css" />
</head>
<body>

<?php


		echo "<p>Thank you, {$name}</p>";


?>
</body>
</html>
