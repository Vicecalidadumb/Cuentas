-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 11-09-2014 a las 15:05:19
-- Versión del servidor: 5.5.20
-- Versión de PHP: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `umb_cuentas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_cortes`
--

CREATE TABLE IF NOT EXISTS `cuentas_cortes` (
  `CORTE_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID DE LA TABLA',
  `CORTE_NOMBREADMIN` varchar(128) DEFAULT NULL COMMENT 'NOMBRE ADMINISTRATIVO',
  `CORTE_DIAPAGO` int(11) DEFAULT NULL COMMENT 'FECHA DE PAGO',
  `CORTE_DIAINICIO` int(11) DEFAULT NULL COMMENT 'DIA DE INICIO DEL CORTE',
  `CORTE_DIAFIN` int(11) DEFAULT NULL COMMENT 'DIA FINALIZACION DEL CORTE',
  `USUARIO_ID` int(11) DEFAULT NULL COMMENT 'ID DEL USUARIO CREADOR',
  `CORTE_FECHACREACION` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'FECHA DE CREACION',
  `CORTE_ESTADO` tinyint(4) DEFAULT '1' COMMENT 'ESTADO EN EL SISTEMA',
  PRIMARY KEY (`CORTE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `cuentas_cortes`
--

INSERT INTO `cuentas_cortes` (`CORTE_ID`, `CORTE_NOMBREADMIN`, `CORTE_DIAPAGO`, `CORTE_DIAINICIO`, `CORTE_DIAFIN`, `USUARIO_ID`, `CORTE_FECHACREACION`, `CORTE_ESTADO`) VALUES
(1, 'CORTE 01', 15, 1, 14, 8, '2014-08-29 21:38:00', 1),
(2, 'CORTE 02', 25, 15, 24, 8, '2014-08-29 21:38:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_modulos`
--

CREATE TABLE IF NOT EXISTS `cuentas_modulos` (
  `ID_MODULO` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID DEL MODULO',
  `NOM_MODULO` varchar(300) DEFAULT NULL COMMENT 'NOMBRE DEL MODULO',
  `SIGLA_MODULO` varchar(3) DEFAULT NULL,
  `ACT_MODULO` tinyint(1) DEFAULT NULL COMMENT 'ESTADO DEL MODULO(1=ACTIVO,0=INACTIVO)',
  PRIMARY KEY (`ID_MODULO`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='MODULOS DE SISTEMA' AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `cuentas_modulos`
--

INSERT INTO `cuentas_modulos` (`ID_MODULO`, `NOM_MODULO`, `SIGLA_MODULO`, `ACT_MODULO`) VALUES
(1, 'ADMINISTRACION DE ROLES', 'ROL', 1),
(2, 'ADMINISTRACION DE USUARIOS', 'USU', 1),
(3, 'ADMINISTRACION DE CORTES', 'COR', 1),
(4, 'ADMINISTRACION DE HOJAS DE VIDA', 'HVI', 1),
(5, 'ADMINISTRACION DE CONTRATOS', 'CON', 1),
(6, 'ADMINISTRACION DE DTOS POR CORTE', 'DCO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_modulos_tipos`
--

CREATE TABLE IF NOT EXISTS `cuentas_modulos_tipos` (
  `ID_MODULO` int(11) NOT NULL COMMENT 'ID DEL MODULO',
  `ID_TIPO_USU` int(11) NOT NULL COMMENT 'ID DEL TIPO DE USUARIO',
  `GUARDAR` tinyint(1) DEFAULT NULL COMMENT 'GUARDAR EN MODULO',
  `ACTUALIZAR` tinyint(1) DEFAULT NULL COMMENT 'ACTUALIZAR EN MODULO',
  `ELIMINAR` tinyint(1) DEFAULT NULL COMMENT 'ELIMINAR EN MODULO',
  `CONSULTAR` tinyint(1) DEFAULT NULL COMMENT 'CONSULTAR MODULO',
  PRIMARY KEY (`ID_MODULO`,`ID_TIPO_USU`),
  KEY `ID_TIPO_USU` (`ID_TIPO_USU`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Modulos por Tipos de Usuario';

--
-- Volcado de datos para la tabla `cuentas_modulos_tipos`
--

INSERT INTO `cuentas_modulos_tipos` (`ID_MODULO`, `ID_TIPO_USU`, `GUARDAR`, `ACTUALIZAR`, `ELIMINAR`, `CONSULTAR`) VALUES
(1, 1, 1, 1, 1, 1),
(1, 2, 0, 0, 0, 0),
(1, 3, 0, 0, 0, 0),
(1, 4, 0, 0, 0, 0),
(2, 1, 1, 1, 1, 1),
(2, 2, 0, 0, 0, 0),
(2, 3, 0, 0, 0, 0),
(2, 4, 0, 0, 0, 0),
(3, 1, 1, 1, 1, 1),
(3, 2, 0, 0, 0, 1),
(3, 3, 1, 1, 1, 1),
(3, 4, 0, 0, 0, 1),
(4, 1, 1, 1, 1, 1),
(4, 2, 1, 1, 1, 1),
(4, 3, 1, 1, 1, 1),
(4, 4, 0, 0, 0, 0),
(5, 1, 1, 1, 1, 1),
(5, 2, 0, 0, 0, 1),
(5, 3, 1, 1, 1, 1),
(5, 4, 0, 0, 0, 1),
(6, 1, 1, 1, 1, 1),
(6, 2, 0, 0, 0, 0),
(6, 3, 1, 1, 1, 1),
(6, 4, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_session`
--

CREATE TABLE IF NOT EXISTS `cuentas_session` (
  `session_id` varchar(40) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(45) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cuentas_session`
--

INSERT INTO `cuentas_session` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('02c04c79f7051dd1f4c4286decfe2502', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2152.0 Safari/537.36', 1410442251, 'a:17:{s:9:"user_data";s:0:"";s:10:"USUARIO_ID";s:1:"8";s:15:"USUARIO_NOMBRES";s:13:"ADMINISTRADOR";s:17:"USUARIO_APELLIDOS";s:7:"CUENTAS";s:21:"USUARIO_TIPODOCUMENTO";s:2:"CC";s:23:"USUARIO_NUMERODOCUMENTO";s:6:"123456";s:14:"USUARIO_CORREO";s:23:"yeison.arias@umb.edu.co";s:14:"USUARIO_GENERO";s:1:"M";s:25:"USUARIO_FECHADENACIMIENTO";s:10:"2014-08-25";s:27:"USUARIO_DIRECCIONRESIDENCIA";s:11:"VICECALIDAD";s:20:"USUARIO_TELEFONOFIJO";s:7:"1234567";s:15:"USUARIO_CELULAR";s:10:"3171115544";s:14:"USUARIO_ESTADO";s:1:"1";s:20:"USUARIO_FECHAINGRESO";s:19:"2014-08-25 14:45:52";s:11:"ID_TIPO_USU";s:1:"1";s:15:"rol_permissions";a:6:{s:3:"ROL";a:3:{s:4:"name";s:23:"ADMINISTRACION DE ROLES";s:2:"id";s:1:"1";s:11:"permissions";a:4:{s:15:"permission_view";s:1:"1";s:14:"permission_add";s:1:"1";s:15:"permission_edit";s:1:"1";s:17:"permission_delete";s:1:"1";}}s:3:"USU";a:3:{s:4:"name";s:26:"ADMINISTRACION DE USUARIOS";s:2:"id";s:1:"2";s:11:"permissions";a:4:{s:15:"permission_view";s:1:"1";s:14:"permission_add";s:1:"1";s:15:"permission_edit";s:1:"1";s:17:"permission_delete";s:1:"1";}}s:3:"COR";a:3:{s:4:"name";s:24:"ADMINISTRACION DE CORTES";s:2:"id";s:1:"3";s:11:"permissions";a:4:{s:15:"permission_view";s:1:"1";s:14:"permission_add";s:1:"1";s:15:"permission_edit";s:1:"1";s:17:"permission_delete";s:1:"1";}}s:3:"HVI";a:3:{s:4:"name";s:31:"ADMINISTRACION DE HOJAS DE VIDA";s:2:"id";s:1:"4";s:11:"permissions";a:4:{s:15:"permission_view";s:1:"1";s:14:"permission_add";s:1:"1";s:15:"permission_edit";s:1:"1";s:17:"permission_delete";s:1:"1";}}s:3:"CON";a:3:{s:4:"name";s:27:"ADMINISTRACION DE CONTRATOS";s:2:"id";s:1:"5";s:11:"permissions";a:4:{s:15:"permission_view";s:1:"1";s:14:"permission_add";s:1:"1";s:15:"permission_edit";s:1:"1";s:17:"permission_delete";s:1:"1";}}s:3:"DCO";a:3:{s:4:"name";s:32:"ADMINISTRACION DE DTOS POR CORTE";s:2:"id";s:1:"6";s:11:"permissions";a:4:{s:15:"permission_view";s:1:"1";s:14:"permission_add";s:1:"1";s:15:"permission_edit";s:1:"1";s:17:"permission_delete";s:1:"1";}}}s:9:"logged_in";b:1;}'),
('119200f9064ec8f41959a3c665914ffc', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2146.0 Safari/537.36', 1410357672, 'a:17:{s:9:"user_data";s:0:"";s:10:"USUARIO_ID";s:1:"8";s:15:"USUARIO_NOMBRES";s:13:"ADMINISTRADOR";s:17:"USUARIO_APELLIDOS";s:7:"CUENTAS";s:21:"USUARIO_TIPODOCUMENTO";s:2:"CC";s:23:"USUARIO_NUMERODOCUMENTO";s:6:"123456";s:14:"USUARIO_CORREO";s:23:"yeison.arias@umb.edu.co";s:14:"USUARIO_GENERO";s:1:"M";s:25:"USUARIO_FECHADENACIMIENTO";s:10:"2014-08-25";s:27:"USUARIO_DIRECCIONRESIDENCIA";s:11:"VICECALIDAD";s:20:"USUARIO_TELEFONOFIJO";s:5:"00000";s:15:"USUARIO_CELULAR";s:5:"00000";s:14:"USUARIO_ESTADO";s:1:"1";s:20:"USUARIO_FECHAINGRESO";s:19:"2014-08-25 14:45:52";s:11:"ID_TIPO_USU";s:1:"1";s:15:"rol_permissions";a:1:{s:3:"COR";a:3:{s:4:"name";s:6:"CORTES";s:2:"id";s:1:"1";s:11:"permissions";a:4:{s:15:"permission_view";s:1:"0";s:14:"permission_add";s:1:"0";s:15:"permission_edit";s:1:"0";s:17:"permission_delete";s:1:"0";}}}s:9:"logged_in";b:1;}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_tipos_usuario`
--

CREATE TABLE IF NOT EXISTS `cuentas_tipos_usuario` (
  `ID_TIPO_USU` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID DEL TIPO DE USUARIO',
  `NOM_TIPO_USU` varchar(250) DEFAULT NULL COMMENT 'NOMBRE DEL TIPO DE USUARIO',
  `ACT_TIPO_USU` tinyint(1) DEFAULT NULL COMMENT 'ESTADO DEL TIPO DE USUARIO(1=ACTIVO,0=INACTIVO)',
  PRIMARY KEY (`ID_TIPO_USU`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='TIPOS DE USUARIOS' AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `cuentas_tipos_usuario`
--

INSERT INTO `cuentas_tipos_usuario` (`ID_TIPO_USU`, `NOM_TIPO_USU`, `ACT_TIPO_USU`) VALUES
(1, 'Administrador General', 1),
(2, 'Administrador de Hojas de Vida', 1),
(3, 'Administrador de Contratos', 1),
(4, 'Administrador de Documentos por Corte', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_usuarios`
--

CREATE TABLE IF NOT EXISTS `cuentas_usuarios` (
  `USUARIO_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID DEL USUARIO',
  `USUARIO_PASSWORD` varchar(256) COLLATE utf8_spanish_ci NOT NULL COMMENT 'CONTRASEÑA DEL USUARIO DEL SISTEMA',
  `USUARIO_NOMBRES` varchar(512) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'NOMBRES DEL USUARIO',
  `USUARIO_APELLIDOS` varchar(512) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'APELLIDOS DEL USUARIO',
  `USUARIO_TIPODOCUMENTO` varchar(2) COLLATE utf8_spanish_ci DEFAULT 'CC' COMMENT 'TIPO DE DOCUMENTO DEL USUARIO',
  `USUARIO_NUMERODOCUMENTO` varchar(11) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'NUMERO DE DOCUMENTO DEL USUARIO',
  `USUARIO_CORREO` varchar(512) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'CORREO ELECTRONICO DEL USUARIO',
  `USUARIO_GENERO` varchar(1) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'GENERO DEL USUARIO (M=MASCULINO,F=FEMENINO)',
  `USUARIO_FECHADENACIMIENTO` date DEFAULT NULL COMMENT 'FECHA DE NACIMIENTO',
  `USUARIO_LUGARDENACIMIENTO` varchar(24) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'CODIGO DANE DEL LUGAR DE NACIMIENTO',
  `USUARIO_DIRECCIONRESIDENCIA` varchar(512) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'DIRECCION DE RESIDENCIA',
  `USUARIO_LUGARDERESIDENCIA` varchar(24) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'CODIGO DANE DEL LUGAR DE RESIDENCIA',
  `USUARIO_TELEFONOFIJO` varchar(24) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'TELEFONO FIJO',
  `USUARIO_CELULAR` varchar(24) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'CELULAR',
  `USUARIO_ESTADO` tinyint(1) DEFAULT '1' COMMENT 'ESTADO DEL USUARIO EN EL SISTEMA (1=ACTIVO,2=INACTIVO))',
  `USUARIO_FECHAINGRESO` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'FECHA DE INGRESO AL SISTEMA',
  `ID_TIPO_USU` int(1) NOT NULL DEFAULT '1' COMMENT 'ID DEL TIPO DE USUARIO',
  PRIMARY KEY (`USUARIO_ID`),
  UNIQUE KEY `USUARIO_NUMERODOCUMENTO_2` (`USUARIO_NUMERODOCUMENTO`),
  KEY `ID_TIPO_USU` (`ID_TIPO_USU`),
  KEY `USUARIO_NUMERODOCUMENTO` (`USUARIO_NUMERODOCUMENTO`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='USUARIOS DEL SISTEMA' AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `cuentas_usuarios`
--

INSERT INTO `cuentas_usuarios` (`USUARIO_ID`, `USUARIO_PASSWORD`, `USUARIO_NOMBRES`, `USUARIO_APELLIDOS`, `USUARIO_TIPODOCUMENTO`, `USUARIO_NUMERODOCUMENTO`, `USUARIO_CORREO`, `USUARIO_GENERO`, `USUARIO_FECHADENACIMIENTO`, `USUARIO_LUGARDENACIMIENTO`, `USUARIO_DIRECCIONRESIDENCIA`, `USUARIO_LUGARDERESIDENCIA`, `USUARIO_TELEFONOFIJO`, `USUARIO_CELULAR`, `USUARIO_ESTADO`, `USUARIO_FECHAINGRESO`, `ID_TIPO_USU`) VALUES
(8, '459c6d57$3c02e33fbdafee02053f7798cec7ccc2cff13f53', 'ADMINISTRADOR', 'CUENTAS', 'CC', '123456', 'yeison.arias@umb.edu.co', 'M', '2014-08-25', 'BOGOTA', 'VICECALIDAD', 'VICECALIDAD', '1234567', '3171115544', 1, '2014-08-25 19:45:52', 1),
(10, '7792924b$eabf81b70d1de8bd63588502ea2fbaaffece34b8', 'Yeison 03', 'Arias 03', 'CC', '1110473459', 'yeison.arias3@umb.edu.co', 'M', '1988-07-18', 'Ibague3', 'Cra 44d Sur No. 72A-82 B/ Nuevo Delicias23', 'Bogota3', '211111133', '3168231713333', 0, '2014-09-10 16:10:16', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
