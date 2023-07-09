<?php
require_once 'models/Campagn.php';
require_once 'models/Company.php';

class CampagnController {
    private $campagn;
    private $company;
    private $companyExists;

    public function __construct() {
        $this->campagn = new Campagn();
        $this->company = new Company();
    }

    /**
     * Retorna todas as campanhas
     *
     * @param  
     * @return json
     */    
    public function getAll() {
        $campagns = $this->campagn->getAll();
        
        return json_encode($campagns);
    }

    public function getCampagn($id) {
        $campagn = new Campagn();
        $campagn->setId($id);
        $campagnExists = $campagn->getCampagnById();

        if(!empty($campagnExists)){
            return json_encode($campagnExists);
        } else {
            return json_encode("Campanha não encontrada");
        }        
    }

    public function createCampagn($data) {
        $campagn = new Campagn();
        $campagn->setTitulo($data['titulo']);
        $campagn->setDescricao($data['descricao']);
        $campagn->setEmpresaId($data['empresa_id']);
        $campagn->setDataInicio($data['data_inicio']);
        $campagn->setDataTermino($data['data_termino']);

        $company = new Company();
        $company->setId($data['empresa_id']);
        $companyExists = $company->getCompanyById();

        if($companyExists){
            $result = $campagn->createCampagn();
        
            if($result){
                return json_encode($result);
            }
            
            return json_encode("Erro ao atualizar a campanha");
        } else {
            return json_encode("Empresa não encontrada");
        }
    }

    public function updateCampagn($id, $data) {
        $campagn = new Campagn();
        $campagn->setId($id);
        $campagn->setTitulo($data['titulo']);
        $campagn->setDescricao($data['descricao']);
        $campagn->setEmpresaId($data['empresa_id']);
        $campagn->setDataInicio($data['data_inicio']);
        $campagn->setDataTermino($data['data_termino']);

        $campagnExists = $campagn->getCampagnById();

        if(!empty($campagnExists)){
            $company = new Company();
            $company->setId($data['empresa_id']);
            $companyExists = $company->getCompanyById();
            
            if($companyExists){
                $result = $campagn->updateCampagn();
                if($result){
                    return json_encode($campagn->getCampagnById());
                }
                
                return json_encode("Erro ao atualizar a campanha");
            } else {
                return json_encode("Empresa não encontrada");
            }
        } else {
            return json_encode("Campanha não encontrada");
        }
    }

    public function deleteCampagn($id) {
        $campagn = new Campagn();
        $campagn->setId($id);
        $campagnExists = $campagn->getCampagnById();

        if(!empty($campagnExists)){
            
            $result = $campagn->deleteCampagn();
        
            if($result){
                return json_encode($result);
            }
            
            return json_encode("Erro ao deletar a campanha");
        } else {
            return json_encode("Campanha não encontrada");
        }
    }
}

?>
