<?php
require_once 'connection.php';
function getFriends($id,$conn){

    $sql="
SELECT 
`id_reco_tag`, 
`profil_id_profil_em`, 
`profil_id_profil_tag`,
`id_profil_tag`,
`profil_id_profil`,
`reco_tag`,
`tag_id_tag`,
`palier`,
`tag_fav`,
`type_tag`,
`vitrine_profil_tag`,
`desc_tag`,
`id_profil`,
`pseudo_profil`,
`email_profil`,
`bio_profil`,
`lieu_profil`,
`classe_profil`,
`dispo_profil`,
`img_profil` 
FROM 
`reco_tag` 
INNER JOIN 
`profil_tag` 
on 
`profil_id_profil_tag` = `id_profil_tag` 
INNER JOIN 
`profil` 
on 
`profil_id_profil` = `id_profil` 
WHERE 
`profil_id_profil_em`=:profil_id
";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':profil_id', $id);
    $stmt->execute();
    errorHandler($stmt);
    while(false !== $row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $res[]=$row;
    }
    return $res;
}

function viewFriends($id,$conn){
    $res=getFriends($id,$conn);
    if(count($res)<=5){
        return $res;
    }else{
        $row =array_slice($res, 0, 5);
        return $row;
    }

}