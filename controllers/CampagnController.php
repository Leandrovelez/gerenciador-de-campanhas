<?php
require 'models/Campagn.php';

class CampagnController {
    private $campagn;

    public function __construct() {
        $this->campagn = new Campagn();
    }

    public function getAll() {
        $campagns = $this->campagn->getAll();
        return $campagn;
    }

    public function getCampagn($id) {
        return 'getID() campagn';
    }

    public function createCampagn() {
        return 'create() campagn';
    }

    public function updateCampagn($id) {
        return 'update() campagn';
    }

    public function deleteCampagn($id) {
        return 'delete() campagn';
    }
}

?>
