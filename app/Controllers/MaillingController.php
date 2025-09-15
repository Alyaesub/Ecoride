<?php

namespace App\Controllers;

class MaillingController
{
  public function sendContactMail()
  {
    require_once __DIR__ . '/../functions/mailsHelper.php';

    $nom = $_POST['nom'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';

    if (!$nom || !$email || !$message) {
      $_SESSION['error'] = "Tous les champs sont obligatoires.";
      header("Location: /contactForm");
      exit;
    }

    if (sendContactMail($nom, $email, $message)) {
      $_SESSION['success'] = "Message envoyé avec succès ✅";
    } else {
      $_SESSION['error'] = "Erreur lors de l'envoi ❌";
    }

    header("Location: /contactForm");
    exit;
  }

  public function sendConfirmationMail($passagers, $covoit)
  {
    require_once __DIR__ . '/../functions/mailsHelper.php';

    foreach ($passagers as $passager) {
      sendConfirmationMail($passager, $covoit);
    }
  }
}
