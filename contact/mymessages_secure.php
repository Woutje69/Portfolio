<?php

// Constanten (connectie-instellingen databank)
define('DB_HOST', 'localhost');
define('DB_USER', 'wout_vandevelde');
define('DB_PASS', 'plopmelk123');
define('DB_NAME', 'portfolio_database');

date_default_timezone_set('Europe/Brussels');

// Verbinding maken met de databank
try {
    $db = new PDO('mysql:host=' . DB_HOST .';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Verbindingsfout: ' .  $e->getMessage();
    exit;
}

// Opvragen van alle taken uit de tabel tasks
$stmt = $db->prepare('SELECT * FROM messages ORDER BY added_on DESC');
$stmt->execute();
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);


?><!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <title>Mijn berichten</title>
    <link rel="stylesheet" type="text/css" href="./form-styles.css" />
</head>
<body>
    <?php if (sizeof($items) > 0) { ?>
    <table>
        <thead>
            <th>naam</th>
            <th>email</th>
            <th>bericht</th>
            <th>gevonden via</th>
        </thead>
        <tbody>
            <?php foreach ($items as $item) { ?>
                <tr>
                    <td><?php echo $item['sender']; ?>: </td>
                    <td><?php echo $item['email']; ?>: </td>
                    <td><?php echo $item['message']; ?> </td>
                    <td><?php echo $item['found on']; ?>: </td>
                    <td>(<?php echo (new Datetime($item['added_on']))->format('d-m-Y H:i:s'); ?>)</td>
                </tr>
            <?php } ?>

        </tbody>
    </table>
    <?php
    } else {
        echo '<p>Nog geen berichten ontvangen.</p>' . PHP_EOL;
    }
    ?>
</body>