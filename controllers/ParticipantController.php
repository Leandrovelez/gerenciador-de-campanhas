<?php
require_once 'models/Participant.php';
require_once 'models/Campagn.php';

class ParticipantController {
    private $participant;
    private $campagn;

    public function __construct() {
        $this->participant = new Participant();
        $this->campagn = new Campagn();
    }

    /**
     * Retuns all the participants
     *
     * 
     * @return json
     */
    public function getAll() {
        $participants = $this->participant->getAll();
        return json_encode($participants);
    }

    /**
     * Retuns the participant with the given id
     *
     * @param  int $id 
     * @return json
     */
    public function getParticipant($id) {
        $participant = new Participant();
        $participant->setId($id);
        $participantExists = $participant->getParticipantById();

        if(!empty($participantExists)){
            return json_encode($participantExists);
        } else {
            return json_encode("Participante não encontrado");
        }
    }

    /**
     * Create a participant with the given data
     *
     * @param  array $data 
     * @return json
     */
    public function createParticipant($data) {
        $validate = $this->validateInputs($data);

        if($validate){
            return json_encode($validate);
        } else {
            $participant = new Participant();
            $participant->setNome($data['nome']);
            $participant->setCpf($data['cpf']);
            $participant->setEmail($data['email']);
            $participant->setCampagnId($data['campanha_id']);

            if($participant->getParticipantByCpf()){
                return json_encode("Já existe um participante com esse CPF");
            } 

            if($participant->getParticipantByEmail()){
                return json_encode("Já existe um participante com esse e-mail");
            } 

            $campagn = new Campagn();
            $campagn->setId($data['campanha_id']);
            
            if($campagn->getCampagnById()){
                $result = $participant->createParticipant();
            
                if($result){
                    return json_encode($result);
                }
                return json_encode("Erro ao criar o participante");
            } else {
                return json_encode("campanha não encontrada");
            }
        }
    }

    /**
     * Updates a participant with the given data
     *
     * @param  int $id, array $data
     * @return json
     */
    public function updateParticipant($id, $data) {
        $validate = $this->validateInputs($data);

        if($validate){
            return json_encode($validate);
        } else {
            $participant = new Participant();
            $participant->setId($id);
            $participant->setNome($data['nome']);
            $participant->setCpf($data['cpf']);
            $participant->setEmail($data['email']);
            $participant->setCampagnId($data['campanha_id']);

            $participantExists = $participant->getParticipantById();

            if(!empty($participantExists)){
                $cpfInUse = $participant->getParticipantByCpf();
                $emailInUse = $participant->getParticipantByEmail();
                
                if($cpfInUse && $cpfInUse[0]['id'] !=  $id){
                    return json_encode("Já existe um participante com esse CPF");
                } 

                if($emailInUse && $emailInUse[0]['id'] !=  $id){
                    return json_encode("Já existe um participante com esse e-mail");
                } 

                $campagn = new Campagn();
                $campagn->setId($data['campanha_id']);
                
                if($campagn->getCampagnById()){
                    $result = $participant->updateParticipant();
                    if($result){
                        return json_encode($participant->getParticipantById());
                    }
                    
                    return json_encode("Erro ao atualizar o participante");
                } else {
                    return json_encode("Campanha não encontrada");
                }

            } else {
                return json_encode("Participante não encontrado");
            }
        }
    }

    /**
     * Delets a participant with the given id
     *
     * @param  int $id 
     * @return json
     */
    public function deleteParticipant($id) {
        $participant = new Participant();
        $participant->setId($id);
        $participantExists = $participant->getParticipantById();

        if(!empty($participantExists)){
            
            $result = $participant->deleteParticipant();
        
            if($result){
                return json_encode($result);
            }
            
            return json_encode("Erro ao deletar o participante");
        } else {
            return json_encode("Participante não encontrado");
        }
    }

    /**
     * Validates the inputes given in data
     *
     * @param array $data 
     * @return string
     */
    public function validateInputs($data){
        if(!isset($data['nome'])  || empty($data['nome']) ){
            return "O campo nome é obrigatório";
        }
        if(strlen($data['nome']) > 250){
            return "O campo nome deve ter no máximo 250 caracteres";
        }

        if(!isset($data['cpf'])  || empty($data['cpf']) ){
            return "O campo cpf é obrigatório";
        }
        if(!preg_match('/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/', $data['cpf'])){
            return "O campo cpf é inválido";
        }  

        if(!isset($data['email'])  || empty($data['email']) ){
            return "O campo email é obrigatório";
        }
        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            return "O campo email é inválido";
        }  
 
        if(!isset($data['campanha_id'])  || empty($data['campanha_id']) ){
            return "O campo campanha_id é obrigatório";
        }
        if(!is_int($data['campanha_id'])){
            return "O campo campanha_id deve ser int";
        }          
    }
}

?>
