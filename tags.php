<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<article>
<?php
require_once 'connection.php';
function getTags($conn){
    $sql="SELECT `id_tag`, `name_tag`, `categorie_tag` FROM `tag` WHERE 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    errorHandler($stmt);
    while(false !== $row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $res[]=$row;}return $res;


}
$res=getTags($conn);
//
foreach($res as $tag){
    echo 'tag :';
    echo $tag['name_tag'];
    echo '<br>';
    echo 'categorie :';
    echo $tag['categorie_tag'];
    echo '<hr>';

}?></article>
</body>
</html>