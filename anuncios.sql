-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-12-2019 a las 17:48:21
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `anuncios`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarSubcategoriasxCategoria` (`id_cat` INT)  SELECT * FROM subcategorias WHERE id_categoria = `id_cat`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerCategoria` (`id` INT)  SELECT * FROM categorias WHERE categorias.id_categoria = `id`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_cambiarContra` (IN `contra` VARCHAR(300), IN `id` INT)  UPDATE login SET pass = md5(`contra`) WHERE id_usuario = `id`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_eliminarAnuncio` (`idA` INT)  DELETE FROM anuncios WHERE id_anuncio = `idA`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_eliminarCategoria` (`idc` INT)  DELETE from categorias WHERE categorias.id_categoria = `idc`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_eliminarPreferencias` (`idU` INT)  DELETE FROM preferencias WHERE id_usuario = `idU`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_eliminarSubcategoria` (`idsc` INT)  DELETE FROM subcategorias WHERE subcategorias.id_subCategoria = `idsc`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_eliminarUsuario` (`id` INT)  DELETE FROM login WHERE login.id_usuario = `id`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_insertarAnuncio` (IN `idUs` INT, IN `idSubcate` INT, IN `nombre` VARCHAR(50), IN `precio` DOUBLE(7,2), IN `descrip` VARCHAR(200), IN `img` VARCHAR(300))  INSERT INTO anuncios(id_usuario, id_subCategoria,nombre_anuncio,precio_anuncio,descripcion,imagen_anuncio)
    VALUES(`idUs`,`idSubcate`,`nombre`,`precio`,`descrip`,`img`)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_insertarCategoria` (IN `nombre` VARCHAR(70), IN `img` VARCHAR(3000))  INSERT INTO categorias(nombre_categoria, imagen_categoria) VALUES (`nombre`,`img`)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_insertarGustos` (`idUsuario` INT, `idCategoria` INT)  INSERT INTO preferencias(id_usuario, id_categoria) VALUES(`idUsuario`,`idCategoria`)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_insertarLogin` (IN `u` VARCHAR(70), IN `c` VARCHAR(70), IN `p` VARCHAR(250), IN `t` TINYINT(2))  INSERT INTO login(usuario,correo, pass, tipo) values (`u`,`c`, md5(`p`), `t` )$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_insertarMensaje` (`nombre` VARCHAR(100), `telefeono` VARCHAR(9), `correo` VARCHAR(80), `comen` VARCHAR(299))  INSERT INTO comentarios(nombre,telefono,correo,mensaje) VALUES (`nombre`,`telefeono`,`correo`,`comen`)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_insertarSubcategoria` (IN `idcategoria` INT, IN `nombre` VARCHAR(50))  INSERT into subcategorias(id_categoria,nombre_subCategoria) VALUES(`idcategoria`,`nombre`)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_modificarAnuncios` (IN `idsub` INT, IN `nombre` VARCHAR(50), IN `precio` DOUBLE(7,2), IN `desc` VARCHAR(250), IN `id` INT, IN `img` VARCHAR(300))  update anuncios set id_subCategoria = `idsub`, nombre_anuncio = `nombre`, precio_anuncio = `precio`, descripcion = `desc`, imagen_anuncio = `img` WHERE id_anuncio = `id`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_modificarCategoria` (IN `id` INT, IN `nombre` VARCHAR(70), IN `img` VARCHAR(300))  UPDATE categorias set categorias.nombre_categoria = `nombre`, imagen_categoria = `img` WHERE id_categoria = `id`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_modificarImg` (`id` INT, `img` VARCHAR(300))  UPDATE usuarios set foto_usuario = `img` WHERE id_usuario = `id`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_modificarSubcategotia` (`idca` INT, `nombre` VARCHAR(50), `idsub` INT)  UPDATE subcategorias SET id_categoria = `idca`, nombre_subCategoria = `nombre` WHERE       id_subCategoria = `idsub`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_modificarUsuario` (IN `nu` VARCHAR(25), IN `au` VARCHAR(25), IN `dep` VARCHAR(50), IN `tel` VARCHAR(50), IN `id` INT)  UPDATE usuarios SET nombre_usuario = `nu`, apellido_usuario = `au`, departamento = `dep`, telefono = `tel` WHERE id_usuario = `id`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_mostrarAnuncioEspecifico` (`id` INT)  SELECT * from anuncios INNER JOIN login on anuncios.id_usuario = login.id_usuario INNER JOIN subcategorias on anuncios.id_subCategoria = subcategorias.id_subCategoria INNER JOIN categorias ON categorias.id_categoria = subcategorias.id_categoria INNER JOIN usuarios on login.id_usuario = usuarios.id_usuario WHERE anuncios.id_anuncio = `id`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_mostrarAnunciosBusqueda` (IN `nombreAnuncio` VARCHAR(70))  SELECT * from anuncios INNER JOIN login on anuncios.id_usuario = login.id_usuario INNER JOIN subcategorias on anuncios.id_subCategoria = subcategorias.id_subCategoria INNER JOIN categorias ON categorias.id_categoria = subcategorias.id_categoria INNER JOIN usuarios on login.id_usuario = usuarios.id_usuario WHERE anuncios.nombre_anuncio LIKE CONCAT('%', `nombreAnuncio` , '%')$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_mostrarAnunciosxMes` (`mes` SMALLINT, `anio` SMALLINT)  SELECT count(*) as suma FROM anuncios WHERE month(publicacion) = `mes` AND YEAR(publicacion) = `anio`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_mostrarAnunciosxUsuario` (`usu` VARCHAR(50))  SELECT * from anuncios INNER JOIN login on anuncios.id_usuario = login.id_usuario INNER JOIN subcategorias on anuncios.id_subCategoria = subcategorias.id_subCategoria INNER JOIN categorias ON categorias.id_categoria = subcategorias.id_categoria WHERE login.usuario = `usu`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_mostrarCategorias` ()  SELECT * FROM categorias ORDER BY id_categoria asc$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_mostrarCategoriasBusqueda` (IN `nombre` VARCHAR(60))  SELECT * from categorias WHERE nombre_categoria LIKE CONCAT('%', `nombre` , '%')$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_mostrarCategoriasUsuaio` (IN `u` VARCHAR(70))  SELECT login.id_usuario,categorias.id_categoria, categorias.nombre_categoria, categorias.imagen_categoria FROM categorias INNER JOIN preferencias ON preferencias.id_categoria = categorias.id_categoria INNER JOIN usuarios on usuarios.id_usuario = preferencias.id_usuario INNER JOIN login on login.id_usuario = usuarios.id_usuario WHERE login.usuario = `u`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_mostrarComentarios` (`var` VARCHAR(50))  SELECT * FROM comentarios$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_mostrarSubcategoriasBusqueda` (IN `nombre` VARCHAR(70))  SELECT * FROM subcategorias inner join categorias on categorias.id_categoria = subcategorias.id_categoria WHERE subcategorias.nombre_subCategoria like CONCAT('%', `nombre` , '%')$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_mostrarUsuarios` ()  SELECT * FROM `login` INNER JOIN usuarios on login.id_usuario = usuarios.id_usuario$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_mostrarUsuariosBusqueda` (IN `valor` VARCHAR(70))  SELECT * FROM `login` INNER JOIN usuarios on login.id_usuario = usuarios.id_usuario 
