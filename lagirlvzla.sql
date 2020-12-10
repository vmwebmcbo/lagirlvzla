-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2020 a las 20:28:43
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `com_manager`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `imagen_categoria` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`, `imagen_categoria`) VALUES
(1, 'OJOS', 'uploads/cat1.jpg'),
(2, 'LABIOS', 'uploads/cat2.jpg'),
(3, 'FACIAL', 'uploads/cat3.jpg'),
(4, 'UÑAS', 'uploads/cat4.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen_inicio`
--

CREATE TABLE `imagen_inicio` (
  `id_imagen` int(11) NOT NULL,
  `imagen` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `link_imagen` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `imagen_inicio`
--

INSERT INTO `imagen_inicio` (`id_imagen`, `imagen`, `link_imagen`) VALUES
(1, 'uploads/bannerWeb.jpg', 'http://localhost/lagirl/Details/?idp=2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id_pago` int(11) NOT NULL,
  `nombre_cli` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `email_cli` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `telefono_cli` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `direccion_cli` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `nombre_pay` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `referencia` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `metodo_pago` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `productos` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `total` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `fecha` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id_pago`, `nombre_cli`, `email_cli`, `telefono_cli`, `direccion_cli`, `nombre_pay`, `referencia`, `metodo_pago`, `productos`, `total`, `fecha`, `estado`) VALUES
(19, 'Juan Álvarez', 'juanjalvarezm571@gmail.com', '04246740043', 'Av. El Milagro. Maracaibo, Zulia.', 'Juan Álvarez', 'asdga1234', 'Zelle', '(1) PRO Face (Boost12) <b>$6.00</b><br>', '6', '19/10/2020 [10:29]', 1),
(20, 'Juan Álvarez', 'juanjalvarezm571@gmail.com', '04246740043', 'Av. El Milagro. Maracaibo, Zulia.', 'Juan Álvarez', 'asdf551512', 'Zelle', '(1) PRO Face (GC123-z) <b>$6.00</b><br>', '6', '19/10/2020 [10:45]', 1),
(21, 'Juan Álvarez', 'juanjalvarezm571@gmail.com', '0424670043165', 'Av. El Milagro. Maracaibo, Zulia.', 'Juan Álvarez', 'aklsd1565', 'Zelle', '(1) Luminous Glow (DZ3581) <b>$7.50</b><br>(1) Luminous Glow (DZ3582) <b>$7.50</b><br>', '15', '20/10/2020 [01:57]', 1),
(22, 'Juan Álvarez', 'juanjalvarezm571@gmail.com', '04246740043', 'Av. El Milagro. Maracaibo, Zulia.', 'Juan Álvarez', 'asdga1234', 'Zelle', '(1) Luminous Glow (DZ3581) <b>$7.50</b><br>', '7.5', '20/10/2020 [02:14]', 0),
(23, 'Juan Álvarez', 'juanjalvarezm571@gmail.com', '04246740043', 'Av. El Milagro. Maracaibo, Zulia.', 'Juan Álvarez', 'asdfha566265', 'Zelle', '(1) Luminous Glow (DZ3581) <b>$7.50</b><br>', '7.5', '20/10/2020 [02:23]', 0),
(24, 'Juan Álvarez', 'juanjalvarezm571@gmail.com', '04246740043', 'Av. El Milagro. Maracaibo, Zulia.', 'Juan Álvarez', 'asdga1234', 'Zelle', '(1) Toallitas Removedoras de Maquillaje (Regular) <b>$7</b><br>', '7', '21/10/2020 [02:12]', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `imagen` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` varchar(800) COLLATE utf8mb4_spanish_ci NOT NULL,
  `precio` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `pos_pagina` tinyint(1) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre`, `imagen`, `descripcion`, `precio`, `pos_pagina`, `id_categoria`) VALUES
(2, 'PRO Face', 'uploads/polvo.jpeg', '<ul><li><strong>Algun Titulo</strong></li></ul><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur in urna nisi. Vivamus vitae nunc nisi. Nam luctus diam felis, sit amet congue nisi consequat ut. Sed blandit convallis tortor non sollicitudin. Aliquam tempus justo quis lorem dictum pharetra. Ut malesuada suscipit risus, facilisis dignissim erat consequat et. Cras convallis dui felis.</p>', '6.00', 1, 1),
(3, 'Just Blushing', 'uploads/paleta.jpeg', '<ul><li><strong>Algun Titulo</strong></li></ul><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur in urna nisi. Vivamus vitae nunc nisi. Nam luctus diam felis, sit amet congue nisi consequat ut. Sed blandit convallis tortor non sollicitudin. Aliquam tempus justo quis lorem dictum pharetra. Ut malesuada suscipit risus, facilisis dignissim erat consequat et. Cras convallis dui felis.</p>', '7.00', 1, 3),
(4, 'Brow Bestie', 'uploads/pen.jpeg', '<ul><li><strong>Algun Titulo</strong></li></ul><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur in urna nisi. Vivamus vitae nunc nisi. Nam luctus diam felis, sit amet congue nisi consequat ut. Sed blandit convallis tortor non sollicitudin. Aliquam tempus justo quis lorem dictum pharetra. Ut malesuada suscipit risus, facilisis dignissim erat consequat et. Cras convallis dui felis.</p>', '8.00', 1, 1),
(5, 'PRO Coverage', 'uploads/iluminatig.jpeg', '<ul><li><strong>Algun Titulo</strong></li></ul><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur in urna nisi. Vivamus vitae nunc nisi. Nam luctus diam felis, sit amet congue nisi consequat ut. Sed blandit convallis tortor non sollicitudin. Aliquam tempus justo quis lorem dictum pharetra. Ut malesuada suscipit risus, facilisis dignissim erat consequat et. Cras convallis dui felis.</p>', '9.00', 1, 3),
(8, 'Luminous Glow', 'uploads/luminous.jpg', '<ul><li><strong>Algun Titulo</strong></li></ul><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus dictum a neque quis luctus. Nunc consequat purus ipsum, at lacinia justo tincidunt quis. Aenean pretium condimentum libero quis maximus. Aenean pharetra bibendum congue. Quisque venenatis fringilla nisl, non consectetur eros cursus ut. Donec et libero id felis aliquet tincidunt.&nbsp;</p>', '7.50', 0, 3),
(9, 'Toallitas Removedoras de Maquillaje', 'uploads/lagirlWipes.jpg', '<ul><li><strong>Algun Titulo</strong></li></ul><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur in urna nisi. Vivamus vitae nunc nisi. Nam luctus diam felis, sit amet congue nisi consequat ut. Sed blandit convallis tortor non sollicitudin. Aliquam tempus justo quis lorem dictum pharetra. Ut malesuada suscipit risus, facilisis dignissim erat consequat et. Cras convallis dui felis.</p>', '7', 0, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

CREATE TABLE `subcategoria` (
  `id_subcategoria` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `imagen` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `subcategoria`
--

INSERT INTO `subcategoria` (`id_subcategoria`, `nombre`, `imagen`) VALUES
(10, 'Blush', 'uploads/cat3.jpg'),
(11, 'Polish', 'uploads/cat4.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `id_tproducto` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `imagen_color` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_producto`
--

INSERT INTO `tipo_producto` (`id_tproducto`, `nombre`, `imagen_color`, `id_producto`) VALUES
(1, 'Boost12', 'uploads/tonos/algoTono.jpg', 2),
(4, 'GC123-z', 'uploads/tonos/algoTono.jpg', 2),
(5, 'DZ3581', 'uploads/tonos/highliterTone.jpg', 8),
(6, 'DZ3582', 'uploads/tonos/highliterTone1.jpg', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_admin`
--

CREATE TABLE `user_admin` (
  `id_user` int(11) NOT NULL,
  `username` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `pass` varchar(300) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `user_admin`
--

INSERT INTO `user_admin` (`id_user`, `username`, `pass`) VALUES
(1, 'jesus_comunica', 'be57bd1ad70520f0e68aba86fe368c5807b3ab430260b3d47ae70c9c7f4b6cda');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `imagen_inicio`
--
ALTER TABLE `imagen_inicio`
  ADD PRIMARY KEY (`id_imagen`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pago`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`id_subcategoria`);

--
-- Indices de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`id_tproducto`);

--
-- Indices de la tabla `user_admin`
--
ALTER TABLE `user_admin`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `imagen_inicio`
--
ALTER TABLE `imagen_inicio`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `id_subcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `id_tproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `user_admin`
--
ALTER TABLE `user_admin`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
