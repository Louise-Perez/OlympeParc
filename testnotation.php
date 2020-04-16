<?php 
 $bdd = new PDO('mysql:host=localhost;dbname=olympeParc', 'root', 'root');
           
    // Récupérer adresse IP / /
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){  // Internet partagé // 
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){  // proxy //
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{ // IP normale // 
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    if(isset($_POST['formnotation'])){
        $ip;
        $notation = htmlspecialchars($_POST['notation_act']);

        $reponse = $bdd->query('SELECT * FROM activites');
        
        while($donnees = $reponse->fetch()) {

        $id_activite = htmlspecialchars($donnees['id_activite']) ;   // Trouver comment l'id s'adapte à son activite //
        }
        // $requete = $bdd->query("SELECT * FROM notation where ip_notation = '$ip'");
        //     if($requete->rowCount() != 0){
            //     echo "Vous avez déja voté";
            // }
            // else {
                if (isset($_POST['notation_act']) AND !empty($_POST['notation_act']) ) {
                $insertnote = $bdd->prepare("INSERT INTO notation(notation, ip_notation, id_ref_activite) VALUES (?, ?, ?)");
                $insertnote->execute(array($notation, $ip, $id_activite));
                echo "Vote validé";
                }
                else {
                    $message = "Votre vote n'a pas été pris en compte";
                }
            // }
    }

?> 

<?php   // Afficher la base de données selon le resultat de la recherche// 
            $bdd = new PDO('mysql:host=localhost;dbname=olympeParc', 'root', 'root');
                $reponse = $bdd->query('SELECT * FROM activites');
                if($reponse->rowCount() >= 0) {
                    $reponse = $bdd->query('SELECT * FROM activites');
                        while($donnees = $reponse->fetch()) { ?> 

                            <article class="activite">
                            <?php if(isset($message)) { echo '<font color="red">'.$message."</font>"; }  ?>  
                            <div class="vote"> <!-- Système de vote --> 
                                    <form action="" method="post" class="vote_btns">
                                    <input type="radio" class="vote_btn" name="notation_act" value="1" width="30" height="30"/>1
                                    <input type="radio" class="vote_btn" name="notation_act" value="2" width="30" height="30"/>2
                                    <input type="radio" class="vote_btn" name="notation_act" value="3" width="30" height="30"/>3
                                    <input type="radio" class="vote_btn" name="notation_act" value="4" width="30" height="30"/>4
                                    <input type="radio" class="vote_btn" name="notation_act" value="5" width="30" height="30"/>5
                                    
                                    <?php 
                                    $requete = $bdd->query('SELECT AVG(notation) AS moyenne FROM notation WHERE id_ref_activite = "5"');
                                    while($donnees3 = $requete->fetch()) {
                                    echo $donnees3['moyenne'] . "/5";
                                    } ?>

                                    <input type="submit" name="formnotation" id="noter" value="Voter"/>                             
                                </from>
                            </div>
                            <?php echo 'L adresse IP de l utilisateur est : '.$ip; ?>

                            <div>
                                    <h2><?php echo htmlspecialchars($donnees['nom_activite']) . " numero " . htmlspecialchars($donnees['id_activite']) ; ?></h2>
                                    <p><span class="intitule_activite">Interet</span> : <?php echo htmlspecialchars($donnees['interet_activite']); ?></p>
                                    <p><span class="intitule_activite">Description</span> : <br/> 
                                        <?php echo htmlspecialchars($donnees['contenu_activite']); ?> 
                                    </p>
                                </div>
                            </article>
                            <hr/>
                        <?php
                        }
                } 