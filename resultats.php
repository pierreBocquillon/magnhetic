
<?php
require_once 'connection.php';
require_once 'recherche.php';
require_once 'profilFunctions.php';

$rec = $_GET['rec'];
$competence = $_GET['filter'];
$dispo='0';
if($_GET['dispo']== '1'){$dispo='1';}

$resultatsListe = rechercher($rec,$competence,$dispo,$conn);

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
<main class="resultatRecherche">
    <h1>Votre recherche : "<?= $rec ?>"</h1>
    <section class="resultat">
        <?php
        if($resultatsListe == NULL){
            echo '<div id="noResults">';
            echo '<h3>Aucun résultat pour cette recherche.</h3>';
            echo '<i>Vérifiez si l\'orthographe du mot est correcte</i>';
            echo '</div>';
        }
        foreach($resultatsListe as $resultat){
            $tagResultats = getTagsProfil($resultat['id_profil'],$conn);
            ?>

            <article>
                <div id="imgResultat"><img src="img/default.jpg" alt="ma photo"></div>
                <img id="fanion" src="img/fanion.svg">
                
                    <form action="profil.php" method="GET">
                        <input type="hidden" value=<?= $resultat['id_profil'] ?> name="id_profil">
                        <h2><?= $resultat['pseudo_profil'] ?></h2>
                        <input type="submit" value="Voir" >
                    </form>
                    <div id="containerResultat">
                    <?php
                    foreach($tagResultats as $tag){
                        if($tag['type_tag']=="competence" && $tag['vitrine_profil_tag'] == "1"){
                            echo '<div>';
                            if($tag['palier'] == 0){
                                echo '<img src="img/empty.svg">';
                            }
                            else if($tag['palier'] == 1){
                                echo '<img src="img/bronz.svg">';
                            }
                            else if($tag['palier'] == 2){
                                echo '<img src="img/silver.svg">';
                            }
                            else if($tag['palier'] == 3) {
                                echo '<img src="img/gold.svg">';
                            }
                            else if($tag['palier'] == 4) {
                                echo '<img src="img/platine.svg">';
                            }
                            echo '<p>'.$tag['name_tag'].'</p>';
                            echo '</div>';
                        }
                    }
                    ?>

                </div>
            </article>

        <?php } ?>
    </section>
</main>
<footer>

    <article>
        <a href="FAQ.html">F.A.Q</a>
    </article>
    <article>
        <a href="Plan-du-site.html">Plan du site</a>
    </article>
    <article>
        <a href="MentionLegal.html">Mentions Légales</a>
    </article>

</footer>
</body>
<script src="https://use.fontawesome.com/6fac2730d4.js"></script>

<script src="JS/script.js"></script>
</html>
