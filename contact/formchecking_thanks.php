<?php

	$name = isset($_GET['name']) ? $_GET['name'] : false;
	$age = isset($_GET['age']) ? $_GET['age'] : false;

?><!DOCTYPE html>
<html lang="en">
<head>
	<title>Bedankt!</title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="./form-styles.css" />
</head>
<body>
	<header>
            <div class="container">
                <a href="./"><img src="./images/logo-wout-vandevelde.png" alt="logo wout vandevelde" class="logo"></a>
                <nav>
                    <ul>
                        <li><a href="./">Home</a></li>
                        <li><a href="./exercises/">Exercises</a></li>
                        <li><a href="./about-me/">About me</a></li>
                        <li><a href="./contact/">Contact</a></li>
                    </ul>
                </nav>
            </div>
    </header>
	<main>
		<?php
		echo "<p>Thank you, '$name'</p>";
		?>
	</main>
	<footer>
            <div class="container">
                <section>
                    <h2>You can also find me on</h2>
                    <ul>
                        <li>
                            <a href="https://www.linkedin.com/in/wout-vandevelde-3999a3371/" target="_blank"><img src="./images/icons/icons8-linkedin-100.png" alt="logo linkedin"></a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/wout_vandevelde_/" target="_blank"><img src="./images/icons/icons8-instagram-100.png" alt="logo instagram"></a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/wout.vandevelde.75" target="_blank"><img src="./images/icons/icons8-facebook-100.png" alt="logo facebook"></a>
                        </li>
                        <li>
                            <a href="https://github.com/Woutje69" target="_blank"><img src="./images/icons/icons8-github-100.png" alt="logo github"></a>
                        </li>
                    </ul>
                    <p class="copyright">&copy; 2025 Wout Vandevelde - copyright</p>
                </section>
            </div>
    </footer>

	<div id="debug">

<?php

	/**
	 * Helper Functions
	 * ========================
	 */

		/**
		 * Dumps a variable
		 * @param mixed $var
		 * @return void
		 */
		function dump($var) {
			echo '<pre>';
			var_dump($var);
			echo '</pre>';
		}


	/**
	 * Main Program Code
	 * ========================
	 */

		// dump $_GET
		dump($_GET);

?>

	</div>

</body>
</html>
