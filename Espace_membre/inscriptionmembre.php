<?php
session_start(); 

   $bdd = new PDO('mysql:host=localhost;dbname=olympeParc', 'root', 'root');
   if(isset($_POST['forminscription'])) {
      $nom_membre = htmlspecialchars($_POST['nom_membre']);
      $prenom_membre = htmlspecialchars($_POST['prenom_membre']);
      $naissance_membre = htmlspecialchars($_POST['naissance_membre']);
      $mail_membre = htmlspecialchars($_POST['mail_membre']);
      $mdp = sha1($_POST['mdp']);
      $mdp2 = sha1($_POST['mdp2']);
      $age = date('Y') - date('Y', strtotime($naissance_membre));
      
      
      if(!empty($_POST['recaptcha-response'])){
         $url = "https://www.google.com/recaptcha/api/siteverify?secret=6LfCV6UZAAAAALVxkdnJhibcu6yCl3h9hxQ8spNK&response={$_POST['recaptcha-response']}";
         $response = file_get_contents($url);
            if(empty($response) || is_null($response)) {
               header('Location: inscription.php');
                $erreur = "Seriez vous un robot ? ";
            }
            else {
               $data = json_decode($response);
               if ($data-> success) {
                  if(!empty($_POST['nom_membre']) AND !empty($_POST['prenom_membre']) AND !empty($_POST['naissance_membre']) 
                  AND !empty($_POST['mail_membre']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']) ){
                     $nom_membre_length = strlen($nom_membre);
                     $prenom_membre_length = strlen($prenom_membre);
                        if ($nom_membre_length <= 255){
                           if($prenom_membre_length <= 255){
                                 if ($age > 17 AND $age < 120) {
                                       if(filter_var($mail_membre, FILTER_VALIDATE_EMAIL)) {
                                          $reqmail_membre = $bdd->prepare('SELECT  id_membre, nom_membre, prenom_membre, naissance_membre, mail_membre, mdp_membre, date_inscription, compte_actif FROM membre WHERE mail_membre = ?');
                                          $reqmail_membre->execute(array($mail_membre));
                                          $mail_membreexist = $reqmail_membre->rowCount();
                                             if($mail_membreexist == 0) {
                                                if($mdp == $mdp2) {
                                                   $insertmembre = $bdd->prepare("INSERT INTO membre(nom_membre, prenom_membre, naissance_membre, mail_membre, mdp_membre, date_inscription, compte_actif) VALUES (?, ?, ?, ?, ?, NOW(), 0)");
                                                   $insertmembre->execute(array($nom_membre, $prenom_membre, $naissance_membre, $mail_membre, $mdp));
                                                   $erreur = "Votre compte a bien été créé ! <a href=\"connexion.php\"> Me connecter </a>";
                                                }
                                                else {
                                                   $erreur = "Vos mots de passes ne correspondent pas !";
                                                }
                                             }
                                       }
                                       else {
                                          $erreur = "Adresse mail déjà utilisée !"; 
                                       }
                                 }
                                 else {
                                    if (($age >= 120) || ($age <= 0))  {
                                       $erreur = "Date de naissance incorrecte";
                                    }
                                    else if ($age <= 17) {
                                       $erreur = "Vous devez être majeur";
                                    }
                                 }
                           }
                           else {
                              $erreur = "Votre prénom ne doit pas dépasser les 255 caractères !";
                           }  
                        }
                        else {
                           $erreur = "Votre nom ne doit pas dépasser les 255 caractères !";
                        }
                  }
               }  // data succes 
            } 
      } // !empty resposne
   } // form inscription

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription membre - Olympe Parc</title>
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
   
      <h2>Inscription</h2>
      <section class="formulaire_inscription">
               <form method="POST" action="">
                  <table>
                     <!-- Nom --> 
                     <tr>
                        <td align="right">
                           <label for="nom_membres">Nom : </label>
                        </td>
                        <td>
                           <input type="text" placeholder="Votre Nom" id="nom_membre" name="nom_membre" value=""/>
                        </td>
                     </tr>
                     <!-- Prenom --> 
                     <tr>
                        <td align="right">
                           <label for="prenom_membres">Prenom : </label>
                        </td>
                        <td>
                           <input type="text" placeholder="Votre Prénom" id="prenom_membre" name="prenom_membre" value=""/>
                        </td>
                     </tr>
                        <!-- Date de naissance --> 
                        <tr>
                            <td align="right">
                                <label for="naissance_membre">Date de naissance : </label>
                            </td>
                            <td>
                                <input type="date" id="date" name="naissance_membre" value="2020-03-31"/>
                        </td>
                        </tr>
                     <!-- Mail --> 
                     <tr>
                        <td align="right">
                           <label for="mail_membres">Mail :</label>
                        </td>
                        <td>
                           <input type="email" placeholder="Votre mail" id="mail_membre" name="mail_membre" value=""/>
                        </td>
                     </tr>
                     <!-- Mot de passe --> 
                     <tr>
                        <td align="right">
                           <label for="mdp">Mot de passe :</label>
                        </td>
                        <td>
                           <input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp"/>
                        </td>
                     </tr>
                     <!-- Mot de passe --> 
                     <tr>
                        <td align="right">
                           <label for="mdp2">Confirmation du mot de passe :</label>
                        </td>
                        <td>
                           <input type="password" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2"/>
                        </td>
                     </tr>
                     <!-- reCAPTCHA (je ne suis pas un robot)-->
                     <tr>
                           <td align="right">
                           </td>
                           <td>
                              <input type="hidden" id="recaptchaResponse" name="recaptcha-response">
                           </td>
                        </tr>
                     <tr>
                        <td></td>
                        <td align="center">
                        <br />
                           <input type="submit" name="forminscription" value="Je m'inscris"/>
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
                           <a href="connexion.php" id="lien_connexion">Déjà inscrit ? Se connecter</a>
                        </td>
                     </tr>
                  </table>
               </form>
      </section>

      <?php include '../Parties/footer.php'; ?>

      <script src="https://www.google.com/recaptcha/api.js?render=6LfCV6UZAAAAAP8mAV1rf51l6hycLnucEAPwBLhU"></script>
      <script>
      grecaptcha.ready(function() {
         grecaptcha.execute('6LfCV6UZAAAAAP8mAV1rf51l6hycLnucEAPwBLhU', {action: 'homepage'}).then(function(token) {
            document.getElementById("recaptchaResponse").value = token
         });
      });
      </script>
</body>
</html>