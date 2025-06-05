<?php

function session(): \Symfony\Component\HttpFoundation\Session\Session {
    return $GLOBALS['session'];
}
