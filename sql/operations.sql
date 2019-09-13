-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 13-Set-2019 às 02:30
-- Versão do servidor: 10.3.16-MariaDB
-- versão do PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id8695685_lotosys`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `operations`
--

CREATE TABLE `operations` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `delta` int(11) DEFAULT 0,
  `created` datetime DEFAULT current_timestamp(),
  `finished` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `operations`
--

INSERT INTO `operations` (`id`, `name`, `description`, `delta`, `created`, `finished`) VALUES
(1, 'Sangria', 'Valor é retirado do TFL', 0, '2019-02-10 19:12:55', NULL),
(2, 'Vale', 'Valor é colocado no TFL', 0, '2019-02-10 19:12:55', NULL),
(3, 'Comissao Bolao', 'Valor da comissao de bolao do dia', 0, '2019-02-10 19:12:55', NULL),
(4, 'Bolao', 'Valor do Bolao gerado no dia', 0, '2019-02-10 19:12:55', NULL),
(5, 'Telesena', 'Valor da Telesena', 0, '2019-02-10 19:12:55', NULL),
(6, 'Other', 'Valor de outros produtos no TFL', 0, '2019-02-10 19:12:55', NULL),
(7, 'Relatorio TFL', 'Valor total no relatorio financeiro TFL', 0, '2019-02-10 19:12:55', NULL),
(8, 'Total', 'Valor total no TFL', 0, '2019-02-10 19:12:55', NULL),
(9, 'Quebra de Caixa', 'Valor resultante do fechamento do TFL', 0, '2019-02-10 19:12:55', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `operations`
--
ALTER TABLE `operations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `operations`
--
ALTER TABLE `operations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
