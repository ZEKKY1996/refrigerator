<?php

require __DIR__ . '/../vendor/autoload.php';

function dbConnect(): object
{
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
    $dotenv->load();

    $dbHost = $_ENV['DB_HOST'];
    $dbUsername = $_ENV['DB_USERNAME'];
    $dbPass = $_ENV['DB_PASS'];
    $dbDatabase = $_ENV['DB_DATABASE'];

    $link = mysqli_connect($dbHost, $dbUsername, $dbPass, $dbDatabase);
    if (!$link) {
        echo 'Erroe: データベースに接続できません' . PHP_EOL;
        echo 'Debugging error:' . mysqli_connect_error() . PHP_EOL;
    }
    return $link;
}
