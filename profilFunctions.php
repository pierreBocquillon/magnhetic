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
    while(false !== $row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $res[]=$row;
    }
    return $res;
}

function getTagsProfil($id_profil, $conn){
    $sql="SELECT 
            `id_profil_tag`,
            `reco_tag`,
            `palier`,
            `tag_fav`,
            `profil_id_profil`,
            `tag_id_tag`,
            `type_tag`,
            `name_tag`,
            `categorie_tag`, 
            `desc_tag`,
            `vitrine_profil_tag`
        FROM
            `profil_tag` 
        INNER JOIN 
            `tag`
        ON 
            `tag_id_tag` = `id_tag`
        WHERE 
            `profil_id_profil`=:id_profil
  ";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id_profil', $id_profil);
    $stmt->execute();
    errorHandler($stmt);
    while(false !== $row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $res[]=$row;
    }
    return $res;
}

function getProjetProfil($id_profil, $conn){
    $sql="SELECT 
                `id_projet_profil`,
                `owner_projet`,
                `profil_id_profil`,
                `projet_id_projet`,
                `name_projet`,
                `finish_projet`,
                `desc_projet` 
            FROM 
                `projet_profil` 
            INNER JOIN 
                `projet` 
            ON 
                `projet_id_projet`=`id_projet`
            WHERE 
                `profil_id_profil`=:id_profil ORDER BY `id_projet_profil`DESC
  ";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id_profil', $id_profil);
    $stmt->execute();
    errorHandler($stmt);
    while(false !== $row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $res[]=$row;
    }
    return $res;
}

function getEquipeProjet($id_projet, $conn){
    $sql="SELECT 
                `pseudo_profil` 
            FROM 
                `projet_profil`
            INNER JOIN 
                `projet`
            ON 
                `projet_id_projet` = `id_projet`
            INNER JOIN 
                `profil`
            ON 
                `profil_id_profil` = `id_profil`
            WHERE 
                `id_projet`=:id_projet
  ";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id_projet', $id_projet);
    $stmt->execute();
    errorHandler($stmt);
    while(false !== $row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $res[]=$row;
    }
    return $res;
}

function getTags($conn){
    $sql="SELECT `id_tag`, `name_tag`, `categorie_tag` FROM `tag` ORDER BY `categorie_tag`";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    errorHandler($stmt);
    while(false !== $row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $res[]=$row;}return $res;
}

function getUserPwd($pid, $conn){
    $sql="SELECT `password_user` FROM `user` WHERE `profil_id_user`=:pid";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':pid', $pid);
    $stmt->execute();
    errorHandler($stmt);
    while(false !== $row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $res[]=$row;}return $res;
}