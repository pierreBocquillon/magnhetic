<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="autentify.php" method="post">
        <input type="email" placeholder="adresse mail" name="conn_mail">
        <input type="password" placeholder="password" name="conn_mdp">
        <input type="submit">
    </form>

</body>
</html>