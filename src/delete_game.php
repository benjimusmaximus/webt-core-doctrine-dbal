<?php

require_once '../vendor/autoload.php';
use Doctrine\DBAL\DriverManager;

if (isset($_POST['delete'])) {
    if (isset($_POST['idToDelete'])) {
        $idToDelete = $_POST['idToDelete'];
        $connectionParams = [
            'dbname' => 'rps',
            'user' => 'root',
            'password' => '',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        ];

        $conn = DriverManager::getConnection($connectionParams);

        $qb = $conn->createQueryBuilder();

        $qb->delete('game')
            ->where('game_id = :id')
            ->setParameter('id', $idToDelete)
            ->executeQuery();

        header('Location: rpsPage.php');
        exit;
    }
}
