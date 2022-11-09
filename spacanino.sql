-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2022 at 03:42 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spacanino`
--

-- --------------------------------------------------------

--
-- Table structure for table `auxvet`
--

CREATE TABLE `auxvet` (
  `id_aux` int(12) NOT NULL,
  `id_rol` int(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `adress` varchar(40) NOT NULL,
  `cel` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auxvet`
--

INSERT INTO `auxvet` (`id_aux`, `id_rol`, `name`, `adress`, `cel`) VALUES
(1116, 3, 'Camilo Trujillo', 'Mz 6', 316480),
(1117, 3, 'Andrea Lopez', 'Cra 3', 310456);

-- --------------------------------------------------------

--
-- Table structure for table `detalle`
--

CREATE TABLE `detalle` (
  `id_deta` int(11) NOT NULL,
  `id_ord` int(10) NOT NULL,
  `id_ser` int(2) NOT NULL,
  `id_usu` int(12) NOT NULL,
  `id_aux` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detalle`
--

INSERT INTO `detalle` (`id_deta`, `id_ord`, `id_ser`, `id_usu`, `id_aux`) VALUES
(9, 8, 1, 1115, 1116),
(10, 8, 3, 1115, 1116),
(12, 9, 1, 1115, 1116),
(13, 9, 4, 1115, 1117),
(15, 10, 2, 1115, 1117),
(16, 10, 1, 1115, 1116),
(17, 11, 1, 1115, 1116),
(18, 11, 4, 1115, 1117),
(20, 12, 4, 1115, 1116),
(21, 12, 3, 1115, 1117);

-- --------------------------------------------------------

--
-- Table structure for table `deta_orden`
--

CREATE TABLE `deta_orden` (
  `id_deta` int(11) NOT NULL,
  `id_ord` int(10) DEFAULT NULL,
  `id_ser` int(2) DEFAULT NULL,
  `id_usu` int(12) NOT NULL,
  `id_aux` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mascotas`
--

CREATE TABLE `mascotas` (
  `id_mas` int(12) NOT NULL,
  `id_tip_pet` int(2) DEFAULT NULL,
  `namepet` varchar(80) DEFAULT NULL,
  `id_raza` int(2) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `id_usu` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mascotas`
--

INSERT INTO `mascotas` (`id_mas`, `id_tip_pet`, `namepet`, `id_raza`, `color`, `id_usu`) VALUES
(7, 1, 'Kity', 6, 'Negro', 123),
(8, 1, 'Junior', 8, 'Café', 123),
(9, 1, 'Teo', 3, 'Café', 9056),
(10, 1, 'Lizy', 7, 'Dorado', 456),
(11, 1, 'Pulgas', 4, 'Blanco', 789),
(12, 1, 'Toby', 1, 'gris', 741),
(13, 1, 'Oso', 2, 'Blanco', 852);

-- --------------------------------------------------------

--
-- Table structure for table `orden`
--

CREATE TABLE `orden` (
  `id_ord` int(11) NOT NULL,
  `fech` datetime DEFAULT current_timestamp(),
  `id_mas` int(12) NOT NULL,
  `valor_tot` int(10) DEFAULT NULL,
  `id_usu` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orden`
--

INSERT INTO `orden` (`id_ord`, `fech`, `id_mas`, `valor_tot`, `id_usu`) VALUES
(8, '2022-09-26 23:17:45', 8, 40000, 1115),
(9, '2022-09-26 23:27:51', 7, 50000, 1115),
(10, '2022-09-26 23:31:04', 9, 50000, 1115),
(11, '2022-09-27 07:40:16', 9, 50000, 1115),
(12, '2022-09-27 07:45:37', 13, 20000, 1115);

-- --------------------------------------------------------

--
-- Table structure for table `razas`
--

CREATE TABLE `razas` (
  `id_raza` int(2) NOT NULL,
  `raza` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `razas`
--

INSERT INTO `razas` (`id_raza`, `raza`) VALUES
(1, 'Schnauzer'),
(2, 'Dalmata '),
(3, 'Bulldog francés'),
(4, 'Criollo'),
(5, 'Husky siberiano'),
(6, 'Pinscher'),
(7, 'Labrador'),
(8, 'Pit bull'),
(9, 'Pastor Aleman'),
(10, 'Pug');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(2) NOT NULL,
  `role` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_rol`, `role`) VALUES
(1, 'Administrador'),
(2, 'Recepcionista'),
(3, 'Auxiliar Veterinario'),
(4, 'Dueño');

-- --------------------------------------------------------

--
-- Table structure for table `servicios`
--

CREATE TABLE `servicios` (
  `id_ser` int(2) NOT NULL,
  `servicio` varchar(100) DEFAULT NULL,
  `precio` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `servicios`
--

INSERT INTO `servicios` (`id_ser`, `servicio`, `precio`) VALUES
(1, 'Baño ', 35000),
(2, 'Corte de pelo', 15000),
(3, 'Corte de uñas', 5000),
(4, 'Spa - Masaje', 15000),
(5, 'Cepillado de dientes', 8000),
(6, 'Limpieza de lagrimales', 8000);

-- --------------------------------------------------------

--
-- Table structure for table `tip_pet`
--

CREATE TABLE `tip_pet` (
  `id_tip_pet` int(2) NOT NULL,
  `pet` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tip_pet`
--

INSERT INTO `tip_pet` (`id_tip_pet`, `pet`) VALUES
(1, 'Perro');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_usu` int(12) NOT NULL,
  `id_rol` int(2) DEFAULT NULL,
  `name` varchar(80) DEFAULT NULL,
  `adress` varchar(40) DEFAULT NULL,
  `cel` bigint(11) DEFAULT NULL,
  `pass` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_usu`, `id_rol`, `name`, `adress`, `cel`, `pass`) VALUES
(123, 4, 'María Osorio', 'Cll. 3', 310256, '$2y$12$ldtoCUY6xu2Y4Do/Y83E9uslDseZZn2xlXoFP0lQEbgvJrElLRD/C'),
(456, 4, 'Sofia Castro', 'Ave. 15', 318456, NULL),
(741, 4, 'David Gallo', 'Vía Salado', 0, NULL),
(789, 4, 'Lina Rodriguez', 'Calle 123', 310256, NULL),
(852, 4, 'Andrea Quintero', 'Ave. 15', 322456, NULL),
(1110, 1, 'Miguel', 'Calle 3', 321908, '$2y$12$F6VwlQk4I9YTSO75gb/4XukRp0cEEHn4dOrZmSOuWsPF0ff6kXRbS'),
(1115, 2, 'Gloria Torres', 'Cr 4', 311698, '$2y$12$wQXKgMtdQkAz0pNKs.eGC.V9c62H4.ZPJ1oMgOd5orVo7k/R/lWMS'),
(9056, 4, 'Oscar Soto', 'Mz 23 Cs A', 315456, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auxvet`
--
ALTER TABLE `auxvet`
  ADD PRIMARY KEY (`id_aux`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indexes for table `detalle`
--
ALTER TABLE `detalle`
  ADD PRIMARY KEY (`id_deta`),
  ADD KEY `id_ord` (`id_ord`),
  ADD KEY `id_ser` (`id_ser`),
  ADD KEY `id_usu` (`id_usu`);

--
-- Indexes for table `deta_orden`
--
ALTER TABLE `deta_orden`
  ADD PRIMARY KEY (`id_deta`),
  ADD KEY `id_ord` (`id_ord`),
  ADD KEY `id_ser` (`id_ser`),
  ADD KEY `id_usu` (`id_usu`),
  ADD KEY `id_aux` (`id_aux`);

--
-- Indexes for table `mascotas`
--
ALTER TABLE `mascotas`
  ADD PRIMARY KEY (`id_mas`),
  ADD KEY `id_tip_pet` (`id_tip_pet`),
  ADD KEY `id_raza` (`id_raza`),
  ADD KEY `id_usu` (`id_usu`);

--
-- Indexes for table `orden`
--
ALTER TABLE `orden`
  ADD PRIMARY KEY (`id_ord`),
  ADD KEY `id_usu` (`id_usu`),
  ADD KEY `id_mas` (`id_mas`);

--
-- Indexes for table `razas`
--
ALTER TABLE `razas`
  ADD PRIMARY KEY (`id_raza`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indexes for table `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id_ser`);

--
-- Indexes for table `tip_pet`
--
ALTER TABLE `tip_pet`
  ADD PRIMARY KEY (`id_tip_pet`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_usu`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detalle`
--
ALTER TABLE `detalle`
  MODIFY `id_deta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `deta_orden`
--
ALTER TABLE `deta_orden`
  MODIFY `id_deta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `mascotas`
--
ALTER TABLE `mascotas`
  MODIFY `id_mas` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orden`
--
ALTER TABLE `orden`
  MODIFY `id_ord` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auxvet`
--
ALTER TABLE `auxvet`
  ADD CONSTRAINT `auxvet_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);

--
-- Constraints for table `detalle`
--
ALTER TABLE `detalle`
  ADD CONSTRAINT `detalle_ibfk_1` FOREIGN KEY (`id_ord`) REFERENCES `orden` (`id_ord`),
  ADD CONSTRAINT `detalle_ibfk_2` FOREIGN KEY (`id_ser`) REFERENCES `servicios` (`id_ser`),
  ADD CONSTRAINT `detalle_ibfk_3` FOREIGN KEY (`id_usu`) REFERENCES `users` (`id_usu`);

--
-- Constraints for table `deta_orden`
--
ALTER TABLE `deta_orden`
  ADD CONSTRAINT `deta_orden_ibfk_1` FOREIGN KEY (`id_ord`) REFERENCES `orden` (`id_ord`),
  ADD CONSTRAINT `deta_orden_ibfk_2` FOREIGN KEY (`id_ser`) REFERENCES `servicios` (`id_ser`),
  ADD CONSTRAINT `deta_orden_ibfk_3` FOREIGN KEY (`id_usu`) REFERENCES `users` (`id_usu`),
  ADD CONSTRAINT `deta_orden_ibfk_4` FOREIGN KEY (`id_aux`) REFERENCES `auxvet` (`id_aux`),
  ADD CONSTRAINT `deta_orden_ibfk_5` FOREIGN KEY (`id_aux`) REFERENCES `auxvet` (`id_aux`);

--
-- Constraints for table `mascotas`
--
ALTER TABLE `mascotas`
  ADD CONSTRAINT `mascotas_ibfk_1` FOREIGN KEY (`id_tip_pet`) REFERENCES `tip_pet` (`id_tip_pet`),
  ADD CONSTRAINT `mascotas_ibfk_2` FOREIGN KEY (`id_raza`) REFERENCES `razas` (`id_raza`),
  ADD CONSTRAINT `mascotas_ibfk_3` FOREIGN KEY (`id_usu`) REFERENCES `users` (`id_usu`);

--
-- Constraints for table `orden`
--
ALTER TABLE `orden`
  ADD CONSTRAINT `orden_ibfk_1` FOREIGN KEY (`id_usu`) REFERENCES `users` (`id_usu`),
  ADD CONSTRAINT `orden_ibfk_2` FOREIGN KEY (`id_mas`) REFERENCES `mascotas` (`id_mas`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
