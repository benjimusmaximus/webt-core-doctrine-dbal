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


$qb = $conn->createQueryBuilder();


$player1Id = $qb->select('player_id')
    ->from('player')
    ->where('name = :name')
    ->setParameter('name', $player1)
    ->executeQuery()->fetchOne();

if ($player1Id == '') {
    $conn->insert('player',
        ['name' => $player1]);
    $player1Id = $qb->select('player_id')
        ->from('player')
        ->where('name = :name')
        ->setParameter('name', $player1)
        ->executeQuery()->fetchOne();
}

$player2Id = $qb->select('player_id')
    ->from('player')
    ->where('name = :name')
    ->setParameter('name', $player2)
    ->executeQuery()->fetchOne();

if ($player2Id == '') {
    $conn->insert('player', ['name' => $player2]);
    $player2Id = $qb->select('player_id')
        ->from('player')
        ->where('name = :name')
        ->setParameter('name', $player2)
        ->executeQuery()->fetchOne();
}


$valueAId = $qb->select('value_id')
    ->from('rps_value', 'r')
    ->where('r.name = :name')
    ->setParameter('name', $valueA)
    ->executeQuery()->fetchOne();

$valueBId = $qb->select('value_id')
    ->from('rps_value', 'r')
    ->where('r.name = :name')
    ->setParameter('name', $valueB)
    ->executeQuery()->fetchOne();

$winnerId = $qb->select('p.player_id')
    ->from('player', 'p')
    ->where('p.name = :name')
    ->setParameter('name', $winner)
    ->executeQuery()->fetchOne();

$conn->insert('game', [
    'player1' => $player1Id,
    'player2' => $player2Id,
    'player1Value' => $valueAId,
    'player2Value' => $valueBId,
    'winner' => $winnerId,
    'date' => $date
]);
header('Location: rpsPage.php');
exit;
