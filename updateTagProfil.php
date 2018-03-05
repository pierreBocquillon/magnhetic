<?php

require_once 'connection.php';

function updateTagProfil($id_profil_tag, $new_fav, $new_type, $new_vitrine, $new_desc, $conn){

    if($new_type == "1"){
        $new_type = "competence";
    }

    if($new_type == "2"){
        $new_type = "envie";
    }

    $sql="UPDATE 
            `profil_tag` 
        SET 
            `tag_fav`= :new_fav,
            `type_tag`= :new_type,
            `vitrine_profil_tag`= :new_vitrine,
            `desc_tag`= :new_desc
        WHERE 
        `id_profil_tag`=:id_profil_tag
  ";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id_profil_tag', $id_profil_tag);
    $stmt->bindValue(':new_fav', $new_fav);
    $stmt->bindValue(':new_type', $new_type);
    $stmt->bindValue(':new_vitrine', $new_vitrine);
    $stmt->bindValue(':new_desc', $new_desc);
    $stmt->execute();
    errorHandler($stmt);
}

$id_profil_tag = $_GET["id_profil_tag"];
$new_fav = $_GET["tag_fav"];
$new_type = $_GET["type_tag"];
$new_vitrine = $_GET["vitrine_profil_tag"];
$new_desc = $_GET["desc_tag"];

updateTagProfil($id_profil_tag, $new_fav, $new_type, $new_vitrine, $new_desc, $conn);
header("Location: prive.php");

?>