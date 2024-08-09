<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Récupération des données du formulaire
    $nom = htmlspecialchars($_POST["fname"]);
    $pnom = htmlspecialchars($_POST["lname"]);
    $tel = htmlspecialchars($_POST["tel"]);
    $email = htmlspecialchars($_POST["mail"]);
    $p = htmlspecialchars($_POST["p"]);
    $message = htmlspecialchars($_POST["message"]);

    // Adresse email où vous souhaitez recevoir les messages (votre adresse Gmail)
    $destinataire = "sasf-voyages66@protonmail.com";

    // Sujet de l'email
    $sujet = "Nouveau message de $nom";

    // Corps de l'email
    $contenu = "Nom: $nom $pnom \n";
    $contenu .= "Email: $email\n";
    $contenu .= "Tel: $tel\n";
    $contenu .= "Pays: $p\n\n";
    $contenu .= "Message:\n$message";

    // Instanciation de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Paramètres SMTP pour Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'giovanidassitankou@gmail.com'; // Votre adresse Gmail
        $mail->Password = 'gsyj ntye gylo zvgz'; // Votre mot de passe Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587; // Port SMTP de Gmail

        // Destinataire et expéditeur
        $mail->setFrom($email, $nom);
        $mail->addAddress($destinataire);

        // Contenu de l'email
        $mail->isHTML(false); // Le contenu est-il au format HTML ? Non

        $mail->Subject = $sujet;
        $mail->Body = $contenu;

        // Envoi de l'email
        $mail->send();
        header("Location:contact.php");
    } catch (Exception $e) {
        echo "<p>Désolé, une erreur s'est produite lors de l'envoi de votre message. Erreur : {$mail->ErrorInfo}</p>";
    }
}
