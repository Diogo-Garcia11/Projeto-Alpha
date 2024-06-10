-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 10-Jun-2024 às 20:26
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bdalphamdb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cliente`
--

DROP TABLE IF EXISTS `tb_cliente`;
CREATE TABLE IF NOT EXISTS `tb_cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome_cliente` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `endereco_cliente` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_cliente` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha_cliente` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `email_cliente` (`email_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `tb_cliente`
--

INSERT INTO `tb_cliente` (`id_cliente`, `nome_cliente`, `endereco_cliente`, `email_cliente`, `senha_cliente`) VALUES
(1, 'Diogo', 'lazwero rossi', 'diogogarcia08@gmail.com', 'alpha'),
(2, 'danieç', 'calux', 'reisleinad162@gmail.com', 'alpha');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_pedido`
--

DROP TABLE IF EXISTS `tb_pedido`;
CREATE TABLE IF NOT EXISTS `tb_pedido` (
  `id_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `dta_pedido` datetime NOT NULL,
  `formapgto_pedido` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `condicaopgto_pedido` int(11) NOT NULL,
  `valorparcela_pedido` decimal(7,2) NOT NULL,
  `valor_pedido` decimal(7,2) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  PRIMARY KEY (`id_pedido`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_produto` (`id_produto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_produto`
--

DROP TABLE IF EXISTS `tb_produto`;
CREATE TABLE IF NOT EXISTS `tb_produto` (
  `id_produto` int(11) NOT NULL AUTO_INCREMENT,
  `nome_prod` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor_prod` decimal(6,2) NOT NULL,
  `des_prod` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_produto`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `tb_produto`
--

INSERT INTO `tb_produto` (`id_produto`, `nome_prod`, `valor_prod`, `des_prod`) VALUES
(1, '[kindle]', '499.99', '[O Kindle é um dispositivo de leitura de livros eletrônicos desenvolvido pela Amazon.]'),
(2, '[Camera Canon]', '3199.00', '[Camera Digital Canon R100 18-45 IS STM]');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
