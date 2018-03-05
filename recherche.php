<?php
session_start();
require_once 'connection.php';

function verif($conn){
    $sql="SELECT 
            `id_user`,
            `email_user`,
            `password_user`,
            `first_connection`,
            `profil_id_user`
        FROM 
            `user` 
        WHERE 
        `email_user`=:email
	;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':email', $_SESSION['mail']);
    $stmt->execute();
    errorHandler($stmt);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    //var_dump($row);

    if($_SESSION['pass'] == $row["password_user"]){

       // header('location:home');
    }else{
        session_unset();
        header('location:test');


    }

}
if(!isset($_SESSION['mail']) || !isset($_SESSION['pass']) || !isset($_SESSION['pid'])){
    header('location:test');
}
verif($conn); ?>

<?php
require_once 'connection.php';
function rechercher($chaine_recherche, $filtre, $checkDispo,$conn){


//-----------/!\ find alias

    if($filtre === "competence")
    {
        $alias = findAlias($chaine_recherche);
        $sql = "
      SELECT 
            `id_profil`,
            `pseudo_profil`, 
            `type_tag`, 
            `name_tag`, 
            `categorie_tag` ,
            `dispo_profil`
        FROM 
            `profil_tag` 
        INNER JOIN 
            `tag` 
        ON 
            `tag_id_tag` = `id_tag` 
        INNER JOIN 
            `profil` 
        ON 
            `profil_id_profil` = `id_profil` 
        WHERE 
            `type_tag`='competence' 
        AND 
            (`name_tag`= :alias OR `categorie_tag` = :alias)
     ";

        if($checkDispo == '1')
        {
            $sql = $sql." AND `dispo_profil` = '1'";
        }

        $sql = $sql." ORDER BY `reco_tag` DESC";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':alias', $alias);
        $stmt->execute();
        errorHandler($stmt);



    while(false !== $row = $stmt->fetch(PDO::FETCH_ASSOC)){$res[]=$row;}



    }

    else if($filtre === "personne")
    {
        $sql = "SELECT 
                  `id_profil`, 
                  `pseudo_profil`, 
                  `email_profil`, 
                  `bio_profil`, 
                  `lieu_profil`, 
                  `classe_profil`, 
                  `dispo_profil`, 
                  `img_profil` 
                FROM 
                  `user` 
                INNER JOIN `profil` 
                ON 
                  `profil_id_user` = `id_profil`

      ";

        if($checkDispo == '1')
        {
            $sql = $sql." WHERE (`name_user` = :chaine_recherche AND `dispo_profil` = '1') OR (`pseudo_profil`= :chaine_recherche AND `dispo_profil` = '1')";
        }
        else
        {
            $sql = $sql." WHERE `name_user` = :chaine_recherche OR `pseudo_profil`= :chaine_recherche";
        }


        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':chaine_recherche', $chaine_recherche);
        $stmt->execute();
        errorHandler($stmt);
        while(false !== $row = $stmt->fetch(PDO::FETCH_ASSOC)){$res[]=$row;}
    }

    else if($filtre == "hobbie")
    {
        $alias = findAlias($chaine_recherche);
        $sql = "
      SELECT 
            `id_profil`,
            `pseudo_profil`, 
            `type_tag`, 
            `name_tag`, 
            `categorie_tag` ,
            `dispo_profil`
        FROM 
            `profil_tag` 
        INNER JOIN 
            `tag` 
        ON 
            `tag_id_tag` = `id_tag` 
        INNER JOIN 
            `profil` 
        ON 
            `profil_id_profil` = `id_profil` 
        WHERE 
            `type_tag`='envie' 
        AND 
            (`name_tag`= :alias OR `categorie_tag` = :alias)
        ";

        if($checkDispo == '1')
        {
            $sql = $sql." AND `dispo_profil` = '1'";
        }

        $sql = $sql." ORDER BY `reco_tag` DESC";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':alias', $alias);
        $stmt->execute();
        errorHandler($stmt);
        while(false !== $row = $stmt->fetch(PDO::FETCH_ASSOC)){$res[]=$row;}
    }

    return $res;
}

