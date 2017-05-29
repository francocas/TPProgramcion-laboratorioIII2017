-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2017 a las 17:51:48
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `estacionamiento`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `Nombre` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Apellido` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Contraseña` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `HorarioDeEntrada` varchar(10) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `HorarioDeSalida` varchar(10) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informes`
--

CREATE TABLE `informes` (
  `idLugar` int(11) NOT NULL,
  `PatenteAuto` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `ColorAuto` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `ModeloAuto` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `idInforme` int(11) NOT NULL,
  `HorarioEntrada` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `HorarioSalida` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `UsuarioIngreso` int(11) NOT NULL,
  `UsuarioSalida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugares`
--

CREATE TABLE `lugares` (
  `id` int(11) NOT NULL,
  `Piso` int(11) NOT NULL,
  `FlagOcupado` tinyint(1) NOT NULL,
  `LugarEspecial` tinyint(1) NOT NULL,
  `PatenteAuto` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `ColorAuto` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `ModeloAuto` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `HorarioEntrada` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `HorarioSalida` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `informes`
--
ALTER TABLE `informes`
  ADD PRIMARY KEY (`idInforme`);

--
-- Indices de la tabla `lugares`
--
ALTER TABLE `lugares`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `informes`
--
ALTER TABLE `informes`
  MODIFY `idInforme` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `lugares`
--
ALTER TABLE `lugares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
