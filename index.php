<?php

    $requestMethod = $_SERVER['REQUEST_METHOD'];
    $requestUri = $_SERVER['REQUEST_URI'];

    require 'controllers/CompanyController.php';    
    require 'controllers/CampagnController.php';    
    require 'controllers/ParticipantController.php';    

    $company = new CompanyController();
    $campagn = new CampagnController();
    $participant = new ParticipantController();
    $uri = '';

    if(substr($_SERVER['REQUEST_URI'], 0, 8) == '/company'){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            $uri = explode('/', $_SERVER['REQUEST_URI']);
        
            if($_SERVER['REQUEST_URI'] === '/company'){
                echo $company->getAll();
            }else if(array_key_exists(2, $uri) && is_numeric($uri[2])){
                echo $company->getCompany($uri[2]);
            }else{
                echo json_encode('endpoint inválido');
            }
        }else if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
            if($_SERVER['REQUEST_URI'] === '/company'){
                // Obter o corpo da solicitação PUT
                $putData = file_get_contents("php://input");

                // Converter o corpo da solicitação em uma matriz associativa
                $dadosPost = json_decode($putData, true);
                echo $company->createCompany($dadosPost);
            }else{
                echo json_encode('endpoint inválido');
            }
        }else if($_SERVER['REQUEST_METHOD'] === 'PUT'){

            $uri = explode('/', $_SERVER['REQUEST_URI']);
            
            if(array_key_exists(2, $uri) && is_numeric($uri[2]) && $uri[1] === 'company'){
                
                $putData = file_get_contents("php://input");
                $dadosPUT = json_decode($putData, true);

                echo $company->updateCompany($uri[2], $dadosPUT);
            }else{
                echo json_encode('endpoint inválido');
            }
        }else if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
            $uri = explode('/', $_SERVER['REQUEST_URI']);
            
            if(array_key_exists(2, $uri) && is_numeric($uri[2]) && $uri[1] === 'company'){
                echo $company->deleteCompany($uri[2]);
            }else{
                echo json_encode('endpoint inválido');
            }
        }

    }else if(substr($_SERVER['REQUEST_URI'], 0, 8) == '/campagn'){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            $uri = explode('/', $_SERVER['REQUEST_URI']);
        
            if($_SERVER['REQUEST_URI'] === '/campagn'){
                echo $campagn->getAll();
            }else if(array_key_exists(2, $uri) && is_numeric($uri[2])){
                echo $campagn->getCampagn($uri[2]);
            }else{
                echo json_encode('endpoint inválido');
            }
        }else if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
            if($_SERVER['REQUEST_URI'] === '/campagn'){
                $putData = file_get_contents("php://input");
                $dadosPost = json_decode($putData, true);

                echo $campagn->createCampagn($dadosPost);
            }else{
                echo json_encode('endpoint inválido');
            }
        }else if($_SERVER['REQUEST_METHOD'] === 'PUT'){
            $uri = explode('/', $_SERVER['REQUEST_URI']);
            
            if(array_key_exists(2, $uri) && is_numeric($uri[2]) && $uri[1] === 'campagn'){
                $putData = file_get_contents("php://input");
                $dadosPUT = json_decode($putData, true);

                echo $campagn->updateCampagn($uri[2], $dadosPUT);
            }else{
                echo json_encode('endpoint inválido');
            }
        }else if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
            $uri = explode('/', $_SERVER['REQUEST_URI']);
            
            if(array_key_exists(2, $uri) && is_numeric($uri[2]) && $uri[1] === 'campagn'){
                echo $campagn->deleteCampagn($uri[2]);
            }else{
                echo json_encode('endpoint inválido');
            }
        }

    }else if(substr($_SERVER['REQUEST_URI'], 0, 12) == '/participant'){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            $uri = explode('/', $_SERVER['REQUEST_URI']);
        
            if($_SERVER['REQUEST_URI'] === '/participant'){
                echo $participant->getAll();
            }else if(array_key_exists(2, $uri) && is_numeric($uri[2])){
                echo $participant->getParticipant($uri[2]);
            }else{
                echo json_encode('endpoint inválido');
            }
        }else if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
            if($_SERVER['REQUEST_URI'] === '/participant'){
                $putData = file_get_contents("php://input");
                $dadosPost = json_decode($putData, true);

                echo $participant->createParticipant($dadosPost);
            }else{
                echo json_encode('endpoint inválido');
            }
        }else if($_SERVER['REQUEST_METHOD'] === 'PUT'){
            $uri = explode('/', $_SERVER['REQUEST_URI']);
            
            if(array_key_exists(2, $uri) && is_numeric($uri[2]) && $uri[1] === 'participant'){
                $putData = file_get_contents("php://input");
                $dadosPUT = json_decode($putData, true);

                echo $participant->updateParticipant($uri[2], $dadosPUT);
            }else{
                echo json_encode('endpoint inválido');
            }
        }else if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
            $uri = explode('/', $_SERVER['REQUEST_URI']);
            
            if(array_key_exists(2, $uri) && is_numeric($uri[2]) && $uri[1] === 'participant'){
                echo $participant->deleteParticipant($uri[2]);
            }else{
                echo json_encode('endpoint inválido');
            }
        }

    }else{
        echo json_encode('endpoint inválido');
    }

?>