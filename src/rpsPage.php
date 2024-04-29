<?php

require_once '../vendor/autoload.php';
use Doctrine\DBAL\DriverManager;
use Htlw3r\DoctrineDbal\Player;
use Htlw3r\DoctrineDbal\Game;
use Htlw3r\DoctrineDbal\rpsValue;

$connectionParams = [
    'dbname' => 'rps',
    'user' => 'root',
    'password' => '',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
];

$conn = DriverManager::getConnection($connectionParams);

$players = [];
$playerRows = $conn->fetchAllAssociative('SELECT * FROM player');
foreach ($playerRows as $playerRow) {
    $player = new Player($playerRow['player_id'], $playerRow['name']);
    $players[] = $player;
}

$rpsValues = [];
$rpsRows = $conn->fetchAllAssociative('SELECT * FROM rps_value');
foreach ($rpsRows as $rpsRow) {
    $rps = new rpsValue($rpsRow['value_id'], $rpsRow['name']);
    $rpsValues[] = $rps;
}


$games = [];
$gameRows = $conn->fetchAllAssociative('SELECT * FROM game');
foreach ($gameRows as $gameRow) {
    $player1 = null;
    $player2 = null;
    $valueA = null;
    $valueB = null;
    $winner = null;
    foreach ($players as $player) {
        if ($player->getId() == $gameRow['player1']) {
            $player1 = $player;
        }
        if ($player->getId() == $gameRow['player2']) {
            $player2 = $player;
        }
        if ($gameRow['winner'] == null) {
            $winner = new Player(0, "Tie");
        }
        if($player->getId() == $gameRow['winner']) {
            $winner = $player;
        }
    }

    foreach ($rpsValues as $rpsValue) {
        if ($rpsValue->getValueId() == $gameRow['player1Value']) {
            $valueA = $rpsValue;
        }
        if ($rpsValue->getValueId() == $gameRow['player2Value']) {
            $valueB = $rpsValue;
        }
    }

    if (($player1 && $player2) && ($valueA && $valueB)) {
        $game = new Game($player1, $player2, $valueA, $valueB, $winner, $gameRow['date']);
        $games[] = $game;
    }
}

$engineParam = "";

foreach ($games as $game) {
    $engineParam .= file_get_contents("gameTemplate.html");
    $engineParam = str_replace('{player a}', $game->getPlayer1()->getName(), $engineParam);
    $engineParam = str_replace('{player b}', $game->getPlayer2()->getName(), $engineParam);
    $engineParam = str_replace('{value a}', $game->getValueA()->getName(), $engineParam);
    $engineParam = str_replace('{value b}', $game->getValueB()->getName(), $engineParam);
    $engineParam = str_replace('{winner}', $game->getWinner()->getName(), $engineParam);
    $engineParam = str_replace('{date}', $game->getDate(), $engineParam);
}

$rpsTemplate = file_get_contents("USARPSTemplate.html");
$rpsTemplate = str_replace('{placeholder}', $engineParam, $rpsTemplate);

echo $rpsTemplate;