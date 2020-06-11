<?php 
session_start();

    $bdd = new PDO('mysql:host=localhost;dbname=olympeParc', 'root', 'root');
    if(isset($_POST['formprereservation'])){
        $nbr_adulte = htmlspecialchars($_POST['nbr_adulte']);
        $nbr_enfant = htmlspecialchars($_POST['nbr_enfant']);
        $date_arrivee = htmlspecialchars($_POST['date_arrivee']);
        $date_depart = htmlspecialchars($_POST['date_depart']);
        $dateActuelle = new dateTime();
        if (!empty($_SESSION)) {
            if (isset($_SESSION['id_admin'])) {
                $erreur = "Vous ne pouvez pas effectuer de pré-réservation en étant connecté en Admin"; 
            }
            else {
                if ($_SESSION['compte_actif'] === "1"){
                    if (( $date_arrivee < $dateActuelle ) AND ($date_depart < $dateActuelle ) AND ($date_depart > $date_arrivee) ) {
                                    if (!empty($_POST['nbr_adulte']) AND !empty($_POST['nbr_enfant']) AND !empty($_POST['date_arrivee']) AND !empty($_POST['date_depart'])) {
                                            $insertreserv = $bdd->prepare("INSERT INTO pre_reservation(date_arrivee, date_depart, nbr_adulte, nbr_enfant, date_reservation, id_ref_membre) VALUES (?, ?, ?, ?, NOW(), '".$_SESSION['id_membre']."')");
                                            $insertreserv->execute(array($date_arrivee, $date_depart, $nbr_adulte, $nbr_enfant));
                                            include 'mailConfirmationReservation.php'; 
                                        }
                                    else {
                                    $erreur = "Tous les champs doivent être complétés !";
                                    }
                    }
                    else {
                        $erreur = "Dates incorrectes"; 
                    }
                }
                else {
                    $erreur = "Vous devez activer votre compte avant toute pré-réservation"; 
                }
            }
        }
        else {
            $erreur = "Vous devez être connecté pour effectuer une pré-réservation"; 
        }
    }
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pré-réservation - Olympe Parc</title>
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

            <h1> Pré-réservation </h1>

            <div class="offreDuMoment">
            <a href="#" class="ticket">
                <img src="image/ticket1.png">
                <p>Offre de lancement</p>
                <p>Réduction temporaire</p>
                <p class="fail"> Offre momentanément indisponible</p>
         </a>
            <a href="#" class="ticket">
             <img src="image/ticket2.png">
             <p>Pack Famille</p>
             <p>2 Adultes + 2 Enfants</p>
             <p class="fail"> Offre momentanément indisponible</p>
            </a>
         </div>

        <?php  if (!empty($_SESSION)) {
        } else {
        ?> 
            <div class="connexion">
                <button><a href="./Espace_membre/connexion.php">Se connecter</a></button>
                <button><a href="./Espace_membre/inscriptionmembre.php">S'inscrire</a></button>
            </div>
        <?php 
        } 
        ?>

            <div class="reservation">
                <h2>Pré-réservation simple en quelques clics</h2>
                <?php if(isset($erreur)) { echo '<font color="red">'.$erreur."</font>"; }  ?>  
                <form method="POST" action="">
                    <p> Choisir le nombre de billet Adultes: </p>
                    <div class="adultes">
                        <input type="radio" name="nbr_adulte" value="1"> 1
                        <input type="radio" name="nbr_adulte" value="2"> 2
                        <input type="radio" name="nbr_adulte" value="3"> 3
                        <input type="radio" name="nbr_adulte" value="4"> 4
                        <input type="radio" name="nbr_adulte" value="5"> 5
                        <input type="radio" name="nbr_adulte" value="6"> 6
                    </div>

                    <p> Choisir le nombre de billet Enfants : </p>
                    <div class="enfants">
                        <input type="radio" name="nbr_enfant" value="0">0
                        <input type="radio" name="nbr_enfant" value="1">1
                        <input type="radio" name="nbr_enfant" value="2">2
                        <input type="radio" name="nbr_enfant" value="3">3
                        <input type="radio" name="nbr_enfant" value="4">4
                        <input type="radio" name="nbr_enfant" value="5">5
                        <input type="radio" name="nbr_enfant" value="6">6
                    </div>

                    <p> Selectionner la date d'arrivée :</p>
                    <input type="date" id="date" name="date_arrivee" value="2020-04-06"/>
                    <p> Selectionner la date de retour :</p>
                    <input type="date" id="date" name="date_depart" value="2020-04-14"/>
                    <p> 
                    <input type="submit" name="formprereservation" id="reserver" value="Pré-réserver"/>
                    </p>
                </form>
            </div>
           
            <?php if(isset($message)) { echo '<h4 style="color: green;">'.$message.'<h4>'; }  ?>  

        </section>

        <?php include './Parties/aside.php'; ?>
    </main>

    <?php include './Parties/footer.php'; ?>
</body>
</html>