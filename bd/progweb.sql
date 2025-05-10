-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-05-2025 a las 05:23:29
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `progweb`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `RegistrarUsuario` (IN `nombre_pers` VARCHAR(255), IN `edad` INT, IN `correo` VARCHAR(255), IN `nick` VARCHAR(20), IN `pwd` VARCHAR(8), IN `id_p` INT)   BEGIN
    DECLARE persona_id INT;
    DECLARE perfil_existe INT;

    
    SELECT COUNT(*) INTO perfil_existe
    FROM perfil
    WHERE id_p = id_p AND borrado = 0;

    IF perfil_existe > 0 THEN
        
        INSERT INTO persona (nombre, edad, correo, borrado)
        VALUES (nombre_pers, edad, correo, 0);

        
        SET persona_id = LAST_INSERT_ID();

        
        INSERT INTO usuario (Nick, Pwd, Borrado, Id_p, Id_person)
        VALUES (nick, pwd, 0, id_p, persona_id);
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `Id_b` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` datetime DEFAULT NULL,
  `accion` varchar(50) DEFAULT NULL,
  `id_u` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`Id_b`, `fecha`, `hora`, `accion`, `id_u`) VALUES
(46, '2025-05-07', '2025-05-07 18:43:55', 'Desactivar', 7),
(47, '2025-05-07', '2025-05-07 18:44:22', 'Desactivar', 1),
(48, '2025-05-07', '2025-05-07 18:48:59', 'Actualización de módulos para el perfil: Estudiant', 1),
(49, '2025-05-07', '2025-05-07 18:49:07', 'Actualización de módulos para el perfil: Estudiant', 1),
(50, '2025-05-07', '2025-05-07 18:50:04', 'Activar', 7),
(51, '2025-05-07', '2025-05-07 18:50:05', 'Activar', 1),
(52, '2025-05-07', '2025-05-07 18:50:16', 'Editar usuario', 1),
(53, '2025-05-07', '2025-05-07 18:50:34', 'Editar usuario', 1),
(54, '2025-05-07', '2025-05-07 18:51:36', 'Editar usuario', 1),
(55, '2025-05-07', '2025-05-07 18:51:48', 'Editar usuario', 1),
(56, '2025-05-07', '2025-05-07 18:55:36', 'Actualización de módulos para el perfil: Estudiant', 1),
(57, '2025-05-07', '2025-05-07 22:41:50', 'Editar usuario', 1),
(58, '2025-05-07', '2025-05-07 22:46:11', 'Desactivar', 7),
(59, '2025-05-07', '2025-05-07 22:47:52', 'Activar', 1),
(60, '2025-05-07', '2025-05-07 22:59:50', 'Editar usuario', 1),
(61, '2025-05-07', '2025-05-07 23:00:07', 'Editar usuario', 1),
(62, '2025-05-07', '2025-05-07 23:06:58', 'Editar usuario', 1),
(63, '2025-05-07', '2025-05-07 23:07:34', 'Agregar usuario', 1),
(64, '2025-05-07', '2025-05-07 23:09:53', 'Agregar usuario', 1),
(65, '2025-05-07', '2025-05-07 23:10:01', 'Actualización de módulos para el perfil: Administr', 1),
(66, '2025-05-09', '2025-05-09 20:56:18', 'Agregar usuario', 1),
(67, '2025-05-09', '2025-05-09 20:56:31', 'Actualización de módulos para el perfil: Administr', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `Id_mod` int(11) NOT NULL,
  `Nombre` varchar(40) DEFAULT NULL,
  `Url` varchar(70) DEFAULT NULL,
  `Borrado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`Id_mod`, `Nombre`, `Url`, `Borrado`) VALUES
