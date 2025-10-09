CREATE DATABASE IF NOT EXISTS cadastro_clientes;

USE cadastro_clientes;

CREATE TABLE cliente (
    -- Dados Pessoais
    id_cliente INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    data_nascimento DATE,
    cpf VARCHAR(14) UNIQUE NOT NULL,
    rg VARCHAR(20) UNIQUE,
    estado_civil VARCHAR(20),
    profissao VARCHAR(100),

    -- Endereço
    cep VARCHAR(10),
    rua VARCHAR(100),
    numero VARCHAR(10),
    bairro VARCHAR(100),
    cidade VARCHAR(100),
    estado CHAR(2),

    -- Contato
    telefone VARCHAR(15),
    celular VARCHAR(15),
    email VARCHAR(100) UNIQUE
);