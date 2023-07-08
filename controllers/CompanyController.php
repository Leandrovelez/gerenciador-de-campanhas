<?php
require_once 'models/Company.php';

class CompanyController {
    private $company;

    public function __construct() {
        $this->company = new Company();
    }

    public function getAll() {
        $companies = $this->company->getAll();
        
        // Defino o cabeçalho de resposta como JSON
        header('Content-Type: application/json');

        echo $companies;
    }

    public function getCompany($id) {
        $companyByd = $this->company->getCompany($id);

        // Defino o cabeçalho de resposta como JSON
        header('Content-Type: application/json');

        echo
         $companyByd;
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