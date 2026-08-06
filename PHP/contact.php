<?php
declare(strict_types=1);

require __DIR__ . '/smtp-mailer.php';

header('Content-Type: application/json; charset=utf-8');

$recipient = 'didi.milenov@gmail.com';

function respond(bool $success, string $message): void
{
    echo json_encode(['success' => $success, 'message' => $message]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    respond(false, 'Method not allowed.');
}

$name        = trim((string) ($_POST['name'] ?? ''));
$email       = trim((string) ($_POST['email'] ?? ''));
$userSubject = trim((string) ($_POST['subject'] ?? ''));
$message     = trim((string) ($_POST['message'] ?? ''));

if ($name === '' || $email === '' || $message === '') {
    http_response_code(422);
    respond(false, 'Please fill in all fields.');
}

// Reject header-injection attempts via newlines in name/email/subject
if (strpbrk($name . $email . $userSubject, "\r\n") !== false) {
    http_response_code(422);
    respond(false, 'Invalid input.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(422);
    respond(false, 'Please enter a valid email address.');
}

if (mb_strlen($message) > 5000) {
    http_response_code(422);
    respond(false, 'Message is too long.');
}

if (mb_strlen($userSubject) > 150) {
    http_response_code(422);
    respond(false, 'Subject is too long.');
}

$configPath = __DIR__ . '/mail-config.php';
if (!is_file($configPath)) {
    http_response_code(500);
    respond(false, 'Mail is not configured yet on this server.');
}

/** @var array{host:string,port:int,username:string,password:string} $config */
$config = require $configPath;

$emailSubject = $userSubject !== ''
    ? "Portfolio contact form: {$userSubject}"
    : "Portfolio contact form - message from {$name}";

$body = "You received a new message from your portfolio site.\n\n"
    . "Name: {$name}\n"
    . "Email: {$email}\n"
    . ($userSubject !== '' ? "Subject: {$userSubject}\n" : '')
    . "\nMessage:\n{$message}\n";

[$sent, $error] = smtp_send_mail(
    $config['host'],
    (int) $config['port'],
    $config['username'],
    $config['password'],
    $config['username'],
    'Portfolio Contact Form',
    $recipient,
    $emailSubject,
    $body,
    $email
);

if ($sent) {
    respond(true, "Thanks, {$name}! Your message has been sent.");
}

error_log('Contact form SMTP error: ' . $error);
http_response_code(500);
respond(false, 'Sorry, something went wrong sending your message. Please try again later or email me directly.');
