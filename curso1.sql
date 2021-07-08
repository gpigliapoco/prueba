-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-07-2021 a las 05:35:20
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `curso1`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `addcita`(IN `IDMEDICO` INT, IN `IDPACIENTE` INT, IN `DESCRIPCION` TEXT)
    NO SQL
    DETERMINISTIC
BEGIN
DECLARE TURNO int;
set @TURNO:=(SELECT COUNT(*) +1 FROM cita WHERE cita.cita_fecha_registro=CURDATE());
INSERT INTO cita(cita.cita_n_ate,cita.cita_fecha_registro,cita.cita_status,cita.idpaciente,cita.idmedico,cita.cita_descripcion) VALUES (@turno,CURDATE(),"pendiente",IDMEDICO,IDPACIENTE,DESCRIPCION);
SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `editar_consulta`(IN `id` INT, IN `descrip` VARCHAR(250), IN `diagn` VARCHAR(250))
UPDATE consulta
SET consulta.con_descripcion=descrip,consulta.con_diagnostico=diagn
WHERE consulta.idconsulta=id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `especialidad`(IN `espe` VARCHAR(250), IN `statu` VARCHAR(250))
BEGIN
DECLARE cantidad int;
DECLARE cant int;
SET @cantidad:=(SELECT COUNT(*) FROM especialidad WHERE especialidad.es_especialidad = espe);
IF @cantidad = 0 THEN
SET @cant:=(SELECT COUNT(*) FROM especialidad WHERE especialidad.es_status = statu);
SELECT 1;
IF @cant = 0 THEN
SELECT 1;
ELSE
SELECT 2;


END IF;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_consulta`(IN `fechaN` DATE, IN `fechaF` DATE)
SELECT consulta.idconsulta,consulta.con_descripcion,consulta.con_diagnostico,consulta.con_fecha_registro,consulta.con_status,consulta.idcita,
cita.idcita,cita.idpaciente,cita.idmedico,cita.cita_descripcion,medico.idmedico,medico.doc_nombre,medico.doc_apellido,medico.idespecialidad,paciente.idpaciente,paciente.pa_nombre,paciente.pa_apellido,paciente.pa_dni,especialidad.idespecialidad,especialidad.es_especialidad,
concat(paciente.pa_nombre,' ',paciente.pa_apellido) AS paciente,
concat(medico.doc_nombre,' ',medico.doc_apellido) AS medico
FROM consulta
INNER JOIN cita ON cita.idcita=consulta.idcita
INNER JOIN paciente ON paciente.idpaciente=cita.idpaciente
INNER JOIN medico ON medico.idmedico=cita.idmedico
INNER JOIN especialidad ON especialidad.idespecialidad=medico.idespecialidad
WHERE consulta.con_fecha_registro BETWEEN fechaN AND fechaF$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_historial`(IN `fechaN` DATE, IN `fechaF` DATE)
SELECT fua.idfua,fua.fua_fecha_registro,fua.idhistoria_clinica,fua.idconsulta,consulta.con_diagnostico,consulta.idcita,cita.idpaciente,CONCAT(" ",paciente.pa_nombre,paciente.pa_apellido) as paciente,paciente.pa_dni,cita.idmedico,CONCAT(" ",medico.doc_nombre,medico.doc_apellido) as medico
FROM fua
INNER JOIN consulta ON fua.idconsulta=consulta.idconsulta
INNER JOIN cita ON consulta.idcita=cita.idcita
INNER JOIN paciente ON cita.idpaciente=paciente.idpaciente
INNER JOIN medico ON cita.idmedico=medico.idmedico
WHERE fua.fua_fecha_registro BETWEEN fechaN and fechaF$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Listar_paciente`()
SELECT cita.idcita,cita.cita_n_ate,cita.cita_fecha_registro,cita.idpaciente,cita.cita_status,paciente.idpaciente,paciente.pa_nombre,paciente.pa_apellido,
concat(paciente.pa_nombre,' ',paciente.pa_apellido) as paciente
FROM cita
INNER JOIN paciente ON paciente.idpaciente=cita.idpaciente
WHERE cita.cita_fecha_registro=CURDATE() AND cita.cita_status='PENDIENTE'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrar_consulta`(IN `id` INT, IN `descrip` VARCHAR(250), IN `diagno` VARCHAR(250))
    NO SQL
