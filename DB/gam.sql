-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.6-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para gam-library
DROP DATABASE IF EXISTS `gam-library`;
CREATE DATABASE IF NOT EXISTS `gam-library` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `gam-library`;

-- Volcando estructura para tabla gam-library.gen_ciudades
DROP TABLE IF EXISTS `gen_ciudades`;
CREATE TABLE IF NOT EXISTS `gen_ciudades` (
  `id_ciudad` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_ciudad` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `descripcion` varchar(255) NOT NULL,
  `iddepartamento` int(11) NOT NULL DEFAULT 0 COMMENT 'Relacional gen_departamentos',
  `estado` int(11) NOT NULL DEFAULT 1 COMMENT '0) Inactivo 1)Inactivo',
  PRIMARY KEY (`id_ciudad`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla gam-library.gen_ciudades: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `gen_ciudades` DISABLE KEYS */;
INSERT INTO `gen_ciudades` (`id_ciudad`, `nombre_ciudad`, `descripcion`, `iddepartamento`, `estado`) VALUES
	(1, 'Bogotá', 'Sede en Bogota', 9, 1);
/*!40000 ALTER TABLE `gen_ciudades` ENABLE KEYS */;

-- Volcando estructura para tabla gam-library.gen_departamentos
DROP TABLE IF EXISTS `gen_departamentos`;
CREATE TABLE IF NOT EXISTS `gen_departamentos` (
  `id_departamento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_dep` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_departamento`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla gam-library.gen_departamentos: ~21 rows (aproximadamente)
/*!40000 ALTER TABLE `gen_departamentos` DISABLE KEYS */;
INSERT INTO `gen_departamentos` (`id_departamento`, `nombre_dep`) VALUES
	(1, 'Antioquia'),
	(2, 'Atlántico'),
	(3, 'Bolívar'),
	(4, 'Boyacá'),
	(5, 'Caldas'),
	(6, 'Cauca'),
	(7, 'Cesar'),
	(8, 'Córdoba'),
	(9, 'Cundinamarca'),
	(10, 'Guajira'),
	(11, 'Huila'),
	(12, 'Magdalena'),
	(13, 'Meta'),
	(14, 'Nariño'),
	(15, 'Norte de Santander'),
	(16, 'Quindío'),
	(17, 'Risaralda'),
	(18, 'Santander'),
	(19, 'Sucre'),
	(20, 'Tolima'),
	(21, 'Valle del Cauca');
/*!40000 ALTER TABLE `gen_departamentos` ENABLE KEYS */;

-- Volcando estructura para tabla gam-library.profiles
DROP TABLE IF EXISTS `profiles`;
CREATE TABLE IF NOT EXISTS `profiles` (
  `id_profile` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_profile`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla gam-library.profiles: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` (`id_profile`, `name`, `description`) VALUES
	(1, 'Administrador', 'Administrador del sistema'),
	(2, 'Bibliotecario', 'Bibliotecario'),
	(3, 'Usuario', 'Usuario');
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;

-- Volcando estructura para tabla gam-library.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL DEFAULT '0',
  `identificacion` varchar(50) NOT NULL DEFAULT '' COMMENT 'Cedula o numero de indentificacion preferido en la empresa',
  `password` varchar(50) NOT NULL DEFAULT '0',
  `idrol` int(11) NOT NULL DEFAULT 0 COMMENT 'Relacional users_roles',
  `nombre1` varchar(50) NOT NULL DEFAULT '0',
  `nombre2` varchar(50) DEFAULT '0',
  `apellido1` varchar(50) NOT NULL DEFAULT '0',
  `apellido2` varchar(50) DEFAULT '0',
  `nombre_completo` varchar(250) DEFAULT NULL,
  `cargo` varchar(50) NOT NULL DEFAULT '0',
  `correo` varchar(100) NOT NULL DEFAULT '0',
  `telefono` varchar(15) NOT NULL DEFAULT '0',
  `extension` varchar(15) NOT NULL,
  `imagen_perfil` varchar(250) NOT NULL DEFAULT '0',
  `estado` int(11) NOT NULL DEFAULT 1 COMMENT '0)Inactivo 1)Activo',
  `logOne` int(11) NOT NULL DEFAULT 0 COMMENT '0)Sin loguearse nunca 1)Logueo validado',
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `UniqueUser` (`usuario`),
  KEY `FKUsuarios_Roles` (`idrol`),
  KEY `nombrecompleto` (`nombre_completo`),
  KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla gam-library.users: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id_usuario`, `usuario`, `identificacion`, `password`, `idrol`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `nombre_completo`, `cargo`, `correo`, `telefono`, `extension`, `imagen_perfil`, `estado`, `logOne`) VALUES
	(1, 'admin', '1031155506', '1NfRz+Q=', 1, 'Usuario', '', 'Administrador', '', 'Usuario  Administrador ', 'Administrador', 'proinsoft.desarrollo@gmail.com', '3195482079', '123', 'iconoUser.jpg', 1, 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Volcando estructura para tabla gam-library.users_roles
DROP TABLE IF EXISTS `users_roles`;
CREATE TABLE IF NOT EXISTS `users_roles` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(50) NOT NULL DEFAULT '0',
  `descripcion` varchar(250) NOT NULL DEFAULT '0',
  `estado` int(11) NOT NULL DEFAULT 1 COMMENT '0)Inactivo 1)Activo',
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla gam-library.users_roles: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `users_roles` DISABLE KEYS */;
INSERT INTO `users_roles` (`id_rol`, `nombre_rol`, `descripcion`, `estado`) VALUES
	(1, 'Super Admin', 'Super Admin', 1),
	(2, 'Administrador', 'Administrador', 0),
	(3, 'Operador', 'Operador', 1);
/*!40000 ALTER TABLE `users_roles` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
