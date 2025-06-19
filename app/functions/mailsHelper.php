<?php
//fonction qui gére le mailling avec PHPMailer composer require phpmailer/phpmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../vendor/autoload.php'; // adapte si besoin


/**
 * Fonction générique d'envoi d'e-mail HTML
 *
 * @param string $to       Destinataire # $to = $user['email']; en prod #
 * @param string $subject  Sujet du mail
 * @param string $html     Contenu HTML du message
 * @param string $from     Adresse de l'expéditeur
 * @return bool            Succès ou échec de l'envoi
 */
function sendMail(string $to, string $subject, string $html, string $from = 'no-reply@ecoride.fr'): bool
{
  $mail = new PHPMailer(true);

  try {
    // Configuration Mailtrap
    $mail->isSMTP();
    $mail->Host = 'sandbox.smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Username = '22d1451e8bd48a';
    $mail->Password = '04f032efe07955';
    $mail->Port = 2525;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    // Adresse d’envoi et de réception
    $mail->setFrom($from, 'EcoRide');
    $mail->addAddress($to);

    // Contenu HTML
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $html;

    $mail->send();
    return true;
  } catch (Exception $e) {
    error_log("Erreur Mailtrap : " . $mail->ErrorInfo);
    return false;
  }
}

/**
 * envoie un e-mail de contact à l'équipe EcoRide
 */
function sendContactMail(string $nom, string $email, string $message): bool
{
  $to = 'test@ecoride.dev'; // Adresse test
  $subject = "📩 Nouveau message de contact EcoRide";

  $html = "
    <html><body>
        <h2>Message de contact</h2>
        <p><strong>Nom :</strong> $nom</p>
        <p><strong>Email :</strong> $email</p>
        <p><strong>Message :</strong><br>" . nl2br(htmlspecialchars($message)) . "</p>
    </body></html>";

  return sendMail($to, $subject, $html, $email);
}

/**
 * envoie un mail au passager pour départ covoiturage
 */
function sendDepartMail(array $user, array $covoit): bool
{
  $to = 'test@ecoride.dev';
  $subject = "🚗 Votre trajet avec EcoRide a démarré !";

  $html = "
    <html><body>
        <p>Bonjour <strong>{$user['prenom']}</strong>,</p>
        <p>Votre chauffeur vient de démarrer le trajet <strong>{$covoit['adresse_depart']} → {$covoit['adresse_arrivee']}</strong>.</p>
        <p>Pensez à préparer votre arrivée à l’heure prévue et à confirmer la fin du trajet une fois arrivé.</p>
        <p>Bon voyage avec EcoRide !</p>
    </body></html>";

  return sendMail($to, $subject, $html);
}

/**
 * envoie un mail aux passagers pour qu'ils confirment le trajet terminé
 */
function sendConfirmationMail(array $user, array $covoit): bool
{
  $to = 'test@ecoride.dev';
  $subject = "🚗 Confirmez votre trajet terminé";

  $html = "
    <html><body>
        <p>Bonjour <strong>{$user['prenom']}</strong>,</p>
        <p>Votre conducteur a marqué le trajet <strong>{$covoit['adresse_depart']} → {$covoit['adresse_arrivee']}</strong> comme terminé.
        Veuillez le confirmer pour que le chaufeur soit créditer
        Merci de vous connecter à votre espace pour le confirmer.</p>
        <p>
            <a href='https://ecoride.fr/detailsCovoit?id={$covoit['id_covoiturage']}'>
                Cliquez ici pour le confirmer
            </a>
        </p>
        <p>Merci pour votre confiance,<br>L’équipe EcoRide</p>
    </body></html>";

  return sendMail($to, $subject, $html);
}

/**
 * envoie un mail au chauffeur reçus crédits
 */
function sendCreditedMail(array $chauffeur, int $credits, array $covoit): bool
{
  $to = 'test@ecoride.dev';
  $subject = "💰 Vous avez été crédité de {$credits} crédits !";

  $html = "
    <html><body>
        <p>Bonjour <strong>{$chauffeur['prenom']}</strong>,</p>
        <p>Bonne nouvelle ! Tous vos passagers ont confirmé le trajet <strong>{$covoit['adresse_depart']} → {$covoit['adresse_arrivee']}</strong>.</p>
        <p>Vous venez d’être crédité de <strong>{$credits} crédits</strong> sur votre compte EcoRide.</p>
        <p>Merci de contribuer à une mobilité plus verte !</p>
    </body></html>";

  return sendMail($to, $subject, $html);
}
