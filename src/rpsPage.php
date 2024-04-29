<?php

require_once '../vendor/autoload.php';
use Doctrine\DBAL\DriverManager;

$connectionParams = [
    'dbname' => 'rps',
    'user' => 'root',
    'password' => '',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
];
$conn = DriverManager::getConnection($connectionParams);
$queryBuilder = $conn->createQueryBuilder();

$queryBuilder
    ->select('g.game_id', 'player1', 'player2')
    ->from('game', 'g');

$stmt = "";
// Ausführen des SQL-Statements
try {
    $stmt = $conn->executeQuery($queryBuilder->getSQL());
} catch (\Doctrine\DBAL\Exception $e) {
}

// Alle Ergebnisse abrufen
while (($row = $stmt->fetchAssociative()) != false ) {
    echo $row['player1'];
    echo "\n";
}