-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2025 at 01:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `progweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bitacora`
--

CREATE TABLE `bitacora` (
  `Id_b` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` datetime DEFAULT NULL,
  `accion` varchar(50) DEFAULT NULL,
  `id_u` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bitacora`
--

INSERT INTO `bitacora` (`Id_b`, `fecha`, `hora`, `accion`, `id_u`) VALUES
(1, '2025-04-05', '2025-04-05 23:02:05', 'Desactivar', 1),
(2, '2025-04-05', '2025-04-05 23:03:23', 'Desactivar', 1),
(3, '2025-04-05', '2025-04-05 23:03:40', 'Activar', 1),
(4, '2025-04-07', '2025-04-07 15:12:41', 'Desactivar', 1),
(5, '2025-04-07', '2025-04-07 15:12:43', 'Activar', 1),
(6, '2025-04-07', '2025-04-07 15:59:57', 'Desactivar', 1),
(7, '2025-04-07', '2025-04-07 16:01:16', 'Activar', 1),
(8, '2025-04-07', '2025-04-07 16:20:26', 'Agregar usuario', 1),
(9, '2025-04-07', '2025-04-07 16:33:41', 'Agregar usuario', 1),
(10, '2025-04-07', '2025-04-07 16:55:08', 'Agregar usuario', 1),
(11, '2025-04-07', '2025-04-07 17:08:11', 'Editar usuario', 1),
(12, '2025-04-07', '2025-04-07 17:08:19', 'Editar usuario', 1);

-- --------------------------------------------------------

--
-- Table structure for table `modulo`
--

CREATE TABLE `modulo` (
  `Id_mod` int(11) NOT NULL,
  `Nombre` varchar(40) DEFAULT NULL,
  `Url` varchar(70) DEFAULT NULL,
  `Borrado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modulo`
--

INSERT INTO `modulo` (`Id_mod`, `Nombre`, `Url`, `Borrado`) VALUES
(1, 'AdmUsuario', 'localhost', '0'),
(2, 'AdmModulo', 'localhost', '0'),
(3, 'AdmBitacora', 'localhost', '0');

-- --------------------------------------------------------

--
-- Table structure for table `mod_perfil`
--

CREATE TABLE `mod_perfil` (
  `Id_mod` int(11) NOT NULL,
  `Id_p` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mod_perfil`
--

INSERT INTO `mod_perfil` (`Id_mod`, `Id_p`) VALUES
(1, 1),
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `perfil`
--

CREATE TABLE `perfil` (
  `Id_p` int(11) NOT NULL,
  `Nombre` varchar(25) DEFAULT NULL,
  `Descripcion` varchar(70) DEFAULT NULL,
  `Borrado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perfil`
--

INSERT INTO `perfil` (`Id_p`, `Nombre`, `Descripcion`, `Borrado`) VALUES
(1, 'Administrador', 'Acceso completo', '0'),
(2, 'Profesor', 'Administrar contenido y alumnos', '0'),
(3, 'Estudiante', 'Ver contenido', '0');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `Id_u` int(11) NOT NULL,
  `Nombre` varchar(65) DEFAULT NULL,
  `Edad` int(11) DEFAULT NULL,
  `Nick` varchar(20) DEFAULT NULL,
  `Pwd` varchar(8) DEFAULT NULL,
  `Borrado` char(1) DEFAULT NULL,
  `Id_p` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`Id_u`, `Nombre`, `Edad`, `Nick`, `Pwd`, `Borrado`, `Id_p`) VALUES
(1, 'Uriel Barrera', 20, 'BarreraCach', '123456', '0', 1),
(2, 'Isaac Espinosa', 21, 'Loquillo21', '234567', '0', 2),
(3, 'Angel Mondragon', 23, 'OjitosLindos23', '345678', '0', 3),
(4, 'Luis Ramirez', 21, 'LuisitoComunica', '123456', '0', 2),
(5, 'leonardo', 50, 'leoncio', '123', '0', 2),
(6, 'Aremi Morales', 32, 'pollitojr', '123456', '0', 1),
(7, 'lian', 9, 'lian', 'lian123', '0', 1),
(8, 'Juan R', 25, 'Juanito', '123456', '0', 3),
(9, 'leonardo', 35, 'leoncio2', '123456', '0', 3),
(10, 'leonardo', 35, 'leoncio2', '123456', '0', 2),
(11, 'leonardo', 35, 'leoncio2', '123456', '0', 2),
(12, 'Horacio Jesus Tacubeño Cruz', 45, 'Horacio', '123456', '0', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`Id_b`),
  ADD KEY `bitacora_ibfk_1` (`id_u`);

--
-- Indexes for table `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`Id_mod`);

--
-- Indexes for table `mod_perfil`
--
ALTER TABLE `mod_perfil`
  ADD PRIMARY KEY (`Id_mod`,`Id_p`),
  ADD KEY `Id_p` (`Id_p`);

--
-- Indexes for table `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`Id_p`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id_u`),
  ADD KEY `Id_p` (`Id_p`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `Id_b` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bitacora`
--
ALTER TABLE `bitacora`
  ADD CONSTRAINT `bitacora_ibfk_1` FOREIGN KEY (`id_u`) REFERENCES `usuario` (`Id_u`);

--
-- Constraints for table `mod_perfil`
--
ALTER TABLE `mod_perfil`
  ADD CONSTRAINT `mod_perfil_ibfk_1` FOREIGN KEY (`Id_mod`) REFERENCES `modulo` (`Id_mod`),
  ADD CONSTRAINT `mod_perfil_ibfk_2` FOREIGN KEY (`Id_p`) REFERENCES `perfil` (`Id_p`);

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`Id_p`) REFERENCES `perfil` (`Id_p`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
