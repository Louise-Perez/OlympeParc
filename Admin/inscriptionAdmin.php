<?php
session_start(); 

   $bdd = new PDO('mysql:host=localhost;dbname=olympeParc', 'root', 'root');
   if(isset($_POST['formAdmin'])) {
      $pseudo_admin = htmlspecialchars($_POST['pseudo_admin']);
      $mail_admin = htmlspecialchars($_POST['mail_admin']);
      $mdp = sha1($_POST['mdp']);
      $mdp2 = sha1($_POST['mdp2']);
        if(!empty($_POST['pseudo_admin']) AND !empty($_POST['mail_admin']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']) ){
            if(filter_var($mail_admin, FILTER_VALIDATE_EMAIL)) {
                $reqmail_admin = $bdd->prepare('SELECT id_admin, pseudo_admin, mail_admin, mdp_admin FROM admin_espace WHERE mail_admin = ?');
                $reqmail_admin->execute(array($mail_admin));
                $mail_adminexist = $reqmail_admin->rowCount();
                if($mail_adminexist == 0) {
                    if($mdp == $mdp2) {
                           $insertadmin = $bdd->prepare("INSERT INTO admin_espace(pseudo_admin, mail_admin, mdp_admin) VALUES (?, ?, ?)");
                           $insertadmin->execute(array($pseudo_admin, $mail_admin, $mdp));
                           $erreur = "Votre compte a bien été créé ! <a href=\"admin.php\"> Me connecter </a>";
                        }
                    else {
                           $erreur = "Vos mots de passes ne correspondent pas !";
                    }
                }
                else {
                    $erreur = "Adresse mail déjà utilisée !"; 
                 }
            }
            else {
               $erreur = "Adresse mail déjà utilisée !"; 
            }
        }
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription ADMIN - Olympe Parc</title>
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
                ?> 
            </a></li>
        </ul>
    </nav>

      <h2>Inscription ADMIN </h2>
      <section class="formulaire_inscription">
               <form method="POST" action="">
                  <table>
                     <!-- Nom --> 
                     <tr>
                        <td align="right">
                           <label for="pseudo_admin">Pseudo : </label>
                        </td>
                        <td>
                           <input type="text" placeholder="Votre Nom" name="pseudo_admin" value=""/>
                        </td>
                     </tr>
                     <!-- Mail --> 
                     <tr>
                        <td align="right">
                           <label for="mail_admin">Mail :</label>
                        </td>
                        <td>
                           <input type="email" placeholder="Votre mail" name="mail_admin" value=""/>
                        </td>
                     </tr>
                     <!-- Mot de passe --> 
                     <tr>
                        <td align="right">
                           <label for="mdp">Mot de passe :</label>
                        </td>
                        <td>
                           <input type="password" placeholder="Votre mot de passe" name="mdp"/>
                        </td>
                     </tr>
                     <!-- Mot de passe --> 
                     <tr>
                        <td align="right">
                           <label for="mdp2">Confirmation du mot de passe :</label>
                        </td>
                        <td>
                           <input type="password" placeholder="Confirmez votre mdp" name="mdp2"/>
                        </td>
                     </tr>
                     <tr>
                        <td></td>
                        <td align="center">
                        <br />
                           <input type="submit" name="formAdmin" value="Je m'inscris"/>
                           <?php
                           if(isset($erreur)) {
                              echo '<font color="red">'.$erreur."</font>";
                           }
                           ?>
                        </td>
                     </tr>
                     <tr><td></td><td></td></tr>
                     <tr>
                        <td></td>
                        <td align="center">
                           <br />
                        </td>
                     </tr>
                  </table>
               </form>
      </section>
</body>
</html>