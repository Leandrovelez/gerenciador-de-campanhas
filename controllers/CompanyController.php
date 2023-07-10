<?php
require_once 'models/Company.php';

class CompanyController {
    private $company;

    //construtor    
    public function __construct() {
        $this->company = new Company();
    }

    /**
     * Returns all the companies
     *
     * 
     * @return json
     */   
    public function getAll() {
        $companies = $this->company->getAll();

        return json_encode($companies);
    }

    /**
     * Retuns the company with the given id
     *
     * @param  int $id id of the company
     * @return json
     */       
    public function getCompany($id) {
        $company = new Company();
        $company->setId($id);
        $result = $company->getCompanyById();

        return json_encode($result);
    }

    /**
     * Creates a company with the given data
     *
     * @param  array $data 
     * @return json
     */        
    public function createCompany($data) {
        
        $validate = $this->validateInputs($data);

        if($validate){
            return json_encode($validate);
        } else {
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
    }

    /**
     * Updates a company with the given id
     *
     * @param int $id, array $data 
     * @return json
     */       
    public function updateCompany($id, $data) {
        $validate = $this->validateInputs($data);

        if($validate){
            return json_encode($validate);
        } else{
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
    }

    /**
     * Delets a company with the given id
     *
     * @param  int $id 
     * @return json
     */       
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

    /**
     * Validates the inputes given in data
     *
     * @param array $data 
     * @return string
     */
    public function validateInputs($data){
    
        if(!isset($data['razao_social'])  || empty($data['razao_social']) ){
            return "O campo razao_social é obrigatório";
        }
        if(is_numeric($data['razao_social'])){
            return "O campo razao_social deve ser uma string";
        }
        if(strlen($data['razao_social']) > 250){
            return "O campo razao_social deve ter no máximo 250 caracteres";
        }

        if(!isset($data['cnpj']) || empty($data['cnpj'])){
            return "O campo cnpj é obrigatório";
        }
        if(!preg_match('/^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$/', $data['cnpj'])){
            return "O CNPj informado é inválido";
        }

        if(!isset($data['endereco']) || empty($data['endereco'])){
            return "O campo endereco é obrigatório";
        }
        if(is_numeric($data['endereco'])){
            return "O campo endereco deve ser uma string";
        }
        if(strlen($data['endereco']) > 250){
            return "O campo endereco deve ter no máximo 250 caracteres";
        }

        if(!isset($data['nome_responsavel']) || empty($data['nome_responsavel'])){
            return "O campo nome_responsavel é obrigatório";
        }
        if(is_numeric($data['nome_responsavel'])){
            return "O campo nome_responsavel deve ser uma string";
        }
        if(strlen($data['nome_responsavel']) > 250){
            return "O campo nome_responsavel deve ter no máximo 250 caracteres";
        }

        if(!isset($data['email'])  || empty($data['email'])){
            return "O campo email é obrigatório";
        }
        if(is_numeric($data['email'])){
            return "O campo email deve ser uma string";
        }
        if(strlen($data['email']) > 250){
            return "O campo email deve ter no máximo 250 caracteres";
        }

        if(!isset($data['telefone']) || empty($data['telefone'])){
            return "O campo telefone é obrigatório";
        }
        if(is_numeric($data['telefone'])){
            return "O campo telefone deve ser uma string";
        }
        if(!preg_match('/^(?:(?:\+|00)?(55)\s?)?(?:\(?([1-9][0-9])\)?\s?)?(?:((?:9\d|[2-9])\d{3})\-?(\d{4}))$/', $data['telefone'])){
            return "O campo telefone é inválido";
        }
    }
}

?>