-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-09-2023 a las 17:11:27
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `quickcarry`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `id_almacen` int(11) NOT NULL,
  `departamento` varchar(25) DEFAULT NULL,
  `ciudad` varchar(25) DEFAULT NULL,
  `calle` varchar(40) DEFAULT NULL,
  `numero_puerta` int(11) DEFAULT NULL,
  `coordenadas` varchar(50) DEFAULT NULL,
  `capacidad` int(11) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`id_almacen`, `departamento`, `ciudad`, `calle`, `numero_puerta`, `coordenadas`, `capacidad`, `estado`) VALUES
(1, 'Montevideo', 'Montevideo', 'Av. Uruguay', 123, '12.345,67.890', 100, 'Activo'),
(2, 'Tacuarembó', 'Tacuarembó', 'Calle Tacuarembó', 456, '23.456,78.901', 80, 'Activo'),
(3, 'Canelones', 'Canelones', 'Calle Canelones', 789, '34.567,89.012', 80, 'Activo'),
(4, 'Maldonado', 'Punta del Este', 'Parada 14', 666, '62.345,67.890', 120, 'Activo'),
(5, 'Rocha', 'Rocha', 'Gral Moser', 456, '23.456,78.901', 80, 'Activo'),
(6, 'Artigas', 'Bella Unión', 'Av. Terra', 856, '13.456,78.901', 80, 'Activo'),
(7, 'Paysandú', 'Las Piedras', 'Av. Julieta', 486, '23.596,78.901', 40, 'Activo'),
(8, 'Colonia', 'Carmelo', 'Levratto', 700, '23.456,78.991', 80, 'Activo'),
(9, 'Cerro Largo', 'Melo', 'Calle A', 346, '10.456,78.901', 80, 'Activo'),
(10, 'Durazno', 'Sarandí del Yi', 'Gral Moser', 456, '23.456,78.901', 80, 'Activo'),
(11, 'Flores', 'Trinidad', 'Av. Flores', 123, '12.345,67.890', 100, 'Activo'),
(12, 'Lavalleja', 'Minas', 'Calle Minas', 456, '23.456,78.901', 80, 'Activo'),
(13, 'Río Negro', 'Fray Bentos', 'Av. Río Negro', 856, '13.456,78.901', 80, 'Activo'),
(14, 'Rivera', 'Rivera', 'Calle Rivera', 486, '23.596,78.901', 40, 'Activo'),
(15, 'Salto', 'Salto', 'Av. Salto', 346, '10.456,78.901', 80, 'Activo'),
(16, 'San José', 'San José', 'Calle San José', 456, '23.456,78.901', 80, 'Activo'),
(17, 'Soriano', 'Mercedes', 'Av. Soriano', 856, '13.456,78.901', 80, 'Activo'),
(18, 'Treinta y Tres', 'Treinta y Tres', 'Av. Treinta y Tres', 486, '23.596,78.901', 40, 'Activo'),
(19, 'Florida', 'Melo', 'Av. Libertad', 789, '34.567,89.012', 80, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camion`
--

CREATE TABLE `camion` (
  `matricula` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `camion`
--

INSERT INTO `camion` (`matricula`) VALUES
('ABC 1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camionero`
--

CREATE TABLE `camionero` (
  `ci` varchar(20) NOT NULL,
  `libreta` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `camionero`
--

INSERT INTO `camionero` (`ci`, `libreta`) VALUES
('3', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camioneta`
--

CREATE TABLE `camioneta` (
  `matricula` varchar(10) NOT NULL,
  `id_almacen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conduce`
--

CREATE TABLE `conduce` (
  `ci_camionero` varchar(20) DEFAULT NULL,
  `matricula` varchar(10) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcionario_almacen`
--

CREATE TABLE `funcionario_almacen` (
  `ci` varchar(20) NOT NULL,
  `id_almacen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `funcionario_almacen`
--

INSERT INTO `funcionario_almacen` (`ci`, `id_almacen`) VALUES
('2', 1),
('4', 4),
('5', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote`
--

CREATE TABLE `lote` (
  `id_lote` int(11) NOT NULL,
  `id_recorrido` int(11) DEFAULT NULL,
  `departamento_destino` varchar(25) DEFAULT NULL,
  `peso` decimal(10,2) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lote`
--

INSERT INTO `lote` (`id_lote`, `id_recorrido`, `departamento_destino`, `peso`, `estado`) VALUES
(1, 1, 'Maldonado', 50.00, 'Abierto'),
(2, NULL, 'Maldonado', 55.00, 'Abierto'),
(3, NULL, 'Canelones', 0.00, 'Abierto'),
(4, NULL, 'Lavalleja', 0.00, 'Abierto'),
(5, NULL, 'Salto', 0.00, 'Abierto'),
(6, NULL, 'Tacuarembó', 0.00, 'Abierto'),
(7, NULL, 'Maldonado', 0.00, 'Abierto'),
(8, NULL, 'Salto', 0.00, 'Abierto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete`
--

CREATE TABLE `paquete` (
  `id_paquete` int(11) NOT NULL,
  `id_lote` int(11) DEFAULT NULL,
  `matricula` varchar(10) DEFAULT NULL,
  `peso` varchar(10) DEFAULT NULL,
  `tamaño` varchar(20) DEFAULT NULL,
  `tipo_entrega` varchar(20) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `hora_ingreso` time DEFAULT NULL,
  `fecha_envio` date DEFAULT NULL,
  `hora_envio` time DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `hora_entrega` time DEFAULT NULL,
  `departamento_destinatario` varchar(25) DEFAULT NULL,
  `ciudad_destinatario` varchar(25) DEFAULT NULL,
  `calle_destinatario` varchar(40) DEFAULT NULL,
  `numero_puerta_destinatario` int(11) DEFAULT NULL,
  `nombre_destinatario` varchar(25) DEFAULT NULL,
  `email_destinatario` varchar(50) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paquete`
--

INSERT INTO `paquete` (`id_paquete`, `id_lote`, `matricula`, `peso`, `tamaño`, `tipo_entrega`, `fecha_ingreso`, `hora_ingreso`, `fecha_envio`, `hora_envio`, `fecha_entrega`, `hora_entrega`, `departamento_destinatario`, `ciudad_destinatario`, `calle_destinatario`, `numero_puerta_destinatario`, `nombre_destinatario`, `email_destinatario`, `estado`) VALUES
(2, NULL, NULL, '', '', 'Almacen', '2023-09-21', '03:09:15', NULL, NULL, NULL, NULL, 'Artigas', 'Artigas', 'boca', 23232323, 'ana', 'ana@gmail', 'Ingresado almacen'),
(3, NULL, NULL, '0-5', 'Chico', 'Final', '2023-09-21', '03:25:59', NULL, NULL, NULL, NULL, 'Artigas', 'Artigas', 'AV pacifica', 3223, 'pedro', 'pedro@gmail', 'Ingresado almacen'),
(4, 2, NULL, '5-10', 'Grande', 'Almacen', '2023-09-21', '03:26:23', NULL, NULL, NULL, NULL, 'San José', 'San José de Mayo', 'peñarol', 1891, 'Martin', 'Martin@gmail', 'Ingresado almacen'),
(5, NULL, NULL, '5-10', 'Grande', 'Almacen', '2023-09-21', '03:27:00', NULL, NULL, NULL, NULL, 'Río Negro', 'Young', 'river', 24134, 'pepe', 'pepe@gmail', 'Ingresado almacen'),
(6, NULL, NULL, '5-10', 'Mediano', 'Almacen', '2023-09-21', '03:27:22', NULL, NULL, NULL, NULL, 'Cerro Largo', 'Melo', 'AV pacificaa', 43333, 'matias', 'matias@gmail', 'Ingresado almacen'),
(7, 2, NULL, '30+', 'Grande', 'Almacen', '2023-09-21', '03:28:37', NULL, NULL, NULL, NULL, 'Durazno', 'Sarandí del Yí', 'durazno', 3333333, 'eze', 'eze@gmail.com', 'Ingresado almacen');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pasa_por`
--

CREATE TABLE `pasa_por` (
  `id_recorrido` int(11) DEFAULT NULL,
  `id_almacen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pasa_por`
--

INSERT INTO `pasa_por` (`id_recorrido`, `id_almacen`) VALUES
(3, 3),
(3, 4),
(3, 1),
(4, 3),
(4, 4),
(5, 3),
(5, 4),
(6, 19),
(7, 19),
(8, 19),
(9, 7),
(10, 7),
(11, 12),
(12, 16),
(13, 16),
(14, 15),
(15, 14),
(16, 14),
(17, 4),
(18, 12),
(19, 13),
(24, 15),
(25, 15),
(26, 17),
(27, 7),
(28, 14),
(29, 14),
(30, 14),
(32, 15),
(33, 17),
(34, 7),
(34, 13),
(34, 14),
(34, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `ci` varchar(20) NOT NULL,
  `nombre` varchar(25) DEFAULT NULL,
  `apellido` varchar(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `cargo` varchar(30) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`ci`, `nombre`, `apellido`, `email`, `cargo`, `estado`) VALUES
('1', 'uno', 'UNO', 'uno@gmail.com', 'Admin', NULL),
('2', 'dos', 'DOS', 'dos@gmail.com', 'Funcionario Almacen', NULL),
('3', 'tres', 'TRES', 'tres@gmail.com', 'Camionero', NULL),
('4', 'cuatro', 'CUATRO', 'cuatro@gmail.com', 'Funcionario Almacen', NULL),
('5', 'cinco', 'CINCO', 'cinco@gmail.com', 'Funcionario Almacen', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recorrido`
--

CREATE TABLE `recorrido` (
  `id_recorrido` int(11) NOT NULL,
  `matricula` varchar(10) DEFAULT NULL,
  `fecha_salida` date DEFAULT NULL,
  `hora_salida` time DEFAULT NULL,
  `fecha_llegada` date DEFAULT NULL,
  `hora_llegada` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recorrido`
--

INSERT INTO `recorrido` (`id_recorrido`, `matricula`, `fecha_salida`, `hora_salida`, `fecha_llegada`, `hora_llegada`) VALUES
(1, 'ABC 1234', '2023-09-13', '07:42:29', '2023-09-13', '14:43:32'),
(2, 'ABC 1234', NULL, NULL, NULL, NULL),
(3, 'ABC 1234', NULL, NULL, NULL, NULL),
(4, 'ABC 1234', NULL, NULL, NULL, NULL),
(5, 'ABC 1234', NULL, NULL, NULL, NULL),
(6, 'ABC 1234', NULL, NULL, NULL, NULL),
(7, 'ABC 1234', NULL, NULL, NULL, NULL),
(8, 'ABC 1234', NULL, NULL, NULL, NULL),
(9, 'ABC 1234', NULL, NULL, NULL, NULL),
(10, 'ABC 1234', NULL, NULL, NULL, NULL),
(11, 'ABC 1234', NULL, NULL, NULL, NULL),
(12, 'ABC 1234', NULL, NULL, NULL, NULL),
(13, 'ABC 1234', NULL, NULL, NULL, NULL),
(14, 'ABC 1234', NULL, NULL, NULL, NULL),
(15, 'ABC 1234', NULL, NULL, NULL, NULL),
(16, 'ABC 1234', NULL, NULL, NULL, NULL),
(17, 'ABC 1234', NULL, NULL, NULL, NULL),
(18, 'ABC 1234', NULL, NULL, NULL, NULL),
(19, 'ABC 1234', NULL, NULL, NULL, NULL),
(24, 'ABC 1234', NULL, NULL, NULL, NULL),
(25, 'ABC 1234', NULL, NULL, NULL, NULL),
(26, 'ABC 1234', NULL, NULL, NULL, NULL),
(27, 'ABC 1234', NULL, NULL, NULL, NULL),
(28, 'ABC 1234', NULL, NULL, NULL, NULL),
(29, 'ABC 1234', NULL, NULL, NULL, NULL),
(30, 'ABC 1234', NULL, NULL, NULL, NULL),
(31, 'ABC 1234', NULL, NULL, NULL, NULL),
(32, 'ABC 1234', NULL, NULL, NULL, NULL),
(33, 'ABC 1234', NULL, NULL, NULL, NULL),
(34, 'ABC 1234', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ci` varchar(20) NOT NULL,
  `contraseña` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ci`, `contraseña`) VALUES
('1', '1'),
('2', '2'),
('3', '3'),
('4', '4'),
('5', '5');



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `matricula` varchar(10) NOT NULL,
  `marca` varchar(25) DEFAULT NULL,
  `modelo` varchar(25) DEFAULT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `capacidad_carga` int(11) DEFAULT NULL,
  `carga_actual` int(11) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`matricula`, `marca`, `modelo`, `tipo`, `capacidad_carga`, `carga_actual`, `estado`) VALUES
('ABC 1234', 'Renault', 'clio', NULL, 500, 0, 'Disponible');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`id_almacen`);

--
-- Indices de la tabla `camion`
--
ALTER TABLE `camion`
  ADD PRIMARY KEY (`matricula`);

--
-- Indices de la tabla `camionero`
--
ALTER TABLE `camionero`
  ADD PRIMARY KEY (`ci`);

--
-- Indices de la tabla `camioneta`
--
ALTER TABLE `camioneta`
  ADD PRIMARY KEY (`matricula`),
  ADD KEY `id_almacen` (`id_almacen`);

--
-- Indices de la tabla `conduce`
--
ALTER TABLE `conduce`
  ADD KEY `ci_camionero` (`ci_camionero`),
  ADD KEY `matricula` (`matricula`);

--
-- Indices de la tabla `funcionario_almacen`
--
ALTER TABLE `funcionario_almacen`
  ADD PRIMARY KEY (`ci`),
  ADD KEY `id_almacen` (`id_almacen`);

--
-- Indices de la tabla `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`id_lote`),
  ADD KEY `id_recorrido` (`id_recorrido`);

--
-- Indices de la tabla `paquete`
--
ALTER TABLE `paquete`
  ADD PRIMARY KEY (`id_paquete`),
  ADD KEY `id_lote` (`id_lote`),
  ADD KEY `matricula` (`matricula`);

--
-- Indices de la tabla `pasa_por`
--
ALTER TABLE `pasa_por`
  ADD KEY `id_recorrido` (`id_recorrido`),
  ADD KEY `id_almacen` (`id_almacen`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`ci`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `recorrido`
--
ALTER TABLE `recorrido`
  ADD PRIMARY KEY (`id_recorrido`),
  ADD KEY `matricula` (`matricula`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ci`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`matricula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `id_almacen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `lote`
--
ALTER TABLE `lote`
  MODIFY `id_lote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `paquete`
--
ALTER TABLE `paquete`
  MODIFY `id_paquete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `recorrido`
--
ALTER TABLE `recorrido`
  MODIFY `id_recorrido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `camion`
--
ALTER TABLE `camion`
  ADD CONSTRAINT `camion_ibfk_1` FOREIGN KEY (`matricula`) REFERENCES `vehiculo` (`matricula`);

--
-- Filtros para la tabla `camionero`
--
ALTER TABLE `camionero`
  ADD CONSTRAINT `camionero_ibfk_1` FOREIGN KEY (`ci`) REFERENCES `persona` (`ci`);

--
-- Filtros para la tabla `camioneta`
--
ALTER TABLE `camioneta`
  ADD CONSTRAINT `camioneta_ibfk_1` FOREIGN KEY (`matricula`) REFERENCES `vehiculo` (`matricula`),
  ADD CONSTRAINT `camioneta_ibfk_2` FOREIGN KEY (`id_almacen`) REFERENCES `almacen` (`id_almacen`);

--
-- Filtros para la tabla `conduce`
--
ALTER TABLE `conduce`
  ADD CONSTRAINT `conduce_ibfk_1` FOREIGN KEY (`ci_camionero`) REFERENCES `camionero` (`ci`),
  ADD CONSTRAINT `conduce_ibfk_2` FOREIGN KEY (`matricula`) REFERENCES `vehiculo` (`matricula`);

--
-- Filtros para la tabla `funcionario_almacen`
--
ALTER TABLE `funcionario_almacen`
  ADD CONSTRAINT `funcionario_almacen_ibfk_1` FOREIGN KEY (`ci`) REFERENCES `persona` (`ci`),
  ADD CONSTRAINT `funcionario_almacen_ibfk_2` FOREIGN KEY (`id_almacen`) REFERENCES `almacen` (`id_almacen`);

--
-- Filtros para la tabla `lote`
--
ALTER TABLE `lote`
  ADD CONSTRAINT `lote_ibfk_1` FOREIGN KEY (`id_recorrido`) REFERENCES `recorrido` (`id_recorrido`);

--
-- Filtros para la tabla `paquete`
--
ALTER TABLE `paquete`
  ADD CONSTRAINT `paquete_ibfk_1` FOREIGN KEY (`id_lote`) REFERENCES `lote` (`id_lote`),
  ADD CONSTRAINT `paquete_ibfk_2` FOREIGN KEY (`matricula`) REFERENCES `camioneta` (`matricula`);

--
-- Filtros para la tabla `pasa_por`
--
ALTER TABLE `pasa_por`
  ADD CONSTRAINT `pasa_por_ibfk_1` FOREIGN KEY (`id_recorrido`) REFERENCES `recorrido` (`id_recorrido`),
  ADD CONSTRAINT `pasa_por_ibfk_2` FOREIGN KEY (`id_almacen`) REFERENCES `almacen` (`id_almacen`);

--
-- Filtros para la tabla `recorrido`
--
ALTER TABLE `recorrido`
  ADD CONSTRAINT `recorrido_ibfk_1` FOREIGN KEY (`matricula`) REFERENCES `camion` (`matricula`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