(1, 'AdmUsuario', '/AdmUsuario', '0'),
(2, 'AdmModulo', '/AdmModulo', '0'),
(3, 'AdmBitacora', '/AdmBitacora', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mod_perfil`
--

CREATE TABLE `mod_perfil` (
  `Id_mod` int(11) NOT NULL,
  `Id_p` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mod_perfil`
--

INSERT INTO `mod_perfil` (`Id_mod`, `Id_p`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `Id_p` int(11) NOT NULL,
  `Nombre` varchar(25) DEFAULT NULL,
  `Descripcion` varchar(70) DEFAULT NULL,
  `Borrado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`Id_p`, `Nombre`, `Descripcion`, `Borrado`) VALUES
(1, 'Administrador', 'Acceso completo', '0'),
(2, 'Profesor', 'Administrar contenido y alumnos', '0'),
(3, 'Estudiante', 'Ver contenido', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `edad` int(11) DEFAULT NULL,
  `correo` varchar(255) NOT NULL,
  `borrado` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `nombre`, `edad`, `correo`, `borrado`) VALUES
(1, 'Aremi Morales', 21, 'arenita@mail.com', b'0'),
(2, 'Ana L?pez', 30, 'ana@mail.com', b'0'),
(3, 'rmfe', 24, 'wiejf[i', b'0'),
(4, 'ergeag', 23, 'ergaeg', b'0'),
(5, 'dxcfvgh', 23, 'xcvubin', b'0'),
(6, 'dfghjk', 23, 'yinmk', b'0'),
(7, 'Isaac Espinosa', 23, 'isaac', b'0'),
(8, 'Alexis Yañez', 22, 'yanez', b'0'),
(9, 'Leonardo Profe', 45, 'leo', b'0'),
(10, 'Horacio Jesus Tacubeño Cruz', 45, 'horaaa', b'0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_u` int(11) NOT NULL,
  `Nick` varchar(20) DEFAULT NULL,
  `Pwd` varchar(8) DEFAULT NULL,
  `Borrado` char(1) DEFAULT NULL,
  `Id_p` int(11) DEFAULT NULL,
  `Id_person` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_u`, `Nick`, `Pwd`, `Borrado`, `Id_p`, `Id_person`) VALUES
(1, 'aremo', '12345', '0', 2, 1),
(2, 'analo', 'clave321', '0', 2, 2),
(3, '12345', 'wiejf[i', '0', 1, 3),
(4, '12345', 'ergaeg', '0', 1, 4),
(5, '12345', 'xcvubin', '0', 1, 5),
(6, '12346', 'yinmk', '0', 2, 6),
(7, 'isaaa', '12345', '0', 3, 7),
(8, '12345', 'yanez', '0', 1, 8),
(9, 'leo', '12345', '0', 2, 9),
(10, 'horaaa', '12345', '0', 2, 10);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`Id_b`),
  ADD KEY `bitacora_ibfk_1` (`id_u`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`Id_mod`);

--
-- Indices de la tabla `mod_perfil`
--
ALTER TABLE `mod_perfil`
  ADD PRIMARY KEY (`Id_mod`,`Id_p`),
  ADD KEY `Id_p` (`Id_p`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`Id_p`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_u`),
  ADD KEY `Id_p` (`Id_p`),
  ADD KEY `Id_person` (`Id_person`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `Id_b` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_u` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD CONSTRAINT `bitacora_ibfk_1` FOREIGN KEY (`id_u`) REFERENCES `usuario` (`Id_u`);

--
-- Filtros para la tabla `mod_perfil`
--
ALTER TABLE `mod_perfil`
  ADD CONSTRAINT `mod_perfil_ibfk_1` FOREIGN KEY (`Id_mod`) REFERENCES `modulo` (`Id_mod`),
  ADD CONSTRAINT `mod_perfil_ibfk_2` FOREIGN KEY (`Id_p`) REFERENCES `perfil` (`Id_p`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_personas` FOREIGN KEY (`Id_person`) REFERENCES `persona` (`id`),
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`Id_p`) REFERENCES `perfil` (`Id_p`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
