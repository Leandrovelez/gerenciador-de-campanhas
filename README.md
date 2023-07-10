# gerenciador-de-campanhas
API REST para um teste de desenvolvedor Backend PHP

# Detalhes

- Cada campanha é atribuída a um cliente específico
- Cada participante é atribuído a uma campnaha específica
- A API aceita e retorna um json

# Endpoints

- GET: /company (retorna todas as empresas)
- GET: /company/{id} (retorna a empresa pelo id especificado)
- POST: /company (cadastra uma nova empresa)
- PUT: /company/{id} (atualiza a empresa pelo id especificado)
- DELETE: /company/{id} (deleta a empresa pelo id especificado)
  <br><br>
- GET: /campagn (retorna todas as campanhas)
- GET: /campagn/{id} (retorna a campanha pelo id especificado)
- POST: /campagn (cadastra uma nova campanha)
- PUT: /campagn/{id} (atualiza a campanha pelo id especificado)
- DELETE: /campagn/{id} (deleta a campanha pelo id especificado)
  <br><br>
- GET: /participant (retorna todos os participantes)
- GET: /participant/{id} (retorna o participantes pelo id especificado)
- POST: /participant (cadastra um novo participantes)
- PUT: /participant/{id} (atualiza o participante pelo id especificado)
- DELETE: /participant/{id} (deleta o participante pelo id especificado)

# Endpoints company

- GET <br>
  /company <br>
  /company/{id}

- Retorno <br>

      {
    		"razao_social": "",
    		"cnpj": "",
    		"endereco": "",
    		"nome_responsavel": "",
    		"email": "",
    		"telefone": ""
      }	
	

- POST <br>
  /company

  Envio:

      {
    		"razao_social": "",
    		"cnpj": "",
    		"endereco": "",
    		"nome_responsavel": "",
    		"email": "",
    		"telefone": ""
      }
  
  Retorno: <br>
    Mensagem de sucesso
  
- PUT <br>
  /company/{id}

  Envio/Retono:

      {
    		"razao_social": "",
    		"cnpj": "",
    		"endereco": "",
    		"nome_responsavel": "",
    		"email": "",
    		"telefone": ""
      }	

- Delete <br>
  /company/{id}

  Retorno: <br>
  true

  # Endpoints campagn

- GET <br>
  /campagn <br>
  /campagn/{id} <br>

  Retorno: <br>

      {
    		"titulo": "",
    		"descricao": "",
    		"empresa_id": *,
    		"data_inicio": "",
    		"data_termino": ""
      }

- POST <br>
  /campagn <br>

  Envio/Retorno: <br>

      {
    		"titulo": "",
    		"descricao": "",
    		"empresa_id": *,
    		"data_inicio": "",
    		"data_termino": ""
      }
  
- PUT <br>
  /campagn/{id} <br>

  Envio/Retorno: <br>

        {
    		"titulo": "",
    		"descricao": "",
    		"empresa_id": *,
    		"data_inicio": "",
    		"data_termino": ""
      }

- Delete <br>
  /campagn/{id} <br>

  Retorno: <br>
  true

  # Endpoints participant

- GET <br>
  /participant <br>
  /participant/{id} <br>

  Retorno: <br>

    	{
    		"nome": "",
    		"cpf": "",
    		"email": "",
    		"campanha_id": *
    	}

- POST <br>
  /participant <br>

  Envio/Retorno: <br>

    	{
    		"nome": "",
    		"cpf": "",
    		"email": "",
    		"campanha_id": *
    	}
  
- PUT <br>
  /participant/{id} <br>

  Envio/Retorno: <br>

      	{
    		"nome": "",
    		"cpf": "",
    		"email": "",
    		"campanha_id": *
    	  }

- Delete <br>
  /participant/{id} <br>

  Retorno: <br>
  true

  #Erros
  - Em caso de erros e/ou campos inválidos, a API retorna uma mensagem descrevendo qual o erro
 
  #Informações

  - Dentro da pasta database tem o arquivo .sql do banco
  - Dentro da pasta rotas tem o arquivo de rotas para facilitar os testes com insomnia/postman (lembrando que a API só aceita dados em     
   formato json)
 
