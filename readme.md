# SGP - Sistema de Gerenciamento de Produtos

## Sobre o projeto

Este projeto foi desenvolvido como um trabalho de faculdade para demonstrar
um sistema web simples de gerenciamento de produtos. A aplicação permite
listar, cadastrar, editar e excluir produtos armazenados em um banco MySQL.

O desenvolvimento também serve como exercício de comparação entre o
ecossistema PHP e tecnologias com as quais já possuo experiência,
principalmente o ecossistema .NET. Por isso, o projeto foi organizado
separando configuração, controller, repository e arquivos de apresentação.

## Tecnologias utilizadas

- **PHP 8.2**: linguagem da aplicação.
- **Apache**: servidor web utilizado pela imagem PHP oficial.
- **MySQL 8.4**: banco de dados relacional.
- **mysqli**: extensão utilizada pela aplicação para abrir a conexão e
  executar consultas parametrizadas.
- **PDO/PDO MySQL**: extensões instaladas na imagem para suporte a PDO e
  futuras integrações.
- **Docker e Docker Compose**: criação e execução padronizada do ambiente.
- **Tailwind CSS**: estilização das páginas por meio do CDN oficial.

## Estrutura do projeto

```text
.
├── database/
│   └── schema.sql                 # Criação do banco e da tabela produtos
├── public/
│   ├── .htaccess                  # Encaminha as rotas para index.php
│   ├── index.php                  # Front controller e tela de listagem
│   ├── create.php                 # Tela de cadastro
│   ├── edit.php                   # Tela de edição
│   └── assets/style.css           # Estilos complementares
├── src/
│   ├── Config/DataBase.php        # Configuração da conexão com o banco
│   ├── Controllers/               # Regras de entrada das requisições
│   ├── Models/                    # Entidades do domínio
│   └── Repositories/              # Consultas e persistência de dados
├── Dockerfile                     # Imagem PHP com Apache e extensões
└── docker-compose.yml             # Serviços web e MySQL
```

## Pré-requisitos

É necessário ter instalado:

- [Docker Desktop](https://www.docker.com/products/docker-desktop/)
- Docker Compose, incluído no Docker Desktop atual

Não é necessário instalar PHP, Apache, MySQL ou Node.js localmente. Esses
componentes são executados ou disponibilizados pelo ambiente Docker. Essa
abordagem é semelhante ao uso de um projeto .NET executado dentro de um
container, evitando diferenças de configuração entre computadores.

## Como executar

Na raiz do projeto, execute:

```bash
docker compose up --build
```

O parâmetro `--build` garante que o `Dockerfile` seja reconstruído e que as
extensões PHP configuradas estejam presentes.

Depois, acesse:

- Listagem: <http://localhost:8000/>
- Produtos: <http://localhost:8000/produtos>
- Novo produto: <http://localhost:8000/produtos/create>

Para executar os containers em segundo plano:

```bash
docker compose up --build -d
```

Para acompanhar os logs:

```bash
docker compose logs -f
```

Para parar os serviços:

```bash
docker compose down
```

## Banco de dados

O serviço `db` utiliza a imagem `mysql:8.4` e cria automaticamente:

- Banco: `meubanco`
- Usuário: `user`
- Senha: `123456`
- Porta publicada: `3306`

O serviço PHP acessa o MySQL pelo host Docker `db`, e não por `localhost`.
Essa diferença é importante: dentro da rede do Compose, cada serviço deve ser
referenciado pelo nome do serviço.

O arquivo `database/schema.sql` é montado no diretório de inicialização do
MySQL. Ele é executado automaticamente somente quando o volume do banco é
criado pela primeira vez.

Para apagar o volume e recriar o banco do zero:

```bash
docker compose down -v
docker compose up --build
```

> O comando `down -v` remove os dados persistidos do banco. Use-o apenas
> quando a recriação do banco for desejada.

## Rotas disponíveis

| Método | Rota | Função |
|---|---|---|
| `GET` | `/` | Lista os produtos |
| `GET` | `/produtos` | Lista os produtos |
| `GET` | `/produtos/create` | Exibe o formulário de cadastro |
| `POST` | `/produtos/store` | Cadastra um produto |
| `GET` | `/produtos/{id}/edit` | Exibe o formulário de edição |
| `POST` | `/produtos/{id}/update` | Atualiza um produto |
| `POST` | `/produtos/{id}/delete` | Exclui um produto |

O Apache usa o módulo `mod_rewrite` e o arquivo `public/.htaccess` para
encaminhar URLs amigáveis ao `public/index.php`, que funciona como front
controller. Essa responsabilidade é semelhante à função de roteamento
realizada pelo ASP.NET Core em uma aplicação .NET.

## Tailwind CSS

As páginas carregam o Tailwind CSS pelo CDN:

```html
<script src="https://cdn.tailwindcss.com"></script>
```

Isso permite utilizar as classes utilitárias diretamente no HTML sem criar
uma etapa local de Node.js, npm ou compilação de CSS. Para este trabalho
acadêmico, essa alternativa reduz a configuração necessária e facilita a
execução em diferentes computadores.

O arquivo `public/assets/style.css` contém apenas estilos complementares que
não dependem do processo de compilação do Tailwind.

Em um projeto maior ou em produção, seria recomendável instalar o Tailwind
como dependência, configurar um processo de build e gerar um CSS estático
otimizado.

## Relação com o ecossistema .NET

As responsabilidades foram separadas de forma semelhante a uma aplicação
tradicional em .NET:

| Neste projeto PHP | Conceito semelhante no .NET |
|---|---|
| `src/Config` | Configuração e serviços de infraestrutura |
| `Controllers` | Controllers |
| `Repositories` | Repositórios ou camada de acesso a dados |
| `public/index.php` | Pipeline de entrada e roteamento |
| `public/*.php` | Views ou páginas de apresentação |
| `docker-compose.yml` | Orquestração do ambiente local |

Apesar da organização semelhante, a aplicação não utiliza ASP.NET Core,
Entity Framework ou Razor. O acesso aos dados é feito diretamente pelo
`mysqli`, usando prepared statements para os comandos com entrada do usuário.

## Solução de problemas

### Docker não inicia

Verifique se o Docker Desktop está aberto e se o Docker Engine está em
execução. Depois tente:

```bash
docker compose down
docker compose up --build
```

### Alterações no banco não aparecem

O `schema.sql` só é executado automaticamente na criação do volume. Para
recriar a estrutura:

```bash
docker compose down -v
docker compose up --build
```

### A página retorna 404

Confirme que os containers foram reconstruídos após alterações no
`Dockerfile` e que o serviço web está ativo:

```bash
docker compose ps
docker compose logs web
```
