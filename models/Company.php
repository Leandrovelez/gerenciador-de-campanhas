<?php
require_once 'database/connection.php';

/** 
 * Company class
 *  
 */ 
class Company {
    private $conn;
    private $id;
    private $razao_social;
    private $cnpj;
    private $endereco;
    private $nome_responsavel;
    private $email;
    private $telefone;

    /**
     * Function Construct
     *
     */    
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

    /**
     * Gets all companies
     *
     * Returns an array
     */
    public function getAll() {
        $query = "SELECT * FROM empresas";
        
        $result = $this->conn->query($query);

        // Verify if there are result
        if ($result && $result->num_rows > 0) {
            // Convert the result into an array
            $companies = [];
            while ($row = $result->fetch_assoc()) {
                $companies[] = $row;
            }
            
            return $companies;
        }
    }

    /**
     * Gets the company with the settled id.
     *
     * Returns an array
     */    
    public function getCompanyById() {
        $query = "SELECT * FROM empresas where id = {$this->id}";
        
        $result = $this->conn->query($query);

        if ($result && $result->num_rows > 0) {
            $company[] = $result->fetch_assoc();

            return $company;
        }

    }

    /**
     * Gets the company with the settled cnpj.
     *
     * Returns an array
     */     
    public function getCompanyByCnpj() {
        $query = "SELECT * FROM empresas where cnpj = '{$this->cnpj}'";
        
        $result = $this->conn->query($query);

        if ($result && $result->num_rows > 0) {
            $company[] = $result->fetch_assoc();
            return $company;
        } 
        
    }

    /**
     * Gets the company with the settled telefone.
     *
     * Returns an array
     */     
    public function getCompanyByTelefone() {
        $query = "SELECT * FROM empresas where telefone = '{$this->telefone}'";
        
        $result = $this->conn->query($query);

        if ($result && $result->num_rows > 0) {
            $company[] = $result->fetch_assoc();
            return $company;
        } 
        
    }

    /**
     * Creates a company with the settled params.
     *
     * Returns a boolean
     */     
    public function createCompany() {
        
        $query = "INSERT INTO EMPRESAS (razao_social, cnpj, endereco, nome_responsavel, email, telefone) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssss", $this->razao_social, $this->cnpj, $this->endereco, $this->nome_responsavel, $this->email, $this->telefone);
        
        return $stmt->execute();
    }

    /**
     * Updates a company with the settled id.
     *
     * Returns a boolean
     */     
    public function updateCompany() {
        $query = "UPDATE EMPRESAS SET razao_social = ?, cnpj = ?, endereco = ?, nome_responsavel = ?, email = ?, telefone = ? WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssssss", $this->razao_social, $this->cnpj, $this->endereco, $this->nome_responsavel, $this->email, $this->telefone, $this->id);
        
        return $stmt->execute();
    }

    /**
     * Deletes a company with the settled id.
     *
     * Returns a boolean
     */     
    public function deleteCompany() {
        $query = "DELETE FROM EMPRESAS WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $this->id);
        
        return $stmt->execute();
    }
}

?>