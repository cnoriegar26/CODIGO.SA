-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-05-2018 a las 16:24:35
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hindudb`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `agregar_cant` (IN `cantidad` INT(11), IN `codigo` INT(11))  NO SQL
BEGIN
DECLARE precio_p int;
DECLARE codigo_factura int;
DECLARE valor int;
DECLARE result int;
SELECT p.precio_prod, d.codigo_fact, d.precio_deta INTO precio_p, codigo_factura, valor FROM producto p, stock st, detalle_factura d WHERE d.codigo_deta=codigo and st.codigo_stoc=d.codigo_stoc and p.codigo_prod=st.codigo_prod;

update facturas f SET f.total_fact=f.total_fact-valor WHERE f.codigo_fact=codigo_factura;
set result=precio_p*cantidad;
update facturas f SET f.total_fact=f.total_fact+result WHERE f.codigo_fact=codigo_factura;
UPDATE detalle_factura d SET d.cantidad_deta=cantidad, d.precio_deta=result WHERE d.codigo_deta=codigo;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_car` (IN `codigo` INT(11))  NO SQL
BEGIN
DECLARE precio INT;
DECLARE codigo_factura int;
SELECT d.codigo_fact, d.precio_deta into codigo_factura, precio from detalle_factura d WHERE d.codigo_deta=codigo;
UPDATE facturas f set f.total_fact=f.total_fact-precio WHERE f.codigo_fact=codigo_factura;
DELETE FROM detalle_factura WHERE codigo_deta=codigo;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `backup`
--

CREATE TABLE `backup` (
  `codigo_back` int(11) NOT NULL,
  `fechahora_back` datetime DEFAULT NULL,
  `codigo_usua` int(11) NOT NULL,
  `url_back` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `codigo_comp` int(11) NOT NULL,
  `nit_prov` varchar(15) NOT NULL,
  `valor_comp` double NOT NULL,
  `fecha_comp` date NOT NULL,
  `url_comp` varchar(45) NOT NULL,
  `codigo_usua` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `codigo_conf` int(11) NOT NULL,
  `consecutivo_inic_conf` varchar(20) NOT NULL,
  `consecutivo_fina_conf` varchar(20) NOT NULL,
  `consecutivo_actu_conf` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`codigo_conf`, `consecutivo_inic_conf`, `consecutivo_fina_conf`, `consecutivo_actu_conf`) VALUES
