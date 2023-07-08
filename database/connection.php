<?php

function createConnection(){
    
    date_default_timezone_set('America/Sao_Paulo');

    $host = 'localhost';
    $username = 'root';
    $password = '@root11';
    $database = 'gerenciador_de_campanhas';

    // Criação da conexão
    $conn = new mysqli($host, $username, $password, $database);

    // Verificação de erros de conexão
    if ($conn->connect_error) {
        die("Erro de conexão com o banco de dados: " . $conn->connect_error);
    }

    return $conn;
}
