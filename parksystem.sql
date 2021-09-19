-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 19/09/2021 às 14:55
-- Versão do servidor: 10.1.32-MariaDB
-- Versão do PHP: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `parksystem`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Estrutura para tabela `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `monthly`
--

CREATE TABLE `monthly` (
  `id` int(11) NOT NULL,
  `register_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `cpf` varchar(20) NOT NULL,
  `rg` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `cellphone` varchar(20) NOT NULL,
  `zip_code` varchar(10) NOT NULL,
  `address` varchar(155) NOT NULL,
  `number` varchar(20) NOT NULL,
  `district` varchar(45) NOT NULL,
  `city` varchar(105) NOT NULL,
  `state` varchar(2) NOT NULL,
  `complement` varchar(145) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `expiration` int(11) NOT NULL,
  `obs` tinytext,
  `updated_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `monthly`
--

INSERT INTO `monthly` (`id`, `register_date`, `first_name`, `last_name`, `birth_date`, `cpf`, `rg`, `email`, `telephone`, `cellphone`, `zip_code`, `address`, `number`, `district`, `city`, `state`, `complement`, `active`, `expiration`, `obs`, `updated_on`) VALUES
(1, '2020-03-13 22:00:02', 'Lucio', 'Souza', '2020-03-13', '359.731.420-19', '334.44644-12', 'lucio@gmail.com', '(83) 3368-1070', '(41) 9999-9999', '80530-000', 'Rua de Curitiba', '45', 'Centro', 'Curitiba', 'PR', '', 1, 31, '', '2021-09-19 17:45:21'),
(2, '2020-03-16 18:32:17', 'João', 'Antonio', '1984-03-13', '964.222.370-81', '33.036.268-9', 'joao@gmail.com', '', '', '80120-000', 'Rua do Trabalho', 'sem número', 'Centro', 'Curitiba', 'PR', '', 0, 10, '', '2020-03-20 02:47:42');

-- --------------------------------------------------------

--
-- Estrutura para tabela `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Fazendo dump de dados para tabela `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `active`, `updated_on`) VALUES
(1, 'Dinheiro', 1, '2021-09-19 16:48:38'),
(3, 'Cartão de Credito', 1, '0000-00-00 00:00:00'),
(4, 'Cartão de Debito', 1, '0000-00-00 00:00:00'),
(5, 'Pix', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pricings`
--

CREATE TABLE `pricings` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `value_hour` varchar(50) NOT NULL,
  `value_month` varchar(20) NOT NULL,
  `number_vacancies` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Fazendo dump de dados para tabela `pricings`
--

INSERT INTO `pricings` (`id`, `category`, `value_hour`, `value_month`, `number_vacancies`, `active`, `updated_on`) VALUES
(1, 'Carros pequenos', '10,00', '130,00', 30, 1, '2021-09-18 17:16:51'),
(2, 'Veículo médio', '15,00', '150,00', 30, 1, '0000-00-00 00:00:00'),
(3, 'Veículo grande', '20,00', '200,00', 30, 1, '0000-00-00 00:00:00'),
(4, 'Motos', '7,00', '70,00', 30, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `system`
--

CREATE TABLE `system` (
  `id` int(11) NOT NULL,
  `name_social` varchar(145) DEFAULT NULL,
  `name_fantasy` varchar(145) DEFAULT NULL,
  `cnpj` varchar(25) DEFAULT NULL,
  `ie` varchar(25) DEFAULT NULL,
  `telephone` varchar(25) DEFAULT NULL,
  `cellphone` varchar(25) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `site_url` varchar(100) DEFAULT NULL,
  `zip_code` varchar(25) DEFAULT NULL,
  `address` varchar(145) DEFAULT NULL,
  `number` varchar(25) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `txt_ticket` tinytext,
  `updated_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `system`
--

INSERT INTO `system` (`id`, `name_social`, `name_fantasy`, `cnpj`, `ie`, `telephone`, `cellphone`, `email`, `site_url`, `zip_code`, `address`, `number`, `city`, `state`, `txt_ticket`, `updated_on`) VALUES
(1, 'Park Now System', 'Park Now', '80.838.809/0001-26', '683.90228-49', '(41) 3232-3030', '(41) 9999-9999', 'parknow@contato.com.br', 'http://parknow.com.br', '58140-000', 'Rua Pedro Grangeiro', '664', 'Areial', 'PB', 'Park Now - Um novo conceito em estacionamento', '2021-09-18 16:07:55');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `updated_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$12$xwTCZ2nDPZXfq0p48T9lFOUVnxSCYDteFO3tGLAax21igCwYLXFDm', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, '2021-09-18 15:48:57', 1631980137, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(8, '::1', 'felps', '$2y$10$Ul2Ib4sxSFH6wVgCEQC2N.kMF84eFKXc0YpsiF41urONtD3SUpk7y', 'felixvicent1306@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1631471999, '2021-09-19 16:30:41', 1632069041, 1, 'Félix', 'Vicente', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(25, 1, 1),
(26, 8, 2);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `monthly`
--
ALTER TABLE `monthly`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pricings`
--
ALTER TABLE `pricings`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `system`
--
ALTER TABLE `system`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Índices de tabela `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `monthly`
--
ALTER TABLE `monthly`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `pricings`
--
ALTER TABLE `pricings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `system`
--
ALTER TABLE `system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
