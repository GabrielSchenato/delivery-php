<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=db_web', 'root', 'root');
    $pdo->query("SET NAMES 'utf8'");
    $pdo->query('SET character_set_connection=utf8');
    $pdo->query('SET character_set_client=utf8');
    $pdo->query('SET character_set_results=utf8');
} catch (Exception $e) {
    exit('Não foi possível conectar ao banco de dados.');
}
