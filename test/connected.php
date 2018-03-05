<?php
require_once 'connection.php';
session_start();

function getInfoProfil($id_profil, $conn){
    $sql="SELECT 
            `id_profil`,
            `pseudo_profil`,
            `email_profil`,
            `bio_profil`,
            `lieu_profil`,
            `classe_profil`,
            `dispo_profil`,
            `img_profil` 
        FROM 
            `profil` 
        WHERE 
            `id_profil`=:id_profil
  ";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id_profil', $id_profil);
    $stmt->execute();
    errorHandler($stmt);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}
$res=getInfoProfil($_SESSION['pid'],$conn);
$img = $res['img_profil'];
$name = $res['pseudo_profil'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="connected.css">
    <title>Document</title>
</head>
<body id="body">
<img id="img" src="big_default.svg" >
<h1 id="h1">Bonjour </h1>
<h2 id="h2"><?php echo$name?></h2>
<script>var $pid = <?php echo $_SESSION['pid'] ?></script>
<script src="connected.js"></script>
</body>
</html>