<?php 
$bdd = new PDO('mysql:host=localhost;dbname=olympeParc', 'root', 'root');
            $destinataire = $_SESSION['mail_membre'];
            $sujet = "Merci pour votre pré-réservation \n";
            $entetes = "From : \n";
            $contenu = "Vous venez de réaliser une pré-réservation sur le site d'OlympeParc. \n
                        Votre pré-réservatoin a bien été prise en compte, vous serez recontacté dès l'ouverture des reservations. \n
                        Vous pouvez consulter votre pré-réservation dans votre espace membre \n ";
    if (mail($destinataire, $sujet, $contenu, $entetes)) {
        $message = "Votre préréservation a été réalisée avec succès, vous recevrez un mail de confirmation prochainement";
    } 
    else {
        $message = "Echec de l'envoi de l'email de confirmation";
    }
?> 