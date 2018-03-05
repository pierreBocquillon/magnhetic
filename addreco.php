<?php
session_start();
require_once 'connection.php';

function verifreco($conn){
    $sql="SELECT 
      `id_reco_tag`,
      `profil_id_profil_em`,
      `profil_id_profil_tag` 
    FROM 
      `reco_tag` 
    WHERE 
      `profil_id_profil_tag`=:profiltag 
    AND 
      `profil_id_profil_em`=:profilem";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':profiltag', $_POST['profiltag']);
    $stmt->bindValue(':profilem', $_POST['sender']);
    $stmt->execute();
    errorHandler($stmt);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row != null){return false;}
    else{return true;}
}

function addRecoProfil($id_profil_em, $id_profil_tag,$conn){
    $sql="INSERT INTO 
            `reco_tag`
            (
                `profil_id_profil_em`, 
                `profil_id_profil_tag`
            ) 
        VALUES 
            (
                :id_profil_em,
                :id_profil_tag
            )
  ";



    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id_profil_em', $id_profil_em);
    $stmt->bindValue(':id_profil_tag', $id_profil_tag);
    $stmt->execute();
    errorHandler($stmt);

    incrementRecoProfil($id_profil_tag,$conn);

}

function incrementRecoProfil($id_profil_tag,$conn){
    $sql="UPDATE `profil_tag`
          SET `reco_tag` = `reco_tag`+1
          WHERE `id_profil_tag` = :id_profil_tag
  ";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id_profil_tag', $id_profil_tag);
    $stmt->execute();
    errorHandler($stmt);
    checkPalier($conn);
}

function checkPalier($conn){
    $sql="SELECT 
            `id_profil_tag`, 
            `profil_id_profil`, 
            `tag_id_tag`, 
            `reco_tag`, 
            `palier`, 
            `tag_fav`, 
            `type_tag`, 
            `vitrine_profil_tag`, 
            `desc_tag` 
          FROM 
            `profil_tag`
          WHERE
            `id_profil_tag` = :idTag";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':idTag', $_POST['profiltag']);
    $stmt->execute();
    errorHandler($stmt);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row['reco_tag'] < 5){
        $palier=0;
    }
    elseif($row['reco_tag'] < 15 && $row['reco_tag'] >= 5){
        $palier=1;
    }
    elseif($row['reco_tag'] < 30 && $row['reco_tag'] >= 15){
        $palier=2;
    }
    elseif($row['reco_tag'] < 50 && $row['reco_tag'] >= 30){
        $palier=3;
    }else{
        $palier=4;
    }
    updatepalier($_POST['profiltag'],$palier,$conn);
}

function updatepalier($id,$palier,$conn){
    $sql="UPDATE `profil_tag`
          SET `palier` = :palier
          WHERE `id_profil_tag` = :id_profil_tag
  ";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id_profil_tag', $id);
    $stmt->bindValue(':palier', $palier);
    $stmt->execute();
    errorHandler($stmt);
}



$verif=verifreco($conn);
if ($verif == false){
    header('location:profil.php?id_profil='.$_SESSION['pid']);}
else{
    addRecoProfil($_POST['sender'],$_POST['profiltag'],$conn);
    header('location:profil.php?id_profil='.$_SESSION['pid']);
}