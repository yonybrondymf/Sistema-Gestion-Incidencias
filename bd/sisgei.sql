-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-08-2018 a las 22:11:46
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `appincidencias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `casos`
--

CREATE TABLE `casos` (
  `id` int(11) NOT NULL,
  `proyecto_id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `estado` int(11) NOT NULL,
  `fecejecucion` datetime DEFAULT NULL,
  `ciclo` int(11) NOT NULL,
  `precondicion` text NOT NULL,
  `resultado` text NOT NULL,
  `fecregistro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `casos`
--

INSERT INTO `casos` (`id`, `proyecto_id`, `nombre`, `estado`, `fecejecucion`, `ciclo`, `precondicion`, `resultado`, `fecregistro`) VALUES
(28, 1, 'Comprobar registro de Ventas', 3, '2018-08-08 08:12:23', 1, 'Iniciar Session', 'Ver registros de ventas', '2018-08-08 08:01:19'),
(29, 1, 'Comprobar impresion de detalle de venta', 3, '2018-08-08 16:25:40', 1, 'Ingresa al formulario de ventas', 'visualizar el detalle de la venta', '2018-08-08 08:11:35'),
(30, 1, 'Comprobar registro de clientes', 3, '2018-08-08 16:35:16', 1, 'Estar en el modulo de clientes', 'Formulario de regisrtro de clientes con exito', '2018-08-08 08:15:49'),
(31, 1, 'Caso 01', 1, '2018-08-08 16:34:31', 1, 'estar logueado', 'este es el resultado  de estes caso', '2018-08-08 16:27:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuraciones`
--

