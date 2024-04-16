<?php

require_once '../vendor/autoload.php';
use Doctrine\DBAL\DriverManager;

$connectionParams = [
    'dbname' => 'rps',
    'user' => 'user',
    'password' => 'secret',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
];

$conn = DriverManager::getConnection($connectionParams);
$queryBuilder = $conn->createQueryBuilder();

$queryBuilder
    ->select('p.player_id', 'p2.player_id',  'r.value_id',  'r2.value_id',  'p3.player_id')
    ->from('game', 'g')
    ->innerJoin('g', 'player', 'p', 'g.player1 = p.player_id')
    ->innerJoin('g', 'player', 'p2', 'g.player2 = p.player_id')
    ->innerJoin('g', 'rps_value', 'r', 'g.player1Value = r.value_id')
    ->innerJoin('g', 'rps_value', 'r2', 'g.player2Value = r.value_id')
    ->innerJoin('g', 'player', 'p3', 'g.winner = p.player_id');

$query = $queryBuilder->getSQL();
echo $query;