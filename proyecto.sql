-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 05-08-2024 a las 18:50:12
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
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `idEvento` int(11) DEFAULT NULL,
  `idPersona` int(11) DEFAULT NULL,
  `entrada` time DEFAULT NULL,
  `salida` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`idEvento`, `idPersona`, `entrada`, `salida`) VALUES
(1, 2019452006, NULL, NULL),
(1, 2019452006, NULL, NULL),
(1, 2019452006, NULL, NULL),
(1, 2019452006, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `idCarrera` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`idCarrera`, `nombre`) VALUES
(1, 'Ing. en Sistemas Computacionales'),
(2, 'Ingeniería en Animación Digital y Efectos Visuales'),
(3, 'Ingeniería Industrial'),
(4, 'Ingeniería Mecatronica'),
(5, 'Ingeniería Quimica'),
(6, 'Licenciatura en Administración'),
(7, 'Licenciatura en Gastronomia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadocivil`
--

CREATE TABLE `estadocivil` (
  `idEstadoCivil` int(11) NOT NULL,
  `estado` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estadocivil`
--

INSERT INTO `estadocivil` (`idEstadoCivil`, `estado`) VALUES
(1, 'Soltero(a)'),
(2, 'Casado(a)'),
(3, 'Viudo(a)'),
(4, 'Divorciado(a)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `idEvento` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `idEncargado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`idEvento`, `descripcion`, `fecha`, `idEncargado`) VALUES
(1, 'Asistencia clase quimica grupo 8usci24', '2024-07-29', 2019452006),
(2, 'culturales', '2024-07-29', 2019452006),
(3, 'culturales', '2024-07-29', 2019452006),
(4, 'Asistencia de alumnos grupo 8isc21', '2024-07-29', 2019452006);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expediente`
--

CREATE TABLE `expediente` (
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

--
-- Volcado de datos para la tabla `expediente`
--

INSERT INTO `expediente` (`idPersona`, `nss`, `vigenciaDerechos`, `tipoSangre`, `fechaNacimiento`, `direccion`, `condMedicas`, `clinica`, `idEstadoCivil`, `idCarrera`, `idTutor`) VALUES
(2021451014, '12345677', NULL, 'O+', '2002-01-11', 'calle 1, abcdx', '  Ninguna', 'Clinica 1', 1, 1, 1721516),
(2020651056, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2019452006, '07169909251', NULL, 'AB+', '1999-06-24', 'Retorno de san Andres', 'ninguno', 'imss', 1, 1, 17222347),
(2021652154, '70180341086', NULL, 'O-', '2003-11-17', 'IMSS UNIDAD DE MEDICINA FAMILIAR 83 CHICOLOAPAN', 'Ningúno', 'Clínica 83', 1, 2, 17223136),
(2022652194, NULL, NULL, 'O+', '2004-12-27', NULL, 'Ninguna', NULL, 1, 2, 17223201),
(2021112015, '66180330426', NULL, 'O-', '2003-08-21', 'Av. 5 de Mayo 84, Sta Maria Nativitas, 56335 Chimalhuacán, Méx', 'Ninguna ', 'IMMS 84', 1, 3, 17223899),
(2020652179, '66170299359', NULL, 'O+', '2002-11-04', 'Independencia S/N, Santiago, 56024 Tezoyuca, Méx', 'No', 'Unidad de Medicina Familiar No.85 IMSS', 1, 2, 17223584),
(2021652096, '11160255318', NULL, 'O+', '2002-08-17', 'Av. 5 de Mayo 84, Sta Maria Nativitas, 56335 Chimalhuacán, Méx.', 'Alergia a picaduras de insectos', '084', 1, 2, 17223314),
(2020651019, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idPersona` int(20) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apPaterno` varchar(100) DEFAULT NULL,
  `apMaterno` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `sexo` varchar(10) DEFAULT NULL,
  `idTipoPersona` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idPersona`, `nombre`, `apPaterno`, `apMaterno`, `telefono`, `correo`, `sexo`, `idTipoPersona`) VALUES
