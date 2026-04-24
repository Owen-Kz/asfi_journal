<?php
// Get user IP address
function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0]; // first in list
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

$ipAddress = getUserIP();
$spamDetected = false;

// Loop through all POST fields
foreach ($_POST as $key => $value) {
    if (stripos($value, 'kraken') !== false) {
        $spamDetected = true;
        break;
    }
}

if ($spamDetected) {
    // Log the IP for review
    file_put_contents(__DIR__ . '/spam_ips.log', date('Y-m-d H:i:s') . " | $ipAddress\n", FILE_APPEND);

    // Optional: Immediately block response
    header('HTTP/1.1 403 Forbidden');
    exit('Spam detected. Access denied.');
}
?>
