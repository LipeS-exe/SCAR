# Código relacionado a esta parte do sistema.

### Back-end (FastAPI) — Lógica e API
#### O que faz:

- Processa as requisições da interface e do Arduino.

- Valida usuários, permissões e autenticações RFID.

- Controla a lógica de liberar ou negar acesso.

- Salva logs e acessos no banco de dados.

- Gera endpoints REST seguros e documentados.

#### Como fazer:

- Criar rotas REST com FastAPI (/login, /acesso, /logs).

- Usar autenticação JWT ou outra para segurança.

- Validar dados com Pydantic.

- Documentar API (FastAPI já gera docs em /docs).

- Integrar banco de dados (PostgreSQL, MySQL) via ORM (SQLAlchemy).



### Comunicação entre Arduino e Back-end
#### O que faz:

- Interface que conecta o hardware com o software.

- Envia dados RFID coletados para o servidor.

- Recebe comandos para ação (abrir porta, alarmar).

#### Como fazer:

- Definir protocolo de comunicação (ex: POST JSON para API FastAPI).

- Implementar handshake e confirmação entre dispositivos.

- Garantir segurança na comunicação (evitar spoofing).

- Testar fluxo de ida e volta dos dados.