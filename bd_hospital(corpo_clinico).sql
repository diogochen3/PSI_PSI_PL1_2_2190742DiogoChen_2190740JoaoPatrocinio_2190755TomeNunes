-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Dez-2020 às 19:34
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1605539068),
('funcionario', '3', 1605539068),
('medico', '2', 1605539068),
('medico', '6', 1606152956),
('medico', '7', 1607957832),
('utente', '10', 1607958489),
('utente', '11', 1608137060),
('utente', '13', 1608137113),
('utente', '4', 1605539068);

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
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

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
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

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `consultas`
--

CREATE TABLE `consultas` (
  `id` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `diagnostico`
--

CREATE TABLE `diagnostico` (
  `id` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `situacao` varchar(255) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `especialidade`
--

CREATE TABLE `especialidade` (
  `id` int(11) NOT NULL,
  `Name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `especialidade`
--

INSERT INTO `especialidade` (`id`, `Name`) VALUES
(1, 213312),
(2, 1232313),
(3, 1212212);

-- --------------------------------------------------------

--
-- Estrutura da tabela `marcacao`
--

CREATE TABLE `marcacao` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `tempo` time NOT NULL,
  `Aceitar` tinyint(1) NOT NULL,
  `id_especialidade` int(11) NOT NULL,
  `id_Utente` int(11) NOT NULL,
  `id_Medico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `medico_especialidade`
--

CREATE TABLE `medico_especialidade` (
  `id_medico` int(11) NOT NULL,
  `id_especialidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
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

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `First_name` varchar(20) NOT NULL,
  `Last_name` varchar(20) NOT NULL,
  `Email` varchar(25) NOT NULL,
  `Phone_number` int(11) NOT NULL,
  `NIF` int(11) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Birth_date` date DEFAULT NULL,
  `gender` enum('Female','Male','Other','') DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `is_medico` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `profile`
--

INSERT INTO `profile` (`id`, `First_name`, `Last_name`, `Email`, `Phone_number`, `NIF`, `Address`, `Birth_date`, `gender`, `postal_code`, `is_medico`) VALUES
(10, 'tome', 'nunes', 'daasdsadasdsad@daadad.co', 96969, 69696, NULL, NULL, NULL, NULL, 1),
(11, '123123123123', '32123123', 'teste@gmail.com2323', 2147483647, 231231231, NULL, NULL, NULL, NULL, 1),
(13, '23123123', '12312312', 'teste2@a.co212312', 9692323, 2147483647, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `receitas`
--

CREATE TABLE `receitas` (
  `id` int(11) NOT NULL,
  `Name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `receitas_consultas`
--

CREATE TABLE `receitas_consultas` (
  `id_receitas` int(11) NOT NULL,
  `id_consultas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_medico` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`, `is_medico`) VALUES
(6, 'ola', 'BrKwfs6tFw4ORtW1c_0WZTfOJyWuC2WL', '$2y$13$phayQOEJTw71zOcFtlam2OMn4qN50sHmGDVsEEhHNVF.BSdoIGRzS', NULL, 'teste@teste.com', 10, 1606152956, 1606152956, NULL, 0),
(7, 'test', 'TA4XOqNYKQssDEd7URkMUPg5P3WELw8H', '$2y$13$CKSR8kKHqPU/TzTVyVNMuOmO.31JWNFR7P2MF8QT4Tep9MIXOWW7W', NULL, 'asdasdasd@daad.com', 10, 1607957832, 1607957832, 'LHiFpqKOA94SXT4t4IlwDBNsSFqBfG9z_1607957832', 0),
(8, 'teste2', '0w9d4nOhEABIhRqFMSLrtfpdWVDQ6xM0', '$2y$13$ajVw/eq6ink0CQW.Pu7deuwwdmsGlra0cphSuuZk0NBHCmmFs94O.', NULL, 'teste2@a.co', 10, 1607958256, 1607958256, 'GsTJ0yyrXuqxEanf8-pRRYYI6Z16f3qT_1607958256', 0),
(9, '232312321', 'cUeCgsUCTUyFz0ppPY6mYVAfPQ3sWOu1', '$2y$13$yMv2VGau8kF3Ms1g1q4MweVm.NZN1Gdne0D43wlgMZsR.XLfYxhUO', NULL, 'sdadsdasds@adad.com', 10, 1607958413, 1607958413, 'AdsN91zr6u4NdhLyHS45jOLUCHH-_fhm_1607958413', 0),
(10, 'tttasdasdsa', 'K7Ocm1MF1j2N6z2VurSJ_-jnsJQKcMnF', '$2y$13$Bm9/0DFgwANjQVt5wnyUB.iN86MKFZ5b7t7gX1Bxzebm8UxmEBsv2', NULL, 'daasdsadasdsad@daadad.co', 10, 1607958489, 1607958489, 'HAQ0F5gyxx0qEfPqEV8ZpivQqKl3fIJ9_1607958489', 0),
(11, 'dadsddasdasd', 'nQRKkI-RapZYoKwk-097hSygnBJF_kdL', '$2y$13$8Ei8/Hm9jNahyhIyQYxHnuCbdw9YLW4nKFA5R5eSUX8uajdtc9jBK', NULL, 'teste@gmail.com2323', 10, 1608137060, 1608137060, 'Q6YsB1nwWflbxTAHVQ4c9wnVidVUpqbg_1608137060', 0),
(12, 'tome123', 'o8fgGDYa09qQ7rRPQpWwg8DhgOa0SGFi', '$2y$13$OAwYH1mANRza7P4n8LqkCeBGhbEZIkeSSYXAbq8f.tf7G/TaSFzyO', NULL, 'teste2@a.co2', 10, 1608137092, 1608137092, 'B4fpqFACjQcmUhHqAF3mRt642vlhHWqJ_1608137092', 0),
(13, 'tome12323312321', 'FYf7-4d2wcIvfE0zimvk88IjPoeH0mUQ', '$2y$13$3ByiQidr805SVChLz9RWteeUVc1.HGvRp4gy3FM4OcPzOupXFeNby', NULL, 'teste2@a.co212312', 10, 1608137113, 1608137113, 'kxb5f8AwDzN0t7dCL_TyQMpxT1EdZJ9k_1608137113', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Índices para tabela `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Índices para tabela `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Índices para tabela `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Índices para tabela `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_marcacao` (`id`) USING BTREE,
  ADD KEY `fk_medico_consulta` (`id_medico`),
  ADD KEY `fk_utente_consulta` (`id_utente`);

--
-- Índices para tabela `diagnostico`
--
ALTER TABLE `diagnostico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_utente_diagnostico` (`id_utente`),
  ADD KEY `fk_medico_diagnostico` (`id_medico`);

--
-- Índices para tabela `especialidade`
--
ALTER TABLE `especialidade`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `marcacao`
--
ALTER TABLE `marcacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_especialidade_marcacao` (`id_especialidade`),
  ADD KEY `fk_medico_marcacao` (`id_Medico`),
  ADD KEY `fk_utente_marcacao` (`id_Utente`);

--
-- Índices para tabela `medico_especialidade`
--
ALTER TABLE `medico_especialidade`
  ADD KEY `fk_especialidade_medico` (`id_especialidade`),
  ADD KEY `fk_medico_especialidade` (`id_medico`);

--
-- Índices para tabela `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Índices para tabela `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `NIF` (`NIF`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `is_medico` (`is_medico`);

--
-- Índices para tabela `receitas`
--
ALTER TABLE `receitas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `receitas_consultas`
--
ALTER TABLE `receitas_consultas`
  ADD PRIMARY KEY (`id_receitas`,`id_consultas`),
  ADD KEY `fk_consultas` (`id_consultas`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `diagnostico`
--
ALTER TABLE `diagnostico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `especialidade`
--
ALTER TABLE `especialidade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `marcacao`
--
ALTER TABLE `marcacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `receitas`
--
ALTER TABLE `receitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  ADD CONSTRAINT `fk_medico_consulta` FOREIGN KEY (`id_medico`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fk_utente_consulta` FOREIGN KEY (`id_utente`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `diagnostico`
--
ALTER TABLE `diagnostico`
  ADD CONSTRAINT `fk_medico_diagnostico` FOREIGN KEY (`id_medico`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fk_utente_diagnostico` FOREIGN KEY (`id_utente`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `marcacao`
--
ALTER TABLE `marcacao`
  ADD CONSTRAINT `fk_especialidade_marcacao` FOREIGN KEY (`id_especialidade`) REFERENCES `especialidade` (`id`),
  ADD CONSTRAINT `fk_medico_marcacao` FOREIGN KEY (`id_Medico`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fk_utente_marcacao` FOREIGN KEY (`id_Utente`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `medico_especialidade`
--
ALTER TABLE `medico_especialidade`
  ADD CONSTRAINT `fk_especialidade_medico` FOREIGN KEY (`id_especialidade`) REFERENCES `especialidade` (`id`),
  ADD CONSTRAINT `fk_medico_especialidade` FOREIGN KEY (`id_medico`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`id`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `receitas_consultas`
--
ALTER TABLE `receitas_consultas`
  ADD CONSTRAINT `fk_consultas` FOREIGN KEY (`id_consultas`) REFERENCES `consultas` (`id`),
  ADD CONSTRAINT `fk_receitas` FOREIGN KEY (`id_receitas`) REFERENCES `receitas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
