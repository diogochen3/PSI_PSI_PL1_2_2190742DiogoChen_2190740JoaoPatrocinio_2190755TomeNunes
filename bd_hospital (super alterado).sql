-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 13-Fev-2021 às 12:45
-- Versão do servidor: 10.4.10-MariaDB
-- versão do PHP: 7.2.34

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
-- Estrutura da tabela `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1605539068),
('admin', '45', 1612633055),
('medico', '32', 1612631077),
('medico', '33', 1612631545),
('medico', '39', 1612632298),
('medico', '46', 1612884907),
('medico', '49', 1612975751),
('medico', '50', 1612975905),
('medico', '51', 1612976029),
('medico', '52', 1612976114),
('medico', '53', 1612976197),
('medico', '54', 1612976340),
('medico', '55', 1612977011),
('medico', '57', 1612977435),
('medico', '58', 1612977482),
('medico', '59', 1612977557),
('medico', '60', 1612977714),
('medico', '61', 1612977871),
('medico', '62', 1612977917),
('medico', '64', 1613077386),
('utente', '31', 1612630617),
('utente', '36', 1612631674),
('utente', '40', 1612632388),
('utente', '42', 1612632509),
('utente', '43', 1612632594),
('utente', '65', 1613164727),
('utente', '66', 1613164877),
('utente', '67', 1613165060),
('utente', '68', 1613165298),
('utente', '69', 1613165357),
('utente', '70', 1613165536),
('utente', '71', 1613165649),
('utente', '72', 1613166189),
('utente', '73', 1613166314),
('utente', '74', 1613166470);

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, NULL, NULL, 1605539068, 1605539068),
('createMarcacao', 2, 'Criar marcação', NULL, NULL, 1605539068, 1605539068),
('CreateMedico', 2, 'Criar Medico', NULL, NULL, 1605539068, 1605539068),
('CreateReceita', 2, 'Criar receita', NULL, NULL, 1605539068, 1605539068),
('DeleteMarcacao', 2, 'Eliminar marcação', NULL, NULL, 1605539068, 1605539068),
('DeleteMedico', 2, 'Eliminar Medico', NULL, NULL, 1605539068, 1605539068),
('funcionario', 1, NULL, NULL, NULL, 1605539068, 1605539068),
('medico', 1, NULL, NULL, NULL, 1605539068, 1605539068),
('SendReceita', 2, 'enviar receita', NULL, NULL, 1605539068, 1605539068),
('updateMarcacao', 2, 'Alterar marcação', NULL, NULL, 1605539068, 1605539068),
('UpdateMedico', 2, 'Alterar Medico', NULL, NULL, 1605539068, 1605539068),
('utente', 1, NULL, NULL, NULL, 1605539068, 1605539068);

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'CreateMedico'),
('admin', 'DeleteMedico'),
('admin', 'medico'),
('medico', 'CreateReceita'),
('medico', 'DeleteMarcacao'),
('medico', 'SendReceita'),
('medico', 'updateMarcacao'),
('medico', 'UpdateMedico'),
('utente', 'createMarcacao'),
('utente', 'DeleteMarcacao'),
('utente', 'updateMarcacao');

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Categoria` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `Categoria`) VALUES
(1, 'Problemas na marcação'),
(2, 'Problemas no Login');

-- --------------------------------------------------------

--
-- Estrutura da tabela `consultas`
--

