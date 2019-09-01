# Assembleia

Este é um projeto que visa auxiliar a criação e votação de pautas através de uma API.

## Instalação e configuração

Para instalar o sistema, é necessário que esteja instalado o docker e docker-compose, assim como o git.
Os comandos ditos neste tutorial são referente ao sistema operacial Ubuntu.

- Clone o projeto
- Acesse o diretório do projeto
- Copie o arquivo .env.example para .env
- Altere as informações ditas abaixo no arquivo .env:

> APP_TIMEZONE=America/Sao_Paulo 

> DB_CONNECTION=pgsql

> DB_HOST=assembleia-database

> DB_PORT=5432

> DB_DATABASE=assembleia

> DB_USERNAME=assembleia

> DB_PASSWORD=123456

- Execute o comando **docker run --rm -v $(pwd):/app composer install** para baixar as dependências do projeto utilizando um container do composer.
- Após execute **sudo chmod 775 -R . && sudo chmod 777 storage/logs/** para ajustar as permissões do projeto.
- Execute **sudo chown -R seu_usuario.seu_grupo .**.
- Execute **docker-compose up -d** para iniciar os serviços.
- Execute **docker exec -it assembleia-app bash** para acessar o container da aplicação.
- Execute **php artisan migrate** para realizar as migrações do banco de dados.
- Execute **exit** para sair do container.

## Utilização do sistema

Este projeto é uma API REST. Abaixo estão as rotas disponíveis com exemplos de informações para os corpos das requisições, quando necessário.

### **GET** localhost:8888/pautas
Consultar todas as pautas.

### **GET** localhost:8888/pauta/{id}
Consultar uma pauta pelo id.

### **POST** localhost:8888/pauta
Inserir uma nova pauta. Exemplo do corpo da requisição:
> {	"nome": "Pauta 1 ",	"descricao": "Decrição da Pauta 1"}

### **PUT** localhost:8888/pauta/{id}
Alteração das informações da pauta. Exemplo do corpo da requisição:
> {	"nome": "Pauta 1 alterada",	"descricao": "Decrição da Pauta 1 alterada"}

### **DELETE** localhost:8888/pauta/{id}
Remove a pauta

### **POST** localhost:8888/votacao
Inicia uma votação para uma pauta. Exemplo do corpo da requisição:
> { "pauta_id": "1", "minutos": "2" }

### **POST** localhost:8888/votacao/votar
Registra um voto para uma votação de uma pauta. Exemplo do corpo da requisição:
> { "votacao_id": "1", "voto": false, "associado": 7 }

### **GET** localhost:8888/votacao/resultado/{id}
Consulta o resultado de uma votação pelo id da pauta
