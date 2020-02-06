-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-04-2018 a las 21:30:10
-- Versión del servidor: 5.7.19-log
-- Versión de PHP: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pelisworld`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `idCome` int(10) NOT NULL,
  `idpeli` int(10) NOT NULL,
  `nombreusu` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fotousu` varchar(1000) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `comentario` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`idCome`, `idpeli`, `nombreusu`, `fotousu`, `comentario`) VALUES
(4, 1, 'Papa', 'upload/mono1.jpg', 'la wea cuantica'),
(5, 1, 'Papa', 'upload/HTML5 (1).png', 'la wea XD XD XD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE `favoritos` (
  `idFav` int(10) NOT NULL,
  `idusu` int(10) NOT NULL,
  `idpeli` int(10) NOT NULL,
  `fotopeli` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `nombrepeli` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `idnot` int(10) NOT NULL,
  `nombreNot` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contenido` varchar(10000) COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `persona` varchar(50) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`idnot`, `nombreNot`, `contenido`, `foto`, `persona`) VALUES
(9, 'lalalal', '¿De dónde viene?\r\nAl contrario del pensamiento popular, el texto de Lorem Ipsum no es simplemente texto aleatorio. Tiene sus raices en una pieza cl´sica de la literatura del Latin, que data del año 45 antes de Cristo, haciendo que este adquiera mas de 2000 años de antiguedad. Richard McClintock, un profesor de Latin de la Universidad de Hampden-Sydney en Virginia, encontró una de las palabras más oscuras de la lengua del latín, \"consecteur\", en un pasaje de Lorem Ipsum, y al seguir leyendo distintos textos del latín, descubrió la fuente indudable. Lorem Ipsum viene de las secciones 1.10.32 y 1.10.33 de \"de Finnibus Bonorum et Malorum\" (Los Extremos del Bien y El Mal) por Cicero, escrito en el año 45 antes de Cristo. Este libro es un tratado de teoría de éticas, muy popular durante el Renacimiento. La primera linea del Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", viene de una linea en la sección 1.10.32\r\n\r\nEl trozo de texto estándar de Lorem Ipsum usado desde el año 1500 es reproducido debajo para aquellos interesados. Las secciones 1.10.32 y 1.10.33 de \"de Finibus Bonorum et Malorum\" por Cicero son también reproducidas en su forma original exacta, acompañadas por versiones en Inglés de la traducción realizada en 1914 por H. Rackham.', 'upload/html5.png', 'gg izzi'),
(10, 'kmlnjk', '¿smkcnjabhavgjhbkjnkmknljkbvghcfhgvjhbknklmlnjkbvghcfhgvjhbjknljkbjgvhcfh jkhjvgcfchgjvhbkjnbkhjgchf bkuvytcyvjkbjlnkjbhvjgfxgchgvhbkjn yguftydrtfyguhugjcf', 'upload/h1-h2.jpg', 'ljddfg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `id` int(10) NOT NULL,
  `nombrePeli` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `video` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `fotoPeli` varchar(500) CHARACTER SET utf32 COLLATE utf32_unicode_ci DEFAULT NULL,
  `anioPeli` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `descarga` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `genero` enum('accion','terror','animacion','comedia','drama','cifi') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`id`, `nombrePeli`, `descripcion`, `video`, `fotoPeli`, `anioPeli`, `descarga`, `genero`) VALUES
(1, 'los prros', 'ajkchjvhcsn.nkcsljkhj dsca', 'https://player.vimeo.com/video/262645114', 'upload/as.jpg', '24/5/1996', 'https://mega.nz/#!uzAnxLiQ!HaC7Q5U_waWIEutUHFqF9kfFTeskIYPogzVhxV1Ellw', 'comedia'),
(3, 'gg izzi', 'kljkhjghfgfhgjhjk.', 'https://player.vimeo.com/video/265894230', 'upload/as.jpg', '24/5/1996', 'https://mega.nz/#!uzAnxLiQ!HaC7Q5U_waWIEutUHFqF9kfFTeskIYPogzVhxV1Ellw', 'terror');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `nombre` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `rol` enum('usu','admin') COLLATE utf8_unicode_ci NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateUpdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `nombre`, `email`, `foto`, `password`, `rol`, `dateCreated`, `dateUpdate`) VALUES
(1, 'Papa', 'floresquijanoj@gmail.com', 'upload/HTML5 (1).png', '12345', 'admin', '2018-03-28 19:19:59', '2018-04-22 03:51:45'),
(2, 'Paul', 'gg@gmail.com', 'upload/htmlogo.jpg', '12345', 'usu', '2018-04-17 21:42:58', '2018-04-20 22:44:41'),
(3, 'el vato', 'ga@gmail.com', 'upload/HTML5 (1).png', '12345', 'usu', '2018-04-17 23:58:32', '2018-04-21 01:09:15'),
(4, 'el papu', 'ja@gmail.com', 'upload/html5.png', '12345', 'usu', '2018-04-21 01:06:23', '2018-04-21 01:19:17'),
(5, 'bayardo', 'baya@gmail.com', 'upload/htmlogo.jpg', '12345', 'usu', '2018-04-23 17:26:21', '2018-04-23 17:28:12');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`idCome`);

--
-- Indices de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`idFav`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`idnot`);

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `idCome` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `idFav` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `idnot` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
