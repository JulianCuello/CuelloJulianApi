-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-11-2024 a las 15:31:23
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_jugueteria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juguete`
--

CREATE TABLE `juguete` (
  `id_juguete` int(45) NOT NULL,
  `nombreProducto` varchar(45) NOT NULL,
  `precio` int(45) NOT NULL,
  `material` varchar(45) NOT NULL,
  `id_marca` int(45) NOT NULL,
  `codigo` int(45) NOT NULL,
  `img` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `juguete`
--

INSERT INTO `juguete` (`id_juguete`, `nombreProducto`, `precio`, `material`, `id_marca`, `codigo`, `img`) VALUES
(3, 'dinosaurios', 7100, 'goma', 3, 451275, 'img/dinosaurios.jpg'),
(59, 'autos', 15500, 'plastico', 10, 3435434, 'img/autos.jpg'),
(60, 'mario', 11500, 'plastico', 3, 2131465, 'img/mario.jpg'),
(61, 'cocina', 11500, 'plastico', 9, 2131465, 'img/cocina.jpg'),
(63, 'pelotaBasket', 43000, 'cuero', 10, 6754564, 'img/pelotaBasket.jpg'),
(64, 'oso', 55000, 'peluche', 11, 6754564, 'img/oso.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(45) NOT NULL,
  `origen` varchar(45) NOT NULL,
  `caracteristica` varchar(45) NOT NULL,
  `nombreMarca` varchar(45) NOT NULL,
  `imgMarca` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id_marca`, `origen`, `caracteristica`, `nombreMarca`, `imgMarca`) VALUES
(3, 'francia', 'Para niños de 4 a 12 años', 'Lego', 'img/lego.jpg'),
(9, 'rusia', 'todos los chicos', 'disney', 'img/disney.jpg'),
(10, 'rusia', 'todos los chicos', 'dutoys', 'img/ditoys.jpg'),
(11, 'Corea del Norte', 'todos los chicos', 'dutoys', 'img/ditoys.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `contraseña` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `contraseña`) VALUES
(1, 'webadmin@gmail.com', '$2y$10$VREXc/mCCVwmfcEY5HtAneei9ak2RLmhciQTj.0U4K2BJ9ALR2PqK');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `juguete`
--
ALTER TABLE `juguete`
  ADD PRIMARY KEY (`id_juguete`),
  ADD KEY `fk_marca` (`id_marca`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `juguete`
--
ALTER TABLE `juguete`
  MODIFY `id_juguete` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `juguete`
--
ALTER TABLE `juguete`
  ADD CONSTRAINT `fk_marca` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
