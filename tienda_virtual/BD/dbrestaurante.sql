-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2020 at 12:59 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbrestaurante`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_A_categoria` (IN `nombre` VARCHAR(50), IN `descripcion` VARCHAR(200), IN `porta` VARCHAR(100), IN `estado` BOOLEAN)  NO SQL
INSERT INTO categoria(catNombre,catDescripcion,portada,catEstado) VALUES(nombre,descripcion,porta,estado)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_A_cliente` (IN `dni` VARCHAR(8), IN `clinombre` VARCHAR(50), IN `cliappaterno` VARCHAR(50), IN `cliapmaterno` VARCHAR(50), IN `clidireccion` VARCHAR(50), IN `clicorreo` VARCHAR(50), IN `clicelular` VARCHAR(9), IN `clipassword` VARCHAR(50))  NO SQL
insert into cliente (DNI,cliNombre,cliApPaterno,cliApMaterno,cliDireccion,cliCorreo,cliCelular,cliPassword) values (dni,clinombre,cliappaterno,cliapmaterno,clidireccion,clicorreo,clicelular,clipassword)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_A_pedido` (IN `clidni` INT(8), IN `pedpreciototal` FLOAT, IN `pedfecha` DATE)  NO SQL
insert into pedido (DNI,pedPrecioTotal,pedFecha)
			values (clidni,pedpreciototal,pedfecha)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_A_producto` (`pronombre` VARCHAR(50), `proprecio` DOUBLE, `stock` INT, `idcategoria` INT)  insert into producto (proNombre,proPrecioPropuesto,proStock,IDCategoria)
			values (pronombre,proprecio,stock,idcategoria)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_A_promocion` (IN `nombre` VARCHAR(50), IN `precio` DOUBLE, IN `stock` INT(11), IN `idproducto` INT(11))  NO SQL
INSERT INTO promocion(promNombre,promPrecio,promStock,promIDproducto) VALUES(nombre,precio,stock,idproducto)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_A_usuario` (IN `dni` VARCHAR(8), IN `usunombres` VARCHAR(50), IN `usuappaterno` VARCHAR(50), IN `usuapmaterno` VARCHAR(50), IN `usudireccion` VARCHAR(50), IN `usutelefono` VARCHAR(100), IN `usupassword` VARCHAR(15), IN `usucorreo` VARCHAR(50))  insert into usuario (DNI,usuNombres,usuApPaterno,usuApMaterno,usuDireccion,usuTelefono,usuPassword,usuCorreo) values (dni,usunombres,usuappaterno,usuapmaterno,usudireccion,usutelefono,usupassword,usucorreo)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_C_pedido` (IN `id` VARCHAR(11))  SELECT*FROM pedido WHERE IDPedido=id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_C_producto` (IN `idproducto` INT(11))  SELECT*FROM producto WHERE IDProducto = idproducto$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_C_promocion` (IN `idpromocion` INT(5))  NO SQL
SELECT * FROM promocion WHERE IDPromocion=idpromocion$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_C_usuario` (IN `dni` VARCHAR(8))  SELECT*FROM usuario WHERE DNI=dni$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_E_pedido` (IN `id` VARCHAR(11))  delete from pedido 
    where IDPedido=id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_E_producto` (`idproducto` INT)  delete from producto 
    where IDProducto=idproducto$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_E_usuario` (`idusuario` INT)  delete from usuario 
    where IDUsuario=idusuario$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_login` (IN `correo` VARCHAR(50), IN `password` VARCHAR(50), IN `estado` BOOLEAN)  NO SQL
SELECT usuCorreo, usuPassword WHERE estado != 0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_M_pedido` (`id` VARCHAR(11), `prec` FLOAT, `fecha` DATE, `dni` VARCHAR(8))  update pedido set pedPrecioTotal=prec,pedFecha=fecha,DNI=dni
where IDPedido=id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_M_producto` (IN `pronombre` VARCHAR(50), IN `proprecio` DOUBLE, IN `stock` INT, IN `idcategoria` INT, IN `idproducto` INT)  update producto 
    set proNombre=nombre,proPrecioPropuesto=proprecio,proStock=stock,IDCategoria=idcategoria
    where IDProducto=idProducto$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_M_usuario` (IN `usunombre` VARCHAR(50), IN `usupassword` VARCHAR(50), IN `idusuario` INT)  update usuario 
    set usuNombres=usunombres,usuPassword=usupassword
    where IDUsuario=idusuario$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `IDCategoria` int(11) NOT NULL,
  `catNombre` varchar(50) NOT NULL,
  `catDescripcion` varchar(200) NOT NULL,
  `catEstado` tinyint(1) NOT NULL DEFAULT 1,
  `portada` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`IDCategoria`, `catNombre`, `catDescripcion`, `catEstado`, `portada`) VALUES
