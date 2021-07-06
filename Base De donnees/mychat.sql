-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2021 at 04:25 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mychat`
--

-- --------------------------------------------------------

--
-- Table structure for table `inscription`
--

CREATE TABLE `inscription` (
  `id` int(10) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `etat` enum('online','offline') NOT NULL DEFAULT 'offline',
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inscription`
--

INSERT INTO `inscription` (`id`, `username`, `email`, `password`, `etat`, `image`) VALUES
(1, 'pc1', 'sebastienfieffe@gmail.com', '$2y$14$pLwEbZvZjYPi97W1FmAAdOd1LmgUPYBBlEEADpPXKGQcjVRhHo2kK', 'offline', NULL),
(2, 'pc4', 'pp@info.com', '$2y$14$DiyU1Aicd1Su/QwETM3OOuUG7cTXM3Psp3UOCoSjlm7bz045oqtei', 'offline', NULL),
(3, 'pc2', 'pc2@gmail.com', '$2y$14$5eLCkzYk8P1W6MgUDc2mhuNKj1Oz6J.cjhMNUkq76OrqK2WBEhOey', 'offline', NULL),
(17, 'melissa', 'melissa@gmail.com', '$2y$14$rqHD4Z/BIshqkLXfdlz.fuMenniLhXzIATVezGN7k1Xn.F3.vPqoO', 'offline', '1625452033melissa.jpg'),
(19, 'bianca', 'bianca@gmail.com', '$2y$14$GoZIYiE1CkrvIrlbkHvUzOSiTC06l0WTLvBWDDUqFE6DU9kWsGUHi', 'offline', 'defaut.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `postmsg`
--

CREATE TABLE `postmsg` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(25) NOT NULL,
  `message` varchar(255) NOT NULL,
  `dateAjout` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `postmsg`
--

INSERT INTO `postmsg` (`id`, `pseudo`, `message`, `dateAjout`) VALUES
(1, 'pc1', 'allo', '2021-06-29 20:13:18'),
(2, 'pc2', 'm fek rive la ? sak gen la?', '2021-06-29 20:16:37'),
(3, 'pc1', 'ye man', '2021-06-29 21:56:28');

-- --------------------------------------------------------

--
-- Table structure for table `privatemsg`
--

CREATE TABLE `privatemsg` (
  `id` int(11) NOT NULL,
  `pseudo_auteur` varchar(25) NOT NULL,
  `message` varchar(100) NOT NULL,
  `dateAjout` timestamp NOT NULL DEFAULT current_timestamp(),
  `pseudo_destinataire` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `privatemsg`
--

INSERT INTO `privatemsg` (`id`, `pseudo_auteur`, `message`, `dateAjout`, `pseudo_destinataire`) VALUES
(1, 'pc2', 'yo ? inbox', '2021-06-29 20:20:10', 'pc1'),
(2, 'pc2', 'yo ? inbox', '2021-06-29 20:21:01', 'pc1'),
(3, 'pc2', 'ou la', '2021-06-29 20:24:10', 'pc1'),
(4, 'pc1', 'wi', '2021-06-29 20:24:41', 'pc2'),
(5, 'pc2', 'm egn o', '2021-06-29 20:26:35', 'pc1'),
(6, 'pc1', 'wi', '2021-06-29 20:31:01', 'pc2'),
(7, 'pc1', 'yo', '2021-06-29 21:42:13', 'pc2'),
(8, 'pc2', 'm korek kounya', '2021-06-29 21:43:24', 'pc1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inscription`
--
ALTER TABLE `inscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postmsg`
--
ALTER TABLE `postmsg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privatemsg`
--
ALTER TABLE `privatemsg`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inscription`
--
ALTER TABLE `inscription`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `postmsg`
--
ALTER TABLE `postmsg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `privatemsg`
--
ALTER TABLE `privatemsg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