BEGIN
INSERT INTO consulta(consulta.con_descripcion,consulta.con_diagnostico,consulta.con_fecha_registro,consulta.con_status,consulta.idcita)
VALUES(descrip,diagno,CURDATE(),"PENDIENTE",id);
UPDATE cita 
SET cita.cita_status = "ATENDIDO"
WHERE cita.idcita=id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateCita`(IN `idc` INT(10), IN `pac` INT(10), IN `doc` INT(10), IN `descrip` TEXT, IN `sta` VARCHAR(250))
BEGIN

UPDATE cita set cita.idpaciente=pac,cita.idmedico=doc,cita.cita_descripcion=descrip,cita.cita_status=sta WHERE cita.idcita=idc;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE IF NOT EXISTS `cita` (
  `idcita` int(11) NOT NULL,
  `cita_n_ate` int(11) DEFAULT NULL,
  `cita_fecha_registro` date DEFAULT NULL,
  `cita_status` enum('atendido','cancelado','pendiente') DEFAULT NULL,
  `idpaciente` int(11) NOT NULL,
  `idmedico` int(11) NOT NULL,
  `cita_descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`idcita`, `cita_n_ate`, `cita_fecha_registro`, `cita_status`, `idpaciente`, `idmedico`, `cita_descripcion`) VALUES
(1, 1, '2021-06-29', '', 1, 1, 'VINO POR DOLOR'),
(2, 2, '2021-06-29', 'atendido', 3, 1, 'funciono'),
(3, 3, '2021-06-29', 'pendiente', 2, 1, 'por gil'),
(4, 4, '2021-06-29', 'cancelado', 2, 2, 'MUELA'),
(5, 1, '2021-07-01', 'pendiente', 1, 2, 'prueba'),
(6, 2, '2021-07-01', 'pendiente', 3, 3, 'asdasdasd'),
(7, 1, '2021-07-06', 'pendiente', 1, 3, 'dolor'),
(8, 2, '2021-07-06', 'pendiente', 2, 3, 'prueba'),
(9, 1, '2021-07-07', 'pendiente', 2, 3, 'dolor de panza'),
(10, 2, '2021-07-07', 'atendido', 1, 3, 'muela');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consulta`
--

CREATE TABLE IF NOT EXISTS `consulta` (
  `idconsulta` int(11) NOT NULL,
  `con_descripcion` text,
  `con_diagnostico` text,
  `con_fecha_registro` date DEFAULT NULL,
  `con_status` enum('pendiente','cancelado') DEFAULT NULL,
  `idcita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `consulta`
--

