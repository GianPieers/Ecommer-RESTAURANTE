-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2020 at 07:53 PM
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_A_categoria` (`nombre` VARCHAR(50))  insert into categoria (catNombre)
			values (nombre)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_A_producto` (`pronombre` VARCHAR(50), `proprecio` DOUBLE, `stock` INT, `idcategoria` INT)  insert into producto (proNombre,proPrecioPropuesto,proStock,IDCategoria)
			values (pronombre,proprecio,stock,idcategoria)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_A_usuario` (`usunombre` VARCHAR(50), `usupassword` VARCHAR(50))  insert into usuario (usuNombre,usuPassword) values (usunombre,usupassword)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_C_categoria` (`idCategoria` INT)  SELECT*FROM categoria WHERE IDCategoria=idCategoria$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_C_producto` (IN `idproducto` INT)  SELECT*FROM producto WHERE IDProducto = idproducto$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_C_usuario` (`idusuario` INT)  SELECT*FROM usuario WHERE IDUsuario=idusuario$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_E_categoria` (`idCategoria` INT)  delete from categoria 
    where IDCategoria=idCategoria$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_E_producto` (`idproducto` INT)  delete from producto 
    where IDProducto=idproducto$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_E_usuario` (`idusuario` INT)  delete from usuario 
    where IDUsuario=idusuario$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_M_categoria` (`nombre` VARCHAR(50), `idCategoria` INT)  update categoria set catNombre=nombre
						
				where IDCategoria=idCategoria$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_M_producto` (`pronombre` VARCHAR(50), `proprecio` DOUBLE, `stock` INT, `idcategoria` INT, `idproducto` INT)  update producto 
    set proNombre=nombre,proPrecioPropuesto=proprecio,proStock=stock,IDCategoria=idcategoria
    where IDCategoria=idCategoria$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_M_usuario` (`usunombre` VARCHAR(50), `usupassword` VARCHAR(50), `idusuario` INT)  update producto 
    set usuNombre=usunombre,usuPassword=usupassword
    where IDUsuario=idusuario$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `IDCategoria` int(11) NOT NULL,
  `catNombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`IDCategoria`, `catNombre`) VALUES
(1, 'Parrillas'),
(2, 'Clásicos'),
(3, 'Sopas'),
(4, 'Ensaladas'),
(5, 'Bebidas');

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
(1, 'inca cola', 34.56, 2, 1, 1),
(2, 'Ejemplo', 20, 10, 1, 0),
(10, 'Otro ejemplo', 40, 10, 1, 1),
(13, 'Chancho al palo', 40, 10, 1, 1),
(14, 'Pachamanca 2 sabores', 60, 20, 2, 1),
(15, 'Pachamanca 1 sabor', 45, 15, 2, 1),
(16, 'Coca Cola', 10, 50, 5, 1),
(17, 'Ceviche', 20, 5, 2, 1),
(18, 'Pepsi', 8, 30, 5, 1),
(19, 'pa borrar', 3, 19, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `IDUsuario` int(11) NOT NULL,
  `usuNombre` varchar(50) NOT NULL,
  `usuPassword` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`IDUsuario`, `usuNombre`, `usuPassword`) VALUES
(1, 'admin', '123456'),
(2, 'oscar', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`IDCategoria`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`IDProducto`),
  ADD KEY `fk_CatPro` (`IDCategoria`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IDUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `IDCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
  MODIFY `IDProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IDUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_CatPro` FOREIGN KEY (`IDCategoria`) REFERENCES `categoria` (`IDCategoria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
