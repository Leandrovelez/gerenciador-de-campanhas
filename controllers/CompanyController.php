<?php
// CompanyController.php
class CompanyController {
    public function getAll() {
       return 'getAll() da controller';
    }

    public function getCompany($id) {
        return 'getID() da controller';
    }

    public function createCompany() {
        return 'Company criada';
    }

    public function updateCompany($id) {
        return 'Company atualizada';
    }

    public function deleteCompany($id) {
        return 'Company deletada';
    }
}

?>