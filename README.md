# Cadastro e Listagem de Produtos em PHP
Este projeto é um exemplo simples de **Cadastro e Listagem de Produtos** feito em PHP, que permite:
- Cadastrar produtos com nome e preço
- Listar todos os produtos cadastrados
- Validar os dados antes de salvar

O código segue as boas práticas: **PSR-12, KISS e DRY**.

---

## Funcionalidades

- Cadastro de produtos com **nome e preço**, garantindo que os campos sejam válidos.
- Listagem de produtos cadastrados, exibindo **ID, nome e preço**.
- Armazenamento dos produtos em um arquivo **products.txt**, permitindo persistência simples.
- Validação básica de dados (nome obrigatório, preço numérico positivo).
- Tratamento de erros simples com mensagens amigáveis.
- Redirecionamento automático após cadastro ou erro de validação.

---

## Como Usar

1. Certifique-se de ter um servidor local como **XAMPP** ou **MAMP** rodando PHP.  
2. Coloque a pasta Cadastro-e-listagem-com-SRP dentro do diretório `htdocs` (XAMPP) ou equivalente.  
3. Abra o navegador e acesse:
http://localhost/Cadastro-e-listagem-com-SRP/public/index.php
4. Preencha o formulário para cadastrar produtos e clique em **Cadastrar**.
5. Acesse a página **Produtos Cadastrados** para ver todos os produtos.

---

## Estrutura do Projeto

- `public/index.php` → Formulário para cadastrar produtos  
- `public/create.php` → Processa o cadastro e valida os dados  
- `public/products.php` → Lista todos os produtos cadastrados  
- `src/Application/ProductService.php` → Lógica de cadastro e listagem de produtos  
- `src/Infra/FileProductRepository.php` → Repositório que lê e salva produtos no arquivo  
- `src/Domain/SimpleProductValidator.php` → Validador simples de produtos  
- `storage/products.txt` → Arquivo que armazena os produtos  

---

## 📌 Casos de Uso

| **ID** | **Descrição** | **Entrada (exemplo)** | **Resultado Esperado** |
|--------|----------------|-----------------------|-------------------------|
| **CU1** | Cadastro válido | `name="Teclado"`, `price=120.50` | Produto criado com sucesso e aparece na listagem |
| **CU2** | Nome curto (inválido) | `name="T"`, `price=50` | Cadastro rejeitado (nome deve ter pelo menos 2 caracteres) |
| **CU3** | Preço negativo (inválido) | `name="Mouse"`, `price=-10` | Cadastro rejeitado (preço deve ser positivo) |
| **CU4** | Lista vazia | Nenhum produto no arquivo | Página de listagem exibe “Nenhum produto cadastrado” |
| **CU5** | Múltiplos cadastros | Cadastro de 3 produtos diferentes | Produtos listados em ordem com IDs incrementados |

---

## 🧪 Casos de Teste

- **Caso de Teste 1 – Create válido**  
  - **Entrada:** `name=Teclado`, `price=120.50`  
  - **Resultado esperado:**  
    - HTTP **201**  
    - Produto aparece na listagem  
    - Resposta:  
      ```json
      {"product":{"id":1,"name":"Teclado","price":120.5}}
      ```

- **Caso de Teste 2 – Create inválido (nome curto)**  
  - **Entrada:** `name=T`, `price=50`  
  - **Resultado esperado:**  
    - HTTP **422**  
    - Mensagem: `"Nome deve ter pelo menos 2 caracteres"`  
    - Storage não deve ser alterado  
    - Resposta:  
      ```json
      {"errors":["Nome deve ter pelo menos 2 caracteres"]}
      ```

- **Caso de Teste 3 – Create inválido (preço negativo)**  
  - **Entrada:** `name=Mouse`, `price=-10`  
  - **Resultado esperado:**  
    - HTTP **422**  
    - Mensagem: `"Preço deve ser maior que zero"`  
    - Storage não deve ser alterado  
    - Resposta:  
      ```json
      {"errors":["Preço deve ser maior que zero"]}
      ```

- **Caso de Teste 4 – List vazio**  
  - **Condição inicial:** arquivo `products.txt` vazio ou inexistente  
  - **Entrada:** GET `/products`  
  - **Resultado esperado:**  
    - HTTP **200**  
    - Resposta:  
      ```json
      []
      ```  
    - UI: `"Nenhum produto cadastrado"`

- **Caso de Teste 5 – List com múltiplos itens**  
  - **Entradas:**  
    1. `name=Teclado`, `price=120.50`  
    2. `name=Camiseta`, `price=50`  
    3. `name=Boné`, `price=35`  
  - **Resultado esperado:**  
    - HTTP **201** para cada criação  
    - Produtos aparecem em ordem na listagem (IDs 1, 2 e 3)  
    - Resposta exemplo para o último cadastro:  
      ```json
      {"product":{"id":3,"name":"Boné","price":35}}
      ```
      
*Feito pelas alunas 
Jênie Danielle Fedel Teixeira RA: 1993310
Simone Siqueira de Melo RA: 2001915*

