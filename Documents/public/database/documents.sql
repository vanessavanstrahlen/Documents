-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-11-2023 a las 04:59:32
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `documents`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doc_documento`
--

CREATE TABLE `doc_documento` (
  `DOC_ID` int(11) NOT NULL,
  `DOC_NOMBRE` varchar(60) NOT NULL,
  `DOC_CODIGO` varchar(250) NOT NULL,
  `DOC_CONTENIDO` varchar(4000) NOT NULL,
  `DOC_ID_TIPO` int(11) NOT NULL,
  `DOC_ID_PROCESO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `doc_documento`
--

INSERT INTO `doc_documento` (`DOC_ID`, `DOC_NOMBRE`, `DOC_CODIGO`, `DOC_CONTENIDO`, `DOC_ID_TIPO`, `DOC_ID_PROCESO`) VALUES
(1, 'Inversiones Innclod', 'RPT-RH-1', '10 INVERSIONES HECHAS EL MES DE OCTUBRE', 12, 3),
(23, 'Desarrollo', 'INS-DEV-2', 'DESARROLLO DE APPS', 11, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pro_proceso`
--

CREATE TABLE `pro_proceso` (
  `PRO_ID` int(11) NOT NULL,
  `PRO_PREFIJO` varchar(20) NOT NULL,
  `PRO_NOMBRE` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pro_proceso`
--

INSERT INTO `pro_proceso` (`PRO_ID`, `PRO_PREFIJO`, `PRO_NOMBRE`) VALUES
(1, 'ING', 'Ingeniería'),
(2, 'MKT', 'Marketing'),
(3, 'RH', 'Recursos Humanos'),
(4, 'VTS', 'Ventas'),
(5, 'DEV', 'Desarrollo de Producto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tip_tipo_doc`
--

CREATE TABLE `tip_tipo_doc` (
  `TIP_ID` int(11) NOT NULL,
  `TIP_NOMBRE` varchar(60) NOT NULL,
  `TIP_PREFIJO` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tip_tipo_doc`
--

INSERT INTO `tip_tipo_doc` (`TIP_ID`, `TIP_NOMBRE`, `TIP_PREFIJO`) VALUES
(11, 'Instructivo', 'INS'),
(12, 'Reporte', 'RPT'),
(13, 'Contrato', 'CTR'),
(14, 'Factura', 'FAC'),
(15, 'Certificado', 'CER');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `CEDULA_ID` int(50) NOT NULL,
  `USUARIO` varchar(60) NOT NULL,
  `PASSWORD` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`CEDULA_ID`, `USUARIO`, `PASSWORD`) VALUES
(1234, 'PruebaT', 'Prueba611');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `doc_documento`
--
ALTER TABLE `doc_documento`
  ADD PRIMARY KEY (`DOC_ID`),
  ADD KEY `DOC_ID_TIPO` (`DOC_ID_TIPO`),
  ADD KEY `DOC_ID_PROCESO` (`DOC_ID_PROCESO`);

--
-- Indices de la tabla `pro_proceso`
--
ALTER TABLE `pro_proceso`
  ADD PRIMARY KEY (`PRO_ID`);

--
-- Indices de la tabla `tip_tipo_doc`
--
ALTER TABLE `tip_tipo_doc`
  ADD PRIMARY KEY (`TIP_ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`CEDULA_ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `doc_documento`
--
ALTER TABLE `doc_documento`
  MODIFY `DOC_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `pro_proceso`
--
ALTER TABLE `pro_proceso`
  MODIFY `PRO_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tip_tipo_doc`
--
ALTER TABLE `tip_tipo_doc`
  MODIFY `TIP_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `doc_documento`
--
ALTER TABLE `doc_documento`
  ADD CONSTRAINT `doc_documento_ibfk_1` FOREIGN KEY (`DOC_ID_TIPO`) REFERENCES `tip_tipo_doc` (`TIP_ID`),
  ADD CONSTRAINT `doc_documento_ibfk_2` FOREIGN KEY (`DOC_ID_PROCESO`) REFERENCES `pro_proceso` (`PRO_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
