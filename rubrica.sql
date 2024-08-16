-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-08-2024 a las 16:38:06
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rubrica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `id_estudiante` int(11) NOT NULL,
  `nombre_estudiante` varchar(100) NOT NULL,
  `tipoDoc` varchar(5) DEFAULT NULL,
  `cedula` int(50) NOT NULL,
  `colegio` varchar(100) DEFAULT NULL,
  `universidad` varchar(100) DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `anioGrado` int(11) DEFAULT NULL,
  `ICFES` int(10) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `estudioAdicional` varchar(10) DEFAULT NULL,
  `correo` varchar(100) NOT NULL,
  `programa_id_programa` int(10) NOT NULL,
  `obsMadre` varchar(255) DEFAULT NULL,
  `obsPadre` varchar(255) DEFAULT NULL,
  `trabaja` varchar(5) DEFAULT NULL,
  `lugarTrabajo` int(100) DEFAULT NULL,
  `fecha_creado` datetime DEFAULT current_timestamp(),
  `fecha_actualizacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`id_estudiante`, `nombre_estudiante`, `tipoDoc`, `cedula`, `colegio`, `universidad`, `titulo`, `anioGrado`, `ICFES`, `ciudad`, `estudioAdicional`, `correo`, `programa_id_programa`, `obsMadre`, `obsPadre`, `trabaja`, `lugarTrabajo`, `fecha_creado`, `fecha_actualizacion`) VALUES
(1, 'javier pruebas', 'CC', 1223334444, 'Colegio de la ciudad', '', '', 0, 351, 'Bogotá', '', '', 0, '36', 'A nada', 'A nad', 0, '2024-08-12 11:08:01', '2024-08-12 11:08:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `id_login` int(10) NOT NULL,
  `tipo_documento` varchar(30) CHARACTER SET utf8 NOT NULL,
  `num_documento` int(30) NOT NULL,
  `nombre_login` varchar(100) CHARACTER SET utf8 NOT NULL,
  `login_id_tipo` int(2) NOT NULL DEFAULT 2,
  `correo` varchar(100) CHARACTER SET utf8 NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 NOT NULL,
  `facultad_nombre` varchar(30) NOT NULL,
  `terminos_condiciones` int(2) NOT NULL,
  `fecha_creo_login` datetime NOT NULL,
  `fecha_actualizacion_login` datetime NOT NULL,
  `fecha_ultimo_ingreso` datetime NOT NULL,
  `activo_login` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa`
--