(1, 'Parrillas clásicas', 'Surtido de carne, pescado, marisco o verdura que se asa a la parrilla, añadido con vegetales.', 1, 'img_4522bc3c07db64c808cbd07d10f04cce.jpg'),
(2, 'Clásicos', '', 1, ''),
(3, 'Sopas', 'Plato de caldo con pasta, arroz, sémola, hortalizas, u otros alimentos troceados que se cuecen en ese caldo.', 1, 'portada_categoria.png'),
(4, 'Ensaladas', '', 1, ''),
(5, 'Bebidas', '', 1, ''),
(14, 'Fusión', 'Mezcla de diferentes condimentos e ingredientes representativos de distintos lugares.', 1, 'img_65809ed12766a1e0929a27e1c509aaf7.jpg'),
(15, 'ejemplo', 'otro ejemplo', 0, 'portada_categoria.png');

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `DNI` varchar(8) NOT NULL,
  `cliNombre` varchar(50) NOT NULL,
  `cliApPaterno` varchar(50) NOT NULL,
  `cliApMaterno` varchar(50) DEFAULT NULL,
  `cliDireccion` varchar(50) NOT NULL,
  `cliCorreo` varchar(50) NOT NULL,
  `cliCelular` varchar(9) NOT NULL,
  `cliPassword` varchar(50) NOT NULL,
  `cliEstado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`DNI`, `cliNombre`, `cliApPaterno`, `cliApMaterno`, `cliDireccion`, `cliCorreo`, `cliCelular`, `cliPassword`, `cliEstado`) VALUES
('64646464', 'Junior', 'Barta', '', 'Psj. San Sebastian 203', 'juniorBarta@outlook.com', '644444444', '6464', 0),
('70605040', 'Jesus', 'Ventura', 'Casachagua', 'Jr. Los olivos 763', 'jesusVentura@gmail.com', '987654321', '123456', 1),
('71254562', 'Juan', 'Morales', '', 'Av. Pierola 342', 'juanMorales@gmail.com', '987235234', '123456', 1),
('80706050', 'Alfredo', 'Muñoz', 'Alvarado', 'Av. Ferrocarril 831', 'alfredoMunoz@outlook.com', '985342643', '123456', 1),
('88888888', 'Hello', 'How Are You?', '', 'I\'m drowning', 'pls@help.com', '888888888', '888', 1);

-- --------------------------------------------------------

--
-- Table structure for table `detallepedido`
--

CREATE TABLE `detallepedido` (
  `IDPedido` int(11) NOT NULL,
  `IDProducto` int(11) NOT NULL,
  `detCantidad` int(4) NOT NULL,
  `detPrecio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pedido`
--

CREATE TABLE `pedido` (
  `IDPedido` int(11) NOT NULL,
  `IDProducto` int(11) NOT NULL,
  `pedPrecioTotal` float NOT NULL,
  `DNI` varchar(8) NOT NULL,
  `pedFecha` date NOT NULL,
  `pedEstado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pedido`
--

INSERT INTO `pedido` (`IDPedido`, `IDProducto`, `pedPrecioTotal`, `DNI`, `pedFecha`, `pedEstado`) VALUES
(1, 0, 300.5, '64646464', '2020-05-04', 0),
(2, 0, 104.2, '70605040', '2020-10-10', 0),
(4, 0, 100.5, '64646464', '2020-07-25', 1),
(5, 0, 200, '70605040', '0000-00-00', 1),
(6, 0, 50.5, '71254562', '2020-09-19', 1),
(7, 0, 89.9, '70605040', '2020-11-12', 1),
(8, 0, 600, '71254562', '2020-11-28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `IDProducto` int(11) NOT NULL,
  `proNombre` varchar(50) NOT NULL,
  `proPrecioPropuesto` float NOT NULL,
  `proStock` int(11) NOT NULL,
  `IDCategoria` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`IDProducto`, `proNombre`, `proPrecioPropuesto`, `proStock`, `IDCategoria`, `estado`) VALUES
(1, 'inca cola', 10, 2, 5, 0),
(13, 'Chancho al palo', 40, 10, 1, 1),
(14, 'Pachamanca 2 sabores', 45, 20, 2, 0),
(15, 'Pachamanca 1 sabor', 30, 15, 2, 0),
(16, 'Coca Cola', 10, 50, 5, 1),
(17, 'Ceviche', 20, 50, 2, 1),
(18, 'Pepsi', 8, 30, 5, 0),
(24, 'Coca Cola Zero', 8, 110, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `promocion`
--

CREATE TABLE `promocion` (
  `IDPromocion` int(5) NOT NULL,
  `promNombre` varchar(50) NOT NULL,
  `promPrecio` double NOT NULL,
  `promStock` int(11) NOT NULL,
  `promIDproducto` int(11) NOT NULL,
  `promEstado` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `promocion`
--

INSERT INTO `promocion` (`IDPromocion`, `promNombre`, `promPrecio`, `promStock`, `promIDproducto`, `promEstado`) VALUES
(2, 'Cyber Monday', 10, 100, 17, 1),
(4, 'Descuentos sobre descuentos', 80.8, 34, 18, 1),
(5, 'Black Friday', 50, 1000, 14, 1),
(6, 'ejemplo', 99, 99, 14, 0);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `DNI` varchar(8) NOT NULL,
  `usuNombres` varchar(50) NOT NULL,
  `usuPassword` varchar(100) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `usuApPaterno` varchar(50) NOT NULL,
  `usuApMaterno` varchar(50) DEFAULT NULL,
  `usuDireccion` varchar(100) NOT NULL,
  `usuTelefono` varchar(15) NOT NULL,
  `usuCorreo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`DNI`, `usuNombres`, `usuPassword`, `estado`, `usuApPaterno`, `usuApMaterno`, `usuDireccion`, `usuTelefono`, `usuCorreo`) VALUES
