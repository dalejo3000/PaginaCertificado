-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-03-2021 a las 13:01:23
-- Versión del servidor: 10.1.33-MariaDB
-- Versión de PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `carrito2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(300) NOT NULL,
  `cedula` char(10) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `cedula`, `imagen`, `id_categoria`) VALUES
(1, 'Alejandro Romero', '1234567890', '1616139888.jpg', 1),
(2, 'Alejandro Romero', '1234567890', '1616139888.jpg', 2),
(3, 'Alejandro Romero', '1234567890', '1616139888.jpg', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(400) NOT NULL,
  `duracion` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `imagen` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `nombre`, `descripcion`, `duracion`, `fecha_inicio`, `imagen`) VALUES
(1, 'Matemáticas', 'Materia de Matemáticas', 30, '2021-03-09', ''),
(2, 'Lenguaje', 'Materia de Lenguaje', 40, '2021-03-25', ''),
(3, 'Sociales', 'Materia de Sociales', 60, '2021-03-17', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_certificado`
--

CREATE TABLE `registro_certificado` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `certificado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `registro_certificado`
--

INSERT INTO `registro_certificado` (`id`, `id_usuario`, `fecha`, `certificado`) VALUES
(1, 11, '2020-11-15 09:11:39', 0),
(50, 47, '2021-03-19 12:03:59', 0),
(51, 48, '2021-03-19 13:03:34', 0),
(52, 50, '2021-03-19 14:03:32', 0),
(53, 51, '2021-03-19 14:03:16', 0),
(54, 52, '2021-03-19 14:03:46', 0),
(55, 53, '2021-03-19 14:03:47', 0),
(56, 54, '2021-03-24 13:03:21', 0),
(57, 55, '2021-03-24 13:03:45', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `telefono` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `img_perfil` varchar(300) NOT NULL,
  `nivel` varchar(20) NOT NULL,
  `cedula` char(10) NOT NULL,
  `fecha` date NOT NULL,
  `curso` varchar(123) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `telefono`, `email`, `password`, `img_perfil`, `nivel`, `cedula`, `fecha`, `curso`) VALUES
(2, 'David Romero', '+593998004766', 'dalejo3000@gmail.com', '601f1889667efaebb33b8c12572835da3f027f78', 'david.jpg', 'admin', '1122334455', '1991-03-10', ''),
(54, 'Alejandro Romero', '1234', 'aromero@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'default.jpg', 'cliente', '1234567890', '1962-12-25', ''),
(55, 'Teresa Vaca', '1234', 'tvaca@prueba.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'default.jpg', 'cliente', '12345', '1958-11-15', ''),
(58, 'Ricardo Palacios', '+593998004766', 'rpalacios@prueba.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'default.jpg', 'admin', '1234', '2021-03-11', ''),
(65, 'fdsfsdf Romero', '+593998004766', 'pruebalunes', '601f1889667efaebb33b8c12572835da3f027f78', 'default.jpg', 'admin', '1234', '2021-03-08', 'frio'),
(66, 'cliente CLIENTE', '0998004766', 'pruebalunes', '601f1889667efaebb33b8c12572835da3f027f78', 'default.jpg', 'cliente', '1234567890', '2021-03-10', 'curso'),
(67, 'cliente CLIJFISJD', '+593998004766', 'pruebalunes', '601f1889667efaebb33b8c12572835da3f027f78', 'default.jpg', 'cliente', '1234', '2021-03-17', 'casa');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registro_certificado`
--
ALTER TABLE `registro_certificado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT de la tabla `registro_certificado`
--
ALTER TABLE `registro_certificado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
