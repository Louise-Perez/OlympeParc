<?php
session_start();
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attractions - Olympe Parc</title>
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
                ?></a></li>
        </ul>
    </nav>

    <main>
            <section class="container">
                <h1> Attractions </h1>
                <div class="rechercher">
                    <form method="POST" action="">
                        <p> Filtrer par :</p>
                        <label> Intêret : </label> 
                        <select name="interet_activite">
                            <option value="e">Toutes les attractions</option>
                            <option value="Toute la famille">Toute la famille</option>
                            <option value="Amateur de sensation">Amateur de sensation</option>
                            <option value="Culture">Culture</option>
                        </select>
                        <input type="SUBMIT" value="Rechercher"> 
                    </form> 
                </div>

                <?php   // Afficher la base de données selon le resultat de la recherche// 
            $bdd = new PDO('mysql:host=localhost;dbname=olympeParc', 'root', 'root');
            if (isset($_POST['interet_activite']) AND !empty($_POST['interet_activite'])) {
                $interet_activite = htmlspecialchars($_POST['interet_activite']);
                $reponse = $bdd->query('SELECT * FROM activites WHERE type_activite = "Attraction" AND interet_activite LIKE "%$interet_activite%"');
                if($reponse->rowCount() >= 0) {
                    $reponse = $bdd->query('SELECT * FROM activites WHERE type_activite = "Attraction" AND CONCAT(interet_activite) LIKE "%'.$interet_activite.'%"');
                        while($donnees = $reponse->fetch()) { ?> 
                            <article class="activite">
                        <div>
                            <img src="image/<?php echo htmlspecialchars($donnees['image_activite']); ?>.jpg">
                              
                                <div class="vote"> <!-- Système de vote --> 
                                        <form action="" method="post" class="vote_btns">
                                            <input type="image" class="vote_btn" alt="Login" src="https://img.icons8.com/color/48/000000/star--v1.png" value="1" width="30" height="30"> 
                                            <input type="image" class="vote_btn" alt="Login" src="https://img.icons8.com/color/48/000000/star--v1.png" value="2" width="30" height="30"> 
                                            <input type="image" class="vote_btn" alt="Login" src="https://img.icons8.com/color/48/000000/star--v1.png" value="3" width="30" height="30">
                                            <input type="image" class="vote_btn" alt="Login" src="https://img.icons8.com/color/48/000000/star--v1.png" value="4" width="30" height="30">
                                            <input type="image" class="vote_btn" alt="Login" src="https://img.icons8.com/color/48/000000/star--v1.png" value="5" width="30" height="30">
                                            <?php echo $donnees['notation_activite'] ?>/5
                                            <input type="submit" name="formnotation" id="noter" value="Voter"/>
                                            
                                        </from>
                                </div>

                        </div>
                            
                        <div>
                            <h2><?php echo htmlspecialchars($donnees['nom_activite']); ?></h2>
                            <p><span class="intitule_activite">Taille minimum</span> : <?php echo htmlspecialchars($donnees['taille_minimum']); ?>cm</p>
                            <p><span class="intitule_activite">Interet</span> : <?php echo htmlspecialchars($donnees['interet_activite']); ?></p>
                            <p><span class="intitule_activite">Description</span> : <br/> 
                            <?php echo htmlspecialchars($donnees['contenu_activite']); ?> </p>
                        </div>
                    </article>
                            <hr/>
                        <?php
                        }
                } 
            }
            else {   // Afficher la base de données sans filtre// 
                $bdd = new PDO('mysql:host=localhost;dbname=olympeParc', 'root', 'root');
                $reponse = $bdd->query('SELECT * FROM activites WHERE type_activite = "Attraction"');
                while ($donnees = $reponse->fetch()){
                ?>
                    <article class="activite">
                        <div>
                            <img src="image/<?php echo htmlspecialchars($donnees['image_activite']); ?>.jpg">
                              
                                <div class="vote"> <!-- Système de vote --> 
                                        <form action="" method="post" class="vote_btns">
                                            <input type="image" class="vote_btn" alt="Login" src="https://img.icons8.com/color/48/000000/star--v1.png" value="1" width="30" height="30"> 
                                            <input type="image" class="vote_btn" alt="Login" src="https://img.icons8.com/color/48/000000/star--v1.png" value="2" width="30" height="30"> 
                                            <input type="image" class="vote_btn" alt="Login" src="https://img.icons8.com/color/48/000000/star--v1.png" value="3" width="30" height="30">
                                            <input type="image" class="vote_btn" alt="Login" src="https://img.icons8.com/color/48/000000/star--v1.png" value="4" width="30" height="30">
                                            <input type="image" class="vote_btn" alt="Login" src="https://img.icons8.com/color/48/000000/star--v1.png" value="5" width="30" height="30">
                                            <?php echo $donnees['notation_activite'] ?>/5
                                            <input type="submit" name="formnotation" id="noter" value="Voter"/>
                                            
                                        </from>
                                </div>

                        </div>
                            
                        <div>
                            <h2><?php echo htmlspecialchars($donnees['nom_activite']); ?></h2>
                            <p><span class="intitule_activite">Taille minimum</span> : <?php echo htmlspecialchars($donnees['taille_minimum']); ?>cm</p>
                            <p><span class="intitule_activite">Interet</span> : <?php echo htmlspecialchars($donnees['interet_activite']); ?></p>
                            <p><span class="intitule_activite">Description</span> : <br/> 
                            <?php echo htmlspecialchars($donnees['contenu_activite']); ?> </p>
                        </div>
                    </article>
            <hr/>
                <?php } 
            }
            ?> 

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
                    <h4> Comment venir ? </h4>
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