<?php

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;

$session = new Session(new NativeSessionStorage());
$session->start();

// Optionally store it globally
$GLOBALS['session'] = $session;
