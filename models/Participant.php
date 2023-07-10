<?php
require_once 'database/connection.php';

/**
 * Participant class.
 *
 * 
 */ 
class Participant {

    private $conn;
    private $id;    
    private $cpf;    
    private $nome;    
    private $email;    
    private $campanha_id;    

    // Constructor
    public function __construct() {
        // Chamada da função de criação da conexão
        $this->conn = createConnection();
    }

    // Métodos getters e setters para acessar e modificar os atributos
        
    public function getId(){
        $this->id = $id;
    }

    public function setId($id){
        $this->id = $id;
    } 
  
    public function getCpf(){
        $this->id = $id;
    }

    public function setCpf($cpf){
        $this->cpf = $cpf;
    } 
  
    public function getNome(){
        $this->nome = $nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    } 
  
    public function getEmail(){
        $this->email = $email;
    }

    public function setEmail($email){
        $this->email = $email;
    } 
  
    public function getCampagnId(){
        $this->campanha_id = $campanha_id;
    }

    public function setCampagnId($campanha_id){
        $this->campanha_id = $campanha_id;
    } 

    /**
     * Gets all participants.
     *
     * Returns an array
     */ 
    public function getAll() {
        $query = "SELECT * FROM participantes";
        
        $result = $this->conn->query($query);

        if ($result && $result->num_rows > 0) {
            
            $participants = [];
            while ($row = $result->fetch_assoc()) {
                $participants[] = $row;
            }

            return $participants;
        }
    }

    /**
     * Gets the participant with the settled id.
     *
     * Returns an array
     */ 
    public function getParticipantById() {
        $query = "SELECT * FROM participantes where id = {$this->id}";
        
        $result = $this->conn->query($query);

        if ($result && $result->num_rows > 0) {
            
            $participant[] = $result->fetch_assoc();

            return $participant;
        }
    }

    /**
     * Gets the participant with the settled cpf.
     *
     * Returns an array
     */ 
    public function getParticipantByCpf() {
        $query = "SELECT * FROM participantes where cpf = '{$this->cpf}' LIMIT 1";
        
        $result = $this->conn->query($query);

        if ($result && $result->num_rows > 0) {
            
            $participant[] = $result->fetch_assoc();

            return $participant;
        }
    }

    /**
     * Gets the participant with the settled email.
     *
     * Returns an array
     */ 
    public function getParticipantByEmail() {
        $query = "SELECT * FROM participantes where email = '{$this->email}' LIMIT 1";
        
        $result = $this->conn->query($query);

        if ($result && $result->num_rows > 0) {
            
            $participant[] = $result->fetch_assoc();

            return $participant;
        }
    }

    /**
     * Creats a participant with the settled params.
     *
     * Returns a boolean
     */ 
    public function createParticipant() {
        $query = "INSERT INTO participantes (nome, cpf, email, campanha_id) VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssss", $this->nome, $this->cpf, $this->email, $this->campanha_id);
        
        return $stmt->execute(); 
    }

    /**
     * Updates the participant with the settled id.
     *
     * Returns a boolean
     */ 
    public function updateParticipant() {
        $query = "UPDATE participantes SET nome = ?, cpf = ?, email = ?, campanha_id = ? WHERE ID = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssss", $this->nome, $this->cpf, $this->email, $this->campanha_id, $this->id);

        return $stmt->execute(); 
    }

    /**
     * Delets a participant with the settled id.
     *
     * Returns a boolean
     */ 
    public function deleteParticipant() {
        $query = "DELETE FROM participantes WHERE ID = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $this->id);
        
        return $stmt->execute();
    }
}

?>




