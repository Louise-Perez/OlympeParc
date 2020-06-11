<?php 
session_start();
// Connexion Administrateur // 
   $bdd = new PDO('mysql:host=localhost;dbname=olympeParc', 'root', 'root');
   if(isset($_POST['formAdminConnexion'])) {
      $mail_adminconnect = htmlspecialchars($_POST['mail_adminconnect']);
      $mdpadminconnect = sha1($_POST['mdpadminconnect']);
      if (!empty($mail_adminconnect) AND !empty($mdpadminconnect)){
         $reqadmin = $bdd->prepare("SELECT * FROM admin_espace WHERE mail_admin = ? AND mdp_admin = ?");
         $reqadmin->execute(array($mail_adminconnect, $mdpadminconnect));
         $adminexist = $reqadmin->rowCount();
         if ($adminexist == 1){
            $admininfo = $reqadmin->fetch();
            $_SESSION['id_admin'] = $admininfo['id_admin'];
            $_SESSION['pseudo_admin'] = $admininfo['pseudo_admin'];
            $_SESSION['mail_admin'] = $admininfo['mail_admin'];
            $_SESSION['mdp_admin'] = $admininfo['mdp_admin'];
            header("Location: admin.php");
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
    <title>Admin - Olympe Parc</title>
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



      <?php $bdd = new PDO('mysql:host=localhost;dbname=olympeParc', 'root', 'root');
         if(isset($_SESSION['id_admin'])) {
         $requser = $bdd->prepare("SELECT * FROM admin_espace WHERE id_admin = ?");
         $requser->execute(array($_SESSION['id_admin']));
         $user = $requser->fetch();
         ?> 

         <h4> Administrateur : <?php  echo $_SESSION['pseudo_admin'] ?> </h4>
         <button><a href="../Espace_membre/deconnexion.php">Se déconnecter</a></button>


      <section class="ajout_activite">
         <?php  // AJOUT ACTIVITE 
            $bdd = new PDO('mysql:host=localhost;dbname=olympeParc', 'root', 'root');
            if(isset($_POST['formactivite'])) {
               $nom_activite = htmlspecialchars($_POST['nom_activite']);
               $type_activite = htmlspecialchars($_POST['type_activite']);
               $contenu_activite = htmlspecialchars($_POST['contenu_activite']);
               $interet_activite = htmlspecialchars($_POST['interet_activite']);
               $taille_minimum = htmlspecialchars($_POST['taille_minimum']);
               if(!empty($_POST['nom_activite']) AND !empty($_POST['type_activite']) AND !empty($_POST['contenu_activite']) AND !empty($_POST['interet_activite']) AND !empty($_POST['taille_minimum'])){
                  $insertactivite = $bdd->prepare("INSERT INTO activites(nom_activite, type_activite, taille_minimum, interet_activite, contenu_activite, image_activite, notation_activite, id_ref_admin) VALUES (?, ?, ?, ?, ?, '00', 0, '".$_SESSION['id_admin']."')");
                  $insertactivite->execute(array($nom_activite, $type_activite, $taille_minimum, $interet_activite, $contenu_activite));;
                  $message = "Votre activité a bine été ajouter";
               }
               else {
                  $erreur = "Vous devez remplir tous les champs";
               }
            }
         ?>
         <h2> Ajouter une activité</h2>
            <?php
               if(isset($message)){
                  echo '<font color="green">'.$message."</font>";
               }
               if(isset($erreur)) {
                  echo '<font color="red">'.$erreur."</font>";
               }
            ?> 
            <form method="POST" action="">
               <table>
                  <tr><!-- Type d'activité--> 
                     <td align="right">
                        <p> Type de l'activité</p>
                     </td>
                     <td>
                        <select name="type_activite">
                           <option value=""></option>
                           <option value="Attraction">Attraction</option>
                           <option value="Spectacle">Spectacle</option>
                           <option value="Activité">Activité</option>
                        </select>
                     </td>
                  </tr>   
                  <tr><!-- Nom --> 
                     <td align="right">
                        <label for="nom_activite">Nom : </label>
                     </td>
                     <td>
                        <input type="text" placeholder="Nom de l'activité" name="nom_activite"/>
                     </td>
                  </tr>
                  <tr><!-- Contenu --> 
                     <td align="right">
                        <label for="contenu_activite">Contenu de l'activité : </label>
                     </td>
                     <td>
                        <input type="text" name="contenu_activite"/>
                     </td>
                  </tr>
                  <tr><!-- Interet de l'activité--> 
                     <td align="right">
                        <p> Intérêt : </p>
                     </td>
                     <td>
                        <select name="interet_activite">
                           <option value=""></option>
                           <option value="Toute la famille">Toute la famille</option>
                           <option value="Amateur de sensation">Amateur de sensation</option>
                           <option value="Culture">Culture</option>
                        </select>
                     </td>
                  </tr>            
                  <tr><!-- Taille minimum de l'activité--> 
                     <td align="right">
                        <p> Taille minimum : </p>
                     </td>
                     <td>
                        <select name="taille_minimum">
                           <option value="10">0cm</option>
                           <option value="90">90cm</option>
                           <option value="120">120cm</option>
                           <option value="150">150cm</option>
                        </select>
                     </td>
                  </tr>            
                  <tr><!-- Submit--> 
                     <td></td>
                     <td align="center">
                        <br />
                        <input type="submit" name="formactivite" value="Enregistrer l'activité"/>
                     </td>
                  </tr>
               </table>
            </form>
      </section>

      <hr/>

      <section class="admin_vu" >   <!-- Afficher les activités -->
         <h3> Tableaux activités </h3> 

         <table class="admin_tableaux">
            <tr>
               <th> Id_admin </th>
               <th> Nom</th>
               <th> Type </th>
               <th> Interet </th>  
               <th> Contenu </th>
               <th> Moyenne des notes </th>
            </tr>

         <?php   // Afficher les activités// 
            $bdd = new PDO('mysql:host=localhost;dbname=olympeParc', 'root', 'root');
            $reponse = $bdd->query('SELECT * FROM activites');
            while ($donnees = $reponse->fetch()){
            ?>
               <tr>
                  <td><?php echo htmlspecialchars($donnees['id_ref_admin']); ?></td>
                  <td><?php echo htmlspecialchars($donnees['nom_activite']); ?></td>
                  <td><?php echo htmlspecialchars($donnees['type_activite']); ?> </td>   <!-- Trier par date-->
                  <td><?php echo htmlspecialchars($donnees['interet_activite']); ?></td>
                  <td><?php echo htmlspecialchars($donnees['contenu_activite']); ?></td>
                  <td><?php 
                        $requete = $bdd->query('SELECT AVG(notation) AS moyenne FROM notation WHERE id_ref_activite="'.$donnees['id_activite'].'"');
                        while($donnees3 = $requete->fetch()) {
                           echo (round($donnees3['moyenne'], 2)) . "/5";
                        }
                     ?>
                  </td>
               </tr>
         <?php
            }
         ?> 
         </table>
      </section>

      <hr/>
      <br/>

      <section class="admin_vu" > <!-- Afficher les Pré-réservation --> 
         <h3> Tableaux des pré-reservations en cours </h3> 

         <table class="admin_tableaux">
            <tr>
               <th> N° de reservation</th>
               <th> Date de réservation </th> 
               <th> Id + Nom de la réservation </th>
               <th> Date arrivé et départ </th>
               <th> Billet Adulte </th>
               <th> Billlet Enfant </th>
            </tr>
            
            <?php   // Afficher les Pré-réservation// 
               $bdd = new PDO('mysql:host=localhost;dbname=olympeParc', 'root', 'root');
               $reponse = $bdd->query('SELECT * FROM pre_reservation ORDER BY date_reservation');
               while ($donnees = $reponse->fetch()){
                  $reponse2 = $bdd->query("SELECT nom_membre FROM membre INNER JOIN pre_reservation ON membre.id_membre = ".$donnees['id_ref_membre']);
                  $donnees2 = $reponse2->fetch();
            ?>
                  <tr>
                     <td><?php echo htmlspecialchars($donnees['id_reservation']); ?></td>
                     <td><?php echo htmlspecialchars($donnees['date_reservation']); ?></td>
                     <td><?php echo htmlspecialchars($donnees['id_ref_membre']) . " - " . htmlspecialchars($donnees2['nom_membre']) ; ?></td>
                     <td><?php echo htmlspecialchars($donnees['date_arrivee']) . " - " . htmlspecialchars($donnees['date_depart']) ; ?></td>  
                     <td><?php echo htmlspecialchars($donnees['nbr_adulte']); ?></td>
                     <td><?php echo htmlspecialchars($donnees['nbr_enfant']); ?></td>
                  </tr>
            <?php
               }
            ?> 
         </table>
      </section>

   <?php  
   } 
   else {           // Espace Connexion ADMIN 
   ?>
      <section class="espace_connexion">
         <h2> Connexion Administrateur </h2> 
            <?php
            if(isset($erreur)) {
               echo '<font color="red">'.$erreur."</font>";
            }
            ?>
               <form method="POST" action="">
               <input type="email" name="mail_adminconnect" placeholder="Mail" />
               <input type="password" name="mdpadminconnect" placeholder="Mot de passe" />
               <br /><br />
               <input type="submit" name="formAdminConnexion" value="Se connecter !" />
               </form>
      </section>   
   <?php
   }
   ?>
</body>
</html>

