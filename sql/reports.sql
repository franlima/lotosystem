-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 13-Set-2019 às 02:31
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
-- Estrutura da tabela `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `idop` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `value` double NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `due` datetime DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `finished` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `reports`
--

INSERT INTO `reports` (`id`, `idop`, `iduser`, `value`, `status`, `due`, `created`, `finished`) VALUES
(1, 1, 1, 1000, 0, '2019-02-23 00:00:00', '2019-02-23 20:49:00', NULL),
(2, 1, 1, 1000, 0, '2019-02-23 00:00:00', '2019-02-23 20:51:10', NULL),
(3, 1, 1, 1000, 0, '2019-02-23 00:00:00', '2019-02-23 20:53:03', NULL),
(4, 3, 1, 300, 0, '2019-02-23 00:00:00', '2019-02-23 20:56:30', NULL),
(6, 1, 1, 5000, 0, '2019-02-23 00:00:00', '2019-02-23 21:03:39', NULL),
(7, 1, 1, 10000, 0, '2019-02-23 00:00:00', '2019-02-23 21:04:29', NULL),
(8, 4, 1, 567, 0, '2019-02-23 00:00:00', '2019-02-23 21:04:49', NULL),
(9, 1, 2, 1000, 0, '2019-02-23 00:00:00', '2019-02-23 21:05:07', NULL),
(10, 1, 3, 10000, 0, '2019-02-23 00:00:00', '2019-02-23 21:10:48', NULL),
(12, 3, 2, 158, 0, '2019-02-23 00:00:00', '2019-02-23 21:13:32', NULL),
(13, 4, 2, 36, 0, '2019-02-23 00:00:00', '2019-02-23 21:14:19', NULL),
(15, 1, 3, 5000, 0, '2019-02-24 00:00:00', '2019-02-24 05:22:28', NULL),
(16, 4, 2, 354, 0, '2019-02-24 00:00:00', '2019-02-24 05:56:09', NULL),
(18, 1, 3, 15000, 0, '2019-02-24 00:00:00', '2019-02-24 06:04:02', NULL),
(25, 3, 3, 2500, 0, '2019-02-24 00:00:00', '2019-02-24 15:06:26', NULL),
(41, 1, 3, 5500, 0, '2019-02-24 00:00:00', '2019-02-25 00:17:57', NULL),
(60, 9, 3, 0, 0, '2019-02-25 00:00:00', '2019-02-25 02:58:29', NULL),
(61, 7, 3, 32800, 0, '2019-02-25 00:00:00', '2019-02-25 02:58:46', NULL),
(62, 9, 3, -32800, 0, '2019-02-25 00:00:00', '2019-02-25 02:58:56', NULL),
(63, 8, 3, 33000, 0, '2019-02-25 00:00:00', '2019-02-25 02:59:13', NULL),
(64, 9, 3, 200, 0, '2019-02-25 00:00:00', '2019-02-25 02:59:24', NULL),
(65, 1, 3, 5000, 0, '2019-02-26 00:00:00', '2019-02-26 09:28:46', NULL),
(66, 8, 3, 38000, 0, '2019-02-26 00:00:00', '2019-02-26 09:29:02', NULL),
(67, 1, 1, 5000, 0, '2019-06-04 00:00:00', '2019-06-04 01:33:20', NULL),
(68, 7, 1, 34500, 0, '2019-06-04 00:00:00', '2019-06-04 01:33:52', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idop` (`idop`),
  ADD KEY `iduser` (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`idop`) REFERENCES `operations` (`id`),
  ADD CONSTRAINT `reports_ibfk_2` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
