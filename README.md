# Sistema de Biblioteca - API

Backend em PHP (OOP) desenvolvido para gerenciar o acervo e os empréstimos da biblioteca.

## Contrato da API (Endpoints)

Todas as requisições devem ser feitas com o cabeçalho `Content-Type: application/json`.

Rotas protegidas exigem o cabeçalho `Authorization: Bearer <token_jwt>`.

### Autenticação e Usuários
* **`POST /api/usuarios/registrar`**
    * **Descrição:** Auto-cadastro de novos membros da igreja.
    * **Body:** `{"nome": "João", "email": "joao@mail.com", "senha": "123"}`.
    * **Regra:** O sistema força criar o papel (role) `leitor`.

* **`POST /api/login`**
    * **Descrição:** autenticação de usuários.
    * **Body:** `{"email": "joao@mail.com", "senha": "123"}`
    * **Retorno Sucesso:** `200 OK` com o token JWT `{"token": "eyJhbG..."}`

* **`PUT /api/usuarios/{id}/promover`**
    * **Descrição:** Eleva um `leitor` a `admin`.
    * **Regra:** Apenas usuários autenticados com o papel de `admin podem acessar `.
    * **Retorno Sucesso:** `200 OK`| **Erro:** `403 Forbidden`.

### Livros do Acervo
* **`GET /api/livros`**
    * **Descrição:** Lista todos os livros disponíveis para empréstimo.
    * **Retorno:** `200 OK` com array de livros

* **`POST /api/livros`**
    * **Descrição:** Cadastra um novo livro no acervo.
    * **Regra:** Restrito para `admin`
    * **Body:** `{"titulo": "As Crônicas de Nárnia", "autor": "C.S. Lewis", "quantidade": "1"}`
    * **Retorno Sucesso:** `201 Created`

### Gestão de Empréstimos
* **`POST /api/emprestimos`**
    * **Descrição:** Registra a saída de um livro para um usuário
    * **Regra:** Restrito para `admin`. O sistema deve reduzir a `quantidade_disponivel` do livro
    * **Body:** `{"usuario_id": "5", "livro_id": "12", "dias_devolucao": "7"}`
    * **Retorno Sucesso:** `201 Created`

* **`PUT /api/emprestimos/{id}/devolver`**
    * **Descrição:** Registra a devolução e atualiza o status do empréstimo para 'concluido'.
    * **Regra:** Restrito para `admin`. O sistema devolve +1 na `quantidade_disponivel` do livro.
    * **Retorno Sucesso:** `200 OK`