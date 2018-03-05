<?php

require_once 'connection.php';

function updateProfilInfo($id_profil, $new_pseudo, $new_email, $new_bio, $new_lieu, $new_classe, $new_dispo, $conn){
    $sql="UPDATE 
            `profil` 
        SET 
            `pseudo_profil`= :new_pseudo,
            `email_profil`= :new_email,
            `bio_profil`= :new_bio,
            `lieu_profil`= :new_lieu,
            `classe_profil`= :new_classe,
            `dispo_profil`= :new_dispo
        WHERE 
            `id_profil`=:id_profil
  ";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':new_pseudo', $new_pseudo);
    $stmt->bindValue(':new_email', $new_email);
    $stmt->bindValue(':new_bio', $new_bio);
    $stmt->bindValue(':new_lieu', $new_lieu);
    $stmt->bindValue(':new_classe', $new_classe);
    $stmt->bindValue(':new_dispo', $new_dispo);
    $stmt->bindValue(':id_profil', $id_profil);
    $stmt->execute();
    errorHandler($stmt);

}

function updatePwdUser($pid, $new_pwd, $conn){
    $sql="UPDATE 
            `user` 
        SET 
            `password_user`= :new_pwd,
            `first_connection`=:fc
        WHERE 
            `profil_id_user`=:pid
  ";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':pid', $pid);
    $stmt->bindValue(':fc', 0);
    $stmt->bindValue(':new_pwd', $new_pwd);
    $stmt->execute();
    errorHandler($stmt);

}

$id_profil = $_GET["id_profil"];
$new_pseudo = $_GET["pseudo_profil"];
$new_email = $_GET["email_profil"];
$new_bio = $_GET["bio_profil"];
$new_classe = $_GET["classe_profil"];
$new_lieu = $_GET["lieu_profil"];
$new_dispo = $_GET["dispo_profil"];
$new_path_img = "default.png";

$pid = $_GET["id_profil"];
$new_pwd = $_GET["new_pwd"];


updateProfilInfo($id_profil, $new_pseudo, $new_email, $new_bio, $new_lieu, $new_classe, $new_dispo, $conn);
updatePwdUser($pid, $new_pwd, $conn);
//updateTag($id_profil_tag, $new_fav, $new_type, $new_vitrine, $new_desc, $conn);
//updateProfilInfo($id_profil, "michmichmich", "mich@hetic.net", "blavblzzjjihu", "chez moi", "master", "1", $conn);

header("Location: prive.php");

?>