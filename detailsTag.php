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
function getUserProjet($conn)
{
    $sql = "
        SELECT `id_projet_profil`, `owner_projet`, `profil_id_profil`, `projet_id_projet`, `id_profil`, `pseudo_profil`, `email_profil`, `bio_profil`, `lieu_profil`, `classe_profil`, `dispo_profil`, `img_profil` FROM `projet_profil` INNER JOIN `profil` ON `profil_id_profil`=`id_profil` WHERE `projet_id_projet`=:profil_projet
    ";

    $stmt = $conn->prepare($sql);
    $tmp = getDetailProjet($conn);
    $stmt->bindValue(':profil_projet', $tmp['projet_id_projet']);
    $stmt->execute();
    errorHandler($stmt);
    while (false !== $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $res[] = $row;
    }
    return $res;
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
    <link rel="stylesheet" type="text/css" href="css/canvas.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script src="JS/script.js"></script>
    <title>MagnHETIC</title>
</head>
<body>
<header>
    <nav>
        <a href="home.php"><img src="img/magnet.svg" alt="logo magnHETIC" id="logo"></a>
        <div id="trait"></div>
        <a href="home.php"><i class="fas fa-search"></i></a>
        <div id="trait"></div>
        <a href="prive.php"><img src="img/default.png" alt="ma photo" id="maPhoto"></a>
        <a href="logout.php"><img src="img/deco.svg" alt="deco" id="deco"></a>
    </nav>
    <img src="img/wave.svg" id="wave" alt="wave">
</header>
<main id="detail">

    <section class="detailArticle">
        <article>
            <h2><?php
                if($_POST['isTag'] == 1){
                    $row=getDetailTag($conn);
                        echo $row['name_tag'];
                }elseif($_POST['isProject'] == 1){
                    $row=getDetailProjet($conn);
                    echo $row['name_projet'];
                }else{
                    header('location:profil.php');
                }?></h2>
            <div>
                <?php
                if($_POST['isTag'] == 1){
                    $row=getDetailTag($conn);
                    if($row['palier'] == 0){
                        echo '<img src="img/empty.svg" height="150px" width="150px">';
                    }elseif($row['palier'] == 1){
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
                    $res=getUserProjet($conn);
                    foreach($res as $tag){
                        echo '<a href="/profil?id_profil='.$tag['profil_id_profil'].'">';
                        echo '<img src="'.$tag['img_profil'].'"title="'.$tag['pseudo_profil'].'" height="150px" width="150px">';
                        echo '</a>';
                    }
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
                    $row=getDetailProjet($conn);
                    echo $row['desc_projet'];
                }else{
                    header('location:profil.php');
                }?>
            </p>
        </article>


    </section>
