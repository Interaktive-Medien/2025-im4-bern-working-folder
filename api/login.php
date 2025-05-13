<?php

require_once('../system/config.php');

header('Content-Type: text/plain; charset=UTF-8');

$loginInfo = $_POST['loginInfo'] ?? '';
$password = $_POST['password'] ?? '';

echo "Habe folgende Daten erhalten, LoginInfo: {$loginInfo}, Passwort: {$password}";