(1721516, 'Ruth Maria', 'Gutierrez', 'Ramos', '5555555555', '', '', 3),
(17222347, 'Gabriela', 'Martinez', 'Ramirez', '5579252659', '', '', 3),
(17223136, 'María Guadalupe ', 'Sánchez ', 'Flores ', '5591393124', '', '', 3),
(17223201, 'Maritza ', 'Alfaro ', 'Paez ', '5553779965', '', '', 3),
(17223314, 'Sayuri', 'Gómez', 'Zavala', '5611819259', '', '', 3),
(17223584, 'María Guadalupe ', 'Tello', 'Hernández', '5541034982', '', '', 3),
(17223899, 'Benita', 'Castro', 'Pacheco', '5574964166', '', '', 3),
(2019452006, 'Jonathan Alfredo', 'Antonio', 'Ramirez', '5588155155', 'xalfredoramirezx@gmail.com', 'M', 1),
(2020651019, '', '', '', '', 'c137monse@gmail.com', '', 1),
(2020651056, '', '', '', '', 'charlymagianike@gmail.com', '', 1),
(2020652179, 'Kennya Nicolh ', 'Vargas ', 'Tello', '5577125069', 'dianxia.hl@gmail.com', 'F', 1),
(2021112015, 'Diego Jahir ', 'Chavelas ', 'Castro', '3223604723', 'diegochavelas2003@gmail.com', 'M', 1),
(2021451014, 'Ricardo Esteban ', 'Reyes', 'Gutierrez', '5959528172', '2021451014@teschi.edu.mx', 'M', 1),
(2021652096, 'Aylyn Mayte', 'García ', 'Gómez', '5577884765', 'mayg2833@gmail.com', 'F', 1),
(2021652154, 'Cristian angel ', 'Hernández ', 'Sánchez ', '5547008162', '2021652154@teschi.edu.mx', 'M', 1),
(2022652194, 'Karen', 'Senset', 'Alfaro ', '5542272058', 'karensenset@gmail.com', 'F', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte`
--

CREATE TABLE `reporte` (
  `idReporte` int(11) NOT NULL,
  `idPersona` int(11) DEFAULT NULL,
  `idReportante` int(11) DEFAULT NULL,
  `fechaHora` datetime DEFAULT NULL,
  `comentarios` varchar(255) DEFAULT NULL,
  `ubicacion` varchar(255) DEFAULT NULL,
  `idTipoIncidente` int(11) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reporte`
--

INSERT INTO `reporte` (`idReporte`, `idPersona`, `idReportante`, `fechaHora`, `comentarios`, `ubicacion`, `idTipoIncidente`, `estado`) VALUES
(9, 2019452006, 2019452006, '2024-07-29 17:58:16', 'me cai de la moto', '19.4100915,-98.8914364', 3, 'Nuevo'),
(10, 2019452006, 2019452006, '2024-07-29 20:23:30', 'se cayo al canal', '19.4100915,-98.8914364', 3, 'Nuevo'),
(11, 2019452006, 2019452006, '2024-07-29 21:09:46', 'ayuda', '19.4100915,-98.8914364', 3, 'Nuevo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL,
  `rol` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `rol`) VALUES
(1, 'Usuario'),
(2, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoincidente`
--

CREATE TABLE `tipoincidente` (
  `idTipoIncidente` int(11) NOT NULL,
  `tipo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipoincidente`
--

INSERT INTO `tipoincidente` (`idTipoIncidente`, `tipo`) VALUES
(1, 'Medico'),
(2, 'Robo'),
(3, 'Accidente'),
(4, 'Violencia de género'),
(5, 'Amenaza natural');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopersona`
--

CREATE TABLE `tipopersona` (
  `idTipoPersona` int(11) NOT NULL,
  `tipo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipopersona`
--

INSERT INTO `tipopersona` (`idTipoPersona`, `tipo`) VALUES
(1, 'Estudiante'),
(2, 'Maestro'),
(3, 'Tutor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idPersona` int(11) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `idRol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idPersona`, `pass`, `imagen`, `idRol`) VALUES
(2021451014, '$2y$10$UB1mSqlXky9KV8rRe9rCu.7s73qSuWbzhmXSRsgx6ecLgWPK2reZW', 'assets/imgs/profilePictures/Moon.png', 2),
(2020651056, '$2y$10$MRBcFrq.V5xowZrdN2SKpuMzbNrJ14jvAbat3N7igbPMseLJB4m06', NULL, 2),
(2019452006, '$2y$10$qRKfImKrt2ruPFSYP95Ytupi1uQCSTFl7vEYvyMNEFLdUo14tnynm', 'assets/imgs/profilePictures/aaa3fab9-1212-4ae4-b6c9-0641b73462de.jpeg', 2),
(2021652154, '$2y$10$p6A.q6ZXeeFnaET.fI.hlu3NqBj/K64fkIQw4OjLCGW76LuC1/Awa', NULL, 1),
(2022652194, '$2y$10$RktEuWtplRAqKvJkaFtaAuXprhXyXvcOhL5CoFIFxf3VQFLgol8RS', NULL, 1),
(2021112015, '$2y$10$uUxybwPqD91egh5JmNUCWeUNp1rsmCAZNXyBlOuSphtz.URFwU3Bq', NULL, 1),
(2020652179, '$2y$10$1xIWokCrY./iQSTBGLRom.fiBGKqwviHZpyvVZCBPeppJ7GHpE6qy', NULL, 1),
(2021652096, '$2y$10$tI8p.7VEC/xT3GKG7L/Y3eVM8viGkQB3PpBQ7RfFSd9bcveOqBET.', NULL, 1),
(2020651019, '$2y$10$GNI/5tNmozZ0PeP7hG4iTef3A4/JxMiFxOceXR.9UxuqqSVa98oie', NULL, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD KEY `idEvento` (`idEvento`),
  ADD KEY `idPersona` (`idPersona`);

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`idCarrera`);

--
-- Indices de la tabla `estadocivil`
--
ALTER TABLE `estadocivil`
  ADD PRIMARY KEY (`idEstadoCivil`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`idEvento`),
  ADD KEY `idEncargado` (`idEncargado`);

--
-- Indices de la tabla `expediente`
--
ALTER TABLE `expediente`
  ADD KEY `idPersona` (`idPersona`),
  ADD KEY `idEstadoCivil` (`idEstadoCivil`),
  ADD KEY `idCarrera` (`idCarrera`),
  ADD KEY `idTutor` (`idTutor`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idPersona`),
  ADD KEY `idTipoPersona` (`idTipoPersona`);

--
-- Indices de la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD PRIMARY KEY (`idReporte`),
  ADD KEY `idPersona` (`idPersona`),
  ADD KEY `idReportante` (`idReportante`),
  ADD KEY `idTipoIncidente` (`idTipoIncidente`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `tipoincidente`
--
ALTER TABLE `tipoincidente`
  ADD PRIMARY KEY (`idTipoIncidente`);

--
-- Indices de la tabla `tipopersona`
--
ALTER TABLE `tipopersona`
  ADD PRIMARY KEY (`idTipoPersona`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD KEY `idPersona` (`idPersona`),
  ADD KEY `idRol` (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `idCarrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `estadocivil`
--
ALTER TABLE `estadocivil`
  MODIFY `idEstadoCivil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `idEvento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `reporte`
--
ALTER TABLE `reporte`
  MODIFY `idReporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipoincidente`
--
ALTER TABLE `tipoincidente`
  MODIFY `idTipoIncidente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipopersona`
--
ALTER TABLE `tipopersona`
  MODIFY `idTipoPersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`idEvento`) REFERENCES `evento` (`idEvento`),
  ADD CONSTRAINT `asistencia_ibfk_2` FOREIGN KEY (`idPersona`) REFERENCES `persona` (`idPersona`);

--
-- Filtros para la tabla `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `evento_ibfk_1` FOREIGN KEY (`idEncargado`) REFERENCES `persona` (`idPersona`);

--
-- Filtros para la tabla `expediente`
--
ALTER TABLE `expediente`
  ADD CONSTRAINT `expediente_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `persona` (`idPersona`),
  ADD CONSTRAINT `expediente_ibfk_2` FOREIGN KEY (`idEstadoCivil`) REFERENCES `estadocivil` (`idEstadoCivil`),
  ADD CONSTRAINT `expediente_ibfk_3` FOREIGN KEY (`idCarrera`) REFERENCES `carrera` (`idCarrera`),
  ADD CONSTRAINT `expediente_ibfk_4` FOREIGN KEY (`idTutor`) REFERENCES `persona` (`idPersona`);

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`idTipoPersona`) REFERENCES `tipopersona` (`idTipoPersona`);

--
-- Filtros para la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD CONSTRAINT `reporte_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `persona` (`idPersona`),
  ADD CONSTRAINT `reporte_ibfk_2` FOREIGN KEY (`idReportante`) REFERENCES `persona` (`idPersona`),
  ADD CONSTRAINT `reporte_ibfk_3` FOREIGN KEY (`idTipoIncidente`) REFERENCES `tipoincidente` (`idTipoIncidente`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `persona` (`idPersona`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
