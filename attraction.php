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
                                    <p> Moyenne des votes du public : </p>
                                    <?php 
                                        $requete = $bdd->query('SELECT AVG(notation) AS moyenne FROM notation WHERE id_ref_activite="'.$donnees['id_activite'].'"');
                                        while($donnees3 = $requete->fetch()) {
                                            echo (round($donnees3['moyenne'], 2)) . "/5";
                                        }
                                    ?>  
                                    <br/>
                                    <a href="sondage.php" class="sondageLien">Participez à notre sondage !</a>
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
                                <p> Moyenne des votes du public : </p>
                                    <?php 
                                    $requete = $bdd->query('SELECT AVG(notation) AS moyenne FROM notation WHERE id_ref_activite="'.$donnees['id_activite'].'"');
                                    while($donnees3 = $requete->fetch()) {
                                        echo (round($donnees3['moyenne'], 2)) . "/5";
                                    }
                                    ?>  
                                    <br/>
                                    <a href="sondage.php" class="sondageLien">Participez à notre sondage !</a>       
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
            }?> 

        </section>
        <?php include './Parties/aside.php'; ?>
    </main>
    <?php include './Parties/footer.php'; ?>
</body>
</html>