CREATE TABLE `programa` (
  `id_programa` int(11) NOT NULL,
  `codigo_programa` int(11) NOT NULL,
  `nombre_programa` varchar(250) NOT NULL,
  `facultad_id_facultad` int(11) NOT NULL,
  `modalidad_id_modalidad` int(11) NOT NULL,
  `activo_programa` tinyint(1) NOT NULL DEFAULT 1,
  `tipo_programa` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `programa`
--

INSERT INTO `programa` (`id_programa`, `codigo_programa`, `nombre_programa`, `facultad_id_facultad`, `modalidad_id_modalidad`, `activo_programa`, `tipo_programa`) VALUES
(1, 2007, 'ESPECIALIZACIÓN EN ENFERMERÍA EN CUIDADO CRITICO DEL ADULTO', 1, 2, 1, 4),
(2, 2009, 'ESPECIALIZACIÓN EN CUIDADO DE ENFERMERÍA EN URGENCIAS', 1, 2, 1, 4),
(3, 2004, 'ESPECIALIZACIÓN EN ENFERMERÍA  NEFROLÓGICA DEL ADULTO', 1, 2, 1, 4),
(4, 2000, 'ENFERMERÍA', 1, 6, 1, 3),
(5, 5003, 'ESPECIALIZACIÓN EN GERENCIA DE LA SALUD (VIRTUAL)', 7, 7, 1, 4),
(6, 6002, 'TÉCNICO PROFESIONAL EN PROCESOS ADMINISTRATIVOS EN SALUD', 7, 6, 1, 1),
(7, 6003, 'TECNOLOGÍA EN GESTIÓN DE INFORMACIÓN EN SALUD', 7, 6, 1, 2),
(8, 6004, 'ADMINISTRACIÓN DE SERVICIOS DE SALUD', 7, 6, 1, 3),
(9, 6000, 'PSICOLOGÍA', 5, 6, 1, 3),
(10, 5000, 'ADMINISTRACIÓN DE EMPRESAS', 7, 6, 0, 0),
(11, 5002, 'ESPECIALIZACIÓN EN DOCENCIA UNIVERSITARIA', 5, 2, 1, 4),
(12, 6005, 'MAESTRÍA EN EDUCACIÓN Y DESARROLLO SOCIAL', 5, 5, 1, 4),
(13, 6006, 'ESPECIALIZACIÓN EN GERENCIA EN MERCADEO DE SERVICIOS DE SALUD (VIRTUAL)', 7, 7, 1, 4),
(14, 5001, 'ESPECIALIZACIÓN EN GERENCIA DE ORGANIZACIONES DE SALUD', 7, 2, 1, 4),
(15, 3000, 'INSTRUMENTACIÓN QUIRÚRGICA', 4, 6, 1, 3),
(25, 1700, 'FISIOTERAPIA', 6, 6, 1, 3),
(34, 1134, 'MAESTRÍA EN EPIDEMIOLOGÍA CLÍNICA', 3, 5, 1, 4),
(35, 6007, 'MAESTRÍA EN FARMACOLOGÍA CLÍNICA', 3, 5, 1, 4),
(36, 1000, 'MEDICINA', 3, 6, 1, 3),
(65, 1150, 'PREUNIVERSITARIO', 3, 1, 1, 1),
(72, 1500, 'TECNOLOGÍA EN ATENCIÓN PREHOSPITALARIA DIURNA', 2, 6, 1, 2),
(73, 4000, 'TECNOLOGÍA EN CITOHISTOLOGÍA', 2, 6, 1, 2),
(75, 0, 'ESPECIALIZACIÓN EN GERENCIA DE LA CALIDAD Y GESTIÓN CLÍNICA (VIRTUAL)', 7, 7, 1, 4),
(79, 0, 'NUTRICIÓN Y DIETÉTICA', 3, 6, 1, 3),
(80, 0, 'TECNOLOGÍA EN RADIOLOGÍA E IMÁGENES DIAGNÓSTICAS', 2, 6, 1, 2),
(83, 0, 'ESPECIALIZACIÓN EN ENFERMERÍA ONCOLÓGICA', 1, 2, 1, 4),
(84, 0, 'ESPECIALIZACIÓN EN PERFUSIÓN Y CIRCULACIÓN EXTRACORPÓREA', 1, 2, 1, 4),
(89, 6016, 'TECNOLOGÍA EN REGENCIA DE FARMACIA', 7, 6, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `activo` int(1) DEFAULT 1 COMMENT '1=Activo | 0=Inactivo',
  `usuarioCreo` varchar(100) DEFAULT NULL,
  `fechaActualizo` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rubrica`
--

CREATE TABLE `rubrica` (
  `id` int(11) NOT NULL,
  `id_estudiante` int(10) NOT NULL,
  `documentoEstudiante` int(20) NOT NULL,
  `puntajeICFES` int(5) NOT NULL,
  `historiaAcademica` tinyint(1) NOT NULL,
  `aspectosVocacionales` tinyint(1) NOT NULL,
  `conocimientoFUCS` tinyint(1) NOT NULL,
  `inAcGenerales` tinyint(1) NOT NULL,
  `expOralComprension` tinyint(1) NOT NULL,
  `comportamiento` tinyint(1) NOT NULL,
  `observacion` varchar(255) DEFAULT NULL,
  `calificaICFES` int(11) DEFAULT NULL,
  `totalEntre` float(3,1) DEFAULT NULL,
  `totalAdmision` float(3,1) DEFAULT NULL,
  `creoEntrevista` varchar(100) DEFAULT NULL,
  `fechaEntrevista` datetime NOT NULL,
  `fechaActualizacion` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoprograma`
--

CREATE TABLE `tipoprograma` (
  `idTipoProg` int(10) NOT NULL,
  `nombreTipoProg` varchar(100) NOT NULL,
  `activoTipoProg` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipoprograma`
--

INSERT INTO `tipoprograma` (`idTipoProg`, `nombreTipoProg`, `activoTipoProg`) VALUES
(1, 'TÉCNICO', 1),
(2, 'TECNÓLOGO', 1),
(3, 'PROFESIONAL', 1),
(4, 'POSGRADO', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`id_estudiante`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`),
  ADD UNIQUE KEY `documento_login` (`num_documento`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `fk_login_id_tipo` (`login_id_tipo`);

--
-- Indices de la tabla `programa`
--
ALTER TABLE `programa`
  ADD PRIMARY KEY (`id_programa`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rubrica`
--
ALTER TABLE `rubrica`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_estudiante` (`id_estudiante`);

--
-- Indices de la tabla `tipoprograma`
--
ALTER TABLE `tipoprograma`
  ADD PRIMARY KEY (`idTipoProg`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `id_estudiante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `programa`
--
ALTER TABLE `programa`
  MODIFY `id_programa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rubrica`
--
ALTER TABLE `rubrica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipoprograma`
--
ALTER TABLE `tipoprograma`
  MODIFY `idTipoProg` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `rubrica`
--
ALTER TABLE `rubrica`
  ADD CONSTRAINT `fk_id_estudiante` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiante` (`id_estudiante`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
