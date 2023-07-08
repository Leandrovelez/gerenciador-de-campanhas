<?php
require_once 'database/connection.php';

class Company {
    private $conn;
    private $id;
    private $razao_social;
    private $cnpj;
    private $endereco;
    private $nome_responsavel;
    private $email;
    private $telefone;

    public function __construct() {
        // Chamada da função de criação da conexão
        $this->conn = createConnection();
    }

    // Métodos getters e setters para acessar e modificar os atributos
    public function getId($id){
        $this->id = $id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getRazaoSocial(){
        return $this->razao_social;
    }

    public function setRazaoSocial($razao_social){
        $this->razao_social = $razao_social;
    }

    public function getCnpj(){
        return $this->cnpj;
    }

    public function setCnpj($cnpj){
        $this->cnpj = $cnpj;
    }

    public function getEndereco(){
        return $this->endereco;
    }

    public function setEndereco($endereco){
        $this->endereco = $endereco;
    }

    public function getNomeResponsavel(){
        return $this->nome_responsavel;
    }

    public function setNomeResponsavel($nome_responsavel){
        $this->nome_responsavel = $nome_responsavel;
    }
    
    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getTelefone(){
        return $this->telefone;
    }

    public function setTelefone($telefone){
        $this->telefone = $telefone;
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

    public function getCompanyById() {
        $query = "SELECT * FROM empresas where id = {$this->id}";
        
        $result = $this->conn->query($query);

        // Verificar se há resultados
        if ($result && $result->num_rows > 0) {
            // Converter os resultados em um array
            $company[] = $result->fetch_assoc();

            // Retornar os usuários encontrados como JSON
            return json_encode($company);
        }

        // Caso não haja resultados, retornar um JSON vazio
        return json_encode([]);
    }

    public function getCompanyByCnpj() {
        $query = "SELECT * FROM empresas where cnpj = '{$this->cnpj}'";
        
        $result = $this->conn->query($query);

        // Verificar se há resultados
        if ($result && $result->num_rows > 0) {
            $company[] = $result->fetch_assoc();
            return json_encode($company);
        } 
        
    }

    public function getCompanyByTelefone() {
        $query = "SELECT * FROM empresas where telefone = '{$this->telefone}'";
        
        $result = $this->conn->query($query);

        // Verificar se há resultados
        if ($result && $result->num_rows > 0) {
            $company[] = $result->fetch_assoc();
            return json_encode($company);
        } 
        
    }

    public function createCompany() {
        
        $query = "INSERT INTO EMPRESAS (razao_social, cnpj, endereco, nome_responsavel, email, telefone) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssss", $this->razao_social, $this->cnpj, $this->endereco, $this->nome_responsavel, $this->email, $this->telefone);
        
        if ($stmt->execute()){
            return json_encode('Empresa criada com sucesso');
        }
        return json_encode('Erro ao criar a empresa');
    }

    public function updateCompany() {
        $query = "UPDATE EMPRESAS SET razao_social = ?, cnpj = ?, endereco = ?, nome_responsavel = ?, email = ?, telefone = ? WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssssss", $this->razao_social, $this->cnpj, $this->endereco, $this->nome_responsavel, $this->email, $this->telefone, $this->id);
        
        if ($stmt->execute()){
            return json_encode('Empresa atualizada com sucesso');
        }
        return json_encode('Erro ao atualizar a empresa');
    }

    public function deleteCompany() {
        $query = "DELETE FROM EMPRESAS WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $this->id);
        
        if ($stmt->execute()){
            return json_encode('Empresa deletada com sucesso');
        }
        return json_encode('Erro ao deletar a empresa');
    }
}

?>