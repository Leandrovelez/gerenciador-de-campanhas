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
        $participant = new Participant();
        $participant->setNome($data['nome']);
        $participant->setCpf($data['cpf']);
        $participant->setEmail($data['email']);
        $participant->setCampagnId($data['campanha_id']);

        if($participant->getParticipantByCpf()){
            return json_encode("Já existe um participante com esse CPF");
        } else {
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
        $participant = new Participant();
        $participant->setId($id);
        $participant->setNome($data['nome']);
        $participant->setCpf($data['cpf']);
        $participant->setEmail($data['email']);
        $participant->setCampagnId($data['campanha_id']);

        $participantExists = $participant->getParticipantById();

        if(!empty($participantExists)){
            $cpfInUse = $participant->getParticipantByCpf();
            
            if($cpfInUse && $cpfInUse[0]['id'] !=  $id){
                return json_encode("Já existe um participante com esse CPF");
            } else {
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
            }

        } else {
            return json_encode("Participante não encontrado");
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
}

?>
