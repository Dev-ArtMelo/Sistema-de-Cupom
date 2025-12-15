-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15/12/2025 às 02:02
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_cupom`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `associado`
--

CREATE TABLE `associado` (
  `cpf_associado` varchar(14) NOT NULL,
  `nom_associado` varchar(40) NOT NULL,
  `dtn_associado` date DEFAULT NULL,
  `end_associado` varchar(40) DEFAULT NULL,
  `bai_associado` varchar(30) DEFAULT NULL,
  `cep_associado` varchar(8) DEFAULT NULL,
  `cid_associado` varchar(40) DEFAULT NULL,
  `uf_associado` char(2) DEFAULT NULL,
  `cel_associado` varchar(15) DEFAULT NULL,
  `email_associado` varchar(50) NOT NULL,
  `sen_associado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `associado`
--

INSERT INTO `associado` (`cpf_associado`, `nom_associado`, `dtn_associado`, `end_associado`, `bai_associado`, `cep_associado`, `cid_associado`, `uf_associado`, `cel_associado`, `email_associado`, `sen_associado`) VALUES
('43128838779', 'Arthur Melo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'arthur@email.com', '$2y$10$s37TNwWb6cCxRwOVDsldJuk4vG/LTcSXzDgokZcYvoPf5TFEs/vKu'),
('43182237870', 'Arthur S Melo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'arthurm@email.com', '$2y$10$l7NbSBYly/wAuHQtvBHahOgDU.QkBgwSdnBhz/R.5i1LDShZxR7ia');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nom_categoria` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nom_categoria`) VALUES
(1, 'Alimentacao'),
(2, 'Vestuario'),
(3, 'Servicos'),
(4, 'Lazer');

-- --------------------------------------------------------

--
-- Estrutura para tabela `comercio`
--

CREATE TABLE `comercio` (
  `cnpj_comercio` varchar(18) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `raz_social_comercio` varchar(50) DEFAULT NULL,
  `nom_fantasia_comercio` varchar(30) DEFAULT NULL,
  `end_comercio` varchar(40) DEFAULT NULL,
  `bai_comercio` varchar(30) DEFAULT NULL,
  `cep_comercio` varchar(8) DEFAULT NULL,
  `cid_comercio` varchar(40) DEFAULT NULL,
  `uf_comercio` char(2) DEFAULT NULL,
  `con_comercio` varchar(15) DEFAULT NULL,
  `email_comercio` varchar(50) DEFAULT NULL,
  `sen_comercio` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `comercio`
--

INSERT INTO `comercio` (`cnpj_comercio`, `id_categoria`, `raz_social_comercio`, `nom_fantasia_comercio`, `end_comercio`, `bai_comercio`, `cep_comercio`, `cid_comercio`, `uf_comercio`, `con_comercio`, `email_comercio`, `sen_comercio`) VALUES
('78914373000165', 1, 'Padaria ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'padaria@email.com', '$2y$10$leKsLGsAfgA9ND3YbbE5I.Ja5pkTD.LC9X8EPE.BwqaQLJwCHugfq');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cupom`
--

CREATE TABLE `cupom` (
  `num_cupom` char(12) NOT NULL,
  `tit_cupom` varchar(25) DEFAULT NULL,
  `cnpj_comercio` varchar(18) DEFAULT NULL,
  `dta_emissao_cupom` date DEFAULT NULL,
  `dta_inicio_cupom` date DEFAULT NULL,
  `dta_termino_cupom` date DEFAULT NULL,
  `per_desc_cupom` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cupom`
--

INSERT INTO `cupom` (`num_cupom`, `tit_cupom`, `cnpj_comercio`, `dta_emissao_cupom`, `dta_inicio_cupom`, `dta_termino_cupom`, `per_desc_cupom`) VALUES
('5D039FCC7F5E', 'SONHO 50%', '78914373000165', '2025-12-14', '2025-12-14', '2025-12-20', 50.00),
('85E65627251F', 'SONHO 50%', '78914373000165', '2025-12-14', '2025-12-14', '2025-12-20', 50.00),
('B206DE36878F', 'SONHO 50%', '78914373000165', '2025-12-14', '2025-12-14', '2025-12-20', 50.00),
('E170317305C7', 'SONHO 50%', '78914373000165', '2025-12-14', '2025-12-14', '2025-12-20', 50.00),
('F04C58198CC5', 'SONHO 50%', '78914373000165', '2025-12-14', '2025-12-14', '2025-12-20', 50.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cupom_associado`
--

CREATE TABLE `cupom_associado` (
  `id_cupom_associado` int(11) NOT NULL,
  `num_cupom` char(12) DEFAULT NULL,
  `cpf_associado` varchar(14) DEFAULT NULL,
  `dta_cupom_associado` date DEFAULT NULL,
  `dta_uso_cupom_associado` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cupom_associado`
--

INSERT INTO `cupom_associado` (`id_cupom_associado`, `num_cupom`, `cpf_associado`, `dta_cupom_associado`, `dta_uso_cupom_associado`) VALUES
(1, '85E65627251F', '43182237870', '2025-12-14', '2025-12-14');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `associado`
--
ALTER TABLE `associado`
  ADD PRIMARY KEY (`cpf_associado`);

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Índices de tabela `comercio`
--
ALTER TABLE `comercio`
  ADD PRIMARY KEY (`cnpj_comercio`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Índices de tabela `cupom`
--
ALTER TABLE `cupom`
  ADD PRIMARY KEY (`num_cupom`),
  ADD KEY `cnpj_comercio` (`cnpj_comercio`);

--
-- Índices de tabela `cupom_associado`
--
ALTER TABLE `cupom_associado`
  ADD PRIMARY KEY (`id_cupom_associado`),
  ADD KEY `num_cupom` (`num_cupom`),
  ADD KEY `cpf_associado` (`cpf_associado`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `cupom_associado`
--
ALTER TABLE `cupom_associado`
  MODIFY `id_cupom_associado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `comercio`
--
ALTER TABLE `comercio`
  ADD CONSTRAINT `comercio_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);

--
-- Restrições para tabelas `cupom`
--
ALTER TABLE `cupom`
  ADD CONSTRAINT `cupom_ibfk_1` FOREIGN KEY (`cnpj_comercio`) REFERENCES `comercio` (`cnpj_comercio`);

--
-- Restrições para tabelas `cupom_associado`
--
ALTER TABLE `cupom_associado`
  ADD CONSTRAINT `cupom_associado_ibfk_1` FOREIGN KEY (`num_cupom`) REFERENCES `cupom` (`num_cupom`),
  ADD CONSTRAINT `cupom_associado_ibfk_2` FOREIGN KEY (`cpf_associado`) REFERENCES `associado` (`cpf_associado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
