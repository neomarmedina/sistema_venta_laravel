-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-06-2020 a las 05:01:38
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbventaslaravel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE `articulo` (
  `idarticulo` int(11) NOT NULL,
  `idcategoria` int(11) NOT NULL,
  `idtalla` int(11) DEFAULT NULL,
  `codigo` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `stock` float NOT NULL,
  `descripcion` varchar(512) COLLATE utf8_spanish_ci DEFAULT NULL,
  `marca` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `modelo` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `unidad_medida` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`idarticulo`, `idcategoria`, `idtalla`, `codigo`, `nombre`, `stock`, `descripcion`, `marca`, `modelo`, `unidad_medida`, `imagen`, `estado`) VALUES
(38, 6, 24, '123ABCD', 'COLONIA', 100, 'FRAGANCIA', 'NORVEN', '0109', 'DOCENAS', 'sinimagen.jpg', 'Activo'),
(39, 6, 25, '0909', 'DESODORANTE', 96, 'DESODORANTE', 'NORVEN', 'A233R', 'DOCENA', 'sinimagen.jpg', 'Activo'),
(40, 7, 24, 'P100', 'BOLSAS PLASTICAS 1/4 TETA', 90, 'BOLSAS PLASTICAS 1/4 TETA 10X100', 'NO POSEE', 'NO POSEE', 'MILLAR', 'sinimagen.jpg', 'Activo'),
(41, 8, 24, '009', 'LEGGINS', 105, 'CORTO', 'ADIDAS', 'ACTUALES', 'UINIDAD', 'sinimagen.jpg', 'Activo'),
(42, 8, 24, '1000', 'shorts', 50, 'mm', 'ADIIDAS', 'NNNN', 'UNIDAD', 'sinimagen.jpg', 'Activo'),
(43, 6, 24, '89', 'PROBANDO', 100, 'LLL', 'JHJH', 'HJHJ', 'UNIDAD', 'sinimagen.jpg', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(256) COLLATE utf8_spanish_ci DEFAULT NULL,
  `condicion` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nombre`, `descripcion`, `condicion`) VALUES
(6, 'PRODUCTOS PARA EL CUERPO', 'PRODUCTOS PARA EL CUERPO', 1),
(7, 'BOLSAS', 'BOLSAS PLASTICAS', 1),
(8, 'Ropas', 'Ropas en general', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_devolucion`
--

CREATE TABLE `detalle_devolucion` (
  `iddetalle_devolucion` int(11) NOT NULL,
  `iddevolucion` int(11) NOT NULL,
  `iddetalle_venta` int(11) NOT NULL,
  `idarticulo` int(11) NOT NULL,
  `cantidadnueva` float NOT NULL,
  `precio_venta` decimal(10,0) NOT NULL,
  `observaciones` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_devolucion`
--

INSERT INTO `detalle_devolucion` (`iddetalle_devolucion`, `iddevolucion`, `iddetalle_venta`, `idarticulo`, `cantidadnueva`, `precio_venta`, `observaciones`) VALUES
(20, 20, 63, 38, 1, '150', 'producto defectuoso'),
(21, 21, 65, 38, 1, '150', 'producto defectuoso'),
(22, 21, 64, 39, 1, '150', 'producto defectuoso'),
(23, 22, 67, 39, 1, '150', 'producto defectuoso'),
(24, 23, 71, 39, 1, '150', 'PRODUCTO DEFECTUDOSO');

--
-- Disparadores `detalle_devolucion`
--
DELIMITER $$
CREATE TRIGGER `tr_updStockDevolucion` AFTER INSERT ON `detalle_devolucion` FOR EACH ROW BEGIN
    UPDATE articulo SET stock = stock + NEW.cantidadnueva
    WHERE articulo.idarticulo = NEW.idarticulo;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ingreso`
--

CREATE TABLE `detalle_ingreso` (
  `iddetalle_ingreso` int(11) NOT NULL,
  `idingreso` int(11) NOT NULL,
  `idarticulo` int(11) NOT NULL,
  `cantidad` float NOT NULL,
  `precio_compra` decimal(11,2) NOT NULL,
  `precio_venta` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_ingreso`
--

INSERT INTO `detalle_ingreso` (`iddetalle_ingreso`, `idingreso`, `idarticulo`, `cantidad`, `precio_compra`, `precio_venta`) VALUES
(28, 28, 38, 100, '100.00', '150.00'),
(29, 29, 39, 100, '100.00', '150.00'),
(30, 30, 40, 100, '100.00', '150.00'),
(31, 31, 41, 5, '20000.00', '35000.00');

--
-- Disparadores `detalle_ingreso`
--
DELIMITER $$
CREATE TRIGGER `tr_updStockIngreso` AFTER INSERT ON `detalle_ingreso` FOR EACH ROW BEGIN
 	 UPDATE articulo SET stock = stock + NEW.cantidad
     where articulo.idarticulo = NEW.idarticulo;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `iddetalle_venta` int(11) NOT NULL,
  `idventa` int(11) NOT NULL,
  `idarticulo` int(11) NOT NULL,
  `cantidad` float NOT NULL,
  `precio_venta` decimal(11,2) NOT NULL,
  `descuento` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`iddetalle_venta`, `idventa`, `idarticulo`, `cantidad`, `precio_venta`, `descuento`) VALUES
(63, 67, 38, 0, '150.00', '0.00'),
(64, 68, 39, 0, '150.00', '75.00'),
(65, 68, 38, 0, '150.00', '75.00'),
(66, 69, 39, 2, '150.00', '0.00'),
(67, 70, 39, 0, '150.00', '0.00'),
(68, 71, 39, 1, '150.00', '0.00'),
(69, 72, 39, 1, '150.00', '0.00'),
(70, 73, 40, 10, '150.00', '0.00'),
(71, 74, 39, 0, '150.00', '75.00');

--
-- Disparadores `detalle_venta`
--
DELIMITER $$
CREATE TRIGGER `tr_updStockVenta` AFTER INSERT ON `detalle_venta` FOR EACH ROW BEGIN
 	 UPDATE articulo SET stock = stock - NEW.cantidad
     where articulo.idarticulo = NEW.idarticulo;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devolucion`
--

CREATE TABLE `devolucion` (
  `iddevolucion` int(11) NOT NULL,
  `idventa` int(11) NOT NULL,
  `fecha_devolucion` date NOT NULL,
  `total_devolucion` decimal(11,0) NOT NULL,
  `tipo_devolucion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `estatus` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `devolucion`
--

INSERT INTO `devolucion` (`iddevolucion`, `idventa`, `fecha_devolucion`, `total_devolucion`, `tipo_devolucion`, `estatus`, `estado`) VALUES
(20, 67, '2019-12-18', '150', 'Parcial', 'Pendiente', 1),
(21, 68, '2019-12-18', '174', 'Parcial', 'Ejecutada', 1),
(22, 70, '2019-12-18', '174', 'Total', 'Ejecutada', 1),
(23, 74, '2020-02-19', '75', 'Total', 'Pendiente', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso`
--

CREATE TABLE `ingreso` (
  `idingreso` int(11) NOT NULL,
  `idproveedor` int(11) NOT NULL,
  `tipo_comprobante` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `serie_comprobante` varchar(7) COLLATE utf8_spanish_ci DEFAULT NULL,
  `num_comprobante` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `impuesto` decimal(4,2) NOT NULL,
  `estado` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ingreso`
--

INSERT INTO `ingreso` (`idingreso`, `idproveedor`, `tipo_comprobante`, `serie_comprobante`, `num_comprobante`, `fecha_hora`, `impuesto`, `estado`) VALUES
(28, 9, 'Factura', '1', '1', '2019-12-17 22:52:44', '16.00', 'A'),
(29, 9, 'Factura', '5', '5', '2019-12-18 10:56:59', '16.00', 'A'),
(30, 9, 'Factura', '12', '12', '2019-12-18 18:15:45', '16.00', 'A'),
(31, 9, 'Factura', '700', '701', '2020-02-19 17:49:42', '16.00', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_07_07_223315_crear_tabla_tipos_usuario', 2),
('2016_07_07_225615_update_table_users_V2', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota_credito`
--

CREATE TABLE `nota_credito` (
  `idnota_credito` int(11) NOT NULL,
  `idventa` int(11) NOT NULL,
  `iddevolucion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametros`
--

CREATE TABLE `parametros` (
  `idparametro` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `valor` decimal(10,0) NOT NULL,
  `descripcion` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `condicion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `parametros`
--

INSERT INTO `parametros` (`idparametro`, `codigo`, `nombre`, `valor`, `descripcion`, `condicion`) VALUES
(1, 1, 'I.V.A', '16', 'Este valor nos permite asignar el valor actual del IVA', 1),
(2, 2, 'N°.Factura', '150', 'Este es el valor iniciar de la factura', 1),
(3, 3, 'N°.Control', '100', 'Este es el valor iniciar del N°.Control', 1),
(4, 4, 'N°.Nota de Crédito', '500', 'Este es el valor inicial del N° . Nota de Crédito', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idpersona` int(11) NOT NULL,
  `tipo_persona` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_documento` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `num_documento` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(70) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `codigo` varchar(500) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idpersona`, `tipo_persona`, `nombre`, `tipo_documento`, `num_documento`, `direccion`, `telefono`, `email`, `codigo`) VALUES
(9, 'Proveedor', 'POLAR', 'RIF', 'RJ-1332666', 'CUMANA', '04128776868', 'POLAR@GMAIL.COM', '123441HGHG'),
(10, 'Cliente', 'NEOMAR', 'CI', '18621609', 'LOS CHAIMAS', '04128776868', 'neomedina800@gmail.com', '6101'),
(11, 'Cliente', 'NICOLAS SALAZAR', 'CI', '24874592', 'CUMANÁ', '04128606845', 'NESMKS326@GMAILCOM', 'N100');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `talla`
--

CREATE TABLE `talla` (
  `idtalla` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `condicion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `talla`
--

INSERT INTO `talla` (`idtalla`, `nombre`, `descripcion`, `condicion`) VALUES
(24, '35', '35', 1),
(25, '36', '36', 1),
(26, 'M', 'TALLA DE TRAJE DE BAÑOS', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tienda`
--

CREATE TABLE `tienda` (
  `idtienda` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(256) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(256) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `rif` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `condicion` tinyint(1) DEFAULT NULL,
  `codigo` varchar(500) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tienda`
--

INSERT INTO `tienda` (`idtienda`, `nombre`, `descripcion`, `direccion`, `telefono`, `rif`, `condicion`, `codigo`) VALUES
(8, 'INVERSIONES PLAST ALCA, C.A ', 'EMPRESA DE GOLOSINAS ', 'CALLE CASTELLOS CENTRO COMERCIAL SAN PEDRO ', '04128776868 ', 'V-18621609', 1, 'codigo neo'),
(9, 'neo', 'decripcion de calzados', 'direccion editado', '04128776868', 'V-18621609', 1, 'codigo 123abvneo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_usuario`
--

CREATE TABLE `tipos_usuario` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipos_usuario`
--

INSERT INTO `tipos_usuario` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'administrador', '2019-05-08 08:00:00', '2019-05-08 08:00:00'),
(2, 'vendedor', '2019-05-08 08:00:00', '2019-05-08 08:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `idtipo_usuario` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipoUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `tipoUsuario`) VALUES
(2, 'Neomar Medina ', 'neomedina800@gmail.com', '$2y$10$hIKAn7qMDT5IIfB7/B4BrueV81JqiBZpCeMh53Z9Ezn.OqnKx17eu', 'Rn2wPyuacddXJfFgLgepvzM8OsN3j9ZFsg0lv4BWSmP1WSYmVhz1G55bSz7K', '2019-05-07 15:27:14', '2020-02-27 02:11:23', 1),
(4, 'Camilo Arias', 'camilo@gmail.com', '$2y$10$ibknHDFAjeW10x4RvGqlX.9S7sxwuGMKL3Tvw1hlvTcD6EBA8ERmK', NULL, '2020-02-19 23:06:47', '2020-02-19 23:06:47', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedor`
--

CREATE TABLE `vendedor` (
  `idvendedor` int(11) NOT NULL,
  `tipo_vendedor` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_documento` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `num_documento` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(70) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `comision` varchar(500) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `vendedor`
--

INSERT INTO `vendedor` (`idvendedor`, `tipo_vendedor`, `nombre`, `tipo_documento`, `num_documento`, `direccion`, `telefono`, `email`, `comision`) VALUES
(7, 'Activo', 'JOSE ', 'CI', '18621766', 'DIRECCION', '04127865436', 'JOSE@GMAIL.COM', '5'),
(8, 'Activo', 'ARGENIS', 'CI', '187645625', 'DIRECCION', '041257676', 'ARGENI@GMAIL.COM', '5'),
(9, 'Activo', 'ARGENIS', 'CI', '187645625', 'DIRECCION', '041257676', 'ARGENI@GMAIL.COM', '5'),
(10, 'Activo', 'camilo', 'CI', '989', 'jjj', '8988', 'camilo@gmail.com', '5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `idventa` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `idvendedor` int(11) NOT NULL,
  `idtienda` int(11) NOT NULL,
  `tipo_comprobante` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `serie_comprobante` varchar(7) COLLATE utf8_spanish_ci NOT NULL,
  `num_comprobante` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_hora` date NOT NULL,
  `impuesto` decimal(4,2) NOT NULL,
  `total_venta` decimal(11,2) NOT NULL,
  `estado` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `estatus_venta` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_pagada` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`idventa`, `idcliente`, `idvendedor`, `idtienda`, `tipo_comprobante`, `serie_comprobante`, `num_comprobante`, `fecha_hora`, `impuesto`, `total_venta`, `estado`, `estatus_venta`, `fecha_pagada`) VALUES
(67, 10, 7, 8, 'Nota de Entrega', '501', '1', '2019-12-17', '18.00', '0.00', 'A', 'Pagado', '2019-12-18'),
(68, 10, 7, 8, 'Factura', '151', '1', '2019-12-18', '18.00', '0.00', 'A', 'Por Cobrar', NULL),
(69, 10, 7, 8, 'Nota de Entrega', '502', '2', '2019-12-18', '18.00', '300.00', 'A', 'Pagado', NULL),
(70, 10, 7, 8, 'Factura', '152', '2', '2019-12-18', '18.00', '0.00', 'C', 'Por Cobrar', NULL),
(71, 10, 7, 8, 'Nota de Entrega', '503', '3', '2019-12-18', '18.00', '150.00', 'A', 'Por Cobrar', NULL),
(72, 10, 7, 8, 'Factura', '153', '3', '2019-12-18', '18.00', '180.00', 'A', 'Pagado', '2019-12-18'),
(73, 11, 7, 8, 'Factura', '154', '4', '2019-12-18', '18.00', '1800.00', 'A', 'Pagado', '2019-12-18'),
(74, 10, 7, 8, 'Nota de Entrega', '504', '4', '2020-02-19', '18.00', '12.00', 'A', 'Pagado', '2020-02-19');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`idarticulo`),
  ADD KEY `fk_articulo_categoria_idx` (`idcategoria`),
  ADD KEY `fk_articulo_talla_idx` (`idtalla`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `detalle_devolucion`
--
ALTER TABLE `detalle_devolucion`
  ADD PRIMARY KEY (`iddetalle_devolucion`),
  ADD KEY `iddevolucion` (`iddevolucion`),
  ADD KEY `iddetalle_venta` (`iddetalle_venta`);

--
-- Indices de la tabla `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  ADD PRIMARY KEY (`iddetalle_ingreso`),
  ADD KEY `fk_detalle_ingreso_idx` (`idingreso`),
  ADD KEY `fk_detalle_ingreso_articulo_idx` (`idarticulo`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`iddetalle_venta`),
  ADD KEY `fk_detalle_venta_articulo_idx` (`idarticulo`),
  ADD KEY `fk_detalle_venta_idx` (`idventa`);

--
-- Indices de la tabla `devolucion`
--
ALTER TABLE `devolucion`
  ADD PRIMARY KEY (`iddevolucion`),
  ADD KEY `idventa` (`idventa`);

--
-- Indices de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD PRIMARY KEY (`idingreso`),
  ADD KEY `fk_ingreso_persona_idx` (`idproveedor`);

--
-- Indices de la tabla `nota_credito`
--
ALTER TABLE `nota_credito`
  ADD PRIMARY KEY (`idnota_credito`),
  ADD KEY `idventa` (`idventa`),
  ADD KEY `iddevolucion` (`iddevolucion`);

--
-- Indices de la tabla `parametros`
--
ALTER TABLE `parametros`
  ADD PRIMARY KEY (`idparametro`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idpersona`);

--
-- Indices de la tabla `talla`
--
ALTER TABLE `talla`
  ADD PRIMARY KEY (`idtalla`);

--
-- Indices de la tabla `tienda`
--
ALTER TABLE `tienda`
  ADD PRIMARY KEY (`idtienda`);

--
-- Indices de la tabla `tipos_usuario`
--
ALTER TABLE `tipos_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`idtipo_usuario`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `tipoUsuario` (`tipoUsuario`),
  ADD KEY `email` (`email`);

--
-- Indices de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  ADD PRIMARY KEY (`idvendedor`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`idventa`),
  ADD KEY `fk_venta_cliente_idx` (`idcliente`),
  ADD KEY `fk_venta_vendedor_idx` (`idvendedor`),
  ADD KEY `fk_venta_tienda_idx` (`idtienda`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulo`
--
ALTER TABLE `articulo`
  MODIFY `idarticulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `detalle_devolucion`
--
ALTER TABLE `detalle_devolucion`
  MODIFY `iddetalle_devolucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  MODIFY `iddetalle_ingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `iddetalle_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT de la tabla `devolucion`
--
ALTER TABLE `devolucion`
  MODIFY `iddevolucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  MODIFY `idingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `nota_credito`
--
ALTER TABLE `nota_credito`
  MODIFY `idnota_credito` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `parametros`
--
ALTER TABLE `parametros`
  MODIFY `idparametro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idpersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `talla`
--
ALTER TABLE `talla`
  MODIFY `idtalla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT de la tabla `tienda`
--
ALTER TABLE `tienda`
  MODIFY `idtienda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `tipos_usuario`
--
ALTER TABLE `tipos_usuario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  MODIFY `idvendedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `idventa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD CONSTRAINT `fk_articulo_categoria` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_articulo_talla` FOREIGN KEY (`idtalla`) REFERENCES `talla` (`idtalla`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_devolucion`
--
ALTER TABLE `detalle_devolucion`
  ADD CONSTRAINT `fk_detalle_devolucion_detalle_venta` FOREIGN KEY (`iddetalle_venta`) REFERENCES `detalle_venta` (`iddetalle_venta`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detalle_devolucion_devolucion` FOREIGN KEY (`iddevolucion`) REFERENCES `devolucion` (`iddevolucion`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  ADD CONSTRAINT `fk_detalle_ingreso` FOREIGN KEY (`idingreso`) REFERENCES `ingreso` (`idingreso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_ingreso_articulo` FOREIGN KEY (`idarticulo`) REFERENCES `articulo` (`idarticulo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `fk_detalle_venta_articulo` FOREIGN KEY (`idarticulo`) REFERENCES `articulo` (`idarticulo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_venta_venta` FOREIGN KEY (`idventa`) REFERENCES `venta` (`idventa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `devolucion`
--
ALTER TABLE `devolucion`
  ADD CONSTRAINT `fk_devolucion_venta` FOREIGN KEY (`idventa`) REFERENCES `venta` (`idventa`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD CONSTRAINT `fk_ingreso_persona` FOREIGN KEY (`idproveedor`) REFERENCES `persona` (`idpersona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `nota_credito`
--
ALTER TABLE `nota_credito`
  ADD CONSTRAINT `fk_nota_credito_devolucion` FOREIGN KEY (`iddevolucion`) REFERENCES `devolucion` (`iddevolucion`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nota_credito_venta` FOREIGN KEY (`idventa`) REFERENCES `venta` (`idventa`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_venta_cliente` FOREIGN KEY (`idcliente`) REFERENCES `persona` (`idpersona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venta_tienda` FOREIGN KEY (`idtienda`) REFERENCES `tienda` (`idtienda`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venta_vendedor` FOREIGN KEY (`idvendedor`) REFERENCES `vendedor` (`idvendedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
