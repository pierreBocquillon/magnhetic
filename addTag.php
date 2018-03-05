<?php

require_once 'connection.php';

function addTagProfil($id_profil, $id_tag, $tag_fav, $type_tag, $vitrine_profil_tag, $desc_tag, $conn){

    if($tag_fav == NULL){
        $tag_fav = 0;
    }

    if($vitrine_profil_tag == NULL){
        $vitrine_profil_tag = 0;
    }

    if($type_tag == "1"){
        $type_tag = "competence";
    }

    if($type_tag == "2"){
        $type_tag = "envie";
    }

    $sql="INSERT INTO 
            `profil_tag`
            (
                `profil_id_profil`, 
                `tag_id_tag`, 
                `tag_fav`, 
                `type_tag`, 
                `vitrine_profil_tag`, 
                `desc_tag`
            )
        VALUES 
            (
                :id_profil,
                :id_tag,
                :tag_fav,
                :type_tag,
                :vitrine_profil_tag,
                :desc_tag
            )
  ";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id_profil', $id_profil);
    $stmt->bindValue(':id_tag', $id_tag);
    $stmt->bindValue(':tag_fav', $tag_fav);
    $stmt->bindValue(':type_tag', $type_tag);
    $stmt->bindValue(':vitrine_profil_tag', $vitrine_profil_tag);
    $stmt->bindValue(':desc_tag', $desc_tag);
    $stmt->execute();
    errorHandler($stmt);

}

    $id_profil = $_GET['id_profil'];
    $id_tag = $_GET['id_tag'];
    $tag_fav = $_GET['tag_fav'];
    $type_tag = $_GET['type_tag'];
    $vitrine_profil_tag = $_GET['vitrine_tag'];
    $desc_tag = $_GET['desc_tag'];

addTagProfil($id_profil, $id_tag, $tag_fav, $type_tag, $vitrine_profil_tag, $desc_tag, $conn);
header("Location: prive.php");

?>