CREATE TABLE Usuarios (
  id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
  nome VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  senha VARCHAR(255),
  criado_em TIMESTAMP DEFAULT now()
);

CREATE TABLE Permissoes (
  id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
  nome VARCHAR(50) UNIQUE,
  descricao TEXT
);

CREATE TABLE Usuarios_Permissoes (
  id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
  usuario_id UUID REFERENCES Usuarios(id),
  permissao_id UUID REFERENCES Permissoes(id)
);

CREATE TABLE AcessosRFID (
  id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
  usuario_id UUID REFERENCES Usuarios(id),
  rfid_tag VARCHAR(50) UNIQUE,
  ativo BOOLEAN DEFAULT true,
  criado_em TIMESTAMP DEFAULT now()
);

CREATE TABLE Logs (
  id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
  usuario_id UUID REFERENCES Usuarios(id),
  acesso_id UUID REFERENCES AcessosRFID(id),
  data_hora TIMESTAMP DEFAULT now(),
  status_acesso VARCHAR(50)
);
