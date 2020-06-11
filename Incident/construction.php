<?php
session_start();
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attractions - Olympe Parc</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="icon" href="../image/logo.png"/>
</head>
<body>
        
    <nav class="navbar">
        <ul>
            <li><a href="../index.php"><img src="../image/logo.png"></a></li>
            <li><a href="../index.php">Accueil</a></li>
            <li><a href="../attraction.php">Attractions</a></li>
            <li><a href="../spectacle.php">Spectacles</a></li>
            <li><a href="../activite.php">Activités</a></li>
            <li><a href="../prereservation.php">Pré-reservation</a></li>
            <li><a href="../espacemembre.php">
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
    <section class="construction">
            <h2>🚧 Oups, cette page est en construction 🚧</h2>
            <br/>
            <a href="../index.php" >Retour à l'accueil</a>
    </section> 

    </main>
    
</body>
</html>