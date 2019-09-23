-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 16-Set-2019 às 14:40
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lotosystem`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `operations`
--

CREATE TABLE `operations` (
  `id` int(11) NOT NULL,
  `idrep` int(11) NOT NULL,
  `idop` int(11) NOT NULL,
  `value` double NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `comments` text COLLATE utf8_unicode_ci,
  `due` datetime DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `finished` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estrutura da tabela `operationstypes`
--

CREATE TABLE `operationstypes` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `delta` int(11) DEFAULT '0',
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `finished` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `operationstypes`
--

INSERT INTO `operationstypes` (`id`, `name`, `description`, `category`, `delta`, `created`, `finished`) VALUES
(1, 'Sangria', 'Valor é retirado do TFL', 'money', 0, '2019-02-10 19:12:55', NULL),
(2, 'Vale', 'Valor é colocado no TFL', 'money', 0, '2019-02-10 19:12:55', NULL),
(3, 'Comissao Bolao', 'Valor da comissao de bolao do dia', 'money', 1, '2019-02-10 19:12:55', NULL),
(4, 'Bolao', 'Valor do Bolao gerado no dia', 'money', 1, '2019-02-10 19:12:55', NULL),
(5, 'Telesena', 'Valor da Telesena', 'money', 1, '2019-02-10 19:12:55', NULL),
(6, 'Restante', 'Valor de sobra no TFL', 'money', 0, '2019-02-10 19:12:55', NULL),
(7, 'Relatorio TFL', 'Valor total no relatorio financeiro TFL', 'totals', 0, '2019-02-10 19:12:55', NULL),
(8, 'Total Caixa', 'Valor total no TFL', 'totals', 0, '2019-02-10 19:12:55', NULL),
(9, 'Quebra de Caixa', 'Valor resultante do fechamento do TFL', 'totals', 0, '2019-02-10 19:12:55', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `comments` text COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `finished` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `idtype` int(11) NOT NULL DEFAULT '2',
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `finished` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `idtype`, `username`, `password`, `created`, `finished`) VALUES
(1, 1, 'helio', 'aa1bf4646de67fd9086cf6c79007026c', '2018-11-25 13:07:11', '2018-12-09 04:34:39'),
(2, 1, 'franciney', 'aa1bf4646de67fd9086cf6c79007026c', '2018-11-25 13:07:43', NULL),
(3, 2, 'erika', 'aa1bf4646de67fd9086cf6c79007026c', '2018-11-25 13:06:33', NULL),
(4, 2, 'keite', 'aa1bf4646de67fd9086cf6c79007026c', '2018-11-25 13:08:29', NULL),
(6, 2, 'teste', 'aa1bf4646de67fd9086cf6c79007026c', '2019-01-30 21:33:52', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `userstypes`
--

CREATE TABLE `userstypes` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `finished` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `userstypes`
--

INSERT INTO `userstypes` (`id`, `type`, `description`, `created`, `finished`) VALUES
(1, 'supervisor', 'Supervisor da unidade', '2018-11-25 05:35:25', NULL),
(2, 'vendedor', 'Vendedor de boloes e operador de TFL', '2018-11-25 05:50:01', NULL),
(3, 'caixa', 'Operador de TFL', '2018-11-25 05:16:53', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `operations`
--
ALTER TABLE `operations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idop` (`idop`),
  ADD KEY `idrep` (`idrep`);

--
-- Indexes for table `operationstypes`
--
ALTER TABLE `operationstypes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iduser` (`iduser`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `idtype` (`idtype`);

--
-- Indexes for table `userstypes`
--
ALTER TABLE `userstypes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type` (`type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `operations`
--
ALTER TABLE `operations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `operationstypes`
--
ALTER TABLE `operationstypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `userstypes`
--
ALTER TABLE `userstypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `operations`
--
ALTER TABLE `operations`
  ADD CONSTRAINT `operations_operationstypes_fk1` FOREIGN KEY (`idop`) REFERENCES `operationstypes` (`id`);

--
-- Limitadores para a tabela `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_operations_fk1` FOREIGN KEY (`id`) REFERENCES `operations` (`idrep`),
  ADD CONSTRAINT `reports_users_fk1` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_userstypes_fk1` FOREIGN KEY (`idtype`) REFERENCES `userstypes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
