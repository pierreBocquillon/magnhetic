<?php
require_once 'connection.php';
require_once 'profilFunctions.php';
session_start();

$infoProfil = getInfoProfil($_SESSION['pid'],$conn);
$tagsProfil = getTagsProfil($_SESSION['pid'], $conn);
$projetProfil = getProjetProfil($_SESSION['pid'], $conn);
$res = getTags($conn);

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
    <main>
           
        <section class="myProfil">
            <article id="myBio">
                <img src="img/profil.jpg" alt="ma photo">
                <form action="updateProfil.php" method="GET">
                    <input type="hidden" value=<? echo $_SESSION['pid']?> name="id_profil">
                    <p><input type="text" value="<?= $infoProfil[0]["pseudo_profil"] ?>" name="pseudo_profil"></p>
                    <p><input type="text" value="<?= $infoProfil[0]["email_profil"] ?>" name="email_profil"></p>
                    <p><input type="text" value="<?= $infoProfil[0]["lieu_profil"] ?>" name="lieu_profil"></p>
                    <p><input type="text" value="<?= $infoProfil[0]["classe_profil"] ?>" name="classe_profil"></p>
                    <p><textarea name="bio_profil"><?= $infoProfil[0]["bio_profil"] ?></textarea></p>
            </article>
            <article>
                <div id="containerCanvas"></div>
            </article>
            <article>
                <p>Disponible :
                <?php
                if($infoProfil[0]["dispo_profil"] == "1") {
                ?>
                    <span><i class="fas fa-check-circle"></i></span></p>
                <?php }else{ ?>
                <span><i class="fas fa-times-circle"></i></span></p>
                <?php } ?>
                <p>Nombre de projets en cours : <?= count($projetProfil) ?></p>
                <p>Mes magnets : </p>
                <?php
                foreach($tagsProfil as $tag){
                    if($tag['palier'] == 1){
                        echo '<p>MEDAILLE BRONZE '.$tag['name_tag'].'</p>';
                    }
                    else if($tag['palier'] == 2){
                        echo '<p>MEDAILLE ARGENT '.$tag['name_tag'].'</p>';
                    }
                    else if($tag['palier'] == 3) {
                        echo '<p>MEDAILLE OR '.$tag['name_tag'].'</p>';
                    }
                    else if($tag['palier'] == 4) {
                        echo '<p>MEDAILLE PLATINE ' . $tag['name_tag'] . '</p>';
                    }
                }
                ?>
            </article>
        </section>

        <section class="onglets">
                <div class="tab">
                        <button class="tablinks" onclick="openCity(event, 'competence')">Je sais faire</button>
                        <button class="tablinks" onclick="openCity(event, 'hobby')">Je veux faire</button>
                        <button class="tablinks" onclick="openCity(event, 'projet')">Mes projets</button>
                      </div>
        </section>
                      <section class="myChoice">
                      <div id="competence" class="tabcontent">
                            <article>
                                <?php
                                foreach($tagsProfil as $tag){
                                    if($tag['type_tag']=="competence"){
                                        if($tag['tag_fav']=="1"){
                                            echo '<div id="fav">';
                                        }
                                        else{
                                            echo '<div class="vitrine">';
                                        }
                                        echo '<h2>'.$tag['name_tag'].'</h2>'.
                                            '<form method="post" action="addreco.php">'.
                                            '<input type="hidden" value="'.$tag[profil_id_profil].'" name="profil">
                                            <input type="hidden" value="'.$tag[id_profil_tag].'" name="profiltag">
                                            <input type="hidden" value="'.$_SESSION['pid'].'" name="sender">
                                            <input type="submit" value="Recommander">
                                           </form>'
                                        ;
                                        echo '<form method="post" action="detailsTag.php">'.
                                            '<input type="hidden" value='.$tag['id_profil_tag'].' name="id_profil_tag">
                                            <input type="hidden" value=1 name="isTag">
                                        <input type="submit" value="Voir">
                                       </form></div>'
                                        ;
                                    }
                                }
                                ?>
                            </article>
                      </div>
                      
                      <div id="hobby" class="tabcontent">
                            <article>
                                <?php
                                foreach($tagsProfil as $tag){
                                    if($tag['type_tag']=="envie"){
                                        echo '<div><h2>'.$tag['name_tag'].'</h2>';
                                        echo '<form method="post" action="detailsTag.php">'.
                                            '<input type="hidden" value='.$tag['id_profil_tag'].' name="id_profil_tag">
                                            <input type="hidden" value=1 name="isTag">
                                            <input type="submit" value="Voir">
                                           </form></div>'
                                        ;
                                    }
                                }
                                ?>
                            </article>
                      </div>
                      
                      <div id="projet" class="tabcontent">
                            <article>
                                <form action="bindProfilProject.php" method="post">
                                    <input type="hidden" value="<?= $_SESSION['pid']?>" name="id_owner">
                                    <input type="hidden" value=3 name="id_partner">
                                    <h3>Ajouter à un projet</h3>
                                    <select name="id_projet">
                                        <?php
                                        foreach($projetProfil as $projet){
                                            echo '<option value='.$projet['projet_id_projet'].'>'.$projet['name_projet'].'</option>';
                                        }
                                        ?>
                                    </select>
                                    <input type="submit" value="Ajouter">
                                </form>
                                <div>
                                <?php
                                foreach($projetProfil as $projet){
                                    $i = 0;
                                    echo '<form action="details.php" method="post">';
                                    echo '<input type="hidden" value=1 name="isProject">';
                                    echo '<input type="hidden" value='.$projet['id_projet_profil'].' name="id_projet_profil">';
                                    echo '<input type="submit" value="Voir projet">';
                                    echo '<p>'.$projet['name_projet'].' | ';
                                    $equipeProjet = getEquipeProjet($projet['projet_id_projet'], $conn);
                                    echo '<b>Equipe : </b>';
                                    foreach($equipeProjet as $equipe){
                                        echo '<i>'.$equipe['pseudo_profil'].'</i>';
                                        ++$i;
                                        if($i != count($equipeProjet)){
                                            echo ' - ';
                                        }
                                        else{
                                            echo '</p>';
                                        }
                                    }
                                }
                                ?>
                                </div>
                            </article>
                      </div>
        </section>
  
        
    </main>
    <footer>
        <article>
            <a href="Plan-du-site.html">Plan du site</a>
        </article>
        <article>
            <a href="FAQ.html">F.A.Q</a>
        </article>
        <article>
            <a href="MentionLegal.html">Mentions Légales</a>
        </article>
    </footer>

</body>


</html>