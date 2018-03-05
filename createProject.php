<?php

require_once 'connection.php';

function createProject($name_projet, $finish_projet, $desc_projet, $conn){

    if($finish_projet == NULL){
        $finish_projet = 0;
    } 

	$sql="INSERT INTO 
        `projet`
        (
            `name_projet`, 
            `finish_projet`, 
            `desc_projet`
        ) 
        VALUES 
        (
            :name_projet,
            :finish_projet,
            :desc_projet
        )
  ";
  
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':name_projet', $name_projet);
  $stmt->bindValue(':finish_projet', $finish_projet);
  $stmt->bindValue(':desc_projet', $desc_projet);
  $stmt->execute();
  errorHandler($stmt);

}

function selectCreatedProject($name_projet, $desc_projet, $conn){
    $sql="SELECT `id_projet` FROM `projet` WHERE `name_projet` = :name_projet AND `desc_projet` = :desc_projet
  ";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':name_projet', $name_projet);
    $stmt->bindValue(':desc_projet', $desc_projet);
    $stmt->execute();
    errorHandler($stmt);
    while(false !== $row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $res[]=$row;
    }
    return $res;
}

function bindProfilProject($id_owner, $id_partner, $id_projet, $conn){
    $sql="INSERT INTO 
            `projet_profil`
        (
            `owner_projet`, 
            `profil_id_profil`, 
            `projet_id_projet`
        ) 
        VALUES 
        (
            :id_owner,
            :id_partner,
            :id_projet
        )
  ";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id_owner', $id_owner);
    $stmt->bindValue(':id_partner', $id_partner);
    $stmt->bindValue(':id_projet', $id_projet);
    $stmt->execute();
    errorHandler($stmt);

}

$id_owner = $_GET['id_owner'];
$id_partner = $_GET['id_partner'];

$name_projet = $_GET['name_projet'];
$finish_projet = $_GET['finish_projet'];
$desc_projet = $_GET['desc_projet'];

createProject($name_projet, $finish_projet, $desc_projet, $conn);
$createdProject = selectCreatedProject($name_projet, $desc_projet, $conn);
//var_dump($createdProject);
bindProfilProject($id_owner, $id_partner, $createdProject[0]['id_projet'], $conn);
header("Location: profil");

?>