<?php

namespace App\Services;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class MailService
{
    public function send(
        string $to,
        string $subject,
        string $body,
        bool $isHtml = true
    ): bool {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();

            $mail->Host       = $_ENV['SMTP_HOST'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $_ENV['SMTP_USER'];
            $mail->Password   = $_ENV['SMTP_PASSWORD'];
            $mail->Port       = (int) $_ENV['SMTP_PORT'];

            if ($_ENV['SMTP_ENCRYPTION'] === 'ssl') {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            } else {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            }

            $mail->setFrom(
                $_ENV['MAIL_FROM'],
                $_ENV['MAIL_FROM_NAME']
            );

            $mail->addAddress($to);

            $mail->isHTML($isHtml);
            $mail->Subject = $subject;
            $mail->Body    = $body;

            if (!$isHtml) {
                $mail->AltBody = $body;
            }

            return $mail->send();

        } catch (Exception $e) {
	    echo "ERROR PHPMailer: " . $e->getMessage() . PHP_EOL;
	    return false;
	}
    }
}
