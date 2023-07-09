<?php
require_once 'models/Participant.php';

class ParticipantController {
    private $participant;

    public function __construct() {
        $this->participant = new Participant();
    }

    public function getAll() {
        $participants = $this->participant->getAll();
        return json_encode($participants);
    }

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

    public function createParticipant($data) {
        $participant = new Participant();
        $participant->setNome($data['nome']);
        $participant->setCpf($data['cpf']);
        $participant->setEmail($data['email']);
        $participant->setCampanhaId($data['campanha_id']);

        $result = $participant->createParticipant();
        
        if($result){
            return json_encode($result);
        }
        
        return json_encode("Erro ao criar o participante");
    }

    public function updateParticipant($id, $data) {
        $participant = new Participant();
        $participant->setId($id);
        $participant->setNome($data['nome']);
        $participant->setCpf($data['cpf']);
        $participant->setEmail($data['email']);
        $participant->setCampanhaId($data['campanha_id']);

        $participantExists = $participant->getParticipantById();

        if(!empty($participantExists)){
            //verificar aqui na tabela intermediária $campanha_participant->getCampagnParticipant()
            $cpfInUse = $participant->getParticipantByCpf();

            if(!empty($cpfInUse)){
                $result = $participant->updateParticipant();
                if($result){
                    return json_encode($participant->getParticipantById());
                }
                

                return json_encode("Erro ao atualizar o participante");
            } else {
                return json_encode("Já existe um participante com esse CPF nessa campanha");
            }
        } else {
            return json_encode("Participante não encontrado");
        }
    }

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
