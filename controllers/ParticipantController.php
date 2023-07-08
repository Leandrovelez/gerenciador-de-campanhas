<?php
require_once 'models/Participant.php';

class ParticipantController {
    private $participant;

    public function __construct() {
        $this->participant = new Participant();
    }

    public function getAll() {
        $participants = $this->participant->getAll();
        return $participants;
    }

    public function getParticipant($id) {
        $participants = $this->participant->getAll();
        return $participants;
    }

    public function createParticipant() {
        return 'create() participant';
    }

    public function updateParticipant($id) {
        return 'update() participant';
    }

    public function deleteParticipant($id) {
        return 'delete() participant';
    }
}

?>
