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

        return $companies;
    }

    public function getCompany($id) {
        $company = new Company();
        $company->setId($id);
        $result = $company->getCompanyById();

        // Defino o cabeçalho de resposta como JSON
        header('Content-Type: application/json');

        return $result;
    }

    public function createCompany($data) {
        $company = new Company();
        $company->setRazaoSocial($data['razao_social']);
        $company->setCnpj($data['cnpj']);
        $company->setEndereco($data['endereco']);
        $company->setNomeResponsavel($data['nome_responsavel']);
        $company->setEmail($data['email']);
        $company->setTelefone($data['telefone']);

        if($company->getCompanyByCnpj()){
            return json_encode("Já existe uma empresa cadastrada com esse CNPJ");
        } else if($company->getCompanyByTelefone()){
            return json_encode("Já existe uma empresa cadastrada com esse telefone");
        } else {
            $result = $company->createCompany();
        
            // Defino o cabeçalho de resposta como JSON
            header('Content-Type: application/json');

            return json_encode($result);
        }
        
    }

    public function updateCompany($id, $data) {
        $company = new Company();
        $company->setId($id);
        $company->setRazaoSocial($data['razao_social']);
        $company->setCnpj($data['cnpj']);
        $company->setEndereco($data['endereco']);
        $company->setNomeResponsavel($data['nome_responsavel']);
        $company->setEmail($data['email']);
        $company->setTelefone($data['telefone']);

        $result = $company->updateCompany();
        
        // Defino o cabeçalho de resposta como JSON
        header('Content-Type: application/json');

        return json_encode($result);
    }

    public function deleteCompany($id) {
        $company = new Company();
        $company->setId($id);

        $result = $company->deleteCompany();
        return $result;
    }
}

?>