<?php
declare(strict_types=1);

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

$name    = trim((string) ($_POST['name'] ?? ''));
$email   = trim((string) ($_POST['email'] ?? ''));
$message = trim((string) ($_POST['message'] ?? ''));

if ($name === '' || $email === '' || $message === '') {
    http_response_code(422);
    respond(false, 'Please fill in all fields.');
}

// Reject header-injection attempts via newlines in name/email
if (strpbrk($name . $email, "\r\n") !== false) {
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

$safeName    = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
$safeMessage = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

$subject = 'Portfolio contact form - message from ' . $safeName;
$body = "You received a new message from your portfolio site.\n\n"
    . "Name: {$safeName}\n"
    . "Email: {$email}\n\n"
    . "Message:\n{$safeMessage}\n";

$host = $_SERVER['SERVER_NAME'] ?? 'localhost';
$headers = [
    "From: Portfolio Contact Form <no-reply@{$host}>",
    "Reply-To: {$email}",
    'Content-Type: text/plain; charset=UTF-8',
];

$sent = mail($recipient, $subject, $body, implode("\r\n", $headers));

if ($sent) {
    respond(true, "Thanks, {$safeName}! Your message has been sent.");
}

http_response_code(500);
respond(false, 'Sorry, something went wrong sending your message. Please try again later or email me directly.');
