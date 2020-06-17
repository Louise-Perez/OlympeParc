<?php
session_start();    
    $bdd = new PDO('mysql:host=localhost;dbname=olympeParc', 'root', 'root');
    if(isset($_SESSION['id_membre'])) {
        $reqmembre = $bdd->prepare("SELECT id_membre, nom_membre, prenom_membre, naissance_membre, mail_membre, mdp_membre, date_inscription, compte_actif FROM membre WHERE id_membre = ?");
        $reqmembre->execute(array($_SESSION['id_membre']));
        $membre = $reqmembre->fetch();

        // Mis à jour Nom // 
        if(isset($_POST['newnom']) AND !empty($_POST['newnom']) AND $_POST['newnom'] != $membre['nom_membre']) {
            $newnom = htmlspecialchars($_POST['newnom']);
            $insertnom = $bdd->prepare("UPDATE membre SET nom_membre = ? WHERE id_membre = ?");
            $insertnom->execute(array($newnom, $_SESSION['id_membre']));
            header('Location: espacemembre.php?id='.$_SESSION['id_membre']);
        }
        // Mis à jour Prénom // 
        if(isset($_POST['newprenom']) AND !empty($_POST['newprenom']) AND $_POST['newprenom'] != $membre['prenom_membre']) {                   
            $newprenom = htmlspecialchars($_POST['newprenom']);
            $insertprenom = $bdd->prepare("UPDATE membre SET prenom_membre = ? WHERE id_membre = ?");
            $insertprenom->execute(array($newprenom, $_SESSION['id_membre']));
            header('Location: espacemembre.php?id='.$_SESSION['id_membre']);
        }
        // Mis à jour Mail // 
        if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $membre['mail_membre']) {                   
            $newmail = htmlspecialchars($_POST['newmail']);
            $insertmail = $bdd->prepare("UPDATE membre SET mail_membre = ? WHERE id_membre = ?");
            $insertmail->execute(array($newmail, $_SESSION['id_membre']));
            header('Location: espacemembre.php?id='.$_SESSION['id_membre']);
        }
        // Mis à jour Date de Naissance // 
        if(isset($_POST['newnaissance']) AND !empty($_POST['newnaissance']) AND $_POST['newnaissance'] != $membre['naissance_membre']) {                   
            $newnaissance = htmlspecialchars($_POST['newnaissance']);
            $insertnaissance = $bdd->prepare("UPDATE membre SET naissance_membre = ? WHERE id_membre = ?");
            $insertnaissance->execute(array($newnaissance, $_SESSION['id_membre']));
            header('Location: espacemembre.php?id='.$_SESSION['id_membre']);
        }
        // Mis à jour Mot de passe //
        if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
            $mdp1 = sha1($_POST['newmdp1']);
            $mdp2 = sha1($_POST['newmdp2']);
            if ($mdp1 === $mdp2){
                $insertmdp = $bdd->prepare("UPDATE membre SET mdp_membre = ? WHERE id_membre = ?");
                $insertmdp->execute(array($mdp1, $_SESSION['id_membre']));
                header('Location: espacemembre.php?id='.$_SESSION['id_membre']);
            }
            else {
                $erreur = "Vos mots de passe ne correspondent pas !";
            }
        }
        // Activation du compte // 
        if (isset($_POST['activationCompte'])) {
            $insertactif = $bdd->prepare("UPDATE membre SET compte_actif = ? WHERE id_membre = ?");
            $insertactif->execute(array(1, $_SESSION['id_membre']));
            $validation = "Compte activé";
        }
        // Si compte déjà activé // 
        if ($_SESSION['compte_actif'] == 1) {
            $validation = "Compte activé";
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace membres - Olympe Parc</title>
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



    <section>
        <h2>Espace membre </h2>  
        <button class="bouton_profil"><a href="./Espace_membre/deconnexion.php">Se déconnecter</a></button>
        
        <?php 
            if (isset($validation)) { 
                echo '<font color="green">'.$validation ."</font>"; 
            }  
            else { ?> 
                <form action="" method="post">
                <input  type="submit" class="bouton_profil" name="activationCompte" value="Activer votre compte"/>
                </form> 
            <?php } ?>
        
        <article class="edition_profil">
            <h3>Edition de mon profil</h3>
        
            <?php if(isset($erreur)) { echo '<font color="red">'.$erreur."</font>"; }  ?>  
            <form method="POST" action="" enctype="multipart/form-data" class="formulaire_edition">
                <table>
                    <tr>
                        <td align="right">
                            <label>Nom :</label>
                        </td>
                        <td>
                            <input type="text" name="newnom" placeholder="Nom" value="<?php echo $membre['nom_membre']; ?>" />
                        </td>
                    </tr>
                     <tr>
                        <td align="right">
                            <label>Prenom :</label>
                        </td>
                        <td>
                            <input type="text" name="newprenom" placeholder="Prenom" value="<?php echo $membre['prenom_membre']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label>Mail :</label>
                        </td>
                        <td>    
                            <input type="text" name="newmail" placeholder="Mail" value="<?php echo $membre['mail_membre']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label>Date de Naissance :</label>
                        </td>
                        <td>    
                            <input type="date" id="date" name="newnaissance" value="<?php echo $membre['naissance_membre']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label>Mot de passe :</label>
                        </td>
                        <td>
                            <input type="password" name="newmdp1" placeholder="Mot de passe"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label>Confirmation - mot de passe :</label>
                        </td>
                        <td>
                            <input type="password" name="newmdp2" placeholder="Confirmation du mot de passe" />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="center">
                            <br />
                            <input type="submit" class="bouton_profil" value="Mettre à jour mon profil !" />
                        </td>
                    </tr>
                </table>
            </form>
            </article>

    </section>

                <hr/>

    <section>
        <h3> Pré-reservation en cours </h3> 
        <table class="encart_pre_reservation">
            <?php 
                $bdd = new PDO('mysql:host=localhost;dbname=olympeParc', 'root', 'root');

                $membreRef = $_SESSION['id_membre']; 
                $reponse = $bdd->prepare('SELECT id_reservation, date_arrivee, date_depart, nbr_adulte, nbr_enfant, date_reservation, id_ref_membre FROM pre_reservation WHERE id_ref_membre=? ');
                $reponse->execute(array($membreRef));
                    
                    if($reponse->rowCount() > 0){
                        $membreRef = $_SESSION['id_membre']; 
                        $reponse = $bdd->prepare('SELECT id_reservation, date_arrivee, date_depart, nbr_adulte, nbr_enfant, date_reservation, id_ref_membre FROM pre_reservation WHERE id_ref_membre=? ');
                        $reponse->execute(array($membreRef));
                        while ($donnees = $reponse->fetch() ) {
                            $membreIdRef = $donnees['id_ref_membre'];
                            $reponse2 = $bdd->prepare("SELECT nom_membre, prenom_membre, mail_membre FROM membre INNER JOIN pre_reservation ON membre.id_membre = ? ");
                            $reponse2->execute(array($membreIdRef));
                            $donnees2 = $reponse2->fetch();
                        ?>
                            <tr>
                                <th><?php echo htmlspecialchars($donnees2['nom_membre']) ?></th> 
                                <td> Du <?php echo htmlspecialchars($donnees['date_arrivee']) ?> au <?php echo htmlspecialchars($donnees['date_depart']) ?></td>
                                <td> Nombre de billet adulte : <?php echo htmlspecialchars($donnees['nbr_adulte']) ?></td>
                                <td> Nombre de billet enfants : <?php echo htmlspecialchars($donnees['nbr_enfant']) ?></td>
                                <td> Confirmation par mail envoyé à : <?php echo htmlspecialchars($donnees2['mail_membre']) ?></td>
                                <td> Effectué le : <?php echo htmlspecialchars($donnees['date_reservation']) ?></td>
                            </tr>
                        <?php
                        }
                    }
                    else {
                        echo '<p style="color: black;"> Vous n\'avez pas de pré-réservation en cours </p>';
                    }
                $reponse->closeCursor();
            ?> 
        </table> 
    </section>

    <?php include './Parties/footer.php'; ?>
</body>
</html>

<?php 
    }
    else {
        header("Location: ./Espace_membre/connexion.php");
    } ?> 