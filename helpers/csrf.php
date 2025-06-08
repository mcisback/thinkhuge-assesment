<?php

require_once __DIR__ . '/session.php';

function csrfToken(string $tokenId): string {
    $session = session();

    $token = bin2hex(random_bytes(32));
    $session->set('_csrf_' . $tokenId, $token);

    return $token;
}
