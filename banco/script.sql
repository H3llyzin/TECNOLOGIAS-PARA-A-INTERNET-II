CREATE DATABASE IF NOT EXISTS goku_games
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE goku_games;



-- 1. CLIENTE


CREATE TABLE IF NOT EXISTS cliente (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) NOT NULL UNIQUE,
    data_nascimento DATE,
    telefone VARCHAR(20),
    email VARCHAR(150),
    endereco VARCHAR(255)
) ENGINE=InnoDB;



-- 2. FUNCIONARIO

CREATE TABLE IF NOT EXISTS funcionario (
    id_funcionario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) NOT NULL UNIQUE,
    telefone VARCHAR(20),
    email VARCHAR(150),
    cargo VARCHAR(60),
    salario DECIMAL(10,2),
    data_admissao DATE
) ENGINE=InnoDB;



-- 3. USUARIO


CREATE TABLE IF NOT EXISTS usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    id_funcionario INT NOT NULL,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    nivel_acesso ENUM('administrador', 'funcionario')
        NOT NULL DEFAULT 'funcionario',
    status BOOLEAN NOT NULL DEFAULT TRUE,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_usuario_funcionario
        FOREIGN KEY (id_funcionario)
        REFERENCES funcionario(id_funcionario)
) ENGINE=InnoDB;


-- 4. CATEGORIA


CREATE TABLE IF NOT EXISTS categoria (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    genero VARCHAR(60),
    faixa_etaria VARCHAR(30),
    status BOOLEAN NOT NULL DEFAULT TRUE
) ENGINE=InnoDB;



-- 5. JOGO


CREATE TABLE IF NOT EXISTS jogo (
    id_jogo INT AUTO_INCREMENT PRIMARY KEY,
    id_categoria INT NOT NULL,
    nome VARCHAR(150) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2) NOT NULL,
    data_lancamento DATE,
    classificacao_indicativa VARCHAR(30),
    desenvolvedora VARCHAR(100),

    CONSTRAINT fk_jogo_categoria
        FOREIGN KEY (id_categoria)
        REFERENCES categoria(id_categoria)
) ENGINE=InnoDB;


-- 6. ESTOQUE

CREATE TABLE IF NOT EXISTS estoque (
    id_estoque INT AUTO_INCREMENT PRIMARY KEY,
    nome_jogo VARCHAR(150) NOT NULL,
    quantidade INT NOT NULL DEFAULT 0,
    estoque_minimo INT NOT NULL DEFAULT 0,
    preco_custo DECIMAL(10,2) NOT NULL,
    localizacao VARCHAR(100)
) ENGINE=InnoDB;



-- 7. VENDA


CREATE TABLE IF NOT EXISTS venda (
    id_venda INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    id_funcionario INT NOT NULL,
    data_venda DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    forma_pagamento VARCHAR(50) NOT NULL,
    desconto DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    valor_total DECIMAL(10,2) NOT NULL,

    CONSTRAINT fk_venda_cliente
        FOREIGN KEY (id_cliente)
        REFERENCES cliente(id_cliente),

    CONSTRAINT fk_venda_funcionario
        FOREIGN KEY (id_funcionario)
        REFERENCES funcionario(id_funcionario)
) ENGINE=InnoDB;



-- 8. ITEM_VENDA


CREATE TABLE IF NOT EXISTS item_venda (
    id_item_venda INT AUTO_INCREMENT PRIMARY KEY,
    id_venda INT NOT NULL,
    id_jogo INT NOT NULL,
    quantidade INT NOT NULL,
    preco_unitario DECIMAL(10,2) NOT NULL,
    desconto DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    subtotal DECIMAL(10,2) NOT NULL,

    CONSTRAINT fk_item_venda_venda
        FOREIGN KEY (id_venda)
        REFERENCES venda(id_venda),

    CONSTRAINT fk_item_venda_jogo
        FOREIGN KEY (id_jogo)
        REFERENCES jogo(id_jogo)
) ENGINE=InnoDB;
