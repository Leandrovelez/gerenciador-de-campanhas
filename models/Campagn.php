<?php
require_once 'database/connection.php';

class Campagn {

    private $conn;
    private $id;    
    private $titulo;    
    private $descricao;    
    private $empresa_id;    
    private $data_inicio;    
    private $data_fim;    

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

    public function getTitulo(){
        return $this->titulo;
    }

    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }
    
    public function getEmpresaId(){
        return $this->empresa_id;
    }

    public function setEmpresaId($empresa_id){
        $this->empresa_id = $empresa_id;
    }

    public function getDataInicio(){
        return $this->data_inicio;
    }

    public function setDataInicio($data_inicio){
        $this->data_inicio = $data_inicio;
    }

    public function getDataTermino(){
        return $this->data_termino;
    }

    public function setDataTermino($data_termino){
        $this->data_termino = $data_termino;
    }

    public function getAll() {
        $query = "SELECT * FROM campanhas";
        
        $result = $this->conn->query($query);

        if ($result && $result->num_rows > 0) {
            
            $campagns = [];
            while ($row = $result->fetch_assoc()) {
                $campagns[] = $row;
            }

            return $campagns;
        }

    }

    public function getCampagnById() {
        $query = "SELECT * FROM campanhas where id = {$this->id}";
        
        $result = $this->conn->query($query);

        if ($result && $result->num_rows > 0) {
            
            $campagn[] = $result->fetch_assoc();

            return $campagn;
        }

    }

    public function createCampagn() {
        $query = "INSERT INTO campanhas (titulo, descricao, empresa_id, data_inicio, data_termino) VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssss", $this->titulo, $this->descricao, $this->empresa_id, $this->data_inicio, $this->data_termino);
        
        return $stmt->execute(); 
    }

    public function updateCampagn() {
        $query = "UPDATE CAMPANHAS SET titulo = ?, descricao = ?, empresa_id = ?, data_inicio = ?, data_termino = ? WHERE ID = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssss", $this->titulo, $this->descricao, $this->empresa_id, $this->data_inicio, $this->data_termino, $this->id);

        return $stmt->execute();  
    }

    public function deleteCampagn() {
        $query = "DELETE FROM CAMPANHAS WHERE ID = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $this->id);
        
        return $stmt->execute();  
    }
}

?>

