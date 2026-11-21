<div align="center">

# 📦 SGP — Sistema de Gerenciamento de Produtos

**Aplicação web CRUD desenvolvida em PHP 8.2, PostgreSQL 16, Docker e Tailwind CSS, estruturada sob arquitetura MVC e princípios SOLID.**

![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-16-4169E1?style=for-the-badge&logo=postgresql&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-Compose-2496ED?style=for-the-badge&logo=docker&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-3.4-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)
![Architecture](https://img.shields.io/badge/Arquitetura-MVC%20%26%20SOLID-10B981?style=for-the-badge)

</div>

---

## 📋 Sobre o Projeto

O **Sistema de Gerenciamento de Produtos (SGP)** é uma aplicação web desenvolvida como projeto prático acadêmico para demonstrar operações completas de **Create, Read, Update e Delete (CRUD)** integradas a um banco de dados relacional.

Em vez de utilizar scripts procedurais acoplados ao HTML ou pacotes locais como XAMPP, o projeto foi arquitetado com foco em **boas práticas de engenharia de software**, separação de responsabilidades, tipagem estrita e ambiente containerizado reproduzível.

---

## 🏗️ Arquitetura e Decisões Técnicas

* **Padrão MVC + Repository Pattern:** Isolamento claro entre camada de apresentação (`views/`), controle de fluxo HTTP (`Controllers/`), entidades de domínio (`Models/`) e persistência de dados (`Repositories/`).
* **Princípios SOLID na Prática:**
  * **SRP (Single Responsibility Principle):** A classe `Database` gerencia exclusivamente a conexão `PDO`, enquanto `ProdutoRepository` encapsula as instruções SQL.
  * **DIP (Dependency Inversion Principle):** O `ProdutoController` depende da abstração `ProdutoRepositoryInterface` injetada via construtor no *Composition Root* (`public/index.php`), reduzindo o acoplamento.
* **Ambiente Isolado com Docker:** Orquestração via `docker-compose.yml` com PHP 8.2 + Apache (apontando o `DocumentRoot` exclusivamente para `public/`) e PostgreSQL 16 inicializado automaticamente a partir de `database/schema.sql`.
* **Segurança e Integridade:**
  * Consultas parametrizadas (`PDO::prepare` + `bindValue`) para prevenção contra **SQL Injection**.
  * Sanitização de saída com `htmlspecialchars()` nas views para mitigação de **XSS**.
  * Validação de tipos e valores no backend antes da persistência no banco.

---

## 📂 Estrutura de Diretórios

```text
SGP/
├── database/
│   └── schema.sql                          # Script DDL de criação da tabela produtos
├── public/
│   └── index.php                           # Front Controller, autoloader PSR-4 e injeção de dependências
├── src/
│   ├── Config/
│   │   └── Database.php                    # Configuração e instância única de conexão PDO
│   ├── Controllers/
│   │   └── ProdutoController.php           # Regras de fluxo, validação de formulários e redirecionamentos
│   ├── Models/
│   │   └── ProdutoModel.php                # Entidade de domínio tipada com getters
│   └── Repositories/
│       ├── ProdutoRepositoryInterface.php  # Contrato de persistência (DIP)
│       └── ProdutoRepository.php           # Implementação SQL com PDO para PostgreSQL
├── views/
│   ├── Index.php                           # Listagem responsiva dos produtos cadastrados
│   ├── createproduto.php                   # Formulário de cadastro de novo produto
│   ├── updateproduto.php                   # Formulário pré-preenchido para edição
│   └── deleteproduto.php                   # Tela de confirmação antes da exclusão
├── Dockerfile                              # Imagem customizada PHP 8.2-Apache + extensão pdo_pgsql
├── docker-compose.yml                      # Orquestração dos serviços web e banco de dados
└── README.md                               # Documentação do projeto

```

## 🗄️ Modelagem do Banco de Dados

O script `database/schema.sql` cria automaticamente a tabela `produtos` na inicialização do container PostgreSQL:

| Coluna | Tipo | Restrições | Descrição |
| :--- | :--- | :--- | :--- |
| `id` | `SERIAL` | `PRIMARY KEY` | Identificador único auto-incrementado |
| `nome` | `VARCHAR(255)` | `NOT NULL` | Nome do produto |
| `descricao` | `TEXT` | `NOT NULL` | Descrição detalhada do item |
| `preco` | `DECIMAL(10, 2)` | `NOT NULL` | Valor monetário do produto |

---

## 🚀 Como Executar o Projeto

### Pré-requisitos
* [Docker](https://www.docker.com/) e **Docker Compose** instalados.

### Passo a passo

1. **Suba os containers da aplicação e do banco de dados:**
   ```bash
   docker compose up -d --build
   ```

2. **Acesse a aplicação no navegador:**
   ```text
   http://localhost:8000
   ```

3. **Para encerrar os containers (ou resetar o volume do banco):**
   ```bash
   # Parar containers mantendo os dados
   docker compose down

   # Parar containers e recriar o banco limpo a partir do schema.sql
   docker compose down -v
   ```

---

## 🧭 Rotas e Funcionalidades

| Ação (`?action=`) | Método HTTP | Controller | Descrição |
| :--- | :---: | :--- | :--- |
| `index` *(padrão)* | `GET` | `index()` | Lista todos os produtos cadastrados |
| `create` | `GET` | `create()` | Exibe o formulário de cadastro |
| `salve_create` | `POST` | `salve_create()` | Valida os dados e insere o novo produto |
| `update&id={id}` | `GET` | `update($id)` \vert{} Carrega o produto e exibe o formulário de edição \vert{} \vert{} `save_update&id={id}` \vert{} `POST` \vert{} `save_update($id)` | Atualiza o registro no PostgreSQL |
| `delete&id={id}` | `GET` | `delete($id)` \vert{} Exibe o resumo do item para confirmação \vert{} \vert{} `save_delete&id={id}` \vert{} `POST` \vert{} `save_delete($id)` | Remove permanentemente o registro do banco |

---

## 👨‍💻 Sobre o Autor

Desenvolvido por **Cássio Zanon Bindaco** — graduando em **Analise e Desenvolvimento de Sistemas** e formado em **Técnico em Informática**, com experiência prática no desenvolvimento backend utilizando o **ecossistema .NET (C#, ASP.NET Core, Entity Framework Core, Clean Architecture e princípios SOLID)**, aplicando esses mesmos padrões arquiteturais e boas práticas de engenharia de software neste projeto em PHP e PostgreSQL.

[![GitHub](https://img.shields.io/badge/GitHub-Ca22io-181717?style=for-the-badge&logo=github&logoColor=white)](https://github.com/Ca22io)

🔗 **Conheça outros projetos e estudos de arquitetura no meu GitHub:** [github.com/Ca22io](https://github.com/Ca22io)