('1', '111', '1', 0, '1', '', '1', '1', ''),
('2', '2', '2', 0, '2', '', '2', '2', '2@2.com'),
('32232232', 'Jordan', '123', 1, 'Jimenez', '', 'Av. Los Alamos 987', '343534', 'jordanJimenez@outlook.com'),
('70401658', 'Jhonatan', '123', 1, 'Capcha', 'Ramos', 'Av. Ferrocarril S/N', '989763365', 'Jhonatan@gmail.com'),
('75972721', 'oscar', '123456', 1, 'Torcillas', 'Tacay', 'Av. Siempre Viva 204', '989645321', 'oscar@gmail.com'),
('76310844', 'Gian Pieers', '123456', 1, 'De La Cruz', 'Quincho', 'Jr. Los Manzanos 840', '987654321', ''),
('85432534', 'Carlos', '123', 1, 'Alcantara', '', 'Jr. Siempre Viva 203', '586434', 'carlosAlcantara@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`IDCategoria`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`DNI`);

--
-- Indexes for table `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD PRIMARY KEY (`IDPedido`,`IDProducto`),
  ADD KEY `IDProducto` (`IDProducto`),
  ADD KEY `IDPedido` (`IDPedido`);

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`IDPedido`),
  ADD KEY `DNI` (`DNI`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`IDProducto`),
  ADD KEY `fk_CatPro` (`IDCategoria`);

--
-- Indexes for table `promocion`
--
ALTER TABLE `promocion`
  ADD PRIMARY KEY (`IDPromocion`),
  ADD KEY `promIDproducto` (`promIDproducto`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`DNI`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `IDCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `IDPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
  MODIFY `IDProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `promocion`
--
ALTER TABLE `promocion`
  MODIFY `IDPromocion` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD CONSTRAINT `detallepedido_ibfk_1` FOREIGN KEY (`IDProducto`) REFERENCES `producto` (`IDProducto`),
  ADD CONSTRAINT `detallepedido_ibfk_2` FOREIGN KEY (`IDPedido`) REFERENCES `pedido` (`IDPedido`);

--
-- Constraints for table `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`DNI`) REFERENCES `cliente` (`DNI`);

--
-- Constraints for table `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_CatPro` FOREIGN KEY (`IDCategoria`) REFERENCES `categoria` (`IDCategoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `promocion`
--
ALTER TABLE `promocion`
  ADD CONSTRAINT `promocion_ibfk_1` FOREIGN KEY (`promIDproducto`) REFERENCES `producto` (`IDProducto`) ON DELETE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