function findAlias($str){
    $str=strtolower($str);
    if($str=='js'||$str=='javascript'){$str='JS';}
    if($str=='css'||$str=='css3'){$str='CSS';}
    if($str=='maçonnerie'||$str=='maconnerie'){$str='Maçonnerie';}
    if($str=='html'||$str=='html5'){$str='HTML';}
    if($str=='plomberie'){$str='Plomberie';}
    if($str=='symfony'||$str=='simphonie'||$str=='symphonie'||$str=='symfonie'||$str=='symphony'){$str=='Symfony';}
    if($str=='ux design'||$str=='ux'){$str=='UX Design';}
    if($str=='ui design'||$str=='ui'){$str=='UI Design';}
    if($str=='3d'||$str=='conception 3d'){$str=='XD';}
    if($str=='cinema 4D'||$str=='c4d'){$str=='Cinema 4D';}
    if($str=='blender'||$str=='blander'){$str=='Blender';}
    if($str=='after Effect'||$str=='ae'){$str=='After Effect';}
    if($str=='motion Design'||$str=='motion'){$str=='Motion Design';}
    if($str=='graphisme'||$str=='créa'){$str=='UX Design';}
    if($str=='benchmark'||$str=='bench'){$str=='UX Design';}
    if($str=='gestion de projet'||$str=='gestion projet'){$str=='Gestion de projet';}
    if($str=='rédaction contenu'||$str=='redac contenu'){$str=='Rédaction contenu';}
    if($str=='stratégie marketing'||$str=='marketing'){$str=='UX Design';}
    if($str=='stratégie communication'||$str=='communication'){$str=='UX Design';}
    if($str=='mysql'||$str=='mongodb'||$str=='bdd'||$str=='sgbd'){$str=='MySql';}
    if($str=='indesign'){$str='InDesign';}
    if($str=='management'||$str=='gestion'){$str=='Management';}
    if($str=='traduction'||$str=='langue'){$str=='Traduction';}
    if($str=='enseignement'||$str=='pédagogie'){$str=='Enseignement';}
    if($str=='comptabilité'){$str=='Comptabilité';}
    if($str=='ressources humaines'||$str=='RH'){$str=='Ressources humaines';}
    if($str=='word'||$str=='document'){$str=='Word';}
    if($str=='powerpoint'||$str=='ppt'){$str=='Powerpoint';}
    if($str=='droit'||$str=='juridique'){$str=='Droit';}
    if($str=='mécanique'||$str=='méca'){$str=='Mécanique';}
    if($str=='recording' ||$str=='ingé son'){$str=='Recording';}
    if($str=='Prise de son'||$str=='perchman'){$str=='Prise de son';}
    if($str=='français'||$str=='rédaction'){$str=='Français';}
    if($str=='anglais'||$str=='lv2'){$str=='Anglais';}
    if($str=='espagnol'){$str=='Espagnol';}
    if($str=='italien'){$str=='Italien';}
    if($str=='allemand'){$str=='Allemand';}
    if($str=='bilingue'){$str=='Bilingue';}
    if($str=='audit'){$str=='Audit';}
    if($str=='livraison' || $str=='transport'){$str=='Livraison';}
    if($str=='correction' || $str=='orthographe'){$str=='Correction';}
    if($str=='permis de conduire' || $str=='conduite' || $str=='conduire'){$str=='Conduite';}
    if($str=='permis poids lourd'){$str=='Permis poids lourd';}
    if($str=='peinture'){$str=='Peinture';}
    if($str=='dessin' || $str=='caricature'){$str=='Dessin';}
    if($str=='théâtre'){$str=='Théâtre';}
    if($str=='storyboarding' || $str=='storyboard'){$str=='Storyboarding';}
    if($str=='coloration' || $str=='colorimétrie'){$str=='Coloration';}
    if($str=='japonais' || $str=='anime' || $str=='manga'){$str=='Japonais';}
    if($str=='sport' || $str=='course' || $str=='musculation'){$str=='Sport';}
    if($str=='cinéma' || $str=='cinématographie'){$str=='Cinéma';}
    if($str=='évènementiel' || $str=='évènementiel' || $str=='évenementiel'){$str=='Evenementiel';}
    if($str=='baby-sitting' || $str=='baby sitting'){$str=='Baby-sitting';}
    if($str=='secouriste' || $str=='médecin' || $str=='médecine'){$str=='Médicine';}
    if($str=='maquettage' || $str=='wireframe' || $str=='wireframing'){$str=='Maquettage';}
    if($str=='danse'){$str=='Danse';}
    if($str=='musique' || $str=='rap' || $str=='instrument de musique' || $str=='Piano' || $str=='Guitare' || $str=='Violon'){$str=='Musique';}
    if($str=='jardinage'){$str=='Jardinage';}
    if($str=='lecture'){$str=='Lecture';}
    if($str=='jeux vidéos' || $str=='e-sport'){$str=='Jeux vidéos';}
    if($str=='ébénisme'){$str=='Ebenisme';}
    if($str=='cuisine' || $str=='patisserie'){$str=='Cuisine';}
    if($str=='journalisme' || $str=='journal'){$str=='Journalisme';}
    if($str=='chant' || $str=='chanter'){$str=='Chant';}
    if($str=='bénévolat'){$str=='Benevolat';}
    if($str=='bricolage'){$str=='Bricolage';}
    if($str=='art' || $str=='musée'){$str=='Art';}
    if($str=='pécher'){$str=='Pécher';}

    return $str;

}


/*$rec = $_GET['rec'];
//var_dump($rec);
$competence = $_GET['filter'];
//var_dump($competence);
$dispo='0';
if($_GET['dispo']== '1'){$dispo='1';}
//var_dump($dispo);
var_dump(rechercher($rec,$competence,$dispo,$conn));*/