WHERE login.usuario like concat('%',`valor`,'%') or usuarios.nombre_usuario like concat('%',`valor`,'%')$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_subcategorias` ()  SELECT * FROM subcategorias inner join categorias on categorias.id_categoria = subcategorias.id_categoria$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncios`
--

CREATE TABLE `anuncios` (
  `id_anuncio` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_subCategoria` int(11) DEFAULT NULL,
  `nombre_anuncio` varchar(70) NOT NULL,
  `precio_anuncio` decimal(7,2) NOT NULL,
  `descripcion` varchar(300) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `imagen_anuncio` varchar(300) NOT NULL DEFAULT 'nodisp.png',
  `publicacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `anuncios`
--

INSERT INTO `anuncios` (`id_anuncio`, `id_usuario`, `id_subCategoria`, `nombre_anuncio`, `precio_anuncio`, `descripcion`, `imagen_anuncio`, `publicacion`) VALUES
(4, 76, 15, 'perro loco', '467.00', 'muerde pero es cariÃ±ozo, se llama dagoberto', 'nodisp.png', '2018-09-30 20:55:55'),
(5, 67, 13, 'camisa rojaC', '13.00', 'es de pull and bear asi que es fina ', 'nodisp.png', '2018-10-02 03:13:38'),
(7, 76, 4, 'nissan juke', '14000.00', 'aÃ±o 2015, en pexcelenes condiciones un solo dueÃ±o la muestro en metrocentro, full extras', 'nodisp.png', '2018-10-02 04:52:06'),
(8, 67, 1, 'celular lg', '100.00', 'Un telefono muy bonito pocos golpes.', '1540602427_ce.jpeg', '2018-10-02 13:23:20'),
(9, 67, 7, 'licuadora semi nueva', '43.00', 'una vez usasda, se vende porque casi no se usa', '1540602367_lic.jpg', '2018-10-24 23:49:04'),
(10, 67, 28, 'macetas', '7.00', 'macetas de cemento y plastico para cualquier tipo de planta', '1540602265_mace.jpg', '2018-10-24 23:52:40'),
(16, 67, 8, 'cama', '320.00', 'matrimonial trato serio, como nueva', '1540578917_cama.jpeg', '2018-10-26 18:35:17'),
(17, 78, 9, 'aspiradora', '23.00', 'aspira de todo seÃ±ores', '1540744368_aspi.jpeg', '2018-10-28 16:32:48'),
(18, 88, 7, 'batidora', '20.00', 'bate todo lo que le metan', '1541447897_bato.jpeg', '2018-11-05 19:58:17'),
(19, 92, 11, 'nintendo 64', '56.00', 'doy dos controles y  un juego de mario', '1541569718_64.jpg', '2018-11-07 05:48:38'),
(20, 91, 11, 'nintendo 3ds', '239.00', 'nueva de paquete nunca usado doy 3 juegos', '1541569924_cons.jpg', '2018-11-07 05:52:04'),
(21, 91, 11, 'control de ps4', '48.00', 'control semi nuevo, estilo unico en su especie', '1541570011_cont.jpeg', '2018-11-07 05:53:31'),
(22, 91, 12, 'camara digital', '99.00', 'con un buen zoom, super efectiva', 'nodisp.png', '2018-11-07 05:55:18'),
(23, 93, 1, 'aparato', '300.00', 'esutil', '1541600783_bato.jpeg', '2018-11-07 14:26:23'),
(24, 108, 3, 'lente para celular', '5.50', 'bonitos ojos de pescado para cualquier dispositivo, incluyen dos lentes con diferente graduacion', '1542129506_fisheye.jpg', '2018-11-13 17:18:26'),
(25, 111, 9, 'bonita casa', '13500.00', 'bonita casa en residencial mariona cerca del penal para visitar a sus seres queridos, excelentes servicios de agua y telefonia', '1542135181_caa.jpg', '2018-11-13 18:53:01'),
(26, 109, 11, 'Consola nintendo', '70.00', 'Es color rojo', '1542380344_ca.jpeg', '2018-11-16 14:59:04'),
(27, 109, 4, 'carro sedan', '5000.00', 'es verde', '1542387396_carro.jpeg', '2018-11-16 16:56:36'),
(28, 85, 9, 'dinoco', '34.00', '', 'nodisp.png', '2019-11-05 07:47:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(70) NOT NULL,
  `imagen_categoria` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`, `imagen_categoria`) VALUES
(1, 'hogar', '1540275513_img.jpeg'),
(2, 'Telefonos y tablets', '1540397753_ta.jpeg'),
(3, 'vehiculos', '1541447454_terrat_landing.jpg'),
(4, 'electronicos', '1540402114_carga.jpeg'),
(5, 'moda', '1540275484_moda.jpeg'),
(6, 'animales', '1540397852_perr.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `telefono` varchar(9) DEFAULT NULL,
  `correo` varchar(100) NOT NULL,
  `mensaje` varchar(250) NOT NULL,
  `fecha_envio` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `nombre`, `telefono`, `correo`, `mensaje`, `fecha_envio`) VALUES
(1, 'mauricio lopez', '77777777', 'mauriccio.lopo@yahoo.es', 'este es el primer mensaje enviado ', '2018-10-29 04:04:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(70) NOT NULL,
  `correo` varchar(70) NOT NULL,
  `pass` varchar(250) NOT NULL,
  `tipo` tinyint(4) NOT NULL DEFAULT '1',
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`id_usuario`, `usuario`, `correo`, `pass`, `tipo`, `fecha_creacion`) VALUES
(55, 'rooter', 'm.jorge1slv@yahoo.es', 'be199e05b2d2cccda0f22275af7c3918', 1, '2018-09-17 21:30:47'),
(67, 'root2', 'm1.jorge1slv@yahoo.es', '8c8e1e1f9207764d450ff416def73663', 1, '2018-09-18 01:58:07'),
(76, 'nuevo', 'algo@yahoo.es', 'be199e05b2d2cccda0f22275af7c3918', 1, '2018-09-23 01:44:29'),
(77, 'fercha1', 'fercho12@123.com', 'b21040a0445855c124affc877bb72a99', 1, '2018-09-25 13:24:10'),
(78, 'prueba', 'prueba@gmail.com', 'c893bad68927b457dbed39460e6afd62', 1, '2018-10-02 13:51:56'),
(85, 'admin1', 'jorge336814@outlook.com', '8c8e1e1f9207764d450ff416def73663', 2, '2018-10-19 19:16:43'),
(86, 'carlos06', 'correo@yahoo.es', 'c2d6331d80c7e81f18a0f8179e648b19', 1, '2018-10-19 19:21:34'),
(87, 'admin2', 'salah@yahoo.es', '36388794be2cf5f298978498ff3c64a2', 2, '2018-11-05 19:52:19'),
(88, 'cristi', 'cristian@gmail.com', '5e95cc78575c2c45c07b9278eebb2827', 1, '2018-11-05 19:56:56'),
(89, 'admin3', 'cristiangil@yahoo.es', '014d4f2f91ba2b5bc921d91ed9857193', 2, '2018-11-06 00:25:46'),
(90, 'carlos12', 'carlos@yahoo.es', '8c8e1e1f9207764d450ff416def73663', 1, '2018-11-06 18:18:03'),
(91, 'carlitos12', 'carlo@yahoo.es', '86c06093b9c9351bcea13ba73dcf9502', 1, '2018-11-06 18:25:50'),
(92, 'sara1996 ', 'sara123@outlook.com', 'fb4e529ea6b9320c8bd32577f78a7fdf', 1, '2018-11-06 18:30:07'),
(93, 'prueba2018', 'prueba1028@yahoo.es', '851389c11af43193ecaca34f962721b3', 1, '2018-11-07 14:15:41'),
(94, 'p2019', 'prueba2019@gmail.com', 'fd45b5a61172e4a80e416fe003678f88', 1, '2018-11-07 14:29:26'),
(102, 'prueba2020', 'prueba2020@gmail.com', 'f3e1f9739be023d72444b66abb384f41', 1, '2018-11-07 14:32:05'),
(105, 'p21', 'prueba21@gmail.com', '47c2970e60e080387736dc6ca60f2e9b', 1, '2018-11-07 14:33:07'),
(107, 'marmota', 'aa@yahoo.es', '8c8e1e1f9207764d450ff416def73663', 1, '2018-11-07 16:14:14'),
(108, 'jlopez', 'jlopeza@yahoo.es', 'cbe1ba534465de78cea731b2ba3e571e', 1, '2018-11-13 15:16:03'),
(109, 'lalo', 'lalo@hotmail.com', '6a0897cfd163f9fb5bad0bea907e14f7', 1, '2018-11-13 18:43:46'),
(111, 'juancito', 'juanlopez@gmail.com', '48276a5f96714dc7f41d082837baa6f0', 1, '2018-11-13 18:47:04'),
(114, 'nuevo12', 'jorge@yahoo.es', 'e363236e51e198f9007b5b09b8346235', 1, '2018-11-16 15:05:07');

--
-- Disparadores `login`
--
DELIMITER $$
CREATE TRIGGER `trig_despuesregistroLogin` AFTER INSERT ON `login` FOR EACH ROW INSERT into usuarios(id_usuario) VALUES (new.id_usuario)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preferencias`
--

CREATE TABLE `preferencias` (
  `id_preferencia` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `preferencias`
--

INSERT INTO `preferencias` (`id_preferencia`, `id_usuario`, `id_categoria`) VALUES
(10, 55, 2),
(11, 76, 2),
(12, 76, 5),
(14, 76, 6),
(15, 76, 1),
(17, 76, 3),
(18, 77, 2),
(19, 77, 3),
(20, 77, 6),
(21, 85, 1),
(22, 85, 2),
(23, 85, 3),
(24, 85, 4),
(25, 85, 5),
(26, 85, 6),
(27, 67, 1),
(28, 67, 4),
(29, 67, 5),
(30, 67, 6),
(31, 78, 1),
(32, 78, 4),
(33, 78, 5),
(34, 78, 6),
(35, 87, 1),
(36, 87, 2),
(37, 88, 4),
(38, 88, 6),
(42, 89, 3),
(43, 89, 4),
(44, 89, 5),
(45, 89, 6),
(46, 92, 1),
(47, 92, 5),
(48, 92, 6),
(49, 91, 2),
(50, 91, 3),
(51, 91, 4),
(56, 93, 1),
(57, 93, 2),
(58, 93, 3),
(59, 93, 4),
(60, 93, 5),
(61, 93, 6),
(62, 108, 3),
(63, 108, 4),
(64, 109, 1),
(65, 109, 2),
(66, 109, 3),
(67, 109, 4),
(68, 111, 2),
(71, 114, 1),
(72, 114, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE `subcategorias` (
  `id_subCategoria` int(11) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `nombre_subCategoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `subcategorias`
--

INSERT INTO `subcategorias` (`id_subCategoria`, `id_categoria`, `nombre_subCategoria`) VALUES
(1, 2, 'tablets'),
(2, 2, 'replicas'),
(3, 2, 'accesorios'),
(4, 3, 'sedan'),
(5, 3, 'motos'),
(6, 3, 'pick-ups'),
(7, 1, 'Electrodomesticos'),
(8, 1, 'muebles'),
(9, 1, 'otros'),
(11, 4, 'video juegos'),
(12, 4, 'camaras'),
(13, 5, 'ropa'),
(14, 5, 'calzado'),
(15, 6, 'perros'),
(16, 6, 'gatos'),
(26, 2, 'telefono'),
(27, 6, 'avestruces'),
(28, 1, 'jardin'),
(29, 3, 'camiones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(25) DEFAULT NULL,
  `apellido_usuario` varchar(25) DEFAULT NULL,
  `departamento` varchar(25) DEFAULT NULL,
  `telefono` char(12) NOT NULL,
  `foto_usuario` varchar(300) NOT NULL DEFAULT 'avatar.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `apellido_usuario`, `departamento`, `telefono`, `foto_usuario`) VALUES
(67, 'jorge', 'martinez', 'la libertad', '7356-0009', '1541463558_casa.jpeg'),
(55, 'prueba', 'ape prueba', 'san miguel', '', 'avatar.jpg'),
(76, NULL, NULL, NULL, '', 'avatar.jpg'),
(77, 'fernando', 'lopez', 'san salvador', '7777-7777', 'avatar.jpg'),
(78, NULL, NULL, NULL, '', 'avatar.jpg'),
(85, 'jorge', 'martinez', 'san salvador', '7777-9999', '1540404621_ter.jpeg'),
(86, 'carlos', 'zumba', 'santa ana', '7777-7777', 'avatar.jpg'),
(87, 'Dennis', 'Eliseo', 'san salvador', '22577777', '1541447748_interiano.jpeg'),
(88, NULL, NULL, NULL, '', 'avatar.jpg'),
(89, NULL, NULL, NULL, '', 'avatar.jpg'),
(90, NULL, NULL, NULL, '', 'avatar.jpg'),
(91, 'carlos', 'lopez', 'cuscatlan', '78781212', 'avatar.jpg'),
(92, NULL, NULL, NULL, '', 'avatar.jpg'),
(93, 'pruebaprueba', 'prueba', 'la libertad', '22030302', '1541600403_carga.jpeg'),
(94, NULL, NULL, NULL, '', 'avatar.jpg'),
(102, NULL, NULL, NULL, '', 'avatar.jpg'),
(105, NULL, NULL, NULL, '', 'avatar.jpg'),
(107, NULL, NULL, NULL, '', 'avatar.jpg'),
(108, 'francisco', 'lopez', 'san vicente', '77777777', 'avatar.jpg'),
(109, 'lorenzo', 'gil', 'sonsonate', '78989888', 'avatar.jpg'),
(111, 'juan alberto', 'anaya', 'cuscatlan', '76090084', '1542134983_perfil.jpg'),
(114, NULL, NULL, NULL, '', 'avatar.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`id_anuncio`),
  ADD KEY `fk_anun_log` (`id_usuario`),
  ADD KEY `fk_anun_subca` (`id_subCategoria`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `preferencias`
--
ALTER TABLE `preferencias`
  ADD PRIMARY KEY (`id_preferencia`),
  ADD KEY `fk_prefe_log` (`id_usuario`),
  ADD KEY `fk_prefe_subca` (`id_categoria`);

--
-- Indices de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`id_subCategoria`),
  ADD KEY `fk_subca_cate` (`id_categoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD KEY `fk_log_usu` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `id_anuncio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT de la tabla `preferencias`
--
ALTER TABLE `preferencias`
  MODIFY `id_preferencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `id_subCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD CONSTRAINT `fk_anun_subca` FOREIGN KEY (`id_subCategoria`) REFERENCES `subcategorias` (`id_subCategoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_anun_usu` FOREIGN KEY (`id_usuario`) REFERENCES `login` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `preferencias`
--
ALTER TABLE `preferencias`
  ADD CONSTRAINT `fk_prefe_usu` FOREIGN KEY (`id_usuario`) REFERENCES `login` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `preferencias_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD CONSTRAINT `fk_subca_cate` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_log_usu` FOREIGN KEY (`id_usuario`) REFERENCES `login` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
