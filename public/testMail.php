<?php

require_once __DIR__ . '/../app/bootstrap.php';

use App\Services\MailService;

$mailService = new MailService();

$sent = $mailService->send(
    $_ENV['MAIL_TEST_TO'],
    'Prueba MailService - SDI',
    '<h1>MailService funcionando</h1>
     <p>Este correo fue enviado desde SDI mediante PHPMailer + Gmail SMTP.</p>'
);

if ($sent) {
    echo "CORREO ENVIADO CORRECTAMENTE\n";
} else {
    echo "ERROR AL ENVIAR CORREO\n";
}
