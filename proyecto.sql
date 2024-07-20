-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 20-07-2024 a las 03:36:44
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Asistencia`
--

CREATE TABLE `Asistencia` (
  `idEvento` int(11) DEFAULT NULL,
  `idPersona` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Carrera`
--

CREATE TABLE `Carrera` (
  `idCarrera` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EstadoCivil`
--

CREATE TABLE `EstadoCivil` (
  `idEstadoCivil` int(11) NOT NULL,
  `estado` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Evento`
--

CREATE TABLE `Evento` (
  `idEvento` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `idEncargado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Expediente`
--

CREATE TABLE `Expediente` (
  `idPersona` int(11) DEFAULT NULL,
  `nss` varchar(100) DEFAULT NULL,
  `vigenciaDerechos` varchar(100) DEFAULT NULL,
  `tipoSangre` varchar(100) DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `condMedicas` varchar(255) DEFAULT NULL,
  `clinica` varchar(100) DEFAULT NULL,
  `idEstadoCivil` int(11) DEFAULT NULL,
  `idCarrera` int(11) DEFAULT NULL,
  `idTutor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Persona`
--

CREATE TABLE `Persona` (
  `idPersona` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apPaterno` varchar(100) DEFAULT NULL,
  `apMaterno` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `sexo` varchar(10) DEFAULT NULL,
  `idTipoPersona` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Reporte`
--

CREATE TABLE `Reporte` (
  `idReporte` int(11) NOT NULL,
  `idPersona` int(11) DEFAULT NULL,
  `idReportante` int(11) DEFAULT NULL,
  `fechaHora` datetime DEFAULT NULL,
  `comentarios` varchar(255) DEFAULT NULL,
  `ubicacion` varchar(255) DEFAULT NULL,
  `idTipoIncidente` int(11) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Rol`
--

CREATE TABLE `Rol` (
  `idRol` int(11) NOT NULL,
  `rol` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TipoIncidente`
--

CREATE TABLE `TipoIncidente` (
  `idTipoIncidente` int(11) NOT NULL,
  `tipo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TipoPersona`
--

CREATE TABLE `TipoPersona` (
  `idTipoPersona` int(11) NOT NULL,
  `tipo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE `Usuario` (
  `idPersona` int(11) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `idRol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Asistencia`
--
ALTER TABLE `Asistencia`
  ADD KEY `idEvento` (`idEvento`),
  ADD KEY `idPersona` (`idPersona`);

--
-- Indices de la tabla `Carrera`
--
ALTER TABLE `Carrera`
  ADD PRIMARY KEY (`idCarrera`);

--
-- Indices de la tabla `EstadoCivil`
--
ALTER TABLE `EstadoCivil`
  ADD PRIMARY KEY (`idEstadoCivil`);

--
-- Indices de la tabla `Evento`
--
ALTER TABLE `Evento`
  ADD PRIMARY KEY (`idEvento`),
  ADD KEY `idEncargado` (`idEncargado`);

--
-- Indices de la tabla `Expediente`
--
ALTER TABLE `Expediente`
  ADD KEY `idPersona` (`idPersona`),
  ADD KEY `idEstadoCivil` (`idEstadoCivil`),
  ADD KEY `idCarrera` (`idCarrera`),
  ADD KEY `idTutor` (`idTutor`);

--
-- Indices de la tabla `Persona`
--
ALTER TABLE `Persona`
  ADD PRIMARY KEY (`idPersona`),
  ADD KEY `idTipoPersona` (`idTipoPersona`);

--
-- Indices de la tabla `Reporte`
--
ALTER TABLE `Reporte`
  ADD PRIMARY KEY (`idReporte`),
  ADD KEY `idPersona` (`idPersona`),
  ADD KEY `idReportante` (`idReportante`),
  ADD KEY `idTipoIncidente` (`idTipoIncidente`);

--
-- Indices de la tabla `Rol`
--
ALTER TABLE `Rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `TipoIncidente`
--
ALTER TABLE `TipoIncidente`
  ADD PRIMARY KEY (`idTipoIncidente`);

--
-- Indices de la tabla `TipoPersona`
--
ALTER TABLE `TipoPersona`
  ADD PRIMARY KEY (`idTipoPersona`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD KEY `idPersona` (`idPersona`),
  ADD KEY `idRol` (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Carrera`
--
ALTER TABLE `Carrera`
  MODIFY `idCarrera` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `EstadoCivil`
--
ALTER TABLE `EstadoCivil`
  MODIFY `idEstadoCivil` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Evento`
--
ALTER TABLE `Evento`
  MODIFY `idEvento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Reporte`
--
ALTER TABLE `Reporte`
  MODIFY `idReporte` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Rol`
--
ALTER TABLE `Rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `TipoIncidente`
--
ALTER TABLE `TipoIncidente`
  MODIFY `idTipoIncidente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `TipoPersona`
--
ALTER TABLE `TipoPersona`
  MODIFY `idTipoPersona` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Asistencia`
--
ALTER TABLE `Asistencia`
  ADD CONSTRAINT `Asistencia_ibfk_1` FOREIGN KEY (`idEvento`) REFERENCES `Evento` (`idEvento`),
  ADD CONSTRAINT `Asistencia_ibfk_2` FOREIGN KEY (`idPersona`) REFERENCES `Persona` (`idPersona`);

--
-- Filtros para la tabla `Evento`
--
ALTER TABLE `Evento`
  ADD CONSTRAINT `Evento_ibfk_1` FOREIGN KEY (`idEncargado`) REFERENCES `Persona` (`idPersona`);

--
-- Filtros para la tabla `Expediente`
--
ALTER TABLE `Expediente`
  ADD CONSTRAINT `Expediente_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `Persona` (`idPersona`),
  ADD CONSTRAINT `Expediente_ibfk_2` FOREIGN KEY (`idEstadoCivil`) REFERENCES `EstadoCivil` (`idEstadoCivil`),
  ADD CONSTRAINT `Expediente_ibfk_3` FOREIGN KEY (`idCarrera`) REFERENCES `Carrera` (`idCarrera`),
  ADD CONSTRAINT `Expediente_ibfk_4` FOREIGN KEY (`idTutor`) REFERENCES `Persona` (`idPersona`);

--
-- Filtros para la tabla `Persona`
--
ALTER TABLE `Persona`
  ADD CONSTRAINT `Persona_ibfk_1` FOREIGN KEY (`idTipoPersona`) REFERENCES `TipoPersona` (`idTipoPersona`);

--
-- Filtros para la tabla `Reporte`
--
ALTER TABLE `Reporte`
  ADD CONSTRAINT `Reporte_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `Persona` (`idPersona`),
  ADD CONSTRAINT `Reporte_ibfk_2` FOREIGN KEY (`idReportante`) REFERENCES `Persona` (`idPersona`),
  ADD CONSTRAINT `Reporte_ibfk_3` FOREIGN KEY (`idTipoIncidente`) REFERENCES `TipoIncidente` (`idTipoIncidente`);

--
-- Filtros para la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD CONSTRAINT `Usuario_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `Persona` (`idPersona`),
  ADD CONSTRAINT `Usuario_ibfk_2` FOREIGN KEY (`idRol`) REFERENCES `Rol` (`idRol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