DROP TABLE IF EXISTS `consultas`;
CREATE TABLE IF NOT EXISTS `consultas` (
  `id` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 0,
  `id_utente` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_marcacao` (`id`) USING BTREE,
  KEY `fk_medico_consulta` (`id_medico`),
  KEY `fk_utente_consulta` (`id_utente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `consultas`
--

INSERT INTO `consultas` (`id`, `estado`, `id_utente`, `id_medico`) VALUES
(1, 1, 43, 64);

-- --------------------------------------------------------

--
-- Estrutura da tabela `contacto`
--

DROP TABLE IF EXISTS `contacto`;
CREATE TABLE IF NOT EXISTS `contacto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `assunto` varchar(255) NOT NULL,
  `corpo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_Categoria` int(11) NOT NULL,
  `id_Utente` int(11) NOT NULL,
  `data_envio` datetime NOT NULL,
  `data_respondido` datetime DEFAULT NULL,
  `respondido` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contacto_categoria` (`id_Categoria`),
  KEY `fk_contacto_profile` (`id_Utente`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `contacto`
--

INSERT INTO `contacto` (`id`, `nome`, `assunto`, `corpo`, `email`, `id_Categoria`, `id_Utente`, `data_envio`, `data_respondido`, `respondido`) VALUES
(1, 'sadasd', 'asdasd', 'sadasdasd', 'qweqwe@fgge.com', 1, 43, '2021-02-11 00:02:00', '2021-02-11 20:43:15', 1),
(2, 'QWEQWE', 'wqeqwe', 'qweqwe', 'qweqwe@fgge.com', 2, 43, '2021-02-11 00:02:00', NULL, NULL),
(3, 'dsad', 'asdasd', 'wqe213', 'wdfdq@fefes.sad', 1, 43, '2021-02-11 00:00:00', NULL, NULL),
(4, 'sadasd', 'qwewqe', 'wqeqweqwe', 'qweqwe@fgge.com', 1, 43, '2021-02-11 00:00:00', NULL, NULL),
(5, 'sadas', 'wqeqwe', 'wqeqwe', 'wdfdq@fefes.sad', 1, 43, '2021-02-11 00:02:56', NULL, NULL),
(6, 'sadas', 'asdasd', 'awsdadaweawe', 'wdfdq@fefes.sad', 1, 43, '2021-02-11 12:20:53', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `diagnostico`
--

DROP TABLE IF EXISTS `diagnostico`;
CREATE TABLE IF NOT EXISTS `diagnostico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `situacao` varchar(255) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_utente_diagnostico` (`id_utente`),
  KEY `fk_medico_diagnostico` (`id_medico`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `diagnostico`
--

INSERT INTO `diagnostico` (`id`, `descricao`, `date`, `situacao`, `id_medico`, `id_utente`) VALUES
(6, 'dsad', '2021-02-03', '1233123', 33, 36),
(11, 'dsad', '2021-02-18', 'wqe123', 64, 43);

-- --------------------------------------------------------

--
-- Estrutura da tabela `especialidade`
--

DROP TABLE IF EXISTS `especialidade`;
CREATE TABLE IF NOT EXISTS `especialidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `especialidade`
--

INSERT INTO `especialidade` (`id`, `Name`) VALUES
(1, 213312),
(2, 1232313),
(3, 1212212);

-- --------------------------------------------------------

--
-- Estrutura da tabela `horario`
--

DROP TABLE IF EXISTS `horario`;
CREATE TABLE IF NOT EXISTS `horario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tempo` datetime NOT NULL,
  `usado` tinyint(1) NOT NULL DEFAULT 0,
  `id_medico` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_horario_profile` (`id_medico`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `horario`
--

INSERT INTO `horario` (`id`, `tempo`, `usado`, `id_medico`) VALUES
(1, '2021-02-24 14:24:22', 1, 64),
(2, '2021-02-18 14:00:00', 0, 64),
(3, '2021-02-24 20:28:00', 0, 64);

-- --------------------------------------------------------

--
-- Estrutura da tabela `marcacao`
--

DROP TABLE IF EXISTS `marcacao`;
CREATE TABLE IF NOT EXISTS `marcacao` (
  `id` int(11) NOT NULL,
  `Aceitar` tinyint(1) DEFAULT 0,
  `id_especialidade` int(11) NOT NULL,
  `id_Utente` int(11) NOT NULL,
  `id_Medico` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_especialidade_marcacao` (`id_especialidade`),
  KEY `fk_medico_marcacao` (`id_Medico`),
  KEY `fk_utente_marcacao` (`id_Utente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `marcacao`
--

INSERT INTO `marcacao` (`id`, `Aceitar`, `id_especialidade`, `id_Utente`, `id_Medico`) VALUES
(1, 1, 1, 43, 64);

-- --------------------------------------------------------

--
-- Estrutura da tabela `medicamento`
--

DROP TABLE IF EXISTS `medicamento`;
CREATE TABLE IF NOT EXISTS `medicamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_medicamento` varchar(255) NOT NULL,
  `dosagem` varchar(255) NOT NULL,
  `forma_farmaceuta` varchar(255) NOT NULL,
  `embalagem` varchar(255) NOT NULL,
  `CodigoOtico` blob DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `medicamento`
--

INSERT INTO `medicamento` (`id`, `nome_medicamento`, `dosagem`, `forma_farmaceuta`, `embalagem`, `CodigoOtico`) VALUES
(1, 'bemfola', '150U.I/0.25ml', 'Solução injetável em caneca pré-cheia', 'Caneta pré-cheia - 1 unidade 0.25ml', NULL),
(2, 'Fositen', '20mg', 'comprimido', 'Blister - 10 unidade(s)', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `medico_especialidade`
--

DROP TABLE IF EXISTS `medico_especialidade`;
CREATE TABLE IF NOT EXISTS `medico_especialidade` (
  `id_medico` int(11) NOT NULL,
  `id_especialidade` int(11) NOT NULL,
  PRIMARY KEY (`id_medico`,`id_especialidade`) USING BTREE,
  KEY `fk_especialidade_medico` (`id_especialidade`),
  KEY `fk_medico_especialidade` (`id_medico`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `medico_especialidade`
--

INSERT INTO `medico_especialidade` (`id_medico`, `id_especialidade`) VALUES
(39, 1),
(56, 1),
(57, 3),
(58, 3),
(59, 2),
(60, 3),
(61, 1),
(61, 2),
(61, 3),
(62, 1),
(62, 3),
(64, 1),
(64, 2),
(64, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1605538976),
('m140506_102106_rbac_init', 1605538978),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1605538978),
('m180523_151638_rbac_updates_indexes_without_prefix', 1605538978),
('m200409_110543_rbac_update_mssql_trigger', 1605538978),
('m130524_201442_init', 1605539068),
('m190124_110200_add_verification_token_column_to_user_table', 1605539068),
('m201113_154952_init_rbac', 1605539068);

-- --------------------------------------------------------

--
-- Estrutura da tabela `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL,
  `First_name` varchar(20) NOT NULL,
  `Last_name` varchar(20) NOT NULL,
  `Email` varchar(25) NOT NULL,
  `Phone_number` int(11) NOT NULL,
  `NIF` int(9) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Birth_date` date NOT NULL,
  `gender` enum('Female','Male','Other','') NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `imagem` longblob DEFAULT NULL,
  `id_medico_familia` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `NIF` (`NIF`),
  UNIQUE KEY `Email` (`Email`),
  KEY `fk_medicofamilia_id` (`id_medico_familia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `profile`
--

INSERT INTO `profile` (`id`, `First_name`, `Last_name`, `Email`, `Phone_number`, `NIF`, `Address`, `Birth_date`, `gender`, `postal_code`, `imagem`, `id_medico_familia`) VALUES
(33, 'Diogo123Medico', 'Chen', 'asd@wqeqwe.py', 123123123, 123123123, 'sdgsdgsdgwe', '2021-02-02', 'Male', '123123123', 0x59584e7a5a58527a4c326c745a79383d, NULL),
(36, 'Diogo', 'Chen', 'a12313sd@wqeqwe.py', 123123123, 1231, 'sd13gsdgs', '2021-02-02', 'Male', '123123', 0x59584e7a5a58527a4c326c745a79383d, NULL),
(39, 'Diogo', 'Chen', 'abcdefg@abc.com', 91233, 1233, 'sdgsdgsdgwewqeqwe', '2021-02-03', 'Male', '21312313', NULL, NULL),
(40, 'Diogo', 'Chen', 'abcdefgh@abc.com', 91233, 123312, 'sdgsasd', '2021-02-03', 'Male', '12313', NULL, NULL),
(42, 'Diogo', 'Chen', 'a@abc.com', 9123312, 12331212, 'sdgsasdada', '2021-02-03', 'Male', '123132244', NULL, NULL),
(43, 'Diogo', 'Chen', 'awqeqwe@abc.com', 9123312, 123, 'sdgsasdada', '2021-02-03', 'Male', '12311', NULL, NULL),
(45, 'DiogoAdmin', 'Chen', 'aasdqweqweqwe@abc.com', 9123312, 12, 'sdgsasdada', '2021-02-03', 'Male', '123132244', 0x59584e7a5a58527a4c326c745a79396a59584e684c6e42755a7a63304c6e42755a773d3d, NULL),
(47, 'tome', 'med', '123123e@wsqe.csa', 213567765, 567568, '213123e12eqwe', '2021-02-03', 'Male', '11232', NULL, NULL),
(49, 'tome', 'medw2', '231wewq23e@wsqe.csa', 213312, 222222, '231312ewqq123', '2021-02-03', 'Male', '22222', NULL, NULL),
(50, 'Diogo', 'asd', '213qweqwe@sqe.sad', 1235665, 1422222, '123ewqed', '2021-02-03', 'Male', '12312', NULL, NULL),
(51, 'Diogo', 'asd', '213qw2wqwqeqwe@sqe.sad', 123566522, 13422212, '123ew213qed', '2021-02-03', 'Male', '123121233', NULL, NULL),
(52, 'Diogo', 'asd', '13123ewqeqwe@sqe.sad', 12353522, 5565478, '123ew213qed123', '2021-02-03', 'Male', '11233133', NULL, NULL),
(53, 'Diogo', 'asd', '213ewqe21e@sqe.sad', 12353522, 7894478, '34551wqeq23', '2021-02-03', 'Male', '35533133', NULL, NULL),
(54, 'Diogo', 'asd', 'wqd213sw1e@sqe.sad', 1235797, 879878, 'sadwe12341we', '2021-02-03', 'Male', '123456', NULL, NULL),
(55, 'Diogo', 'asd', '12313weqwq1e@sqe.sadq', 1235797, 21578931, 'sadwe12341we', '2021-02-03', 'Male', '12346', NULL, NULL),
(56, 'Diogo', 'asd', '123wq1e@sqe.sadq', 21345, 235111, 'sadwe12341we', '2021-02-03', 'Male', '2135', NULL, NULL),
(57, 'Diogo', 'asd', '12wdwqwq1e@sqe.sadq', 12345, 2135, '213ewqdsa', '2021-02-03', 'Male', '21345', NULL, NULL),
(58, 'Diogo', 'asd', '123e21qe1e@sqe.sadq', 41243, 2145512, '213weqea', '2021-02-03', 'Male', '123e41', NULL, NULL),
(59, 'Diogo', 'asd', '123wew1e@sqe.sadq', 41243, 28953, '213weqea', '2021-02-03', 'Male', '216re1', NULL, NULL),
(60, 'Diogo', 'asd', 'qwe12351we1e@sqe.sadq', 41243, 24128953, '213weqea', '2021-02-03', 'Male', '216re1', NULL, NULL),
(61, 'Diogo', 'asd', '2132412qe1e@sqe.sadq', 124551, 1235561, '213weqea', '2021-02-03', 'Male', '1235weq12', NULL, NULL),
(64, 'joao', 'patrocinio', 'etwsad@abc.com', 23423556, 96795, 'sdgsdgsdgwe', '2021-02-04', 'Male', '123415', NULL, NULL),
(74, 'ambrosio', 'nunes', 'ambrosio1.nunes@gmail.com', 969422799, 14, 'rua das ruas', '2000-10-10', 'Male', '2440', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `receitas`
--

DROP TABLE IF EXISTS `receitas`;
CREATE TABLE IF NOT EXISTS `receitas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod_acesso` int(11) NOT NULL,
  `cod_dispensa` int(11) NOT NULL,
  `data_emissao` date NOT NULL,
  `id_consulta` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_consulta_receita` (`id_consulta`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `receitas`
--

INSERT INTO `receitas` (`id`, `cod_acesso`, `cod_dispensa`, `data_emissao`, `id_consulta`) VALUES
(1, 213123, 123123, '2021-02-12', 1),
(2, 213123, 123123, '2021-02-12', 1),
(3, 213123, 123123, '2021-02-12', 1),
(4, 213123, 123123, '2021-02-12', 1),
(5, 213123, 123123, '2021-02-12', 1),
(6, 213123, 123123, '2021-02-12', 1),
(7, 213123, 123123, '2021-02-12', 1),
(8, 213123, 123123, '2021-02-12', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `receita_medicamento`
--

DROP TABLE IF EXISTS `receita_medicamento`;
CREATE TABLE IF NOT EXISTS `receita_medicamento` (
  `id_medicamento` int(11) NOT NULL,
  `id_receita` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `posologia` varchar(255) NOT NULL,
  PRIMARY KEY (`id_medicamento`,`id_receita`),
  KEY `fk_idreceita_receita` (`id_receita`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `receita_medicamento`
--

INSERT INTO `receita_medicamento` (`id_medicamento`, `id_receita`, `quantidade`, `posologia`) VALUES
(1, 1, 1, 'uma vez por dia'),
(1, 2, 1, 'uma vez por dia'),
(1, 3, 1, 'uma vez por dia'),
(1, 4, 1, 'uma vez por dia'),
(1, 5, 1, 'uma vez por dia'),
(1, 6, 1, 'uma vez por dia'),
(1, 7, 1, 'uma vez por dia'),
(1, 8, 1, 'tres vez por dia'),
(2, 8, 2, 'duas vez por dia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_medico` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`, `is_medico`) VALUES
(33, 'Diogo', 'KAfrecU2GPXvBZAJvqNKGYOo0T02wA5y', '$2y$13$Fx/Ubtr/E3eUNAf.y.upZ.FvMq6gXadtlBDDgQoGhJU/kAqbQaUaK', NULL, 'asd@wqeqwe.py', 10, 1612631544, 1612631544, 'lrjds2AclNPVX8Uepu5fpAPEUp1w2yxg_1612631544', 0),
(36, 'Diogo', 'ReUS0RNTP-X00uqrmWNuxHFFjBIxwdMJ', '$2y$13$uSRH4F825qUTAnIWStgoaukdUgqvQrILMyXCxJK5XLA1W30xDNvle', NULL, 'a12313sd@wqeqwe.py', 10, 1612631674, 1612631674, 'fvkPsasCOmSCiFCCB7SWIF0uBjnZRNER_1612631674', 0),
(37, 'Diogo', 'lWFbt8EOUG1rRf-klTjKNMFXqukWQHYw', '$2y$13$a8dr1lOTSibcXb8MqmUWZ./LwuA0WyMXjK19z.gAB2MpPrBkXgdwC', NULL, 'abcd@abc.com', 10, 1612632167, 1612632167, 'zt3kUtdF3yTwEMdWOEV4YND5H92ueT8p_1612632167', 0),
(38, 'Diogo', 'yvfqWOZJhECtZBMQcmPbjaOjgkoWyNVu', '$2y$13$Eb1c5iii0VmLsMM2nnr0uuyvwsKNs.0jDTUHTZAhJrEEAexWF2gku', NULL, 'abcde@abc.com', 10, 1612632223, 1612632223, 'sFcZFhsuHbfDDkQIkoJ98-HINBj-Kdl3_1612632223', 0),
(39, 'Diogo', 'PYjpVaIx63ChgN5sCCHlkyw23W_ygVSz', '$2y$13$VxzZFSIZD8659VdjIRerc.G.5m8bvgNHk6M1CDBcDvpO/Do/pCjO2', NULL, 'abcdefg@abc.com', 10, 1612632298, 1612632298, 'y4-rZEu1-1NBucQrPzEXzQ5-r-NAzIJ8_1612632298', 0),
(40, 'Diogo', 'FBmXEB_XvnQpTElkU2EsxhJSDOIUdq5N', '$2y$13$n235lGQyY6gQ3ESp.RN1duQV.8ljkDMWk1m9OjPB3nHvrBhqpt7j6', NULL, 'abcdefgh@abc.com', 10, 1612632388, 1612632388, 'dJOeYmRQZek9NEzUHxwsesxgSfaDforn_1612632388', 0),
(41, 'Diogo', 'o6nlxUvY1GQ_t4zSrmBhuvEnReUWCQOX', '$2y$13$3VNVWiPDQGTR3B6nspYbJO08T9UVDZZt2PBuwUxPRpHHbRPVW/g5C', NULL, 'ab@abc.com', 10, 1612632469, 1612632469, 'x7btBThy2eda0c0s05npEx52WCrkXD9I_1612632469', 0),
(42, 'Diogo', 'qMgMgnszffksr-Fryksody5TjwK6F_fD', '$2y$13$/VjVOeyLKk0/gHUPNcGEbOEEBAzQIejINN0kcCnC9tR4M1BrqbLai', NULL, 'a@abc.com', 10, 1612632508, 1612632508, 'k2uUA43BXFbkVs7Dt9ufe725a9Xup364_1612632508', 0),
(43, 'Diogo', 'NbuPhU_eY02tQmSvZtRW_7NER8tnBjvi', '$2y$13$FgpF2MAO.q8mYSSrT33/9epwx8i/abfHnKnAuE3WVj.qt.x6Y90ce', NULL, 'awqeqwe@abc.com', 10, 1612632593, 1612632593, 'MI9GyBogcJ_ROtQu48xiGZo9C8p1H7r7_1612632593', 0),
(44, 'Diogo', 'qiljjUfYvsYjmk3T9MpUhS8WU56QajbF', '$2y$13$0hQNksIelAF2mXHcsDexLO5vyIEaO.Rcke2Dnsro.S6jx1W//CKIK', NULL, 'asadawsdqw@abc.com', 10, 1612633004, 1612633004, 'mjEuWqeDkhmJDndSy-kY7RewShQinDuU_1612633004', 0),
(45, 'Diogo', '5kDu9PbteB5FBiQ9Uw178kRbP6KZSYCv', '$2y$13$B3LLa.AogfRPHdrx6kqXhusHDqNPGvsW5iHvy9yJjJzHJDlSkKYOO', NULL, 'aasdqweqweqwe@abc.com', 10, 1612633055, 1612633055, 'yAhPibgudCitIY9P6IDSgq6eHnkjOhAT_1612633055', 0),
(47, 'tome', 'pjJAtfSVmYyLnczuR1k0UiYjpuqCVEBL', '$2y$13$zxHY2IL9KyDCTTNVQ/cYyejw6VvoPRAEt..dgiE/l9euAjlQfsBQK', NULL, '123123e@wsqe.csa', 10, 1612975530, 1612975530, 'AgJ8D3_c-ZRXDErbiZN_w00Tnb_gr3IA_1612975530', 0),
(48, 'tome', 'YGHTKXOs4PpNp-WNbba5PeEm8Xp4Re_S', '$2y$13$23YUlhnnb22Ew0MEi1qaF.CFZLC63N8/a1lxRtzCxMGxT7D3KGd7q', NULL, 'wqe123e@wsqe.csa', 10, 1612975707, 1612975707, 'UtcDtCrWDBS3FDZeaNtVcHhcfhe_R5I1_1612975707', 0),
(49, 'tome', 'bZoPQiYP9Wnw-eJZPxwLyXlfHNaJ2aWz', '$2y$13$KJph7pjBZh2cuEfAiWOkhe.1JYCCm9HIiXv7v9.OfMIBfBu5NBRxO', NULL, '231wewq23e@wsqe.csa', 10, 1612975751, 1612975751, 'HnRXJ7biY0hycRNxyc458Y5lj7MRE0zi_1612975751', 0),
(50, 'Diogo', 'EAw7yX1ilWNUPKmV-lqs6Pe_rhFWVeh6', '$2y$13$eDJvOejRsmGF8iyX5zSeJuldp6Twaeif9ehbDFFDj/kMF9MbSEYsi', NULL, '213qweqwe@sqe.sad', 10, 1612975905, 1612975905, 'FhB4RHaCz18evQYkzA9ANPvUbsRrobJw_1612975905', 0),
(51, 'Diogo', 'r8jxTO3u8tXu49Oespo1nK_bGBmVDU0n', '$2y$13$jaKeI9ZRI1r3Dh6xraQnCegpdqk5SbTfnsasKUSRWHoVco7vFht/G', NULL, '213qw2wqwqeqwe@sqe.sad', 10, 1612976028, 1612976028, 'VyQ5p8oMGBAegrQ4IJth5PhEg2Q3_qFw_1612976028', 0),
(52, 'Diogo', '02JTWZoBnPuLvHsofUR9czajVgB_mGV-', '$2y$13$I2bbnG869ASYcuZcnRekF.GDNI2HPYncti.4t5qK/GTWrGopalSKy', NULL, '13123ewqeqwe@sqe.sad', 10, 1612976114, 1612976114, 'iLX5YhlY7AuSwRjWHerZAZIwrSLiZjgy_1612976114', 0),
(53, 'Diogo', 'A9GTQXojndDc2I4_x2QrvssPCUWxfVCW', '$2y$13$.yH9hLQh6SyCO9ubEe50rujL2E42o5gr4nxQlOkX0VZ3bVlTQ5msq', NULL, '213ewqe21e@sqe.sad', 10, 1612976197, 1612976197, '3FjM4-d09_LuVAmGeT7zen5PMInRKzWl_1612976197', 0),
(54, 'Diogo', 'r9nKxxrzRJ9bavoL0w2MIOqF-vA4_n4i', '$2y$13$PJkeyNsQTJjcRKbbU5NEROaKu.DeAglXmvE3a1nsLkXXzfMtf7UXe', NULL, 'wqd213sw1e@sqe.sad', 10, 1612976340, 1612976340, 'RyL8yLU_PRAMOOkss8Kjg-ywtQz9hGcv_1612976340', 0),
(55, 'Diogo', 'PbbjdO-e2dG5lAnxYJSLxyCWCkJKWbaX', '$2y$13$E6vDz/6rAtFSML5IXFLZlerR7G78H9zuAs6uJP7UilT9PHXNNHQze', NULL, '12313weqwq1e@sqe.sadq', 10, 1612977011, 1612977011, 'q75g7Fb8fyNoLCKixtaszwvYPxU8ao37_1612977011', 0),
(56, 'Diogo', 'pgOqMmp6g3-r6xCujAqtdQBfTz_xecn_', '$2y$13$7hpIA1W5zaweS39c828Tx.1DLQgOkPksp0w1K1N1u9copQa/MsFwu', NULL, '123wq1e@sqe.sadq', 10, 1612977196, 1612977196, '_zzx52Zy1f5IZY0GcEycdT_4_7x7kKiQ_1612977196', 0),
(57, 'Diogo', 'Jhal2Wvn1uroLxEGN1HFm7xjWjDOuv-7', '$2y$13$WbEugAXJPmt4qQ68v8eTX.cnlYY5RA0dW734yGh4FWDNaxviYYRaO', NULL, '12wdwqwq1e@sqe.sadq', 10, 1612977434, 1612977434, 'Kyd2chT7MeC9GEefUtDqLTglzkuxeo7f_1612977434', 0),
(58, 'Diogo', 'dl1B2ENqn0SGkuI46DVv_Ww-8ybqi7Vp', '$2y$13$OfIl.73xzugYSpj0HcDETeiJEcjIMZ8yK0ASCzQuT5qWQpj17OP6W', NULL, '123e21qe1e@sqe.sadq', 10, 1612977481, 1612977481, 'XInzchHpxzfOQk-h1nKytd96QG9suQMj_1612977481', 0),
(59, 'Diogo', '6OWbUiBc_mfCXs5RXVDZT3CAtso6YmvR', '$2y$13$DWZK3d/ofO/3jTR/WfxObeMdUKenfNCQqdOKQwz3IywU3bNZExcF.', NULL, '123wew1e@sqe.sadq', 10, 1612977556, 1612977556, 'CuPESpDuIrEkqorMEMkSgV26UBqf5l9W_1612977556', 0),
(60, 'Diogo', 'kwsAzZWIptSWMGYkS3nl-qkWNRyynCDy', '$2y$13$KTI0tUPzXu4H.oRRrG4jzeuoMiS/fmXZSSQMvF52LI.Vhg7cSPeCm', NULL, 'qwe12351we1e@sqe.sadq', 10, 1612977713, 1612977713, 'oh_gtfENLlad0aLASppJ7FNjZ-nL8Gcn_1612977713', 0),
(61, 'Diogo', 'Z7G_CR-3FC_5qkkZfma5PpHMKMCE_fA4', '$2y$13$ZyaajZhRKXtN3hvG9Fn0BOSXbrNyNoQVR0PtyCTp/BWaYHyTYDuI.', NULL, '2132412qe1e@sqe.sadq', 10, 1612977870, 1612977870, 'rUvQblf1AEVAoXNhWjQeFh4QL9s2ss7R_1612977870', 0),
(64, 'joao', 'rY3c5ryQbJv60M2MrQ6k4yWNzrIj1wHR', '$2y$13$wgoj/Y1Hg8FomReQofFpo.mGb0j29Ogooyzm80/XXwUVFuqxWIC3e', NULL, 'etwsad@abc.com', 10, 1613077385, 1613077385, 'OL7h929aQRnsqwqKiqUoxrhBKj7aXIIl_1613077385', 0),
(74, 'ambrosio', 'wKLOzwC_vmEOlDxC4vXbbTQt5udpJ3vf', '$2y$13$2oWdnNksVAm/D.xWFWJVI.TvgpEtYuGZZmJd.XxvUI2B2n5eh/Vay', NULL, 'ambrosio1.nunes@gmail.com', 10, 1613166470, 1613166470, '_vO38hyM7kIA4Jz5Lwf03btNwbYSaq-H_1613166470', 0);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limitadores para a tabela `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `consultas`
--
ALTER TABLE `consultas`
  ADD CONSTRAINT `fk_marcacao` FOREIGN KEY (`id`) REFERENCES `marcacao` (`id`),
  ADD CONSTRAINT `fk_medico_consulta` FOREIGN KEY (`id_medico`) REFERENCES `profile` (`id`),
  ADD CONSTRAINT `fk_utente_consulta` FOREIGN KEY (`id_utente`) REFERENCES `profile` (`id`);

--
-- Limitadores para a tabela `contacto`
--
ALTER TABLE `contacto`
  ADD CONSTRAINT `fk_contacto_categoria` FOREIGN KEY (`id_Categoria`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `fk_contacto_profile` FOREIGN KEY (`id_Utente`) REFERENCES `profile` (`id`);

--
-- Limitadores para a tabela `diagnostico`
--
ALTER TABLE `diagnostico`
  ADD CONSTRAINT `fk_medico_diagnostico` FOREIGN KEY (`id_medico`) REFERENCES `profile` (`id`),
  ADD CONSTRAINT `fk_utente_diagnostico` FOREIGN KEY (`id_utente`) REFERENCES `profile` (`id`);

--
-- Limitadores para a tabela `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `fk_horario_profile` FOREIGN KEY (`id_medico`) REFERENCES `profile` (`id`);

--
-- Limitadores para a tabela `marcacao`
--
ALTER TABLE `marcacao`
  ADD CONSTRAINT `fk_especialidade_marcacao` FOREIGN KEY (`id_especialidade`) REFERENCES `especialidade` (`id`),
  ADD CONSTRAINT `fk_horario_marcacao` FOREIGN KEY (`id`) REFERENCES `horario` (`id`),
  ADD CONSTRAINT `fk_medico_marcacao` FOREIGN KEY (`id_Medico`) REFERENCES `profile` (`id`),
  ADD CONSTRAINT `fk_utente_marcacao` FOREIGN KEY (`id_Utente`) REFERENCES `profile` (`id`);

--
-- Limitadores para a tabela `medico_especialidade`
--
ALTER TABLE `medico_especialidade`
  ADD CONSTRAINT `fk_especialidade_medico` FOREIGN KEY (`id_especialidade`) REFERENCES `especialidade` (`id`),
  ADD CONSTRAINT `fk_medico_especialidade` FOREIGN KEY (`id_medico`) REFERENCES `profile` (`id`);

--
-- Limitadores para a tabela `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fk_medicofamilia_id` FOREIGN KEY (`id_medico_familia`) REFERENCES `profile` (`id`);

--
-- Limitadores para a tabela `receitas`
--
ALTER TABLE `receitas`
  ADD CONSTRAINT `fk_consulta_receita` FOREIGN KEY (`id_consulta`) REFERENCES `consultas` (`id`);

--
-- Limitadores para a tabela `receita_medicamento`
--
ALTER TABLE `receita_medicamento`
  ADD CONSTRAINT `fk_idmedicamento_medicamento` FOREIGN KEY (`id_medicamento`) REFERENCES `medicamento` (`id`),
  ADD CONSTRAINT `fk_idreceita_receita` FOREIGN KEY (`id_receita`) REFERENCES `receitas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
