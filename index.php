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

        <aside>
            <div class="horaires">
                <h4> Prochainement </h4>
                <p> Du Lundi au vendredi</p>
                <p> 9h30 - 20h </p>
                <p> Week-end et jour Férié</p>
                <p> 9h - 22h </p>
            </div>

            <div class="planSite"> 
                <h4> Comment venir ?  </h4>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24421.50456528392!2d22.355293475148038!3d40.08236949193205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x135813c2bb740cbd%3A0xb99522688db8a6e9!2sMont%20Olympe!5e0!3m2!1sfr!2sfr!4v1585587561876!5m2!1sfr!2sfr" 
                 frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>

            <div class="reseauxSociaux">
                <h4> Suivez - nous</h4>
                <a href="https://facebook.com"><img src="image/facebook.png"></a>
                <a href="https://twitter.com"><img src="image/twitter.png"></a>
                <a href="https://instragram.com"><img src="image/instagram.png"></a>
            </div>
        </aside>

    </main>
    <?php include './Parties/footer.php'; ?>
</body>
</html>