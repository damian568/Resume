<?php
declare(strict_types=1);

/**
 * Minimal dependency-free SMTP client (implicit TLS, AUTH LOGIN).
 * Built for hosts that disable PHP's mail() (e.g. free tiers) but still
 * allow outbound SMTP connections.
 */
function smtp_send_mail(
    string $host,
    int $port,
    string $username,
    string $password,
    string $fromEmail,
    string $fromName,
    string $toEmail,
    string $subject,
    string $body,
    ?string $replyTo = null
): array {
    $timeout = 12;
    $socket = @stream_socket_client(
        "ssl://{$host}:{$port}",
        $errno,
        $errstr,
        $timeout
    );

    if ($socket === false) {
        return [false, "Could not connect to mail server: {$errstr}"];
    }

    stream_set_timeout($socket, $timeout);

    $readResponse = function () use ($socket): string {
        $data = '';
        while (($line = fgets($socket, 515)) !== false) {
            $data .= $line;
            // Stop once a line has a space (not a dash) after the 3-digit code —
            // that marks the final line of a multi-line SMTP response.
            if (isset($line[3]) && $line[3] === ' ') {
                break;
            }
        }
        return $data;
    };

    $sendCommand = function (string $command) use ($socket, $readResponse): string {
        fwrite($socket, $command . "\r\n");
        return $readResponse();
    };

    $expectCode = function (string $response, string $expectedCode) use ($socket): bool {
        return substr($response, 0, 3) === $expectedCode;
    };

    $greeting = $readResponse();
    if (!$expectCode($greeting, '220')) {
        fclose($socket);
        return [false, 'Unexpected greeting from mail server: ' . trim($greeting)];
    }

    $response = $sendCommand('EHLO localhost');
    if (!$expectCode($response, '250')) {
        fclose($socket);
        return [false, 'EHLO failed: ' . trim($response)];
    }

    $response = $sendCommand('AUTH LOGIN');
    if (!$expectCode($response, '334')) {
        fclose($socket);
        return [false, 'AUTH LOGIN not supported: ' . trim($response)];
    }

    $response = $sendCommand(base64_encode($username));
    if (!$expectCode($response, '334')) {
        fclose($socket);
        return [false, 'SMTP username rejected: ' . trim($response)];
    }

    $response = $sendCommand(base64_encode($password));
    if (!$expectCode($response, '235')) {
        fclose($socket);
        return [false, 'SMTP authentication failed: ' . trim($response)];
    }

    $response = $sendCommand("MAIL FROM:<{$fromEmail}>");
    if (!$expectCode($response, '250')) {
        fclose($socket);
        return [false, 'MAIL FROM rejected: ' . trim($response)];
    }

    $response = $sendCommand("RCPT TO:<{$toEmail}>");
    if (!$expectCode($response, '250')) {
        fclose($socket);
        return [false, 'RCPT TO rejected: ' . trim($response)];
    }

    $response = $sendCommand('DATA');
    if (!$expectCode($response, '354')) {
        fclose($socket);
        return [false, 'DATA command rejected: ' . trim($response)];
    }

    $encodedFromName = '=?UTF-8?B?' . base64_encode($fromName) . '?=';
    $encodedSubject = '=?UTF-8?B?' . base64_encode($subject) . '?=';

    $headers = [
        "From: {$encodedFromName} <{$fromEmail}>",
        "To: <{$toEmail}>",
        "Subject: {$encodedSubject}",
        'MIME-Version: 1.0',
        'Content-Type: text/plain; charset=UTF-8',
        'Content-Transfer-Encoding: 8bit',
    ];

    if ($replyTo !== null && $replyTo !== '') {
        $headers[] = "Reply-To: <{$replyTo}>";
    }

    // Dot-stuff any line that starts with "." per RFC 5321.
    $stuffedBody = preg_replace('/^\./m', '..', $body);
    $message = implode("\r\n", $headers) . "\r\n\r\n" . $stuffedBody . "\r\n.";

    $response = $sendCommand($message);
    if (!$expectCode($response, '250')) {
        fclose($socket);
        return [false, 'Mail server rejected the message body: ' . trim($response)];
    }

    $sendCommand('QUIT');
    fclose($socket);

    return [true, 'Sent.'];
}
