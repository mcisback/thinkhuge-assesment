<?php

function my_password_hash($rawPassword) {
    return password_hash($rawPassword, PASSWORD_ARGON2ID);
}