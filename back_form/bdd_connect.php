<?php
$dsn = 'mysql:host=127.0.0.1;dbname=black_thursday';
$user = 'root';
$password = '';

try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}