(1, '1', '10000', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

CREATE TABLE `detalle_factura` (
  `codigo_deta` int(11) NOT NULL,
  `cantidad_deta` int(11) NOT NULL,
  `precio_deta` double NOT NULL,
  `codigo_fact` int(11) NOT NULL,
  `codigo_stoc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `nit_empr` int(11) NOT NULL,
  `nombre_empr` varchar(50) NOT NULL,
  `direccion_empr` varchar(100) DEFAULT NULL,
  `telefono_empr` varchar(15) NOT NULL,
  `correo_empr` varchar(100) DEFAULT NULL,
  `mision` text NOT NULL,
  `vision` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`nit_empr`, `nombre_empr`, `direccion_empr`, `telefono_empr`, `correo_empr`, `mision`, `vision`) VALUES
(1065902232, 'palacio hindu', 'Carrera 16 N° 3-21 Aguachica-Cesar', '5650389', 'palacio@gmail.com', 'En nuestros negocios de productos esotéricos buscamos siempre mejorar la calidad de vida de nuestros clientes y el progreso de nuestra gente.\r\n\r\nBuscamos el crecimiento rentable de nuestros clientes c', 'Nuestra estrategia está dirigida a duplicar al año 2025, las ventas del año 2018, con una rentabilidad sostenida entre el 12 y el 14%. Para lograrla nuestra visión ofrecemos a nuestros clientes la may');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `codigo_fact` int(11) NOT NULL,
  `total_fact` double NOT NULL,
  `estado_fact` int(11) NOT NULL,
  `fecha_hora_fact` date NOT NULL,
  `documento_pers` varchar(15) NOT NULL,
  `codigo_usua` int(11) NOT NULL,
  `url_fact` varchar(45) NOT NULL,
  `numero_fact` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `documento_pers` varchar(15) NOT NULL,
  `nombre_pers` varchar(100) NOT NULL,
  `telefono_pers` varchar(12) NOT NULL,
  `direccion_pers` varchar(50) DEFAULT NULL,
  `email_pers` varchar(100) NOT NULL,
  `fechanac_pers` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`documento_pers`, `nombre_pers`, `telefono_pers`, `direccion_pers`, `email_pers`, `fechanac_pers`) VALUES
('1234567', 'admin', '1234567', 'admin', 'admin@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `codigo_prod` int(11) NOT NULL,
  `nombre_prod` varchar(100) NOT NULL,
  `descripcion_prod` varchar(500) DEFAULT NULL,
  `precio_prod` varchar(20) NOT NULL,
  `codigo_tipo` int(11) NOT NULL,
  `imagen_prod` varchar(200) NOT NULL,
  `estado_prod` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_proveedores`
--

CREATE TABLE `productos_proveedores` (
  `codigo_prod_prov` int(11) NOT NULL,
  `codigo_prod` int(11) NOT NULL,
  `nit_prov` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `nit_prov` varchar(15) NOT NULL,
  `nombre_prov` varchar(100) NOT NULL,
  `direccion_prov` varchar(50) DEFAULT NULL,
  `telefono_prov` varchar(12) NOT NULL,
  `correo_prov` varchar(100) NOT NULL,
  `descripcion_prov` varchar(500) DEFAULT NULL,
  `estado_prov` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE `stock` (
  `codigo_stoc` int(11) NOT NULL,
  `cantidad_stoc` int(11) DEFAULT NULL,
  `fecha_venc_stoc` date DEFAULT NULL,
  `codigo_prod` int(11) NOT NULL,
  `nit_prov` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `codigo_tipo` int(11) NOT NULL,
  `nombre_tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`codigo_tipo`, `nombre_tipo`) VALUES
(1, 'Esencias'),
(2, 'Extractos'),
(3, 'Perfumes'),
(4, 'Colonias'),
(5, 'Lociones'),
(6, 'Veladoras'),
(7, 'Velas'),
(8, 'Jabones'),
(9, 'Plantas medicinales'),
(10, 'Amuletos'),
(11, 'Pomadas medicinales'),
(12, 'Aceites'),
(13, 'Sahumerios'),
(14, 'Baños'),
(15, 'Riegos'),
(16, 'Despojos'),
(17, 'Imágenes en Cuadros'),
(18, 'Santos'),
(19, 'Sales zodiacales'),
(20, 'Purgantes'),
(21, 'Libros'),
(22, 'Novenas'),
(23, 'Oraciones'),
(24, 'Imágenes de estampas'),
(25, 'Polvos esotéricos'),
(26, 'Tabacos'),
(27, 'Medicina natural');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `codigo_usua` int(11) NOT NULL,
  `contrasena_usua` varchar(20) NOT NULL,
  `rol_usua` int(11) NOT NULL,
  `documento_pers` varchar(15) NOT NULL,
  `estado_usua` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`codigo_usua`, `contrasena_usua`, `rol_usua`, `documento_pers`, `estado_usua`) VALUES
(1, '123456', 0, '1234567', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `backup`
--
ALTER TABLE `backup`
  ADD PRIMARY KEY (`codigo_back`),
  ADD KEY `usua_back_idx` (`codigo_usua`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`codigo_comp`),
  ADD KEY `prov_comp_idx` (`nit_prov`),
  ADD KEY `usua_comp_idx` (`codigo_usua`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`codigo_conf`);

--
-- Indices de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD PRIMARY KEY (`codigo_deta`),
  ADD KEY `fact_deta_idx` (`codigo_fact`),
  ADD KEY `stoc_detalle_fact_idx` (`codigo_stoc`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`nit_empr`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`codigo_fact`),
  ADD KEY `pers_fact_idx` (`documento_pers`),
  ADD KEY `codigo_usua_idx` (`codigo_usua`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`documento_pers`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`codigo_prod`),
  ADD KEY `tipo_prod_idx` (`codigo_tipo`);

--
-- Indices de la tabla `productos_proveedores`
--
ALTER TABLE `productos_proveedores`
  ADD PRIMARY KEY (`codigo_prod_prov`),
  ADD KEY `prove_prod_prov_idx` (`nit_prov`),
  ADD KEY `prod_prod_prov_idx` (`codigo_prod`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`nit_prov`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`codigo_stoc`),
  ADD KEY `prod_stoc_idx` (`codigo_prod`),
  ADD KEY `prov_stoc_idx` (`nit_prov`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`codigo_tipo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`codigo_usua`),
  ADD KEY `pers_usua_idx` (`documento_pers`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `backup`
--
ALTER TABLE `backup`
  MODIFY `codigo_back` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `codigo_comp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `codigo_conf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  MODIFY `codigo_deta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `codigo_fact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `codigo_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos_proveedores`
--
ALTER TABLE `productos_proveedores`
  MODIFY `codigo_prod_prov` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `codigo_stoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `codigo_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `codigo_usua` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `backup`
--
ALTER TABLE `backup`
  ADD CONSTRAINT `usua_back` FOREIGN KEY (`codigo_usua`) REFERENCES `usuarios` (`codigo_usua`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `prov_comp` FOREIGN KEY (`nit_prov`) REFERENCES `proveedores` (`nit_prov`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usua_comp` FOREIGN KEY (`codigo_usua`) REFERENCES `usuarios` (`codigo_usua`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD CONSTRAINT `fact_deta` FOREIGN KEY (`codigo_fact`) REFERENCES `facturas` (`codigo_fact`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stoc_detalle_fact` FOREIGN KEY (`codigo_stoc`) REFERENCES `stock` (`codigo_stoc`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `codigo_usua` FOREIGN KEY (`codigo_usua`) REFERENCES `usuarios` (`codigo_usua`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pers_fact` FOREIGN KEY (`documento_pers`) REFERENCES `persona` (`documento_pers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `tipo_prod` FOREIGN KEY (`codigo_tipo`) REFERENCES `tipo` (`codigo_tipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos_proveedores`
--
ALTER TABLE `productos_proveedores`
  ADD CONSTRAINT `prod_prod_prov` FOREIGN KEY (`codigo_prod`) REFERENCES `producto` (`codigo_prod`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prove_prod_prov` FOREIGN KEY (`nit_prov`) REFERENCES `proveedores` (`nit_prov`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `prod_stoc` FOREIGN KEY (`codigo_prod`) REFERENCES `producto` (`codigo_prod`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prov_stoc` FOREIGN KEY (`nit_prov`) REFERENCES `proveedores` (`nit_prov`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `pers_usua` FOREIGN KEY (`documento_pers`) REFERENCES `persona` (`documento_pers`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
