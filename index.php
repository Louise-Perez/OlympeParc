<?php
session_start();
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olympe Parc</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="image/logo.png"/>
</head>
<body>
    
    <nav class="navbar">
        <ul>
            <li><a href="index.php"><img src="image/logo.png"></a></li>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="attraction.php">Attractions</a></li>
            <li><a href="spectacle.php">Spectacles</a></li>
            <li><a href="activite.php">Activités</a></li>
            <li><a href="prereservation.php">Pré-reservation</a></li>
            <li><a href="espacemembre.php">
                <?php 
                if($_SESSION) {
                    echo 'Espace Membre'; 
                }
                else {
                    echo 'Se connecter'; 
                }
                ?> 
            </a></li>
        </ul>
    </nav>

    <header id="banniere">
        <img src='image/banniere.png'> <!-- Bannièere "Prochainement-->
        <p> Bienvenue au <strong>Mont Olympe</strong> un parc à thème qui vous plongera dans l’univers de la mythologie grecques. 
            Au cours de votre vie vous aurez sans doute entendu parler de l’Odyssée d’Ulysse ou bien de la boite de Pandore, 
            n’attendez plus pour en apprendre d’avantage en vous amusant ! 
            Arpantez notre parc, apprenez, amusez vous, petits et grands seront comblé !  
           <br/> Έχετε ένα ωραίο ταξίδι !! (bon voyage)</p>
    </header>

    <main class="container">

        <section class="corpsIndex">
        <a href="sondage.php">
                <article class="indexStyle" id="sondageIndex">
                    <div>
                        <h2> Participer à notre sondage </h2>
                        <p> Voter pour les prochaines attractions. </p>
                    </div>
                    <img class="fleche" src="image/fleche.png"> <!-- flèche -->
                </article>
            </a>
            <hr/>
            <a href="attraction.php">
                <article class="indexStyle">
                    <img src="image/attraction.jpg"> <!-- Image Attractions -->
                    <div>
                        <h2> Attractions</h2>
                        <p> Voici la liste des attractions à venir dans notre parcs. </p>
                    </div>
                    <img class="fleche" src="image/fleche.png"> <!-- flèche -->
                </article>
            </a>
            <hr/>
            <a href="spectacle.php">
                <article class="indexStyle">
                    <img src="image/spectacles.jpg"> <!-- Image Spectacles -->
                    <div>
                        <h2> Spectacles</h2>
                        <p>Voir les prochains spectacles de prévu.</p>
                    </div>
                    <img class="fleche" src="image/fleche.png"> <!-- flèche -->
                </article>
            </a>
            <hr/>
            <a href="activite.php">
                <article class="indexStyle"> 
                    <img src="image/activite.jpg"> <!-- Image Activités -->
                    <div>
                        <h2> Activités</h2>
                        <p> Découvrez les différentes activités du parc. </p>
                    </div>
                    <img class="fleche" src="image/fleche.png"> <!-- flèche -->
                </article>
            </a>
        </section>

        <?php include './Parties/aside.php'; ?>

    </main>
    <?php include './Parties/footer.php'; ?>
</body>
</html>