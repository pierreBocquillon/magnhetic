<?php

require_once 'connection.php';

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
$id_projet = $_GET['id_projet'];

bindProfilProject($id_owner, $id_partner, $id_projet, $conn);
header("Location: home");

?>