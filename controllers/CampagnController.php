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
     * Retuns all the campagns
     *
     * 
     * @return json
     */    
    public function getAll() {
        $campagns = $this->campagn->getAll();
        
        return json_encode($campagns);
    }

    /**
     * Retuns the campagn with the given id
     *
     * @param  int $id 
     * @return json
     */   
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
    
    /**
     * Creates a campagn with the given data
     *
     * @param  array $data 
     * @return json
     */
    public function createCampagn($data) {
        $validate = $this->validateInputs($data);

        if($validate){
            return json_encode($validate);
        } else {
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
    }

    /**
     * Updates a campagn with the given data
     *
     * @param  int $id, array $data 
     * @return json
     */
    public function updateCampagn($id, $data) {
        $validate = $this->validateInputs($data);

        if($validate){
            return json_encode($validate);
        } else {
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
    }

    /**
     * Delets a campagn with the given id
     *
     * @param  int $id 
     * @return json
     */
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

    /**
     * Validates the inputes given in data
     *
     * @param array $data 
     * @return string
     */
    public function validateInputs($data){
        if(!isset($data['titulo'])  || empty($data['titulo']) ){
            return "O campo titulo é obrigatório";
        }
        if(strlen($data['titulo']) > 250){
            return "O campo titulo deve ter no máximo 250 caracteres";
        }   

        if(!isset($data['descricao'])  || empty($data['descricao']) ){
            return "O campo descricao é obrigatório";
        }
        if(strlen($data['descricao']) > 250){
            return "O campo descricao deve ter no máximo 250 caracteres";
        }

        if(!isset($data['empresa_id'])  || empty($data['empresa_id']) ){
            return "O campo empresa_id é obrigatório";
        }
        if(!is_int($data['empresa_id'])){
            return "O campo empresa_id deve ser int";
        }  
        
        if(!isset($data['data_inicio'])  || empty($data['data_inicio']) ){
            return "O campo data_inicio é obrigatório";
        } 
        
        if(!isset($data['data_termino'])  || empty($data['data_termino']) ){
            return "O campo data_termino é obrigatório";
        } 
        
        $data_inicio = DateTime::createFromFormat('d/m/Y', $data['data_inicio']);
        $data_termino = DateTime::createFromFormat('d/m/Y', $data['data_termino']);
        if($data_inicio && $data_inicio->format('d/m/Y') != $data['data_inicio']){
            return 'data_inicio inválida';
        }

        if($data_termino && $data_termino->format('d/m/Y') != $data['data_termino']){
            return 'data_termino inválida';
        }
             
    }
}

?>
