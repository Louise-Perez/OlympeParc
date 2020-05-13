<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=olympeParc', 'root', 'root');        
   // Récupérer adresse IP / /
   if(!empty($_SERVER['HTTP_CLIENT_IP'])){  // Internet partagé // 
       $ip = $_SERVER['HTTP_CLIENT_IP'];
   }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){  // proxy //
       $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
   }else{ // IP normale // 
       $ip = $_SERVER['REMOTE_ADDR'];
   }

   // Le formulaire de notation
   if(isset($_POST['formnotation'])){
       $ip;
       $notation = htmlspecialchars($_POST['notation_act']);
       $id_activite = substr($notation, 0, -2);
       $taille = strlen($notation);
       $notation = substr($notation, $taille-1);
       $reponse2 = $bdd->query('SELECT * FROM activites');

       $i = 0;
       while($donnees = $reponse2->fetch()) {
           $id_ref_activite[$i] = htmlspecialchars($donnees['id_activite']) ;
           $i++;
       }
           //Si mon IP est déjà enregistré
               // $requete = $bdd->query("SELECT * FROM notation where ip_notation = '$ip'");    
               //     if($requete->rowCount() != 0){
               //     echo "Vous avez déja voté";
               // }
               // else {

                   if (isset($_POST['notation_act']) AND !empty($_POST['notation_act']) ) {
                       $insertnote = $bdd->prepare("INSERT INTO notation(notation, ip_notation, id_ref_activite) VALUES (?, ?, ?)");
                       $insertnote->execute(array($notation, $ip, $id_activite));
                       $message = "Vote validé, vous pouvez voter pour une autre activité" ;
                   }
                   else {
                       $message = "Votre vote n'a pas été pris en compte";
                   }    
   }
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

    <main>
        <section class="container">

            <h1> Sondage </h1>
            <p id="sondageTexte"> Vous avez l'opportunité de voter pour chacune de nos activités. 
                De 1 à 5 , votre note nous sera utile pour le développement du parc. 
                Ainsi nous pourrons nous adapter à vos envies.<br/>
                <strong>Attention un vote à la fois</strong>
            </p>
            <?php if(isset($message)) { echo '<font color="red">'.$message."</font>"; }  ?>  
                                
            <hr/>

            <?php   // Afficher la base de données selon le resultat de la recherche// 
                $bdd = new PDO('mysql:host=localhost;dbname=olympeParc', 'root', 'root');
                $reponse = $bdd->query('SELECT * FROM activites');
                if($reponse->rowCount() >= 0) {
                    $reponse = $bdd->query('SELECT * FROM activites');
                    $id_activite_recup = 0; 
                    while($donnees = $reponse->fetch()) { ?> 

                        <article class="activite">
                            <div>
                                <img src="image/<?php echo htmlspecialchars($donnees['image_activite']); ?>.jpg">
                                <div class="vote"> <!-- Système de vote --> 
                                    <form action="" method="post" class="vote_btns"> 
                                        <input type="radio" class="vote_btn" name="notation_act" value="<?="${id_ref_activite[$id_activite_recup]}-"?>1" width="30" height="30"/> 1
                                        <input type="radio" class="vote_btn" name="notation_act" value="<?="${id_ref_activite[$id_activite_recup]}-"?>2" width="30" height="30"/> 2
                                        <input type="radio" class="vote_btn" name="notation_act" value="<?="${id_ref_activite[$id_activite_recup]}-"?>3" width="30" height="30"/> 3
                                        <input type="radio" class="vote_btn" name="notation_act" value="<?="${id_ref_activite[$id_activite_recup]}-"?>4" width="30" height="30"/> 4
                                        <input type="radio" class="vote_btn" name="notation_act" value="<?="${id_ref_activite[$id_activite_recup]}-"?>5" width="30" height="30"/> 5
                                                    
                                        <input type="submit" name="formnotation" id="noter" value="Voter"/>  <!-- Valider mon choix de vote -->
                                        <?php $id_activite_recup++; ?>                         
                                    </form>
                                </div>
                            </div>

                            <div>
                                <h2><?php echo htmlspecialchars($donnees['nom_activite']); ?></h2>
                                <p><span class="intitule_activite">Interet</span> : <?php echo htmlspecialchars($donnees['interet_activite']); ?></p>
                                <p><span class="intitule_activite">Description</span> : <br/> 
                                <?php echo htmlspecialchars($donnees['contenu_activite']); ?> </p>
                            </div>
                        </article>
                        <hr/>
                    <?php
                    }
                } 
            ?>
        </section>
        <?php include './Parties/aside.php'; ?>
    </main>
    <?php include './Parties/footer.php'; ?>
</body>
</html>