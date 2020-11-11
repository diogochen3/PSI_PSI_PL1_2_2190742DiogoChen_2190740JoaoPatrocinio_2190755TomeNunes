-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 10-Nov-2020 às 15:27
-- Versão do servidor: 10.4.10-MariaDB
-- versão do PHP: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_hospital`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administrador`
--

DROP TABLE IF EXISTS `administrador`;
CREATE TABLE IF NOT EXISTS `administrador` (
  `codigo_administrador` int(11) NOT NULL COMMENT 'Codigo do administrador',
  PRIMARY KEY (`codigo_administrador`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `consultas`
--

DROP TABLE IF EXISTS `consultas`;
CREATE TABLE IF NOT EXISTS `consultas` (
  `codigo_consultas` int(11) NOT NULL AUTO_INCREMENT COMMENT 'codigo da consulta',
  `utente_consulta` int(11) NOT NULL COMMENT 'ligacao utente consulta',
  `medico_consulta` int(11) NOT NULL COMMENT 'ligacao medico consulta',
  `marcacao_consulta` int(11) NOT NULL COMMENT 'ligacao marcacao consulta',
  PRIMARY KEY (`codigo_consultas`),
  KEY `utente_consulta` (`utente_consulta`),
  KEY `medico_consulta` (`medico_consulta`),
  KEY `marcacao` (`marcacao_consulta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `diagnosticos`
--

DROP TABLE IF EXISTS `diagnosticos`;
CREATE TABLE IF NOT EXISTS `diagnosticos` (
  `codigo_diagnostico` int(11) NOT NULL COMMENT 'codigo do diagnostico',
  `descricao` varchar(255) NOT NULL COMMENT 'descriçao do diagnostico',
  `situacao` varchar(255) NOT NULL COMMENT 'situaçao do diagnostico',
  `data` date NOT NULL COMMENT 'data do diagnostico',
  `medico_diagnostico` int(11) NOT NULL COMMENT 'ligaçao medico com diagnostico',
  `utente_diagnostico` int(11) NOT NULL COMMENT 'ligaçao utente ao diagnostico',
  PRIMARY KEY (`codigo_diagnostico`),
  KEY `fk_medico` (`medico_diagnostico`),
  KEY `fk_dia_utent` (`utente_diagnostico`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `especialidade`
--

DROP TABLE IF EXISTS `especialidade`;
CREATE TABLE IF NOT EXISTS `especialidade` (
  `Codigo_especialidade` int(11) NOT NULL AUTO_INCREMENT COMMENT 'codigo da especialidade',
  `especialidade` varchar(50) NOT NULL COMMENT 'nome da especialidade',
  PRIMARY KEY (`Codigo_especialidade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `marcacoes`
--

DROP TABLE IF EXISTS `marcacoes`;
CREATE TABLE IF NOT EXISTS `marcacoes` (
  `codigo_marcacoes` int(11) NOT NULL AUTO_INCREMENT COMMENT 'codigo das marcaçoes',
  `data` date NOT NULL COMMENT 'data da marcaçao',
  `medico_marcacoes` int(11) NOT NULL COMMENT 'medico da marcaçao',
  `utente_marcacoes` int(11) NOT NULL COMMENT 'utente da marcaçao',
  `especialidade_marcacao` int(11) NOT NULL COMMENT 'ligaçao especialidade com marcacoes',
  PRIMARY KEY (`codigo_marcacoes`),
  KEY `fk_medico` (`medico_marcacoes`),
  KEY `fk_utente` (`utente_marcacoes`),
  KEY `fk_especialidade` (`especialidade_marcacao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `medico`
--

DROP TABLE IF EXISTS `medico`;
CREATE TABLE IF NOT EXISTS `medico` (
  `codigo_medico` int(11) NOT NULL COMMENT 'codigo do medico',
  PRIMARY KEY (`codigo_medico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `medico`
--

INSERT INTO `medico` (`codigo_medico`) VALUES
(3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `medico_especialidade`
--

DROP TABLE IF EXISTS `medico_especialidade`;
CREATE TABLE IF NOT EXISTS `medico_especialidade` (
  `codigo_medico` int(11) NOT NULL COMMENT 'codigo do medico',
  `codigo_especialidade` int(11) NOT NULL COMMENT 'codigo da tabela especialidade',
  PRIMARY KEY (`codigo_medico`,`codigo_especialidade`),
  KEY `fk_especialidade_ME` (`codigo_especialidade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoas`
--

DROP TABLE IF EXISTS `pessoas`;
CREATE TABLE IF NOT EXISTS `pessoas` (
  `cod_pessoas` int(11) NOT NULL AUTO_INCREMENT COMMENT 'codigo da pessoa',
  `PNome` varchar(20) NOT NULL COMMENT 'Primeiro Nome',
  `UNome` varchar(20) NOT NULL COMMENT 'Ultimo Nome',
  `Email` varchar(80) NOT NULL COMMENT 'Email do Utente',
  `Contacto` int(15) NOT NULL COMMENT 'Numero de telefone',
  `NIF` int(25) NOT NULL COMMENT 'Numero de identificaçao fiscal',
  `Genero` enum('Masculino','Feminino','Outro','') NOT NULL COMMENT 'Genero da pessoa',
  `morada` varchar(255) NOT NULL COMMENT 'Morada da pessoa',
  `codigo_postal` varchar(10) NOT NULL COMMENT 'codigo postal da pessoa',
  `nacionalidade` varchar(25) NOT NULL COMMENT 'nacionalidade da pessoa',
  `Foto` blob DEFAULT NULL COMMENT 'Foto da pessoa',
  `data_nascimento` date NOT NULL COMMENT 'data de nascimento da pessoa',
  `palavra_passe` varchar(24) NOT NULL COMMENT 'palavra-passe da pessoa',
  PRIMARY KEY (`cod_pessoas`),
  UNIQUE KEY `Uni_email` (`Email`),
  UNIQUE KEY `Uni_NIF` (`NIF`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pessoas`
--

INSERT INTO `pessoas` (`cod_pessoas`, `PNome`, `UNome`, `Email`, `Contacto`, `NIF`, `Genero`, `morada`, `codigo_postal`, `nacionalidade`, `Foto`, `data_nascimento`, `palavra_passe`) VALUES
(3, 'tome', 'nunes', 'tome.nunes@gmail.com', 969422799, 239232323, 'Masculino', 'dassdassd', '2440-395', 'Portuguesa', NULL, '0000-00-00', 'tome');

-- --------------------------------------------------------

--
-- Estrutura da tabela `receitas`
--

DROP TABLE IF EXISTS `receitas`;
CREATE TABLE IF NOT EXISTS `receitas` (
  `codigo_receitas` int(11) NOT NULL AUTO_INCREMENT COMMENT 'codigo das receitas',
  `Nome` varchar(255) NOT NULL COMMENT 'nome do medicamento',
  PRIMARY KEY (`codigo_receitas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `receita_consultas`
--

DROP TABLE IF EXISTS `receita_consultas`;
CREATE TABLE IF NOT EXISTS `receita_consultas` (
  `codigo_consultas` int(11) NOT NULL COMMENT 'codigo das consultas',
  `codigo_receitas` int(11) NOT NULL COMMENT 'codigo das receitas',
  PRIMARY KEY (`codigo_consultas`,`codigo_receitas`),
  KEY `fk_receitas` (`codigo_receitas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `utente`
--

DROP TABLE IF EXISTS `utente`;
CREATE TABLE IF NOT EXISTS `utente` (
  `codigo_utente` int(11) NOT NULL COMMENT 'codigo do utente',
  `medico_familia` int(11) NOT NULL,
  PRIMARY KEY (`codigo_utente`),
  KEY `fk_medico` (`medico_familia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `fk_administrador_pesssoa` FOREIGN KEY (`codigo_administrador`) REFERENCES `pessoas` (`cod_pessoas`);

--
-- Limitadores para a tabela `consultas`
--
ALTER TABLE `consultas`
  ADD CONSTRAINT `fk_marcacao_consulta` FOREIGN KEY (`marcacao_consulta`) REFERENCES `marcacoes` (`codigo_marcacoes`),
  ADD CONSTRAINT `fk_medico_consulta` FOREIGN KEY (`medico_consulta`) REFERENCES `medico` (`codigo_medico`),
  ADD CONSTRAINT `fk_utente_consulta` FOREIGN KEY (`utente_consulta`) REFERENCES `utente` (`codigo_utente`);

--
-- Limitadores para a tabela `diagnosticos`
--
ALTER TABLE `diagnosticos`
  ADD CONSTRAINT `fk_medico_diagnosticos` FOREIGN KEY (`medico_diagnostico`) REFERENCES `medico` (`codigo_medico`);

--
-- Limitadores para a tabela `marcacoes`
--
ALTER TABLE `marcacoes`
  ADD CONSTRAINT `fk_especialidade_marcacao` FOREIGN KEY (`especialidade_marcacao`) REFERENCES `especialidade` (`Codigo_especialidade`),
  ADD CONSTRAINT `fk_medico_marcacao` FOREIGN KEY (`medico_marcacoes`) REFERENCES `medico` (`codigo_medico`),
  ADD CONSTRAINT `fk_utente_marcacao` FOREIGN KEY (`utente_marcacoes`) REFERENCES `utente` (`codigo_utente`);

--
-- Limitadores para a tabela `medico`
--
ALTER TABLE `medico`
  ADD CONSTRAINT `fk_medico_pessoa` FOREIGN KEY (`codigo_medico`) REFERENCES `pessoas` (`cod_pessoas`);

--
-- Limitadores para a tabela `medico_especialidade`
--
ALTER TABLE `medico_especialidade`
  ADD CONSTRAINT `fk_especialidade_ME` FOREIGN KEY (`codigo_especialidade`) REFERENCES `especialidade` (`Codigo_especialidade`),
  ADD CONSTRAINT `fk_medico_ME` FOREIGN KEY (`codigo_medico`) REFERENCES `medico` (`codigo_medico`);

--
-- Limitadores para a tabela `receita_consultas`
--
ALTER TABLE `receita_consultas`
  ADD CONSTRAINT `fk_consultas` FOREIGN KEY (`codigo_consultas`) REFERENCES `consultas` (`codigo_consultas`),
  ADD CONSTRAINT `fk_receitas` FOREIGN KEY (`codigo_receitas`) REFERENCES `receitas` (`codigo_receitas`);

--
-- Limitadores para a tabela `utente`
--
ALTER TABLE `utente`
  ADD CONSTRAINT `fk_medico_familia` FOREIGN KEY (`medico_familia`) REFERENCES `medico` (`codigo_medico`),
  ADD CONSTRAINT `pk_pessoa_utente` FOREIGN KEY (`codigo_utente`) REFERENCES `pessoas` (`cod_pessoas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