INSERT INTO `consulta` (`idconsulta`, `con_descripcion`, `con_diagnostico`, `con_fecha_registro`, `con_status`, `idcita`) VALUES
(1, 'prueba', 'prueba', '2021-07-05', '', 3),
(2, 'dolor 5', 'prueba 5', '2021-07-07', 'pendiente', 2),
(3, 'prueba 2', 'prueba 2                     ', '2021-07-07', 'pendiente', 10),
(4, 'prueba 3', 'prueba 3                     ', '2021-07-07', 'pendiente', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_insumos`
--

CREATE TABLE IF NOT EXISTS `detalle_insumos` (
  `iddetalle_insumos` int(11) NOT NULL,
  `idinsumos` int(11) NOT NULL,
  `idfua` int(11) NOT NULL,
  `det_cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_medicamento`
--

CREATE TABLE IF NOT EXISTS `detalle_medicamento` (
  `iddetalle_medicamento` int(11) NOT NULL,
  `detM_cantidad` int(11) DEFAULT NULL,
  `idfua` int(11) NOT NULL,
  `idmedicamentos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_procedimientos`
--

CREATE TABLE IF NOT EXISTS `detalle_procedimientos` (
  `iddetalle_procedimientos` int(11) NOT NULL,
  `idprocedimientos` int(11) NOT NULL,
  `idfua` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE IF NOT EXISTS `especialidad` (
  `idespecialidad` int(11) NOT NULL,
  `es_especialidad` varchar(45) DEFAULT NULL,
  `es_fecha_registro` date DEFAULT NULL,
  `es_status` enum('activo','inactivo') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `especialidad`
--

INSERT INTO `especialidad` (`idespecialidad`, `es_especialidad`, `es_fecha_registro`, `es_status`) VALUES
(1, 'traumatologo', '2021-06-21', 'activo'),
(2, 'biologo', '2021-06-21', 'activo'),
(3, 'cirujano', '2021-06-21', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fua`
--

CREATE TABLE IF NOT EXISTS `fua` (
  `idfua` int(11) NOT NULL,
  `fua_fecha_registro` date DEFAULT NULL,
  `idhistoria_clinica` int(11) NOT NULL,
  `idconsulta` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `fua`
--

INSERT INTO `fua` (`idfua`, `fua_fecha_registro`, `idhistoria_clinica`, `idconsulta`) VALUES
(1, '2021-07-07', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia_clinica`
--

CREATE TABLE IF NOT EXISTS `historia_clinica` (
  `idhistoria_clinica` int(11) NOT NULL,
  `his_fecha_registro` date DEFAULT NULL,
  `paciente_idpaciente` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `historia_clinica`
--

INSERT INTO `historia_clinica` (`idhistoria_clinica`, `his_fecha_registro`, `paciente_idpaciente`) VALUES
(1, '2021-07-07', 1),
(2, '2021-07-07', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
--

CREATE TABLE IF NOT EXISTS `insumos` (
  `idinsumos` int(11) NOT NULL,
  `ins_nombre` varchar(45) DEFAULT NULL,
  `ins_stock` int(11) DEFAULT NULL,
  `ins_fecha_registro` date DEFAULT NULL,
  `ins_status` enum('activo','inactivo') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `insumos`
--

INSERT INTO `insumos` (`idinsumos`, `ins_nombre`, `ins_stock`, `ins_fecha_registro`, `ins_status`) VALUES
(1, 'guantes', 25, '2021-06-21', 'activo'),
(2, 'vendas', 5, '2021-06-21', 'activo'),
(3, 'jeringas', 50, '2021-06-21', 'activo'),
(4, 'gasa', 15, '2021-06-21', 'activo'),
(5, 'peine', 15, '0000-00-00', 'activo'),
(6, 'tabla', 15, '2021-06-22', 'activo'),
(7, 'tafirol', 17, '2021-06-23', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos`
--

CREATE TABLE IF NOT EXISTS `medicamentos` (
  `idmedicamentos` int(11) NOT NULL,
  `medi_nombre` varchar(45) DEFAULT NULL,
  `medi_stock` int(11) DEFAULT NULL,
  `medi_fecha_registro` date DEFAULT NULL,
  `medi_status` enum('activo','inactivo') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `medicamentos`
--

INSERT INTO `medicamentos` (`idmedicamentos`, `medi_nombre`, `medi_stock`, `medi_fecha_registro`, `medi_status`) VALUES
(1, 'migral', 10, '2021-06-21', 'activo'),
(2, 'ibupirac', 40, '2021-06-21', 'activo'),
(3, 'redoxon', 30, '2021-06-21', 'activo'),
(4, 'paracetamol', 70, '2021-06-21', 'activo'),
(5, 'tafirol', 10, '2021-06-23', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico`
--

CREATE TABLE IF NOT EXISTS `medico` (
  `idmedico` int(11) NOT NULL,
  `doc_nombre` varchar(45) DEFAULT NULL,
  `doc_apellido` varchar(45) DEFAULT NULL,
  `doc_direccion` varchar(45) DEFAULT NULL,
  `doc_movil` varchar(45) DEFAULT NULL,
  `doc_sexo` char(1) DEFAULT NULL,
  `doc_fecha_nac` date DEFAULT NULL,
  `doc_dni` varchar(45) DEFAULT NULL,
  `doc_cole` varchar(45) DEFAULT NULL,
  `idespecialidad` int(11) NOT NULL,
  `idusuarios` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `medico`
--

INSERT INTO `medico` (`idmedico`, `doc_nombre`, `doc_apellido`, `doc_direccion`, `doc_movil`, `doc_sexo`, `doc_fecha_nac`, `doc_dni`, `doc_cole`, `idespecialidad`, `idusuarios`) VALUES
(1, 'leo', 'piglia', 'quesada 3209', '156611434', NULL, '2021-06-09', '29985934', '25254', 1, 1),
(2, 'pedro', 'perez', 'pasaje 123', '414541', 'm', '2021-06-08', '123541', '6546', 3, 3),
(3, 'jose', 'maria', 'laprida 434', '892691', 'm', '2021-07-07', '2453453', '6666', 2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE IF NOT EXISTS `paciente` (
  `idpaciente` int(11) NOT NULL,
  `pa_nombre` varchar(45) DEFAULT NULL,
  `pa_apellido` varchar(45) DEFAULT NULL,
  `pa_direccion` varchar(250) DEFAULT NULL,
  `pa_movil` varchar(45) DEFAULT NULL,
  `pa_sexo` char(1) DEFAULT NULL,
  `pa_fecha_nac` date DEFAULT NULL,
  `pa_dni` varchar(45) DEFAULT NULL,
  `pa_status` enum('activo','inactivo') DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`idpaciente`, `pa_nombre`, `pa_apellido`, `pa_direccion`, `pa_movil`, `pa_sexo`, `pa_fecha_nac`, `pa_dni`, `pa_status`) VALUES
(1, 'leo', 'piglia', 'psaje 3209', '12542146', 'm', '2021-06-09', '299854144', 'activo'),
(2, 'pedro', 'Biscontin', 'Quesada 3209', '12346', 'm', '2021-06-22', '123541', 'activo'),
(3, 'santi', 'piglia', 'mitre 23241', '656464', 'm', '2021-07-14', '6767575', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procedimientos`
--

CREATE TABLE IF NOT EXISTS `procedimientos` (
  `idprocedimientos` int(11) NOT NULL,
  `pro_nombre` varchar(45) DEFAULT NULL,
  `pro_status` enum('activo','inactivo') DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `procedimientos`
--

INSERT INTO `procedimientos` (`idprocedimientos`, `pro_nombre`, `pro_status`) VALUES
(1, 'ODONTOLOGIA', 'activo'),
(2, 'TRAUMATOLOGO', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_usuario`
--

CREATE TABLE IF NOT EXISTS `rol_usuario` (
  `idrol_usuario` int(11) NOT NULL,
  `rol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol_usuario`
--

INSERT INTO `rol_usuario` (`idrol_usuario`, `rol`) VALUES
(1, 'administrador'),
(2, 'mantenimiento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idusuarios` int(11) NOT NULL,
  `usu_nombre` varchar(45) DEFAULT NULL,
  `usu_contra` varchar(45) DEFAULT NULL,
  `usu_sexo` char(1) DEFAULT NULL,
  `usu_status` enum('activo','inactivo') DEFAULT NULL,
  `usu_email` varchar(45) DEFAULT NULL,
  `idrol_usuario` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuarios`, `usu_nombre`, `usu_contra`, `usu_sexo`, `usu_status`, `usu_email`, `idrol_usuario`) VALUES
(1, 'leo', 'leo', 'm', 'activo', 'gpigliapoco@gmail.com', 1),
(2, 'tata', 'tata', 'f', 'activo', 'peter@gmail.com', 1),
(3, 'tata', 'tata', 'm', 'activo', 'peter@gmail.com', 1),
(4, 'pepe', 'pepe', 'm', 'activo', 'peter@gmail.com', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`idcita`), ADD KEY `fk_cita_paciente1` (`idpaciente`), ADD KEY `fk_cita_medico1` (`idmedico`);

--
-- Indices de la tabla `detalle_insumos`
--
ALTER TABLE `detalle_insumos`
  ADD PRIMARY KEY (`iddetalle_insumos`);

--
-- Indices de la tabla `fua`
--
ALTER TABLE `fua`
  ADD PRIMARY KEY (`idfua`);

--
-- Indices de la tabla `historia_clinica`
--
ALTER TABLE `historia_clinica`
  ADD PRIMARY KEY (`idhistoria_clinica`);

--
-- Indices de la tabla `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`idmedico`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`idpaciente`);

--
-- Indices de la tabla `procedimientos`
--
ALTER TABLE `procedimientos`
  ADD PRIMARY KEY (`idprocedimientos`);

--
-- Indices de la tabla `rol_usuario`
--
ALTER TABLE `rol_usuario`
  ADD PRIMARY KEY (`idrol_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuarios`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_insumos`
--
ALTER TABLE `detalle_insumos`
  MODIFY `iddetalle_insumos` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `fua`
--
ALTER TABLE `fua`
  MODIFY `idfua` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `historia_clinica`
--
ALTER TABLE `historia_clinica`
  MODIFY `idhistoria_clinica` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `medico`
--
ALTER TABLE `medico`
  MODIFY `idmedico` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `idpaciente` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `procedimientos`
--
ALTER TABLE `procedimientos`
  MODIFY `idprocedimientos` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuarios` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
