-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 17/04/2024 às 03:22
-- Versão do servidor: 8.2.0
-- Versão do PHP: 8.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_cadastro`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_pedido`
--

DROP TABLE IF EXISTS `tb_pedido`;
CREATE TABLE IF NOT EXISTS `tb_pedido` (
  `NOME` varchar(60) COLLATE utf8mb3_unicode_ci NOT NULL,
  `ENDERECO` varchar(60) COLLATE utf8mb3_unicode_ci NOT NULL,
  `FORMA_PGTO` varchar(20) COLLATE utf8mb3_unicode_ci NOT NULL,
  `CONDICAO_PGTO` varchar(2) COLLATE utf8mb3_unicode_ci NOT NULL,
  `VALOR_PARCELA` double NOT NULL,
  `VALOR_PEDIDO` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
