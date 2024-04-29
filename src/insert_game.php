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


$player1 = $_POST['player1'];
$player2 = $_POST['player2'];
$valueA = $_POST['valueA'];
$valueB = $_POST['valueB'];
$winner = $_POST['winner'];
$date = $_POST['date'];


echo "Insert is ready";
$conn->insert('game', [
    'player1' => $player1,
    'player2' => $player2,
    'player1Value' => $valueA,
    'player2Value' => $valueB,
    'winner' => $winner,
    'date' => $date
]);
header('Location: rpsPage.php');
exit;
