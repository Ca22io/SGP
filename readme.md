# SGP

## Executar com Docker

```bash
docker compose up --build
```

A aplicação estará disponível em `http://localhost:8000`. O serviço PHP usa a
extensão `mysqli` e conecta ao serviço MySQL pelo host `db`.

O arquivo `database/schema.sql` é executado automaticamente apenas na primeira
inicialização do volume do MySQL. Para recriar o banco do zero:

```bash
docker compose down -v
docker compose up --build
```