<?php

// Show all errors (for educational purposes)
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

// Constanten (connectie-instellingen databank)
define('DB_HOST', 'localhost');
define('DB_USER', 'wout_vandevelde');
define('DB_PASS', 'plopmelk123');
define('DB_NAME', 'portfolio_database');

date_default_timezone_set('Europe/Brussels');

// Verbinding maken met de databank
try {
    $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Verbindingsfout: ' . $e->getMessage();
    exit;
}

$name = isset($_POST['name']) ? (string)$_POST['name'] : '';
$mail = isset($_POST['email']) ? (string)$_POST['email'] : '';
$found = isset($_POST['found']) ? (string)$_POST['found'] : '';
$message = isset($_POST['message']) ? (string)$_POST['message'] : '';
$msgName = '';
$msgMail = '';
$msgFound = '';
$msgMessage = '';

// form is sent: perform formchecking!
if (isset($_POST['btnSubmit'])) {

    $allOk = true;

    // name not empty
    if (trim($name) === '') {
        $msgName = 'Gelieve een naam in te voeren';
        $allOk = false;
    }
    
    if (trim($mail) === '') {
        $msgMail = 'Gelieve een mail in te voeren';
        $allOk = false;
    }

    if (trim($found) === '') {
        $msgFound = 'Gelieve een optie te kiezen';
        $allOk = false;
    }

    if (trim($message) === '') {
        $msgMessage = 'Gelieve een boodschap in te voeren';
        $allOk = false;
    }

    // end of form check. If $allOk still is true, then the form was sent in correctly
    if ($allOk) {
        // build & execute prepared statement
        $stmt = $db->prepare('INSERT INTO messages (sender, email, message, found, added_on) VALUES (?, ?, ?)');
        $stmt->execute(array($name, $mail, $message, $found, (new DateTime())->format('Y-m-d H:i:s')));

        // the query succeeded, redirect to this very same page
        if ($db->lastInsertId() !== 0) {
            header('Location: formchecking_thanks.php?name=' . urlencode($name));
            exit();
        } // the query failed
        else {
            echo 'Databankfout.';
            exit;
        }

    }

}

?><!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Funnel+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../styles/normalize.css">
        <link rel="stylesheet" type="text/css" href="../styles/main-styles.css">
        <link rel="stylesheet" type="text/css" href="./form-styles.css">
        <title>Contact</title>
    </head>
    <body>
         <header>
            <div class="container">
                <a href="../" id="logo"><img src="../images/logo-wout-vandevelde.png" alt="logo wout vandevelde" class="logo"></a>
                <nav>
                    <ul>
                        <li><a href="../">Home</a></li>
                        <li><a href="../exercises/">Exercises</a></li>
                        <li><a href="../about-me/">About me</a></li>
                        <li><a href="../contact/">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        <main>
            <div class="container">
                <h1>Contact me</h1>
                <section>
                    <h2 class="visually-hidden">contactform</h2>
                    
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <p class="message">Alle velden zijn verplicht, tenzij anders aangegeven.</p>
                    
                            <div>
                                <label for="name">Jouw naam</label>
                                <input type="text" id="name" name="name" value="<?php echo htmlentities($name); ?>" class="input-text"/>
                                <span class="message error"><?php echo $msgName; ?></span>
                            </div>

                            <div>
                                <label for="email">Jouw e-mail</label>
                                <input type="email" id="email" name="email" value="<?php echo htmlentities($mail); ?>" class="input-text"/>
                                <span class="message error"><?php echo $msgMail; ?></span>
                            </div>

                            <fieldset>
                                <legend>Hoe heb je mij gevonden</legend>
                                <div>
                                    <input type="checkbox" name="found[]" id="found0" value="google"/>
                                    <label for="found0">Google</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="found[]" id="found1" value="linkedin"/>
                                    <label for="found1">LinkedIn</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="found[]" id="found2" value="instagram"/>
                                    <label for="found2">Instagram</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="found[]" id="found3" value="github"/>
                                    <label for="found3">GitHub</label>
                                </div>
                            </fieldset>
                    
                            <div>
                                <label for="message">Boodschap</label>
                                <textarea name="message" id="message" rows="5" cols="40"><?php echo htmlentities($message); ?></textarea>
                                <span class="message error"><?php echo $msgMessage; ?></span>
                            </div>
                    
                            <input type="submit" id="btnSubmit" class="button" name="btnSubmit" value="Verstuur"/>
                        </form>
                </section>
            </div>
        </main>
        <footer>
            <div class="container">
                <p class="copyright">&copy; 2025 Wout Vandevelde - copyright</p>
            </div>
        </footer>
    </body>
</html>
