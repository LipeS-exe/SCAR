# Código relacionado a esta parte do sistema.

### Arduino — Leitura e envio do RFID
#### O que faz:

- Lê o cartão RFID quando aproximado do sensor.

- Envia o código do cartão para o back-end (via Wi-Fi, Bluetooth ou serial).

- Recebe resposta (liberar ou negar acesso).

- Controla hardware (abre porta, aciona luz ou alarme).

#### Como fazer:

- Programar Arduino em C++ para leitura do sensor RFID.

- Implementar comunicação com back-end (HTTP requests, MQTT ou Serial).

- Fazer tratamento de erros no hardware.

- Testar funcionamento com cartões reais.


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


