<?php

require_once __DIR__ . '/session.php';

function csrfToken(string $tokenId=''): string {
    $token = bin2hex(random_bytes(32));

    session()->set('_csrf_token', "{$tokenId}_{$token}");

    return "{$tokenId}_{$token}";
}
