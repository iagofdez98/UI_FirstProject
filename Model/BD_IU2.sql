-- jrodeiro - 7/10/2017
-- script de creación de la bd, usuario, asignación de privilegios a ese usuario sobre la bd
-- creación de tabla e insert sobre la misma.
--
-- CREAR LA BD BORRANDOLA SI YA EXISTIESE
--
DROP DATABASE IF EXISTS `IU2018`;
CREATE DATABASE `IU2018` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
--
-- SELECCIONAMOS PARA USAR
--
USE `IU2018`;
--
-- DAMOS PERMISO USO Y BORRAMOS EL USUARIO QUE QUEREMOS CREAR POR SI EXISTE
--
GRANT USAGE ON * . * TO `iu2018`@`localhost`;
	DROP USER `iu2018`@`localhost`;
--
-- CREAMOS EL USUARIO Y LE DAMOS PASSWORD,DAMOS PERMISO DE USO Y DAMOS PERMISOS SOBRE LA BASE DE DATOS.
--
CREATE USER IF NOT EXISTS `iu2018`@`localhost` IDENTIFIED BY 'pass2018';
GRANT USAGE ON *.* TO `iu2018`@`localhost` REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
GRANT ALL PRIVILEGES ON `IU2018`.* TO `iu2018`@`localhost` WITH GRANT OPTION;

--
-- Estructura de tabla para la tabla `CENTRO`
--

CREATE TABLE `CENTRO` (
  `CODCENTRO` varchar(10) NOT NULL,
  `CODEDIFICIO` varchar(10) NOT NULL,
  `NOMBRECENTRO` varchar(50) NOT NULL,
  `DIRECCIONCENTRO` varchar(150) NOT NULL,
  `RESPONSABLECENTRO` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EDIFICIO`
--

CREATE TABLE `EDIFICIO` (
  `CODEDIFICIO` varchar(10) NOT NULL,
  `NOMBREEDIFICIO` varchar(50) NOT NULL,
  `DIRECCIONEDIFICIO` varchar(150) NOT NULL,
  `CAMPUSEDIFICIO` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ESPACIO`
--

CREATE TABLE `ESPACIO` (
  `CODESPACIO` varchar(10) NOT NULL,
  `CODEDIFICIO` varchar(10) NOT NULL,
  `CODCENTRO` varchar(10) NOT NULL,
  `TIPO` enum('DESPACHO','LABORATORIO','PAS') NOT NULL,
  `SUPERFICIEESPACIO` int(4) NOT NULL,
  `NUMINVENTARIOESPACIO` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PROFESOR`
--

CREATE TABLE `PROFESOR` (
  `DNI` varchar(9) NOT NULL,
  `NOMBREPROFESOR` varchar(15) NOT NULL,
  `APELLIDOSPROFESOR` varchar(30) NOT NULL,
  `AREAPROFESOR` varchar(60) NOT NULL,
  `DEPARTAMENTOPROFESOR` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PROF_ESPACIO`
--

CREATE TABLE `PROF_ESPACIO` (
  `DNI` varchar(9) NOT NULL,
  `CODESPACIO` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PROF_TITULACION`
--

CREATE TABLE `PROF_TITULACION` (
  `DNI` varchar(9) NOT NULL,
  `CODTITULACION` varchar(10) NOT NULL,
  `ANHOACADEMICO` varchar(9) NOT NULL DEFAULT '2019-2020'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TITULACION`
--

CREATE TABLE `TITULACION` (
  `CODTITULACION` varchar(10) NOT NULL,
  `CODCENTRO` varchar(10) NOT NULL,
  `NOMBRETITULACION` varchar(50) NOT NULL,
  `RESPONSABLETITULACION` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIOS`
--

CREATE TABLE `USUARIOS` (
  `login` varchar(15) NOT NULL,
  `password` varchar(128) NOT NULL,
  `DNI` varchar(9) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `fotopersonal` varchar(50) NOT NULL,
  `sexo` enum('hombre','mujer') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `CENTRO`
--
ALTER TABLE `CENTRO`
  ADD PRIMARY KEY (`CODCENTRO`),
  ADD KEY `CODEDIFICIO` (`CODEDIFICIO`);

--
-- Indices de la tabla `EDIFICIO`
--
ALTER TABLE `EDIFICIO`
  ADD PRIMARY KEY (`CODEDIFICIO`);

--
-- Indices de la tabla `ESPACIO`
--
ALTER TABLE `ESPACIO`
  ADD PRIMARY KEY (`CODESPACIO`);

--
-- Indices de la tabla `PROFESOR`
--
ALTER TABLE `PROFESOR`
  ADD PRIMARY KEY (`DNI`);

--
-- Indices de la tabla `PROF_ESPACIO`
--
ALTER TABLE `PROF_ESPACIO`
  ADD PRIMARY KEY (`DNI`,`CODESPACIO`);

--
-- Indices de la tabla `PROF_TITULACION`
--
ALTER TABLE `PROF_TITULACION`
  ADD PRIMARY KEY (`DNI`,`CODTITULACION`);

--
-- Indices de la tabla `TITULACION`
--
ALTER TABLE `TITULACION`
  ADD PRIMARY KEY (`CODTITULACION`);

--
-- Indices de la tabla `USUARIOS`
--
ALTER TABLE `USUARIOS`
  ADD PRIMARY KEY (`login`),
  ADD UNIQUE KEY `DNI` (`DNI`),
  ADD UNIQUE KEY `email` (`email`);