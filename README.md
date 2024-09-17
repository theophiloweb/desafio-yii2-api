## Desafio de Desenvolvimento em Yii2 Framework

## Informações Gerais

**Nome Completo:** Francisco das Chagas Teófilo da Silva  
**Vaga:** Back-end Developer Pleno da FEBACAPITAL  
**Data do Desafio:** 17 de setembro de 2024  
**Contato:** [teophilo@gmail.com](mailto:teophilo@gmail.com)  
**LinkedIn:** [www.linkedin.com/in/teophilo-silva-dev](https://www.linkedin.com/in/teophilo-silva-dev)

## Requisitos

### Obrigatórios
1. **PHP 7.4+** (preferencialmente PHP 8.0 ou superior)
2. **Composer** na versão 2
3. **Base de dados** em MySQL 8
4. **Uso de JSON** para envio e recebimento de dados na API
5. **Documentação** no README.md com instruções de uso, configuração e detalhes das APIs
6. **Respostas HTTP apropriadas** (códigos 200, 201, 400, 401, 404, etc.)

### Desejáveis
1. **Boas práticas de código** (PSR-12, SOLID)
2. **Uso de migrations** do Yii2 para criação da base de dados
3. **Subir o projeto** em um repositório Git (Github)
4. **Desacoplar lógica de negócio** dos controllers, utilizando MVCS.

## Funcionalidades

### 1. Autenticação
- **Endpoint:** `POST /login`
- **Descrição:** Implementa autenticação por credenciais (usuário/senha) e retorna um token JWT.
- **Exemplo de Requisição:**
  ```json
  {
    "username": "admin",
    "password": "admin"
  }
  
### Pode criar o usuário através do arquivo generate-auth-key.php na raiz do sistema
```
php generate-auth-key.php
```


-   **Exemplo de Resposta:**
    

    
    Copiar código
    
    `{
      "token": "your_jwt_token"
    }` 
    

### 2. Cadastro de Cliente

-   **Endpoint:** `POST /cliente`
-   **Descrição:** Cria um cliente com os campos `nome`, `cpf`, `cep`, `logradouro`, `numero`, `cidade`, `estado`, `complemento`, e `sexo`.
-   **Exemplo de Requisição:**
    
    
    Copiar código
    
    `{
      "nome": "João da Silva",
      "cpf": "12345678901",
      "cep": "12345678",
      "logradouro": "Rua Exemplo",
      "numero": "123",
      "cidade": "Cidade Exemplo",
      "estado": "SP",
      "complemento": "Apto 101",
      "sexo": "M"
    }` 
    
-   **Exemplo de Resposta:**
    
      
    Copiar código
    
    `{
      "id": 1,
      "nome": "João da Silva",
      "cpf": "12345678901",
      "cep": "12345678",
      "logradouro": "Rua Exemplo",
      "numero": "123",
      "cidade": "Cidade Exemplo",
      "estado": "SP",
      "complemento": "Apto 101",
      "sexo": "M",
      "created_at": "2024-09-17T00:00:00",
      "updated_at": "2024-09-17T00:00:00"
    }` 
    

### 3. Lista de Clientes

-   **Endpoint:** `GET /cliente`
-   **Descrição:** Lista os clientes com parâmetros de paginação (`limit` e `offset`), ordenação e filtro.
-   **Exemplo de Requisição:**
    
    
    Copiar código
    
    `GET /cliente?limit=10&offset=0&order=name&filter[name]=João&filter[cpf]=12345678901` 
    
-   **Exemplo de Resposta:**
    
    Copiar código
    
    `[
      {
        "id": 1,
        "nome": "João da Silva",
        "cpf": "12345678901",
        "cep": "12345678",
        "logradouro": "Rua Exemplo",
        "numero": "123",
        "cidade": "Cidade Exemplo",
        "estado": "SP",
        "complemento": "Apto 101",
        "sexo": "M",
        "created_at": "2024-09-17T00:00:00",
        "updated_at": "2024-09-17T00:00:00"
      }
    ]` 
    

### 4. Cadastro de Livros

-   **Endpoint:** `POST /book`
-   **Descrição:** Cria um livro com os campos `isbn`, `title`, `author`, `price`, e `stock`.
-   **Exemplo de Requisição:**
    
    
    Copiar código
    
    `{
      "isbn": "9781234567890",
      "title": "Livro Exemplo",
      "author": "Autor Exemplo",
      "price": 29.90,
      "stock": 10
    }` 
    
-   **Exemplo de Resposta:**
    
   
    Copiar código
    
    `{
      "id": 1,
      "isbn": "9781234567890",
      "title": "Livro Exemplo",
      "author": "Autor Exemplo",
      "price": 29.90,
      "stock": 10
    }` 
    

### 5. Lista de Livros

-   **Endpoint:** `GET /book`
-   **Descrição:** Lista os livros com parâmetros de paginação (`limit` e `offset`), ordenação e filtro.
-   **Exemplo de Requisição:**
    
    
    Copiar código
    
    `GET /book?limit=10&offset=0&order=title&filter[title]=Livro` 
    
-   **Exemplo de Resposta:**
    
       
    Copiar código
    
    `[
      {
        "id": 1,
        "isbn": "9781234567890",
        "title": "Livro Exemplo",
        "author": "Autor Exemplo",
        "price": 29.90,
        "stock": 10
      }
    ]` 
    

## Tecnologias Utilizadas

## Instalação e Configuração

1.  Clone o repositório:
  
    Copiar código
    
    `git clone https://github.com/theophiloweb/desafio-yii2-api.git` 
    
2.  Navegue para o diretório do projeto:
 
    Copiar código
    
    `cd desafio-yii2-api` 
    
3.  Instale as dependências com o Composer:
     
      
    `composer install` 
    
4.  Configure o arquivo `.env` para o banco de dados e outras variáveis de ambiente conforme necessário.
5.  Execute as migrations para criar as tabelas no banco de dados:
    
   
    
    `php yii migrate` 
    
6.  Popule o banco de dados com dados fictícios:
      
    
    `php yii seed` 
    
7.  Inicie o servidor:
    
      
    `php yii serve` 
    

## Testes com Insomnia

-   **Cadastro de Cliente:** `POST http://localhost:8082/cliente`
-   **Lista de Clientes:** `GET http://localhost:8082/cliente`
-   **Cadastro de Livro:** `POST http://localhost:8082/book`
-   **Lista de Livros:** `GET http://localhost:8082/book`

## Considerações Finais

O projeto foi desenvolvido seguindo boas práticas de desenvolvimento e otimização de queries SQL. Foram aplicados conceitos modernos de segurança e escalabilidade.

 `Você pode ajustar o conteúdo conforme necessário e garantir que todos os detalhes estejam corretos`
