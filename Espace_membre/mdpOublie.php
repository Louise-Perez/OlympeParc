<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=olympeParc', 'root', 'root');
if(isset($_POST['mail_membre'])) {
    $mdp = uniqid();
    $hashedMdp = sha1($mdp);
    $mail_membre = htmlspecialchars($_POST['mail_membre']);

    $contenu = " Bonjour, voici votre nouveau mot de passe : $mdp";
    $entetes = 'Content-Type: text/plain; charset="utf-8"'." "; 

    if(mail($_POST['mail_membre'], 'Mot de passe oublié', $contenu, $entetes)) {
        
        $updatemdp = $bdd->prepare("UPDATE membre SET mdp_membre = ? WHERE mail_membre = ? ");
        $updatemdp->execute(array($hashedMdp,$mail_membre));
        $message = "Mail envoyé";
        // echo $mdp; 
    }
    else {
        $message = "Echec de l'envoi de l'email de modification";
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
        <h2> Mot de passe oublié ?</h2> 
        <?php
            if(isset($message)) {
                echo '<font color="red">'.$message."</font>";
            }
        ?>
            <form method="POST" action="">
                <lable for="email">Email</label>
                <input type="email" placeholder="Votre mail" id="mail_membre" name="mail_membre" required/>
                    <br /><br />
                <input type="submit" name="formconnexion" value="Envoi d'un nouveau mot de passe" />
            </form>
                    <br/> <br/> 
            <a href="../index.php" class="lien_souligne">Retour à l'accueil</a>
    </section>

    <?php include '../Parties/footer.php'; ?>
</body>
</html>