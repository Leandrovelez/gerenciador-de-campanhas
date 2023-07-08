<?php
require_once 'database/connection.php';

class Company {
    private $conn;

    public function __construct() {
        // Chamada da função de criação da conexão
        $this->conn = createConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM empresas";
        
        $result = $this->conn->query($query);

        // Verificar se há resultados
        if ($result && $result->num_rows > 0) {
            // Converter os resultados em um array
            $companies = [];
            while ($row = $result->fetch_assoc()) {
                $companies[] = $row;
            }

            // Retornar os usuários encontrados como JSON
            return json_encode($companies);
        }

        // Caso não haja resultados, retornar um JSON vazio
        return json_encode([]);
    }

    public function getCompany($id) {
        $query = "SELECT * FROM empresas where id = ".$id;
        
        $result = $this->conn->query($query);

        // Verificar se há resultados
        if ($result && $result->num_rows > 0) {
            // Converter os resultados em um array
            $company = [];
            while ($row = $result->fetch_assoc()) {
                $company[] = $row;
            }

            // Retornar os usuários encontrados como JSON
            return json_encode($company);
        }

        // Caso não haja resultados, retornar um JSON vazio
        return json_encode([]);
    }

    public function createCompany() {
        // Lógica para criar um novo usuário na API
    }

    public function updateCompany($id) {
        // Lógica para atualizar um usuário específico na API
    }

    public function deleteCompany($id) {
        // Lógica para excluir um usuário específico da API
    }
}

?>