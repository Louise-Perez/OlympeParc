<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=olympeParc', 'root', 'root');
    if(isset($_POST['formconnexion'])) {
        $mail_membreconnect = htmlspecialchars($_POST['mail_membreconnect']);
        $mdpconnect = sha1($_POST['mdpconnect']);
        if (!empty($mail_membreconnect) AND !empty($mdpconnect)){
            $reqmembre = $bdd->prepare("SELECT id_membre, nom_membre, prenom_membre, naissance_membre, mail_membre, mdp_membre, date_inscription, compte_actif FROM membre WHERE mail_membre = ? AND mdp_membre = ?");
            $reqmembre->execute(array($mail_membreconnect, $mdpconnect));
            $membreexist = $reqmembre->rowCount();
            if ($membreexist == 1){
                $membreinfo = $reqmembre->fetch();
                $_SESSION['id_membre'] = $membreinfo['id_membre'];
                $_SESSION['nom_membre'] = $membreinfo['nom_membre'];
                $_SESSION['prenom_membre'] = $membreinfo['prenom_membre'];
                $_SESSION['naissance_membre'] = $membreinfo['naissance_membre'];
                $_SESSION['mail_membre'] = $membreinfo['mail_membre'];
                $_SESSION['mdp_membre'] = $membreinfo['mdp_membre'];
                $_SESSION['date_inscription'] = $membreinfo['date_inscription'];
                $_SESSION['compte_actif'] = $membreinfo['compte_actif'];
                header("Location: ../espacemembre.php");
            }
            else {
                $erreur = "Mauvais mail ou mot de passe !";
            }
        }
        else {
            $erreur = "Tous les champs doivent être complétés !";
        }
    }      
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace membres - Olympe Parc</title>
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
                ?> </a></li>
        </ul>
    </nav>

    <section class="espace_connexion">
        <h2> Connexion </h2> 
        <?php
            if(isset($erreur)) {
                echo '<font color="red">'.$erreur."</font>";
            }
        ?>
            <form method="POST" action="">
                <input type="email" name="mail_membreconnect" placeholder="Mail" />
                <input type="password" name="mdpconnect" placeholder="Mot de passe" />
                    <br /><br />
                <input type="submit" name="formconnexion" value="Se connecter !" />
            </form>
                    <br/> 
            
            
            <a href="mdpOublie.php" class="lien_souligne">Mot de passe oublié ? </a>
            <br/>
            <a href="inscriptionmembre.php" class="lien_souligne">Vous n'avez pas de compte ? S'inscrire</a>
    </section>

    <?php include '../Parties/footer.php'; ?>
</body>
</html>