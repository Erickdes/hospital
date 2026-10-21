-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3308
-- Tiempo de generación: 21-10-2026 a las 20:46:09
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hospital_1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cirugias`
--

CREATE TABLE `cirugias` (
  `id` int(11) NOT NULL,
  `nombre_cirugia` varchar(255) DEFAULT NULL,
  `id_medico` int(11) DEFAULT NULL,
  `id_sala` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `id_jefePiso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cirugias`
--

INSERT INTO `cirugias` (`id`, `nombre_cirugia`, `id_medico`, `id_sala`, `fecha`, `id_jefePiso`) VALUES
(502, 'rinoplastia', 7, 101, '2025-04-01', 3),
(503, 'RECONSTRUCCION DE huesos', 6, 102, '0001-01-01', 3),
(504, 'laparoscopia', 5, 104, '2025-03-24', 4),
(505, 'laparoscopia inginal', 7, 104, '2025-03-31', 3),
(506, 'colocacion de bypass', 6, 100, '0001-01-01', 4),
(507, 'kkok', 5, 100, '0001-01-01', 3),
(508, 'colocacion de bypassddddddddsffffffffffffff', 6, 102, '2025-03-19', 4),
(509, 'Upiita', 7, 103, '2025-03-31', 4),
(510, 'ssssssssssssssss', 7, 100, '2025-03-25', 3),
(511, 'qqqqq', 6, 100, '2025-03-27', 3),
(512, 'QQ', 7, 102, '2025-03-27', 4),
(513, 'upiita', 7, 102, '2025-07-18', 4);

--
-- Disparadores `cirugias`
--
DELIMITER $$
CREATE TRIGGER `before_insert_cirugias` BEFORE INSERT ON `cirugias` FOR EACH ROW BEGIN
    -- Verificar si el id_jefePiso pertenece a un usuario con puesto "jefe_piso"
    IF NEW.id_jefePiso IS NOT NULL AND NOT EXISTS (
        SELECT 1 FROM usuarios WHERE id = NEW.id_jefePiso AND puesto = 'jefe_piso'
    ) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El id_jefePiso debe ser un usuario con el puesto "jefe_piso"';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_cirugias` BEFORE UPDATE ON `cirugias` FOR EACH ROW BEGIN
    -- Verificar si el nuevo id_jefePiso pertenece a un usuario con puesto "jefe_piso"
    IF NEW.id_jefePiso IS NOT NULL AND NOT EXISTS (
        SELECT 1 FROM usuarios WHERE id = NEW.id_jefePiso AND puesto = 'jefe_piso'
    ) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El id_jefePiso debe ser un usuario con el puesto "jefe_piso"';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salas`
--

CREATE TABLE `salas` (
  `id` int(11) NOT NULL,
  `numero` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `salas`
--

INSERT INTO `salas` (`id`, `numero`) VALUES
(100, 1),
(101, 2),
(102, 3),
(103, 4),
(104, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `puesto` enum('cirujano','jefe_piso','jefe_unidad') DEFAULT NULL,
  `especialidad` varchar(100) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `usuario`, `contrasena`, `puesto`, `especialidad`, `fecha_inicio`) VALUES
(1, 'Carlos', 'Mendez', 'jefe_unidad1', '$2y$10$c/CYxhcNuN2ecnoq3w58nuqaeULSHcVAfJVOk4pUm6tpSrsOxJiYy', 'jefe_unidad', 'Cardiología', '2010-06-15'),
(2, 'Laura', 'Gomez', 'jefe_unidad2', '$2y$10$lrQ5gqX.Rkcv8e98xyWC4eDuSBwZdN3W//vFElGjqjQb/dGIzjwNG', 'jefe_unidad', 'Neurocirugía', '2012-09-10'),
(3, 'Ana', 'Lopez', 'jefe_piso1', '$2y$10$J73qmkKgNWPGimNM2gnWUOohpu1N.pS6vWE3QJ.FQBSeAzwFu0gD.', 'jefe_piso', 'Cirugía General', '2014-05-20'),
(4, 'Luis', 'Martinez', 'jefe_piso2', '$2y$10$zOPm5D8SrcVTbV2ydtYTD.bsp9gEagmtGzdwvu98spn9Rj/aU0YC.', 'jefe_piso', 'Ortopedia', '2016-11-10'),
(5, 'Juan', 'Perez', 'cirujano1', '$2y$10$ODw/YfwpCUxcEeP5xF.ZcOlvaclSHyvqGOm4V/snuiWFQXo9es7am', 'cirujano', 'Cirugía General', '2018-02-01'),
(6, 'Pedro', 'Ramirez', 'cirujano2', '$2y$10$AGPrZMWNesyvJ53crqJ5cejmuYZKvDRDzcS6IdI2x7wFRLmlbe0lm', 'cirujano', 'Neurocirugía', '2017-08-15'),
(7, 'Maria', 'Sanchez', 'cirujano3', '$2y$10$K7d5GG0ybSWZtspOwe/0R.ldwd7UCRyHV5/lRhLL04ksvjf/h/7mu', 'cirujano', 'Cardiología', '2019-04-18'),
(11, 'AndreaAGUAS', 'TorresAGUA', 'cirujano4', '$2y$10$nrmdKQ3kqcgPrZwPaRfumusKqxotE4GPIiFAK.dvPBMuzhCHXNQQG', 'cirujano', 'Cardiología', '2025-05-28');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cirugias`
--
ALTER TABLE `cirugias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_medico` (`id_medico`),
  ADD KEY `id_sala` (`id_sala`),
  ADD KEY `fk_jefe_piso` (`id_jefePiso`);

--
-- Indices de la tabla `salas`
--
ALTER TABLE `salas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero` (`numero`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cirugias`
--
ALTER TABLE `cirugias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=514;

--
-- AUTO_INCREMENT de la tabla `salas`
--
ALTER TABLE `salas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cirugias`
--
ALTER TABLE `cirugias`
  ADD CONSTRAINT `cirugias_ibfk_1` FOREIGN KEY (`id_medico`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `cirugias_ibfk_2` FOREIGN KEY (`id_sala`) REFERENCES `salas` (`id`),
  ADD CONSTRAINT `fk_jefe_piso` FOREIGN KEY (`id_jefePiso`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
