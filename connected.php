<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="connection.css">
    <title>Connected</title>
</head>
<body>
    <img id="magnet" src="magnet.svg">
    <img id="logo" src="logo_magnhetic.svg">
    <img id="wave" src="wave.svg">
    <h3>cliquer pour continuer</h3>
    <form action="autentify.php" method="post">
        <input type="email" placeholder="adresse mail" id="mail" name="conn_mail" value="">
        <input type="password" placeholder="password" id="pass" name="conn_mdp" value="">
        <input type="submit" id="submit">
    </form>
    <script src="connection.js"></script>
    <script src="pass.js"></script>
</body>
</html>