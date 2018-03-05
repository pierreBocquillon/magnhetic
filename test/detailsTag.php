<?php
require_once 'connection.php';
session_start();
function getDetailTag($conn)
{
    $sql = "
        SELECT 
            `id_profil_tag`, 
            `profil_id_profil`, 
            `tag_id_tag`, 
            `reco_tag`, 
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
            `img_profil` ,
            `name_tag`,
            `categorie_tag`
        FROM 
          `profil_tag` 
        INNER JOIN
          `profil`
        ON 
          `profil_id_profil`=`id_profil`
        INNER JOIN
          `tag`
        ON 
          `tag_id_tag`=`id_tag`
        WHERE
          `id_profil_tag`=:profil_tag
        ";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':profil_tag', $_POST['id_profil_tag']);
    $stmt->execute();
    errorHandler($stmt);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}

function getDetailProjet($conn)
{
    $sql = "
        SELECT 
            `id_projet_profil`,
            `owner_projet`,
            `profil_id_profil`,
            `projet_id_projet`,
            `id_profil`, 
            `pseudo_profil`, 
            `email_profil`, 
            `bio_profil`, 
            `lieu_profil`, 
            `classe_profil`, 
            `dispo_profil`, 
            `img_profil` ,
            `name_projet`,
            `finish_projet`,
            `desc_projet`
        FROM 
          `projet_profil` 
        INNER JOIN
          `profil`
        ON 
          `profil_id_profil`=`id_profil`
        INNER JOIN
          `projet`
        ON 
          `projet_id_projet`=`id_projet`
        WHERE
          `id_projet_profil`=:profil_projet
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':profil_projet', $_POST['id_projet_profil']);
    $stmt->execute();
    errorHandler($stmt);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}



function getDetail($conn){
    if($_POST['isTag'] == 1){
        $row=getDetailTag($conn);
        //$name = $row['name_tag'];
       // $desc = $row['desc_tag'];
       // echo $row['reco_tag'];
        //$img = $row['palier'];

    }elseif($_POST['isProject'] == 1){
        $row=getDetailTag($conn);
       //$name = $row['name_projet'];
       //$desc = $row['desc_projet'];
       //$img = $row['img_profil'];

    }else{
        header('location:profil.php');
    }
}
getDetail($conn);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script src="JS/script.js"></script>
    <title>MagnHETIC</title>
</head>
<body>
<header>
    <nav>
        <a href=""><img src="" alt="logo magnHETIC"></a>
        <a href="profil.html"><img src="img/profil.jpg" alt="ma photo" id="maPhoto"></a>
    </nav>
</header>
<main id="detail">

    <section class="detailArticle">
        <article>
            <h2><?php
                if($_POST['isTag'] == 1){
                    $row=getDetailTag($conn);
                        echo $row['name_tag'];
                }elseif($_POST['isProject'] == 1){
                    $row=getDetailTag($conn);
                    echo $row['name_project'];
                }else{
                    header('location:profil.php');
                }?></h2>
            <div>
                <?php
                if($_POST['isTag'] == 1){
                    $row=getDetailTag($conn);
                    if($row['palier'] == 1){
                        echo '<img src="img/bronz.svg" height="150px" width="150px">';
                    }elseif($row['palier'] == 2){
                        echo '<img src="img/silver.svg" height="150px" width="150px">';
                    }elseif($row['palier'] == 3){
                        echo '<img src="img/gold.svg" height="150px" width="150px">';
                    }elseif($row['palier'] == 4){
                        echo '<img src="img/platine.svg" height="150px" width="150px">';
                    }else{
                        echo '<img src="img/platine.svg" height="150px" width="150px" style="opacity: 0;" >';
                    }
                }elseif($_POST['isProject'] == 1){
                    $row=getDetailTag($conn);
                    echo $row['desc_project'];
                }else{
                    header('location:profil.php');
                }?>
            </div>
            <p>
                <?php
                if($_POST['isTag'] == 1){
                    $row=getDetailTag($conn);
                    echo $row['desc_tag'];
                }elseif($_POST['isProject'] == 1){
                    $row=getDetailTag($conn);
                    echo $row['desc_project'];
                }else{
                    header('location:profil.php');
                }?>
            </p>
        </article>


    </section>

