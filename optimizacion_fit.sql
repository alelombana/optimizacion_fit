-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-06-2024 a las 21:20:55
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
-- Base de datos: `optimizacion_fit`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id_asistencia` int(11) NOT NULL,
  `aprendizT` int(11) DEFAULT NULL,
  `asis_turno` enum('ASISTIO','NO ASISTIO','CANCELO') DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id_asistencia`, `aprendizT`, `asis_turno`, `fecha`, `hora`) VALUES
(2, 123, 'ASISTIO', '2024-06-19', '08:00:00'),
(3, 123, 'ASISTIO', '2024-06-20', '07:00:00'),
(4, 123, 'ASISTIO', '2024-06-21', '08:00:00'),
(5, 789, 'ASISTIO', '2024-06-19', '07:00:00'),
(6, 789, 'ASISTIO', '2024-06-21', '08:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centro`
--

CREATE TABLE `centro` (
  `id_cen` int(11) NOT NULL,
  `nombre_cen` varchar(50) DEFAULT NULL,
  `gimnasio_cen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `centro`
--

INSERT INTO `centro` (`id_cen`, `nombre_cen`, `gimnasio_cen`) VALUES
(1, 'centro de diseño y metrologia', NULL),
(2, 'hoteleria, turismo y alimentos', NULL),
(3, 'cenigraf', NULL),
(4, 'gestion industrial', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha`
--

CREATE TABLE `ficha` (
  `id_fic` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ficha`
--

INSERT INTO `ficha` (`id_fic`) VALUES
(2740648),
(2840648);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gimnasio`
--

CREATE TABLE `gimnasio` (
  `id_gim` int(11) NOT NULL,
  `cap_maxima` int(11) DEFAULT NULL,
  `cap_actual` int(11) DEFAULT NULL,
  `estado` enum('ABIERTO','CERRADO') DEFAULT NULL,
  `maquinas` int(11) DEFAULT NULL,
  `novedades` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horas`
--

CREATE TABLE `horas` (
  `id_horas` int(11) NOT NULL,
  `asistencia_h` int(11) DEFAULT NULL,
  `usuario_h` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maquinas`
--

CREATE TABLE `maquinas` (
  `id_maq` int(11) NOT NULL,
  `maq_descripcion` text DEFAULT NULL,
  `maq_nombre` varchar(30) DEFAULT NULL,
  `maq_estado` enum('DISPONIBLE','FUERA DE SERVICIO') DEFAULT NULL,
  `tmini` int(11) DEFAULT NULL,
  `tmax` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `maquinas`
--

INSERT INTO `maquinas` (`id_maq`, `maq_descripcion`, `maq_nombre`, `maq_estado`, `tmini`, `tmax`) VALUES
(1, 'Una cinta de correr (también cinta ergométrica, caminadora de banda, trotadora, cinta de andar o máquina de caminar) es una máquina para entrenamiento físico que puede funcionar mediante propulsión eléctrica o manual, y que sirve para correr o andar sin moverse de un mismo sitio', 'caminadora', 'FUERA DE SERVICIO', 20, 30),
(2, 'La bicicleta estática es la opción ideal para ponerse en forma en casa o en el gimnasio en poco tiempo. Es más sencillo que correr en una cinta, cansa menos, y puedes ir al ritmo que quieras. Además, se queman muchas calorías, sobre todo, si realizas una clase de spinning', 'Bicicleta estática', 'DISPONIBLE', 10, 20),
(3, 'Una mancuerna es una pieza de equipamiento utilizada en el entrenamiento con pesas, es un tipo de peso libre. Pueden utilizarse individualmente o por parejas (una en cada mano). Mancuerna ajustable con tuercas.', 'Mancuerna', 'DISPONIBLE', 10, 30),
(4, 'Las multipower o máquinas Smith son aparatos de musculación avanzados. Permiten multitud de ejercicios y poner en funcionamiento grandes grupos musculares. Son una buena opción para alternar con el levantamiento de peso libre, y muy recomendables para personas con un recorrido largo de ejercicio y entrenamiento.', 'Multipower', 'DISPONIBLE', 10, 20),
(5, 'Consiste en una barra de metal a la que se acoplan pesos, normalmente en forma de discos. Estas tienen un tamaño entre los 1,2 y 2,2 metros y su diámetro puede variar, pero lo más habitual es que sea próximo a 2,5 cm. Las más comunes son las de 150, 180 y 220', 'Barras', 'DISPONIBLE', 10, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novedades`
--

CREATE TABLE `novedades` (
  `id_nov` int(11) NOT NULL,
  `titulo` varchar(50) DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

CREATE TABLE `reportes` (
  `id_repor` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `reporte` text DEFAULT NULL,
  `id_usu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `rol` enum('INSTRUCTOR','ADMINISTRADOR','APRENDIZ') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `rol`) VALUES
(1, 'APRENDIZ'),
(2, 'INSTRUCTOR'),
(3, 'ADMINISTRADOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno`
--

CREATE TABLE `turno` (
  `id_turno` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `turno_usu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `turno`
--

INSERT INTO `turno` (`id_turno`, `fecha`, `hora_inicio`, `turno_usu`) VALUES
(1, '2024-06-20', '08:00:00', 123),
(61, '2024-06-21', '08:00:00', 1234),
(62, '2024-06-21', '08:00:00', 1234),
(63, '2024-06-21', '08:00:00', 1234),
(64, '2024-06-21', '08:00:00', 1234),
(65, '2024-06-21', '08:00:00', 1234),
(66, '2024-06-21', '08:00:00', 1234),
(67, '2024-06-21', '08:00:00', 1234),
(68, '2024-06-21', '08:00:00', 1234),
(69, '2024-06-21', '08:00:00', 1234),
(70, '2024-06-21', '08:00:00', 1234),
(71, '2024-06-21', '08:00:00', 1234),
(72, '2024-06-21', '08:00:00', 1234),
(73, '2024-06-21', '08:00:00', 1234),
(74, '2024-06-21', '08:00:00', 1234),
(75, '2024-06-21', '08:00:00', 1234),
(77, '2024-06-21', '09:00:00', 123);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usu` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `clave` varchar(15) DEFAULT NULL,
  `centro` int(11) DEFAULT NULL,
  `ficha` int(11) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usu`, `nombre`, `apellido`, `clave`, `centro`, `ficha`, `correo`, `id_rol`, `edad`) VALUES
(123, 'hola', 'mundo', '12', 4, 2740648, 'c1@gmail.com', 1, 20),
(456, 'hgshs', '45+', '123', 2, 2740648, 'c1@gmail.com', 1, 20),
(789, '456', '45+', '123', 2, 2740648, 'c1@gmail.com', 1, 18),
(1234, 'cc', 'cc', '123', 1, 2840648, 'cc@gmail.com', 1, 20);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id_asistencia`),
  ADD KEY `instructor` (`aprendizT`);

--
-- Indices de la tabla `centro`
--
ALTER TABLE `centro`
  ADD PRIMARY KEY (`id_cen`),
  ADD KEY `gimnasio_cen` (`gimnasio_cen`);

--
-- Indices de la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD PRIMARY KEY (`id_fic`);

--
-- Indices de la tabla `gimnasio`
--
ALTER TABLE `gimnasio`
  ADD PRIMARY KEY (`id_gim`),
  ADD KEY `maquinas` (`maquinas`),
  ADD KEY `novedades` (`novedades`);

--
-- Indices de la tabla `horas`
--
ALTER TABLE `horas`
  ADD PRIMARY KEY (`id_horas`),
  ADD KEY `asistencia_h` (`asistencia_h`),
  ADD KEY `usuario_h` (`usuario_h`);

--
-- Indices de la tabla `maquinas`
--
ALTER TABLE `maquinas`
  ADD PRIMARY KEY (`id_maq`);

--
-- Indices de la tabla `novedades`
--
ALTER TABLE `novedades`
  ADD PRIMARY KEY (`id_nov`);

--
-- Indices de la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD PRIMARY KEY (`id_repor`),
  ADD KEY `fk_reportes_usuarios` (`id_usu`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `turno`
--
ALTER TABLE `turno`
  ADD PRIMARY KEY (`id_turno`),
  ADD KEY `turno_usu` (`turno_usu`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usu`),
  ADD KEY `ficha` (`ficha`),
  ADD KEY `centro` (`centro`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id_asistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `centro`
--
ALTER TABLE `centro`
  MODIFY `id_cen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ficha`
--
ALTER TABLE `ficha`
  MODIFY `id_fic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2840649;

--
-- AUTO_INCREMENT de la tabla `gimnasio`
--
ALTER TABLE `gimnasio`
  MODIFY `id_gim` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `horas`
--
ALTER TABLE `horas`
  MODIFY `id_horas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `maquinas`
--
ALTER TABLE `maquinas`
  MODIFY `id_maq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `novedades`
--
ALTER TABLE `novedades`
  MODIFY `id_nov` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `id_repor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `turno`
--
ALTER TABLE `turno`
  MODIFY `id_turno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10246;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`aprendizT`) REFERENCES `usuarios` (`id_usu`);

--
-- Filtros para la tabla `centro`
--
ALTER TABLE `centro`
  ADD CONSTRAINT `centro_ibfk_1` FOREIGN KEY (`gimnasio_cen`) REFERENCES `gimnasio` (`id_gim`);

--
-- Filtros para la tabla `gimnasio`
--
ALTER TABLE `gimnasio`
  ADD CONSTRAINT `gimnasio_ibfk_1` FOREIGN KEY (`maquinas`) REFERENCES `maquinas` (`id_maq`),
  ADD CONSTRAINT `gimnasio_ibfk_2` FOREIGN KEY (`novedades`) REFERENCES `novedades` (`id_nov`);

--
-- Filtros para la tabla `horas`
--
ALTER TABLE `horas`
  ADD CONSTRAINT `horas_ibfk_1` FOREIGN KEY (`asistencia_h`) REFERENCES `asistencia` (`id_asistencia`),
  ADD CONSTRAINT `horas_ibfk_2` FOREIGN KEY (`usuario_h`) REFERENCES `usuarios` (`id_usu`);

--
-- Filtros para la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD CONSTRAINT `fk_reportes_usuarios` FOREIGN KEY (`id_usu`) REFERENCES `usuarios` (`id_usu`);

--
-- Filtros para la tabla `turno`
--
ALTER TABLE `turno`
  ADD CONSTRAINT `turno_ibfk_1` FOREIGN KEY (`turno_usu`) REFERENCES `usuarios` (`id_usu`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`ficha`) REFERENCES `ficha` (`id_fic`),
  ADD CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`centro`) REFERENCES `centro` (`id_cen`),
  ADD CONSTRAINT `usuarios_ibfk_4` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
