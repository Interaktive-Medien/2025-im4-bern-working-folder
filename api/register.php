<?php
// Very simple debugging output.
// In Produktion → Passwort nicht im Klartext zurücksenden,
// sondern z.B. mit password_hash() abspeichern und gar nicht echo‑n!

// immer wenn wir etwas mit der db machen, 
// brauchen wir require once
require_once('../system/config.php');

header('Content-Type: text/plain; charset=UTF-8');

// ► Daten aus $_POST abgreifen (kommen dort an, weil wir FormData benutzen)
$username = $_POST['username'] ?? '';
$email    = $_POST['email']    ?? '';
$password = $_POST['password'] ?? '';

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// check if user already exists
$stmt = $pdo->prepare("SELECT * FROM benutzer WHERE email = :email");
$stmt->execute([
    ':email' => $email
]);
$user = $stmt->fetch();

if ($user) {

    echo "User already exists";
    exit;
    
} else {

    // insert new user
    $insert = $pdo->prepare("INSERT INTO benutzer (email, username, password) VALUES (:email, :user, :pass)");
    $insert->execute([
    ':email' => $email,
    ':pass'  => $hashedPassword,
    ':user' => $username
]);

    // ► Ausgeben – nur zum Test!
    echo "PHP meldet, Daten erfolgreich empfangen.";
    echo "Username: {$username}\n";
    echo "E-Mail:   {$email}\n";
    echo "Passwort: {$hashedPassword}\n";
}

