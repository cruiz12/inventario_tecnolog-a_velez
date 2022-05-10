-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-01-2022 a las 18:06:29
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `database_inventario_cv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id_area` int(11) NOT NULL,
  `nombre_area` varchar(80) NOT NULL DEFAULT 'not null',
  `gerencia` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id_area`, `nombre_area`, `gerencia`) VALUES
(1, 'tecnología', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bodega`
--

CREATE TABLE `bodega` (
  `id_bodega` int(11) NOT NULL,
  `nombre_bodega` varchar(80) NOT NULL DEFAULT 'not null',
  `pais_b` int(11) NOT NULL,
  `departamento_b` int(11) NOT NULL,
  `ciudad_b` int(11) NOT NULL,
  `direccion` varchar(100) NOT NULL DEFAULT 'not null'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `bodega`
--

INSERT INTO `bodega` (`id_bodega`, `nombre_bodega`, `pais_b`, `departamento_b`, `ciudad_b`, `direccion`) VALUES
(1, 'CV', 1, 2, 1, 'cr48-sasasas'),
(2, 'prueba dictamen', 1, 1, 11, 'cr48#aaaaaa'),
(3, 'mamalon', 1, 2, 17, 'cr48#aaaaaa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `idCiudad` int(11) NOT NULL,
  `nombre_ciudad` varchar(80) DEFAULT NULL,
  `departamento` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`idCiudad`, `nombre_ciudad`, `departamento`) VALUES
(1, 'Bello', 1),
(2, 'Caldas', 1),
(3, 'Copacabana', 1),
(4, 'Envigado', 1),
(5, 'Guarne', 1),
(6, 'Itagui', 1),
(7, 'La Ceja', 1),
(8, 'La Estrella', 1),
(9, 'La Tablaza', 1),
(10, 'Marinilla', 1),
(11, 'Medellín', 1),
(12, 'Rionegro', 1),
(13, 'Sabaneta', 1),
(14, 'San Antonio de Prado', 1),
(15, 'San Cristóbal', 1),
(16, 'Caucasia', 1),
(17, 'Barranquilla', 2),
(18, 'Malambo', 2),
(19, 'Puerto Colombia', 2),
(20, 'Soledad', 2),
(21, 'Arjona', 3),
(22, 'Bayunca', 3),
(23, 'Carmen de Bolívar', 3),
(24, 'Cartagena', 3),
(25, 'Turbaco', 3),
(26, 'Arcabuco', 4),
(27, 'Belencito', 4),
(28, 'Chiquinquirá', 4),
(29, 'Combita', 4),
(30, 'Cucaita', 4),
(31, 'Duitama', 4),
(32, 'Mongui', 4),
(33, 'Nobsa', 4),
(34, 'Paipa', 4),
(35, 'Puerto Boyacá', 4),
(36, 'Ráquira', 4),
(37, 'Samaca', 4),
(38, 'Santa Rosa de Viterbo', 4),
(39, 'Sogamoso', 4),
(40, 'Sutamerchán', 4),
(41, 'Tibasosa', 4),
(42, 'Tinjaca', 4),
(43, 'Tunja', 4),
(44, 'Ventaquemada', 4),
(45, 'Villa de Leiva', 4),
(46, 'La Dorada', 5),
(47, 'Manizales', 5),
(48, 'Villamaria', 5),
(49, 'Caloto', 6),
(50, 'Ortigal', 6),
(51, 'Piendamo', 6),
(52, 'Popayán', 6),
(53, 'Puerto Tejada', 6),
(54, 'Santander Quilichao', 6),
(55, 'Tunia', 6),
(56, 'Villarica', 6),
(57, 'Valledupar', 7),
(58, 'Cerete', 8),
(59, 'Montería', 8),
(60, 'Planeta Rica', 8),
(61, 'Alban', 9),
(62, 'Bogotá', 9),
(63, 'Bojaca', 9),
(64, 'Bosa', 9),
(65, 'Briceño', 9),
(66, 'Cajicá', 9),
(67, 'Chía', 9),
(68, 'Chinauta', 9),
(69, 'Choconta', 9),
(70, 'Cota', 9),
(71, 'El Muña', 9),
(72, 'El Rosal', 9),
(73, 'Engativá', 9),
(74, 'Facatativa', 9),
(75, 'Fontibón', 9),
(76, 'Funza', 9),
(77, 'Fusagasuga', 9),
(78, 'Gachancipá', 9),
(79, 'Girardot', 9),
(80, 'Guaduas', 9),
(81, 'Guayavetal', 9),
(82, 'La Calera', 9),
(83, 'La Caro', 9),
(84, 'Madrid', 9),
(85, 'Mosquera', 9),
(86, 'Nemocón', 9),
(87, 'Puente Piedra', 9),
(88, 'Puente Quetame', 9),
(89, 'Puerto Bogotá', 9),
(90, 'Puerto Salgar', 9),
(91, 'Quetame', 9),
(92, 'Sasaima', 9),
(93, 'Sesquile', 9),
(94, 'Sibaté', 9),
(95, 'Silvania', 9),
(96, 'Simijaca', 9),
(97, 'Soacha', 9),
(98, 'Sopo', 9),
(99, 'Suba', 9),
(100, 'Subachoque', 9),
(101, 'Susa', 9),
(102, 'Tabio', 9),
(103, 'Tenjo', 9),
(104, 'Tocancipa', 9),
(105, 'Ubaté', 9),
(106, 'Usaquén', 9),
(107, 'Usme', 9),
(108, 'Villapinzón', 9),
(109, 'Villeta', 9),
(110, 'Zipaquirá', 9),
(111, 'Maicao', 10),
(112, 'Riohacha', 10),
(113, 'Aipe', 11),
(114, 'Neiva', 11),
(115, 'Cienaga', 12),
(116, 'Gaira', 12),
(117, 'Rodadero', 12),
(118, 'Santa Marta', 12),
(119, 'Taganga', 12),
(120, 'Villavicencio', 13),
(121, 'Ipiales', 14),
(122, 'Pasto', 14),
(123, 'Cúcuta', 15),
(124, 'El Zulia', 15),
(125, 'La Parada', 15),
(126, 'Los Patios', 15),
(127, 'Villa del Rosario', 15),
(128, 'Armenia', 16),
(129, 'Calarcá', 16),
(130, 'Circasia', 16),
(131, 'La Tebaida', 16),
(132, 'Montenegro', 16),
(133, 'Quimbaya', 16),
(134, 'Dosquebradas', 17),
(135, 'Pereira', 17),
(136, 'Aratoca', 18),
(137, 'Barbosa', 18),
(138, 'Bucaramanga', 18),
(139, 'Floridablanca', 18),
(140, 'Girón', 18),
(141, 'Lebrija', 18),
(142, 'Oiba', 18),
(143, 'Piedecuesta', 18),
(144, 'Pinchote', 18),
(145, 'San Gil', 18),
(146, 'Socorro', 18),
(147, 'Sincelejo', 19),
(148, 'Armero', 20),
(149, 'Buenos Aires', 20),
(150, 'Castilla', 20),
(151, 'Espinal', 20),
(152, 'Flandes', 20),
(153, 'Guamo', 20),
(154, 'Honda', 20),
(155, 'Ibagué', 20),
(156, 'Mariquita', 20),
(157, 'Melgar', 20),
(158, 'Natagaima', 20),
(159, 'Payande', 20),
(160, 'Purificación', 20),
(161, 'Saldaña', 20),
(162, 'Tolemaida', 20),
(163, 'Amaime', 21),
(164, 'Andalucía', 21),
(165, 'Buenaventura', 21),
(166, 'Buga', 21),
(167, 'Buga La Grande', 21),
(168, 'Caicedonia', 21),
(169, 'Cali', 21),
(170, 'Candelaria', 21),
(171, 'Cartago', 21),
(172, 'Cavasa', 21),
(173, 'Costa Rica', 21),
(174, 'Dagua', 21),
(175, 'El Carmelo', 21),
(176, 'El Cerrito', 21),
(177, 'El Placer', 21),
(178, 'Florida', 21),
(179, 'Ginebra', 21),
(180, 'Guacarí', 21),
(181, 'Jamundi', 21),
(182, 'La Paila', 21),
(183, 'La Unión', 21),
(184, 'La Victoria', 21),
(185, 'Loboguerrero', 21),
(186, 'Palmira', 21),
(187, 'Pradera', 21),
(188, 'Roldanillo', 21),
(189, 'Rozo', 21),
(190, 'San Pedro', 21),
(191, 'Sevilla', 21),
(192, 'Sonso', 21),
(193, 'Tulúa', 21),
(194, 'Vijes', 21),
(195, 'Villa Gorgona', 21),
(196, 'Yotoco', 21),
(197, 'Yumbo', 21),
(198, 'Zarzal', 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato`
--

CREATE TABLE `contrato` (
  `Nro_de_contrato` int(11) NOT NULL,
  `Proveedor` int(11) NOT NULL,
  `Fecha_de_inicio` date NOT NULL,
  `Fecha_fin` date NOT NULL,
  `ruta_pdf` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contrato`
--

INSERT INTO `contrato` (`Nro_de_contrato`, `Proveedor`, `Fecha_de_inicio`, `Fecha_fin`, `ruta_pdf`) VALUES
(43343, 2345123, '2022-01-13', '2022-01-29', 'files/bicatora9darwin-meneses-formato-bitacora-firmadapdf.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `idDepartamento` int(11) NOT NULL,
  `nombre_departamento` varchar(80) DEFAULT NULL,
  `pais` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`idDepartamento`, `nombre_departamento`, `pais`) VALUES
(1, 'Antioquia', 1),
(2, 'Atlántico', 1),
(3, 'Bolívar', 1),
(4, 'Boyacá', 1),
(5, 'Caldas', 1),
(6, 'Cauca', 1),
(7, 'Cesar', 1),
(8, 'Córdoba', 1),
(9, 'Cundinamarca', 1),
(10, 'Guajira', 1),
(11, 'Huila', 1),
(12, 'Magdalena', 1),
(13, 'Meta', 1),
(14, 'Nariño', 1),
(15, 'Norte de Santander', 1),
(16, 'Quindío', 1),
(17, 'Risaralda', 1),
(18, 'Santander', 1),
(19, 'Sucre', 1),
(20, 'Tolima', 1),
(21, 'Valle del Cauca', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dispositivos`
--

CREATE TABLE `dispositivos` (
  `codigo_serial` int(30) NOT NULL,
  `activo` int(30) NOT NULL,
  `marca` int(11) NOT NULL,
  `modelo` int(11) NOT NULL,
  `tipo_dispositivo` int(11) NOT NULL,
  `bodega_disp_id` int(11) DEFAULT NULL,
  `responsable` int(11) DEFAULT NULL,
  `orden_compra` int(11) DEFAULT NULL,
  `contrato_d` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_pdf`
--

CREATE TABLE `factura_pdf` (
  `Nro_factura` varchar(40) NOT NULL,
  `Nro_contrato_f` int(11) NOT NULL,
  `ruta_fac_contrato` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `factura_pdf`
--

INSERT INTO `factura_pdf` (`Nro_factura`, `Nro_contrato_f`, `ruta_fac_contrato`) VALUES
('2r3f43ff3', 43343, 'files/ohmni-robot-1pdf.pdf'),
('5444', 43343, 'files/registro-de-matricula-residentepdf'),
('9849303', 43343, 'files/ohmni-robotpdf.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_dispositivo`
--

CREATE TABLE `historial_dispositivo` (
  `id_historial` int(11) NOT NULL,
  `codigo_serial_h` int(11) NOT NULL,
  `responsable_h` int(11) NOT NULL,
  `fecha_toma` date NOT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `responsable_entrega` varchar(30) NOT NULL,
  `responsable_devuelta` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `historial_dispositivo`
--

INSERT INTO `historial_dispositivo` (`id_historial`, `codigo_serial_h`, `responsable_h`, `fecha_toma`, `fecha_entrega`, `responsable_entrega`, `responsable_devuelta`) VALUES
(12, 434343, 111111, '2021-12-30', '2021-12-30', 'schaverra', 'schaverra'),
(13, 434343, 333333, '2021-12-30', '2021-12-30', 'schaverra', 'schaverra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL,
  `nombre_marca` varchar(20) NOT NULL DEFAULT 'not null'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id_marca`, `nombre_marca`) VALUES
(1, 'lenovo'),
(2, 'hp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelo`
--

CREATE TABLE `modelo` (
  `id_modelo` int(11) NOT NULL,
  `codigo_modelo` varchar(30) NOT NULL DEFAULT 'not null',
  `marca_m` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `modelo`
--

INSERT INTO `modelo` (`id_modelo`, `codigo_modelo`, `marca_m`) VALUES
(1, 'kdskjdk-21f', 2),
(2, 'jklm-34', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_compra`
--

CREATE TABLE `orden_compra` (
  `id_orden` int(11) NOT NULL,
  `id_proveedor_pedido` int(11) NOT NULL,
  `fecha_emision_pedido` date NOT NULL,
  `fecha_recepcion_pedido` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `orden_compra`
--

INSERT INTO `orden_compra` (`id_orden`, `id_proveedor_pedido`, `fecha_emision_pedido`, `fecha_recepcion_pedido`) VALUES
(21323, 1000758590, '2021-12-07', '2021-12-16'),
(32232, 2342, '2021-12-26', '2021-12-22'),
(455444, 1000758590, '2021-12-22', '2021-12-31'),
(55566722, 1000758590, '2021-12-23', '2021-12-23'),
(545478899, 2345123, '2021-12-16', '2021-12-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `idPais` int(11) NOT NULL,
  `nombre_pais` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`idPais`, `nombre_pais`) VALUES
(1, 'Colombia'),
(2, 'Perú'),
(3, 'Ecuador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `nit` int(15) NOT NULL,
  `razon_social` varchar(60) NOT NULL,
  `comercial` varchar(40) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`nit`, `razon_social`, `comercial`, `Telefono`, `correo`) VALUES
(2342, 'Tecno Olimpic', 'Sanra goez', '3111112343', NULL),
(874343, 'santiagochaverra', 'santi', '3334444', NULL),
(2345123, 'telmex', 'oscar', '2211', NULL),
(1000758590, 'santiagochave', 'schaverra', '3116109897', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsables_dispositivos`
--

CREATE TABLE `responsables_dispositivos` (
  `cedula` int(20) NOT NULL,
  `nombre_responsable` varchar(80) NOT NULL,
  `area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `responsables_dispositivos`
--

INSERT INTO `responsables_dispositivos` (`cedula`, `nombre_responsable`, `area`) VALUES
(111111, 'santiago perez', 1),
(333333, 'vannesa perez', 1),
(1224343, 'Camila perez', 1),
(4444444, 'valen perez', 1),
(222222222, 'flor perez', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_para_acciones`
--

CREATE TABLE `tabla_para_acciones` (
  `ID` int(100) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Contraseña` varchar(100) NOT NULL,
  `Descripción` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tabla_para_acciones`
--

INSERT INTO `tabla_para_acciones` (`ID`, `Nombre`, `Contraseña`, `Descripción`) VALUES
(1, 'Diego', 'Velez2021*', 'Empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_pendientes`
--

CREATE TABLE `tabla_pendientes` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `usuario_pendiente` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tabla_pendientes`
--

INSERT INTO `tabla_pendientes` (`id`, `titulo`, `usuario_pendiente`) VALUES
(9, 'jcenjenve', 'schaverra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnicos`
--

CREATE TABLE `tecnicos` (
  `id_user` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL DEFAULT 'not null',
  `clave` varchar(255) NOT NULL DEFAULT 'not null',
  `Apellidos_Usuario` varchar(80) NOT NULL DEFAULT 'not null',
  `Nombre_Usuario` varchar(80) NOT NULL DEFAULT 'not null',
  `rol` varchar(20) NOT NULL DEFAULT 'not null'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tecnicos`
--

INSERT INTO `tecnicos` (`id_user`, `usuario`, `clave`, `Apellidos_Usuario`, `Nombre_Usuario`, `rol`) VALUES
(1234, 'Diego Castaño', '8c5e1040340f5d04f7bd34203c529c82c46479fc', 'Castaño', 'Diego', ''),
(1036518303, 'Dmeneses', '445431738b62ffbd06c826ffe4f1b688f1198490', 'Meneses Duque', 'Darwin Andres', 'Administrador'),
(1036518304, 'LinaMarc', '05e77de40ad4022c2267455c5b0a18f6c54e7fa6', 'Marcela', 'Lina', 'Administrador'),
(1036518305, 'Marcela23@cuerosvelez.com', '064a11a703a7eae8dedd2b1c96ee08f0bbc1b397', 'Marcela', 'Lina ', ''),
(1036518308, 'santacho', '8ba760ef210f84433a68d87258bf36f0ae443194', 'chaverra gaviria', 'santiago', ''),
(1036518309, 'flor@c.com', '8cb2237d0679ca88db6464eac60da96345513964', 'montoya', 'flor', ''),
(1036518310, 'vanne@c.com', '8cb2237d0679ca88db6464eac60da96345513964', 'cifuentes', 'vannesa', ''),
(1036518312, 'schaverra', '8cb2237d0679ca88db6464eac60da96345513964', 'chaverra gaviria', 'santiago', 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_dispositivo`
--

CREATE TABLE `tipo_dispositivo` (
  `id_tipo_dispositivo` int(11) NOT NULL,
  `Nombre_tipo_dispositivo` varchar(60) NOT NULL DEFAULT 'not null'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_dispositivo`
--

INSERT INTO `tipo_dispositivo` (`id_tipo_dispositivo`, `Nombre_tipo_dispositivo`) VALUES
(5, 'Tablet'),
(6, 'Portatil'),
(7, 'Datafono'),
(8, 'Telefono');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id_area`);

--
-- Indices de la tabla `bodega`
--
ALTER TABLE `bodega`
  ADD PRIMARY KEY (`id_bodega`),
  ADD KEY `pais_b` (`pais_b`),
  ADD KEY `departamento_b` (`departamento_b`),
  ADD KEY `ciudad_b` (`ciudad_b`);

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`idCiudad`),
  ADD KEY `idDepartamento` (`departamento`);

--
-- Indices de la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD PRIMARY KEY (`Nro_de_contrato`),
  ADD KEY `fkproveedor` (`Proveedor`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`idDepartamento`),
  ADD KEY `fkpais` (`pais`);

--
-- Indices de la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  ADD PRIMARY KEY (`codigo_serial`),
  ADD KEY `fkbodega` (`bodega_disp_id`),
  ADD KEY `fkresponsable` (`responsable`),
  ADD KEY `fkorden` (`orden_compra`),
  ADD KEY `contrato_d` (`contrato_d`),
  ADD KEY `tipo_dispositivo` (`tipo_dispositivo`),
  ADD KEY `modelo` (`modelo`),
  ADD KEY `marca` (`marca`);

--
-- Indices de la tabla `factura_pdf`
--
ALTER TABLE `factura_pdf`
  ADD PRIMARY KEY (`Nro_factura`),
  ADD KEY `fk_pdf_contrato_factura` (`Nro_contrato_f`);

--
-- Indices de la tabla `historial_dispositivo`
--
ALTER TABLE `historial_dispositivo`
  ADD PRIMARY KEY (`id_historial`),
  ADD KEY `fk_codigo_serial_h` (`codigo_serial_h`),
  ADD KEY `fk_responsable_h` (`responsable_h`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD PRIMARY KEY (`id_modelo`),
  ADD KEY `fkmodelo` (`marca_m`);

--
-- Indices de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  ADD PRIMARY KEY (`id_orden`),
  ADD KEY `fk_proveedor_orden_compra` (`id_proveedor_pedido`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`idPais`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`nit`);

--
-- Indices de la tabla `responsables_dispositivos`
--
ALTER TABLE `responsables_dispositivos`
  ADD PRIMARY KEY (`cedula`),
  ADD KEY `fkarea` (`area`);

--
-- Indices de la tabla `tabla_para_acciones`
--
ALTER TABLE `tabla_para_acciones`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `tabla_pendientes`
--
ALTER TABLE `tabla_pendientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tecnicos`
--
ALTER TABLE `tecnicos`
  ADD PRIMARY KEY (`id_user`);

--
-- Indices de la tabla `tipo_dispositivo`
--
ALTER TABLE `tipo_dispositivo`
  ADD PRIMARY KEY (`id_tipo_dispositivo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `bodega`
--
ALTER TABLE `bodega`
  MODIFY `id_bodega` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `idCiudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `idDepartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `historial_dispositivo`
--
ALTER TABLE `historial_dispositivo`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `modelo`
--
ALTER TABLE `modelo`
  MODIFY `id_modelo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `idPais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tabla_para_acciones`
--
ALTER TABLE `tabla_para_acciones`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tabla_pendientes`
--
ALTER TABLE `tabla_pendientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tecnicos`
--
ALTER TABLE `tecnicos`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1036518313;

--
-- AUTO_INCREMENT de la tabla `tipo_dispositivo`
--
ALTER TABLE `tipo_dispositivo`
  MODIFY `id_tipo_dispositivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bodega`
--
ALTER TABLE `bodega`
  ADD CONSTRAINT `fk_pais_bodega` FOREIGN KEY (`pais_b`) REFERENCES `paises` (`idPais`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD CONSTRAINT `contrato_ibfk_1` FOREIGN KEY (`Proveedor`) REFERENCES `proveedor` (`nit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  ADD CONSTRAINT `dispositivos_ibfj_6` FOREIGN KEY (`contrato_d`) REFERENCES `contrato` (`Nro_de_contrato`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dispositivos_ibfk_2` FOREIGN KEY (`bodega_disp_id`) REFERENCES `bodega` (`id_bodega`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dispositivos_ibfk_4` FOREIGN KEY (`orden_compra`) REFERENCES `orden_compra` (`id_orden`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dispositivos_ibfk_5` FOREIGN KEY (`responsable`) REFERENCES `responsables_dispositivos` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dispositivos_ibfk_7` FOREIGN KEY (`modelo`) REFERENCES `modelo` (`id_modelo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `marca` FOREIGN KEY (`marca`) REFERENCES `marca` (`id_marca`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `modelo` FOREIGN KEY (`marca`) REFERENCES `modelo` (`id_modelo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tipo_dispositivo` FOREIGN KEY (`tipo_dispositivo`) REFERENCES `tipo_dispositivo` (`id_tipo_dispositivo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura_pdf`
--
ALTER TABLE `factura_pdf`
  ADD CONSTRAINT `fk_pdf_contrato_factura` FOREIGN KEY (`Nro_contrato_f`) REFERENCES `contrato` (`Nro_de_contrato`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD CONSTRAINT `fk_marca_modelo` FOREIGN KEY (`marca_m`) REFERENCES `marca` (`id_marca`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
