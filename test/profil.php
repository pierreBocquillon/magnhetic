<?php
require_once 'connection.php';
require_once 'profilFunctions.php';
session_start();

$infoProfil = getInfoProfil(3,$conn);
$tagsProfil = getTagsProfil(3, $conn);
$projetProfil = getProjetProfil(3, $conn);

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
                <p>Pseudo : <?= $infoProfil[0]["pseudo_profil"] ?></p>
                <p>E-mail : <?= $infoProfil[0]["email_profil"] ?></p>
                <p>Bio : <?= $infoProfil[0]["bio_profil"] ?></p>
                <p>Adresse : <?= $infoProfil[0]["lieu_profil"] ?></p>
                <p>Classe : <?= $infoProfil[0]["classe_profil"] ?></p>
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
                    if($tag['palier'] == 2){
                        echo '<p>MEDAILLE BRONZE EN '.$tag['name_tag'].'</p>';
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
                                    <div id="first">1</div>
                                    <div id="second">2</div>
                                    <div id="third">3</div>
                                    <div id="fourth">4</div>
                                    <div id="fith">5</div> 
                            </article>
                      </div>
                      
                      <div id="hobby" class="tabcontent">
                            <article>
                                    <div id="first">ichi</div>
                                    <div id="second">ni</div>
                                    <div id="third">san</div>
                                    <div id="fourth">yon</div>
                                    <div id="fith">go</div> 
                            </article>
                      </div>
                      
                      <div id="projet" class="tabcontent">
                            <article>
                                    <div id="first">One</div>
                                    <div id="second">TWO</div>
                                    <div id="third">THREE</div>
                                    <div id="fourth">FOUR</div>
                                    <div id="fith">FIVE</div> 
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