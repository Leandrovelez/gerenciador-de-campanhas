<?php
require_once 'models/Company.php';

class CompanyController {
    private $company;

    public function __construct() {
        $this->company = new Company();
    }

    public function getAll() {
        $companies = $this->company->getAll();

        return json_encode($companies);
    }

    public function getCompany($id) {
        $company = new Company();
        $company->setId($id);
        $result = $company->getCompanyById();

        return json_encode($result);
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

            return json_encode("Empresa cadastrada com sucesso");
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

        $companyExists = $company->getCompanyById();

        if(!empty($companyExists)){
            
            // $result = $company->updateCompany();
        
            // if($result){
            //     return json_encode($result);
            // }
            
            // return json_encode("Erro ao atualizar a empresa");



            $cnpjInUse = $company->getCompanyByCnpj();
            $telefoneInUse = $company->getCompanyByTelefone();
            
            if($cnpjInUse && $cnpjInUse[0]['id'] !=  $id){
                return json_encode("Já existe uma empresa com esse CNPJ");
            } else if($telefoneInUse && $telefoneInUse[0]['id'] !=  $id){
                return json_encode("Já existe uma empresa com esse telefone");
            } else {    

                $result = $company->updateCompany();
        
                if($result){
                    return json_encode($company->getCompanyById());
                }
                
                return json_encode("Erro ao atualizar a empresa");
            }
        } else {
            return json_encode("Empresa não encontrada");
        }        

    }

    public function deleteCompany($id) {
        $company = new Company();
        $company->setId($id);

        $companyExists = $company->getCompanyById();

        if(!empty($companyExists)){
            
            $result = $company->deleteCompany();
        
            if($result){
                return json_encode($result);
            }
            
            return json_encode("Erro ao deletar a empresa");
        } else {
            return json_encode("Empresa não encontrada");
        }  
    }
}

?>