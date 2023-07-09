<?php
require_once 'database/connection.php';

class CampagnParticipant {

    private $conn;
    private $participant_id;    
    private $campagn_id; 

    public function __construct() {
        // Chamada da função de criação da conexão
        $this->conn = createConnection();
    }

    public function createCampagnParticipant(){

    }    

    public function getCampagnParticipant(){
        
    }  

    public function deleteCampagnParticipant(){
        
    }  
}

?>