CREATE TABLE `configuraciones` (
  `id` int(11) NOT NULL,
  `dias` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `configuraciones`
--

INSERT INTO `configuraciones` (`id`, `dias`) VALUES
(1, '10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_casos`
--

CREATE TABLE `estados_casos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estados_casos`
--

INSERT INTO `estados_casos` (`id`, `descripcion`, `estado`) VALUES
(1, 'Fallido', 1),
(2, 'No ejecutado', 1),
(3, 'Exitoso', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_incidencias`
--

CREATE TABLE `estados_incidencias` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estados_incidencias`
--

INSERT INTO `estados_incidencias` (`id`, `descripcion`, `estado`) VALUES
(1, 'Asignado', 1),
(2, 'Fallido', 1),
(3, 'Exitoso', 1),
(4, 'Resuelto', 1),
(15, 'Otro', 0),
(16, 'ogtro', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_casos`
--

CREATE TABLE `historial_casos` (
  `id` int(11) NOT NULL,
  `caso_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `estado_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historial_casos`
--

INSERT INTO `historial_casos` (`id`, `caso_id`, `usuario_id`, `fecha`, `estado_id`) VALUES
(127, 28, 5, '2018-08-07 08:01:19', 2),
(128, 29, 5, '2018-08-08 08:11:35', 2),
(129, 28, 5, '2018-08-08 08:12:22', 3),
(130, 30, 5, '2018-08-08 08:15:50', 2),
(131, 30, 5, '2018-08-08 08:16:18', 1),
(132, 29, 5, '2018-08-08 08:17:58', 3),
(133, 29, 5, '2018-08-08 15:04:36', 1),
(134, 29, 5, '2018-08-08 16:25:40', 3),
(135, 31, 5, '2018-08-08 16:27:00', 2),
(136, 31, 5, '2018-08-08 16:34:30', 1),
(137, 30, 5, '2018-08-08 16:35:16', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_incidencias`
--

CREATE TABLE `historial_incidencias` (
  `id` int(11) NOT NULL,
  `incidencia_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historial_incidencias`
--

INSERT INTO `historial_incidencias` (`id`, `incidencia_id`, `fecha`, `usuario_id`, `comentario`, `estado`) VALUES
(17, 15, '2018-07-25 06:10:28', 2, 'error el paso 4', 1),
(18, 16, '2018-07-25 07:23:18', 2, 'Comentario 1', 1),
(19, 17, '2018-07-27 20:32:00', 2, 'Soluciunar el problema', 1),
(20, 18, '2018-07-27 21:16:01', 2, 'Espero q solucionen el problema', 1),
(21, 19, '2018-07-27 21:17:21', 2, 'Espero q solucionen el problema', 1),
(22, 20, '2018-07-27 21:52:55', 2, 'Resolver esta inicidencia', 1),
(23, 21, '2018-08-02 06:32:06', 2, 'Nueva incidencia generado de noche', 1),
(24, 22, '2018-08-02 15:39:45', 2, 'Revisar esta incidencia de inmediato', 1),
(25, 23, '2018-08-08 08:16:45', 2, 'Soluciuonar esta indicencia', 2),
(26, 24, '2018-08-08 15:05:07', 2, 'Resolver esta incidencia', 1),
(27, 25, '2018-08-08 16:35:05', 2, 'Resolver este incidencia', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--

CREATE TABLE `incidencias` (
  `id` int(11) NOT NULL,
  `resumen` text NOT NULL,
  `prioridad` int(11) NOT NULL,
  `reproducibilidad` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `adjunto` text NOT NULL,
  `ciclo` int(11) NOT NULL,
  `asignado` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `comentario` text NOT NULL,
  `fecregistro` datetime NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `caso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `incidencias`
--

INSERT INTO `incidencias` (`id`, `resumen`, `prioridad`, `reproducibilidad`, `estado`, `email`, `adjunto`, `ciclo`, `asignado`, `descripcion`, `comentario`, `fecregistro`, `usuario_id`, `caso`) VALUES
(15, 'Registro de clientes', 1, 2, 1, 'yonybrondy17@gmail.com', '', 1, 1, '<p>Acceder al sistema</p><img src=\"http://localhost/appincidencias/assets/images/pasos/mockup_registro_caso.png\" class=\"img-responsive\"><p>Ir modulo de ventas</p><img src=\"http://localhost/appincidencias/assets/images/pasos/avatar04.png\" class=\"img-responsive\">', 'error el paso 4', '2018-07-25 06:10:28', 1, 7),
(16, 'Registro de clientes', 1, 1, 1, 'yonybrondy17@gmail.com', '', 1, 1, '<p>Acceder al sistema</p><img src=\"http://localhost/appincidencias/assets/images/pasos/mockup_registro_caso.png\" class=\"img-responsive\"><p>Ir modulo de ventas</p><img src=\"http://localhost/appincidencias/assets/images/pasos/avatar04.png\" class=\"img-responsive\">', 'Comentario 1', '2018-07-25 07:23:18', 1, 7),
(17, 'Error 404 cuando intento entrar al formulario de ventas', 1, 2, 1, 'yonybrondy17@gmail.com', '', 1, 1, 'me sale mensaje de error', 'Soluciunar el problema', '2018-07-27 20:32:00', 1, 8),
(18, 'Error 505 en agregar nueva venta', 1, 1, 1, 'yonybrondy17@gmail.com', '', 1, 1, 'Sale mensaje de error 505', 'Espero q solucionen el problema', '2018-07-27 21:16:01', 1, 2),
(19, 'Error 505 en agregar nueva venta', 1, 1, 1, 'yonybrondy17@gmail.com', '', 1, 1, 'Sale mensaje de error 505', 'Espero q solucionen el problema', '2018-07-27 21:17:21', 1, 2),
(20, 'Abrir formulario de ventas', 1, 1, 3, 'luis@hotmail.com', '', 1, 4, '<p>desplegar el menu ejecucion</p><img src=\"http://localhost/appincidencias/assets/images/pasos/avatar1.png\" class=\"img-responsive\"><p>Dar click en el boton Agregar Incidencia</p><img src=\"http://localhost/appincidencias/assets/images/pasos/photo1.png\" class=\"img-responsive\">', 'Resolver esta inicidencia', '2018-07-27 21:52:55', 1, 10),
(21, 'Abrir formulario de ventas', 1, 1, 1, 'luis@hotmail.com', '', 1, 4, '<p>1.desplegar el menu ejecucion</p><img src=\"http://localhost/appincidencias/assets/images/pasos/avatar1.png\" class=\"img-responsive\"><p>2.Dar click en el boton Agregar Incidencia</p><img src=\"http://localhost/appincidencias/assets/images/pasos/photo1.png\" class=\"img-responsive\">', 'Nueva incidencia generado de noche', '2018-08-02 06:32:06', 1, 10),
(22, 'Abrir formulario de ventas', 1, 1, 1, 'yonybrondy17@gmail.com', '', 2, 1, '<p>1.desplegar el menu ejecucion</p><img src=\"http://localhost/appincidencias/assets/images/pasos/avatar1.png\" class=\"img-responsive\"><p>2.Dar click en el boton Agregar Incidencia</p><img src=\"http://localhost/appincidencias/assets/images/pasos/photo1.png\" class=\"img-responsive\">', 'Revisar esta incidencia de inmediato', '2018-08-02 15:39:45', 5, 10),
(23, 'Comprobar registro de clientes', 1, 1, 2, 'luis@hotmail.com', '', 1, 4, '<p>1.acceder al sistema</p><img src=\"http://localhost/appincidencias/assets/images/pasos/Koala.jpg\" class=\"img-responsive\"><p>2.Ir al modulo de clientes</p><img src=\"http://localhost/appincidencias/assets/images/pasos/Lighthouse.jpg\" class=\"img-responsive\">', 'Soluciuonar esta indicencia', '2018-08-08 08:16:45', 5, 30),
(24, 'Comprobar impresion de detalle de venta', 1, 2, 1, 'yonybrondy17@gmail.com', '', 1, 1, '<p>1.Acceder al modulo de ventas</p><img src=\"http://localhost/appincidencias/assets/images/pasos/Hydrangeas1.jpg\" class=\"img-responsive\"><p>2.Acceder ala vista del formaulario de ventas</p><img src=\"http://localhost/appincidencias/assets/images/pasos/Penguins1.jpg\" class=\"img-responsive\">', 'Resolver esta incidencia', '2018-08-08 15:05:07', 5, 29),
(25, 'Caso 01', 1, 1, 1, 'yonybrondy17@gmail.com', '', 1, 1, '<p>1.paso 01</p><img src=\"http://localhost/appincidencias/assets/images/pasos/Jellyfish.jpg\" class=\"img-responsive\"><p>2.paso 02</p><img src=\"http://localhost/appincidencias/assets/images/pasos/Koala1.jpg\" class=\"img-responsive\">', 'Resolver este incidencia', '2018-08-08 16:35:05', 5, 31);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `link` varchar(250) NOT NULL,
  `parent` int(11) NOT NULL,
  `orden` int(11) NOT NULL,
  `icono` varchar(150) NOT NULL,
  `leer` int(11) NOT NULL,
  `insertar` int(11) NOT NULL,
  `editar` int(11) NOT NULL,
  `eliminar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`id`, `nombre`, `link`, `parent`, `orden`, `icono`, `leer`, `insertar`, `editar`, `eliminar`) VALUES
(1, 'Inicio', 'backend/dashboard', 0, 1, 'fa fa-home', 1, 0, 0, 0),
(2, 'Incidencias', '	\r\nbackend/incidencias', 0, 2, 'fa fa-home', 1, 1, 1, 0),
(3, 'Ejecucion', '#', 0, 3, 'fa fa-home', 1, 0, 0, 0),
(4, 'Registrar Caso', 'ejecucion/registrarCaso', 3, 0, '', 1, 0, 0, 0),
(5, 'Ejecutar', 'ejecucion/casos', 3, 0, '', 1, 0, 1, 0),
(6, 'Seguimientos', '	\r\nbackend/seguimientos', 0, 4, 'fa fa-home', 1, 0, 0, 0),
(7, 'Avances', '	\r\nbackend/avances', 0, 5, 'fa fa-home', 1, 0, 0, 0),
(8, 'Informes', '	\r\nbackend/informes', 0, 6, 'fa fa-home', 1, 0, 0, 0),
(9, 'Configuraciones', '#', 0, 7, 'fa fa-home', 1, 0, 0, 0),
(10, 'Estados incidencias', 'configuraciones/estadosincidencias', 9, 0, '', 1, 1, 1, 1),
(11, 'Usuarios', 'configuraciones/usuarios', 9, 0, '', 1, 1, 1, 1),
(12, 'Dias Solucion', 'configuraciones/dias-solucion', 9, 0, '', 1, 0, 0, 0),
(13, 'Estados Casos', 'configuraciones/estadoscasos', 9, 0, '', 1, 1, 1, 1),
(14, 'Proyectos', 'configuraciones/proyectos', 9, 0, '', 1, 1, 1, 1),
(15, 'Permisos', 'configuraciones/permisos', 9, 0, '', 1, 1, 1, 1),
(16, 'Carga Masiva', 'ejecucion/carga', 3, 0, '', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pasos`
--

CREATE TABLE `pasos` (
  `id` int(11) NOT NULL,
  `imagen` text NOT NULL,
  `caso` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `titulo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pasos`
--

INSERT INTO `pasos` (`id`, `imagen`, `caso`, `fecha`, `titulo`) VALUES
(1, 'avatar21.png', 6, '2018-07-24 17:13:56', 'iniciar sesion'),
(2, 'avatar3.png', 6, '2018-07-24 17:13:56', 'Modulo de Comprobantes'),
(3, 'mockup_registro_caso.png', 7, '2018-07-24 20:31:15', 'Acceder al sistema'),
(4, 'avatar04.png', 7, '2018-07-24 20:31:15', 'Ir modulo de ventas'),
(5, 'avatar.png', 9, '2018-07-27 06:12:57', 'Dar click en menu Incidencias'),
(6, 'photo2.png', 9, '2018-07-27 06:12:57', 'Dar click en el boton Agregar Incidencia'),
(7, 'avatar1.png', 10, '2018-07-27 21:22:01', 'desplegar el menu ejecucion'),
(8, 'photo1.png', 10, '2018-07-27 21:22:01', 'Dar click en el boton Agregar Incidencia'),
(9, '', 27, '2018-08-04 16:10:04', 'Identificar el caso '),
(10, '', 27, '2018-08-04 16:10:04', 'Analizar el caso'),
(11, '', 27, '2018-08-04 16:10:04', 'Resolver el Caso'),
(12, 'Hydrangeas.jpg', 28, '2018-08-08 08:01:19', 'Modulo de Ventas'),
(13, 'Penguins.jpg', 28, '2018-08-08 08:01:19', 'Hacer click en el boton agregar venta'),
(14, 'Hydrangeas1.jpg', 29, '2018-08-08 08:11:35', 'Acceder al modulo de ventas'),
(15, 'Penguins1.jpg', 29, '2018-08-08 08:11:35', 'Acceder ala vista del formaulario de ventas'),
(16, 'Koala.jpg', 30, '2018-08-08 08:15:49', 'acceder al sistema'),
(17, 'Lighthouse.jpg', 30, '2018-08-08 08:15:50', 'Ir al modulo de clientes'),
(18, 'Jellyfish.jpg', 31, '2018-08-08 16:27:00', 'paso 01'),
(19, 'Koala1.jpg', 31, '2018-08-08 16:27:00', 'paso 02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `read` int(11) DEFAULT NULL,
  `insert` int(11) DEFAULT NULL,
  `update` int(11) DEFAULT NULL,
  `delete` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `menu_id`, `rol_id`, `read`, `insert`, `update`, `delete`) VALUES
(1, 1, 2, 1, NULL, NULL, NULL),
(2, 2, 2, 1, 1, 1, 0),
(3, 3, 2, 1, NULL, NULL, NULL),
(4, 4, 2, 1, NULL, NULL, NULL),
(5, 5, 2, 1, 0, 1, 0),
(6, 6, 2, 1, NULL, NULL, NULL),
(7, 7, 2, 1, NULL, NULL, NULL),
(8, 8, 2, 1, 0, 0, 0),
(10, 1, 3, 1, NULL, NULL, NULL),
(11, 2, 3, 1, 1, 1, NULL),
(12, 3, 3, 1, NULL, NULL, NULL),
(13, 4, 3, 1, NULL, NULL, NULL),
(14, 5, 3, 1, 0, 1, 0),
(15, 6, 3, 1, NULL, NULL, NULL),
(16, 7, 3, 1, NULL, NULL, NULL),
(17, 8, 3, 1, NULL, NULL, NULL),
(18, 9, 3, 1, NULL, NULL, NULL),
(19, 10, 3, 1, 1, 1, 1),
(20, 11, 3, 1, 1, 1, 1),
(21, 12, 3, 1, NULL, NULL, NULL),
(22, 14, 3, 1, 1, 1, 1),
(23, 15, 3, 1, 1, 1, 1),
(24, 13, 3, 1, 1, 1, 1),
(25, 1, 1, 1, NULL, NULL, NULL),
(26, 16, 3, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecregistro` datetime NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id`, `nombre`, `usuario_id`, `fecregistro`, `estado`) VALUES
(1, 'Sistema de Ventas', 4, '2018-07-10 17:46:19', 1),
(2, 'Sistema de Almacen', 1, '2018-07-10 17:15:31', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'Analista'),
(2, 'Desarrollador'),
(3, 'Jefe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `nombres` varchar(200) NOT NULL,
  `apellidos` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `rol` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `cedula`, `nombres`, `apellidos`, `email`, `rol`, `estado`, `password`) VALUES
(1, '101921', 'Yony Brondy', 'Mamani Fuentes', 'yonybrondy17@gmail.com', 2, 1, 'd033e22ae348aeb5660fc2140aec35850c4da997'),
(2, '10102131', 'jairo jose', 'Villannueva Rojas', 'jairo@gmail.com', 1, 1, '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(3, '10102131', 'john', 'caceres', 'john@gmail.com', 1, 1, '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(4, '10102134', 'luis', 'peres', 'luis@hotmail.com', 2, 1, '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(5, '10121212', 'Juan Luis', 'Gomez Arapa', 'juanluis@gmail.com', 3, 1, '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(6, '90912123', 'Yeny', 'Mamani Fuentes', 'yeny@gmail.com', 1, 1, '7110eda4d09e062aa5e4a390b0a572ac0d2c0220');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `casos`
--
ALTER TABLE `casos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados_casos`
--
ALTER TABLE `estados_casos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados_incidencias`
--
ALTER TABLE `estados_incidencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial_casos`
--
ALTER TABLE `historial_casos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial_incidencias`
--
ALTER TABLE `historial_incidencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pasos`
--
ALTER TABLE `pasos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `casos`
--
ALTER TABLE `casos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `estados_casos`
--
ALTER TABLE `estados_casos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estados_incidencias`
--
ALTER TABLE `estados_incidencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `historial_casos`
--
ALTER TABLE `historial_casos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT de la tabla `historial_incidencias`
--
ALTER TABLE `historial_incidencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `pasos`
--
ALTER TABLE `pasos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
