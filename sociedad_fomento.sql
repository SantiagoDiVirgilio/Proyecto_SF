-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2025 a las 15:34:53
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
-- Base de datos: `sociedad_fomento`
--
CREATE DATABASE IF NOT EXISTS `sociedad_fomento` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sociedad_fomento`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canchas`
--

DROP TABLE IF EXISTS `canchas`;
CREATE TABLE `canchas` (
  `id_cancha` int(5) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `precio_hora` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `canchas`
--

INSERT INTO `canchas` (`id_cancha`, `nombre`, `tipo`, `descripcion`, `precio_hora`) VALUES
(1, 'CANCHA PARA 5', 'FUTBOL', 'Cancha de Futbol 5 apta para 8 personas. Materiales: Dos arcos, una pelota', 4000.00),
(2, 'CANCHA PARA 8', 'FUTBOL', 'Cancha de Futbol 5 apta para 12 personas. Materiales: Dos arcos, dos pelotas', 4500.00),
(3, 'CANCHA PARA 5', 'BASQUET', 'Cancha de Basquet apta para 10 personas. Materiales: Dos arcos, una pelota', 4500.00),
(4, 'CANCHA PARA 10', 'BASQUET', 'Cancha de Basquet apta para 15 personas. Materiales: Dos arcos, una pelota', 5000.00),
(5, 'SALON 1', 'SALON', '', 5000.00),
(6, 'PILETA', 'NATACION', '', 2000.00),
(7, 'Prueba', 'Cancha Prueb', 'Prueba de cnacha, favor de eliminar', 1000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deportes`
--

DROP TABLE IF EXISTS `deportes`;
CREATE TABLE `deportes` (
  `id_deporte` int(5) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cupo_maximo` int(3) NOT NULL,
  `cupo_actual` int(3) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `deportes`
--

INSERT INTO `deportes` (`id_deporte`, `nombre`, `descripcion`, `cupo_maximo`, `cupo_actual`) VALUES
(1, 'FUTBOL', 'Días: Lunes, Jueves y Sábados.\nCategorías: Todas.', 20, 1),
(2, 'BASQUET', 'Días: Martes y Miércoles.\nCategorías: Todas.', 2, 2),
(3, 'SALON', '', 200, 0),
(4, 'NATACION', 'Disfruta de nuestra pileta e inscribite a NATACION', 45, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario_cancha`
--

DROP TABLE IF EXISTS `horario_cancha`;
CREATE TABLE `horario_cancha` (
  `id_horario` int(11) NOT NULL,
  `id_cancha` int(5) NOT NULL,
  `horario` time NOT NULL,
  `disponible` tinyint(1) NOT NULL DEFAULT 1,
  `fecha_horario` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `horario_cancha`
--

INSERT INTO `horario_cancha` (`id_horario`, `id_cancha`, `horario`, `disponible`, `fecha_horario`) VALUES
(1, 3, '12:00:00', 0, '2025-10-01'),
(2, 1, '10:00:00', 1, NULL),
(3, 1, '11:00:00', 1, NULL),
(4, 1, '12:00:00', 1, NULL),
(5, 2, '15:00:00', 1, NULL),
(6, 2, '16:00:00', 1, NULL),
(7, 6, '10:00:00', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones`
--

DROP TABLE IF EXISTS `inscripciones`;
CREATE TABLE `inscripciones` (
  `id_inscripcion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_deporte` int(11) NOT NULL,
  `fecha_inscripcion` int(11) NOT NULL,
  `becado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `inscripciones`
--

INSERT INTO `inscripciones` (`id_inscripcion`, `id_usuario`, `id_deporte`, `fecha_inscripcion`, `becado`) VALUES
(2, 201, 2, 1762871548, 0),
(3, 202, 2, 1762871602, 0);

--
-- Disparadores `inscripciones`
--
DROP TRIGGER IF EXISTS `trg_aumentar_cupo_actual`;
DELIMITER $$
CREATE TRIGGER `trg_aumentar_cupo_actual` AFTER INSERT ON `inscripciones` FOR EACH ROW BEGIN
    UPDATE deportes
    SET cupo_actual = cupo_actual + 1
    WHERE id_deporte = NEW.id_deporte;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `trg_validar_cupo_lleno`;
DELIMITER $$
CREATE TRIGGER `trg_validar_cupo_lleno` BEFORE INSERT ON `inscripciones` FOR EACH ROW BEGIN
    DECLARE v_cupo_actual INT;
    DECLARE v_cupo_maximo INT;

    SELECT cupo_actual, cupo_maximo
    INTO v_cupo_actual, v_cupo_maximo
    FROM deportes
    WHERE id_deporte = NEW.id_deporte;
    IF v_cupo_actual >= v_cupo_maximo THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Error: El cupo para este deporte está lleno.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes_contacto`
--

DROP TABLE IF EXISTS `mensajes_contacto`;
CREATE TABLE `mensajes_contacto` (
  `id_mensaje` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha_envio` datetime NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `mensajes_contacto`
--

INSERT INTO `mensajes_contacto` (`id_mensaje`, `nombre`, `email`, `telefono`, `mensaje`, `fecha_envio`, `estado`) VALUES
(1, 'Santiago', 'santiagodivirgilio073@gmail.com', '', 'Alta pagina re crack el lider', '0000-00-00 00:00:00', ''),
(2, 'Santiago', 'santiagodivirgilio073@gmail.com', '1140822338', 'Dotto crack', '0000-00-00 00:00:00', 'Sin Resolver');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

DROP TABLE IF EXISTS `pagos`;
CREATE TABLE `pagos` (
  `id_pago` int(11) NOT NULL,
  `mercadopago_payment_id` bigint(20) NOT NULL,
  `id_reserva` int(11) DEFAULT NULL,
  `status` varchar(30) NOT NULL,
  `transaction_amount` decimal(10,2) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_approved` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

DROP TABLE IF EXISTS `reservas`;
CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL,
  `id_cancha` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_pago` int(11) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `fecha_reserva` date NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `hora_inicio` int(11) NOT NULL,
  `hora_fin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id_usuario` int(5) NOT NULL,
  `nombre` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `dni` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha_alta` date NOT NULL,
  `rol` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_sesion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `clave`, `dni`, `email`, `telefono`, `fecha_alta`, `rol`, `id_sesion`) VALUES
(1, 'Santiago', '123456', '45316151', 'santiagodivirgilio073@gmail.com', '11 4082-2338', '2025-10-09', 'Admin', NULL),
(2, 'Mateo', '123123', '45919324', 'mateoalvarezsanjuan@hotmail.com', '1133204357', '0000-00-00', 'admin', NULL),
(3, 'Agustín', 'santitipazo', '46696151', 'agustincapi08@gmail.com', '1167589998', '2025-10-27', 'Admin', ''),
(5, 'Graff0', 'graffito', '12334', 'santiagodivirgilio074@gmail.com', '1140822338', '2025-10-31', 'usuario', ''),
(6, 'pepito', '1234', '12345789', 'santiagodivirgilio073@gmail.com', '1140822338', '2025-10-31', 'usuario', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `canchas`
--
ALTER TABLE `canchas`
  ADD PRIMARY KEY (`id_cancha`);

--
-- Indices de la tabla `deportes`
--
ALTER TABLE `deportes`
  ADD PRIMARY KEY (`id_deporte`);

--
-- Indices de la tabla `horario_cancha`
--
ALTER TABLE `horario_cancha`
  ADD PRIMARY KEY (`id_horario`),
  ADD KEY `id_cancha` (`id_cancha`);

--
-- Indices de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD PRIMARY KEY (`id_inscripcion`);

--
-- Indices de la tabla `mensajes_contacto`
--
ALTER TABLE `mensajes_contacto`
  ADD PRIMARY KEY (`id_mensaje`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `canchas`
--
ALTER TABLE `canchas`
  MODIFY `id_cancha` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `deportes`
--
ALTER TABLE `deportes`
  MODIFY `id_deporte` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `horario_cancha`
--
ALTER TABLE `horario_cancha`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  MODIFY `id_inscripcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `mensajes_contacto`
--
ALTER TABLE `mensajes_contacto`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
