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
    // Lire les variables depuis .env
    $host       = getenv('MAIL_HOST');
    $port       = getenv('MAIL_PORT');
    $username   = getenv('MAIL_USERNAME');
    $password   = getenv('MAIL_PASSWORD');
    $encryption = getenv('MAIL_ENCRYPTION');
    $from       = $from ?: getenv('MAIL_FROM');
    $fromName   = getenv('MAIL_FROM_NAME');

    // Config SMTP O2Switch
    $mail->isSMTP();
    $mail->Host       = $host;
    $mail->SMTPAuth   = true;
    $mail->Username   = $username;
    $mail->Password   = $password;
    $mail->Port       = $port;
    $mail->SMTPSecure = $encryption === 'ssl'
      ? PHPMailer::ENCRYPTION_SMTPS
      : PHPMailer::ENCRYPTION_STARTTLS;

    // Expéditeur et destinataire
    $mail->setFrom($from, $fromName);
    $mail->addAddress($to);

    // Contenu HTML
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = $subject;
    $mail->Body    = $html;

    $mail->send();
    return true;
  } catch (Exception $e) {
    error_log("[sendMail] Erreur SMTP : " . $mail->ErrorInfo);

    // Fallback : mail() natif
    try {
      $mail->isMail();
      $mail->send();
      return true;
    } catch (Exception $e2) {
      error_log("[sendMail Fallback] Erreur : " . $mail->ErrorInfo);
      return false;
    }
  }
}

/**
 * envoie un e-mail de contact à l'équipe EcoRide
 */
function sendContactMail(string $nom, string $email, string $message): bool
{
  $to = 'repa7303@ecoride.sites-alya.fr'; // Adresse O2 switch
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
  $to = $user['email'];
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
  $to = $user['email'];
  $subject = "🚗 Confirmez votre trajet terminé";

  $html = "
    <html><body>
        <p>Bonjour <strong>{$user['prenom']}</strong>,</p>
        <p>Votre conducteur a marqué le trajet <strong>{$covoit['adresse_depart']} → {$covoit['adresse_arrivee']}</strong> comme terminé.
        Veuillez le confirmer pour que le chaufeur soit créditer
        Merci de vous connecter à votre espace pour le confirmer.</p>
        <p>
            <a href='http://ecoride.localhost:8888/detailsCovoit?id={$covoit['id_covoiturage']}'>
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
  $to = $chauffeur['email'];
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

/**
 * envoie un mail pour annulation de participation d'un passager
 */
function sendMailAnnulationParticipation(array $user, array $covoit): bool
{
  $to = $user['email'];
  $subject = "🚗 Annulation de votre participation au covoiturage";
  $html = "
    <html><body>
      <p>Bonjour <strong>{$user['prenom']}</strong>,</p>
      <p>Vous avez annulé votre participation au trajet <strong>{$covoit['adresse_depart']} → {$covoit['adresse_arrivee']}</strong>.</p>
      <p>Votre réservation a bien été annulée et vos crédits ont été remboursés.</p>
      <p>Merci d'utiliser EcoRide,<br>L’équipe EcoRide</p>
    </body></html>
  ";
  return sendMail($to, $subject, $html);
}

/**
 * envoie un mail au passager si le chauffeur annule le covoit
 */
function sendMailAnnulationChauffeur(array $user, array $covoit): bool
{
  $to = $user['email'];
  $subject = "🚨 Covoiturage annulé par le conducteur";
  $html = "
    <html><body>
      <p>Bonjour <strong>{$user['prenom']}</strong>,</p>
      <p>Le conducteur a annulé le covoiturage prévu de <strong>{$covoit['adresse_depart']} → {$covoit['adresse_arrivee']}</strong>.</p>
      <p>Nous vous confirmons que vos crédits vous ont été remboursés automatiquement.</p>
      <p>Merci de votre compréhension,<br>L’équipe EcoRide</p>
    </body></html>
  ";
  return sendMail($to, $subject, $html);
}

/**
 * envoie un mail au passager si le chauffeur supprime le covoit
 */
function sendMailSuppressionCovoit(array $user, array $covoit): bool
{
  $to = $user['email'];
  $subject = "🚗 Covoiturage supprimé";
  $html = "
    <html><body>
      <p>Bonjour <strong>{$user['prenom']}</strong>,</p>
      <p>Le covoiturage <strong>{$covoit['adresse_depart']} → {$covoit['adresse_arrivee']}</strong> a été supprimé.</p>
      <p>Vos crédits ont été remboursés automatiquement sur votre compte.</p>
      <p>Merci pour votre confiance,<br>L’équipe EcoRide</p>
    </body></html>
  ";
  return sendMail($to, $subject, $html);
}

/**
 * envoie un mail au chauffeur pour prevenir qu'un passager ces incrit a son covoit
 */
function sendMailInscriptionPassager(array $chauffeur, array $passager, array $covoit): bool
{
  $to = $chauffeur['email'];
  $subject = "👤 Nouveau passager pour votre covoiturage !";

  $html = "
    <html><body>
      <p>Bonjour <strong>{$chauffeur['prenom']}</strong>,</p>
      <p>Un nouveau passager, <strong>{$passager['prenom']} ({$passager['pseudo']})</strong>, vient de s'inscrire à votre covoiturage :</p>
      <ul>
        <li><strong>Départ :</strong> {$covoit['adresse_depart']}</li>
        <li><strong>Arrivée :</strong> {$covoit['adresse_arrivee']}</li>
        <li><strong>Date :</strong> {$covoit['date_depart']}</li>
      </ul>
      <p>Vous pouvez consulter les détails du trajet dans votre tableau de bord.</p>
      <p>Merci d'utiliser EcoRide,<br>L’équipe EcoRide</p>
    </body></html>
  ";

  return sendMail($to, $subject, $html);
}

/**
 * envoie un mail au chauffeur pour dire qu'un passager annul sa participation
 */
function sendMailAnnulationPassager(array $chauffeur, array $passager, array $covoit): bool
{
  $to = $chauffeur['email'];
  $subject = "❌ Un passager a annulé sa participation";

  $html = "
    <html><body>
      <p>Bonjour <strong>{$chauffeur['prenom']}</strong>,</p>
      <p>Votre passager <strong>{$passager['prenom']} {$passager['nom']}</strong> a annulé sa participation au covoiturage :</p>
      <ul>
        <li><strong>Trajet :</strong> {$covoit['adresse_depart']} → {$covoit['adresse_arrivee']}</li>
        <li><strong>Date :</strong> {$covoit['date_depart']}</li>
      </ul>
      <p>Une place a été libérée automatiquement.</p>
      <p>Bonne route,<br>L’équipe EcoRide</p>
    </body></html>";

  return sendMail($to, $subject, $html);
}
