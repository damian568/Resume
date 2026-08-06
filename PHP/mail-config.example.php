<?php
// Copy this file to mail-config.php (same folder) and fill in real values.
// mail-config.php is git-ignored — it will never be committed or pushed.
//
// SMTP_USERNAME / SMTP_PASSWORD: a Gmail address + App Password.
// An App Password is NOT your normal Gmail password — generate one at
// https://myaccount.google.com/apppasswords (requires 2-Step Verification
// to be enabled on the Google account first).

return [
    'host'     => 'smtp.gmail.com',
    'port'     => 465,
    'username' => 'your-address@gmail.com',
    'password' => 'your-16-char-app-password',
];
