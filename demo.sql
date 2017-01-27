-- No mamar!

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `FormContact_Fields`;
CREATE TABLE `FormContact_Fields` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `Id_Cliente` varchar(100) NOT NULL,
  `Slug` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Label` varchar(500) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Placeholder` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Type` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Value` mediumtext CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Required` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Order` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Id_Form` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `class` varchar(500) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'col-sm-6',
  `Extra` varchar(500) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `GetVals_Table` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `FormContact_Fields` (`id`, `Id_Cliente`, `Slug`, `Label`, `Placeholder`, `Type`, `Value`, `Required`, `Order`, `Id_Form`, `class`, `Extra`, `GetVals_Table`) VALUES
(17,	'',	'Id_Categoria',	'Categoría',	'',	'select',	'',	'',	'1',	'Productos',	'col-sm-6',	'',	'{\n  \"Tabla\": \"Productos_Categorias\",\n  \"Valor\": \"Id_Categoria\",\n  \"Visible\": \"Categoria\"\n}'),
(18,	'',	'Producto',	'Producto',	'',	'text',	'',	'',	'1',	'Productos',	'col-sm-6',	'',	''),
(19,	'',	'Estatus',	'Estatus',	'',	'select',	'{ \"Activo\":\"Activo\", \"Inactivo\":\"Inactivo\" }',	'',	'1',	'Productos',	'col-sm-6',	'',	''),
(21,	'',	'Usuario',	'Usuario',	'',	'text',	'',	'',	'1',	'Usuarios',	'col-sm-6',	'',	''),
(20,	'',	'Id_Marca',	'Marca',	'',	'select',	'',	'',	'1',	'Productos',	'col-sm-6',	'',	'{\r\n  \"Tabla\": \"Productos_Marcas\",\r\n  \"Valor\": \"Id_Marca\",\r\n  \"Visible\": \"Marca\"\r\n}'),
(22,	'',	'Password',	'Password',	'',	'password',	'',	'',	'1',	'Usuarios',	'col-sm-6',	'',	''),
(23,	'',	'Nombre',	'Nombre',	'',	'text',	'',	'',	'1',	'Usuarios',	'col-sm-6',	'',	''),
(24,	'',	'Apellido_Paterno',	'Apellido Paterno',	'',	'text',	'',	'1',	'1',	'Usuarios',	'col-sm-6',	'',	''),
(25,	'',	'Apellido_Materno',	'Apellido Materno',	'',	'text',	'',	'1',	'1',	'Usuarios',	'col-sm-6',	'',	''),
(26,	'',	'Telefono',	'Teléfono',	'',	'text',	'',	'',	'1',	'Usuarios',	'col-sm-6',	'',	''),
(27,	'',	'Email',	'Email',	'',	'text',	'',	'',	'1',	'Usuarios',	'col-sm-6',	'',	''),
(28,	'',	'Direccion',	'Dirección',	'',	'text',	'',	'',	'1',	'Usuarios',	'col-sm-12',	'',	''),
(29,	'',	'Calle',	'Calle',	'',	'text',	'',	'',	'1',	'Usuarios',	'col-sm-6',	' data-geo=\"route\"',	''),
(30,	'',	'Numero',	'Número',	'',	'text',	'',	'',	'1',	'Usuarios',	'col-sm-6',	' data-geo=\"street_number\"',	''),
(31,	'',	'Colonia',	'Colonia',	'',	'text',	'',	'',	'1',	'Usuarios',	'col-sm-6',	' data-geo=\"sublocality\"',	''),
(32,	'',	'Municipio',	'Municipio',	'',	'text',	'',	'',	'1',	'Usuarios',	'col-sm-6',	' data-geo=\"locality\"',	''),
(33,	'',	'CP',	'CP',	'',	'text',	'',	'',	'1',	'Usuarios',	'col-sm-6',	' data-geo=\"postal_code\"',	''),
(34,	'',	'Estado',	'Estado',	'',	'text',	'',	'',	'1',	'Usuarios',	'col-sm-6',	' data-geo=\"administrative_area_level_1\"',	''),
(35,	'',	'Lat',	'Lat',	'',	'text',	'',	'',	'1',	'Usuarios',	'col-sm-6',	' data-geo=\"lat\"',	''),
(36,	'',	'Lon',	'Lon',	'',	'text',	'',	'',	'1',	'Usuarios',	'col-sm-6',	' data-geo=\"lng\"',	''),
(37,	'',	'Website',	'Website',	'',	'text',	'',	'',	'1',	'Usuarios',	'col-sm-6',	'',	''),
(38,	'',	'Permisos',	'Puesto/Permisos',	'',	'select',	'',	'',	'1',	'Usuarios',	'col-sm-6',	'',	'{\r\n\"Tabla\": \"Usuarios_Puestos\", \r\n\"Valor\": \"Id_Puesto\", \r\n\"Visible\": \"Puesto\" \r\n}'),
(68,	'',	'Precio',	'Precio',	'',	'text',	'',	'',	'1',	'Productos',	'col-sm-6',	'',	''),
(69,	'',	'Moneda',	'Moneda',	'',	'select',	'{ \"MXN\":\"MXN\",\"USD\":\"USD\" }',	'',	'1',	'Productos',	'col-sm-6',	'',	''),
(66,	'',	'Puesto',	'Puesto',	'',	'text',	'',	'1',	'1',	'Usuarios_Puestos',	'col-sm-6',	'',	''),
(67,	'',	'Estatus',	'Estatus',	'',	'select',	'{ \"Activo\":\"Activo\", \"Inactivo\":\"Inactivo\" }',	'1',	'1',	'Usuarios_Puestos',	'col-sm-6',	'',	''),
(70,	'',	'Categoria',	'Categoría',	'',	'text',	'',	'',	'1',	'Productos_Categorias',	'col-sm-6',	'',	''),
(71,	'',	'Estatus',	'Estatus',	'',	'select',	'{ \"Activo\":\"Activo\", \"Inactivo\":\"Inactivo\" }',	'',	'1',	'Productos_Categorias',	'col-sm-6',	'',	'');

DROP TABLE IF EXISTS `Imagenes_Adjuntas`;
CREATE TABLE `Imagenes_Adjuntas` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `Id_Img` varchar(20) NOT NULL,
  `Nombre_Img` varchar(255) NOT NULL,
  `Nombre_Img_FS` varchar(500) NOT NULL COMMENT 'Nombre con el que se guarda en el FileSystem',
  `Usuario` varchar(100) NOT NULL,
  `FechaHora` varchar(20) NOT NULL,
  `Tamano` varchar(50) NOT NULL,
  `Img_Tipo` varchar(100) NOT NULL,
  `Tipo` varchar(30) NOT NULL,
  `Id_Tipo` varchar(100) NOT NULL,
  `Id_Tipo_Sub` varchar(100) NOT NULL,
  `Url` varchar(1000) NOT NULL COMMENT 'No tomar en cuenta $url_server/$path',
  `Url_S3` varchar(1000) NOT NULL,
  `Url_CDN` varchar(1000) NOT NULL,
  `Path_Srv` varchar(1000) NOT NULL,
  `Demo` varchar(20) NOT NULL,
  `Descargas` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Imagenes adjuntas a varios modulos';

DROP TABLE IF EXISTS `Info_Moviles_2FA`;
CREATE TABLE `Info_Moviles_2FA` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `Usuario` varchar(50) NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `Key_Movil` varchar(500) NOT NULL,
  `Token_Push` varchar(500) NOT NULL,
  `Lat` varchar(50) NOT NULL,
  `Lon` varchar(50) NOT NULL,
  `Geo_Aprox` varchar(50) NOT NULL,
  `Handle_Url` varchar(300) NOT NULL,
  `User_Agent` varchar(500) NOT NULL,
  `IP` varchar(300) NOT NULL,
  `FechaHora_Last` varchar(50) NOT NULL,
  `platform` varchar(100) NOT NULL,
  `version` varchar(100) NOT NULL,
  `uuid` varchar(100) NOT NULL,
  `cordova` varchar(50) NOT NULL,
  `model` varchar(100) NOT NULL,
  `Device_json` mediumtext NOT NULL,
  `Header_json` mediumtext NOT NULL,
  `Push_json` mediumtext NOT NULL,
  `Estatus_2FA` varchar(50) NOT NULL,
  `Metodo_2FA` varchar(50) NOT NULL,
  `FechaHora_Last_2FA` varchar(50) NOT NULL,
  `Enviar_SMS` varchar(20) NOT NULL DEFAULT 'No',
  `Token_Firebase` mediumtext NOT NULL,
  `Token_Firebase_Last` varchar(20) NOT NULL,
  `Token_Firebase_Expira` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Datos de 2FA';

DROP TABLE IF EXISTS `Permisos`;
CREATE TABLE `Permisos` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `Permiso` varchar(255) NOT NULL,
  `Nombre_Visible` varchar(255) NOT NULL,
  `Descripcion` varchar(255) NOT NULL,
  `Estatus` varchar(100) NOT NULL DEFAULT 'Activo',
  `Seccion` varchar(255) NOT NULL,
  `Default` varchar(10) DEFAULT 'Si',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Listado de Permisos';

INSERT INTO `Permisos` (`id`, `Permiso`, `Nombre_Visible`, `Descripcion`, `Estatus`, `Seccion`, `Default`) VALUES
(1,	'Administrar_Permisos',	'Administrar Permisos',	'Este cuate puede habilitar a otros para hacer y deshacer a su antojo.',	'Activo',	'Usuarios',	'Si'),
(2,	'Listar_Productos',	'Listar Productos',	'',	'Activo',	'Productos',	'Si'),
(3,	'Listar_Usuarios',	'Listar Usuarios',	'',	'Activo',	'Usuarios',	'Si');

DROP TABLE IF EXISTS `Permisos_Perfiles`;
CREATE TABLE `Permisos_Perfiles` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `Id_Perfil` varchar(100) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Permiso` varchar(255) NOT NULL,
  `Asignado_Por` varchar(255) NOT NULL COMMENT 'Quien crea este perfil',
  `Tipo` varchar(100) NOT NULL DEFAULT 'Global' COMMENT 'Global: se le puede agregar a quien sea; Unico: solo es de un usuario',
  `Nivel` varchar(100) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `Permisos_Perfiles` (`id`, `Id_Perfil`, `Nombre`, `Permiso`, `Asignado_Por`, `Tipo`, `Nivel`) VALUES
(1,	'director-general-641460be-051a-327b-6501-0bb0c28ab46b',	'Listar_Productos',	'Listar_Productos',	'admin-10101010101',	'Global',	'1'),
(2,	'director-general-641460be-051a-327b-6501-0bb0c28ab46b',	'Administrar_Permisos',	'Administrar_Permisos',	'admin-10101010101',	'Global',	'1'),
(3,	'director-general-641460be-051a-327b-6501-0bb0c28ab46b',	'Listar_Usuarios',	'Listar_Usuarios',	'admin-10101010101',	'Global',	'1');

DROP TABLE IF EXISTS `Permisos_RelUsers`;
CREATE TABLE `Permisos_RelUsers` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `Usuario` varchar(255) NOT NULL,
  `Id_Perfil` varchar(255) NOT NULL COMMENT 'Perfil de permisos asignado',
  `FechaHora` varchar(255) NOT NULL,
  `Asignado_Por` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `Productos`;
CREATE TABLE `Productos` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `Id_Producto` varchar(100) NOT NULL,
  `Producto` varchar(100) NOT NULL,
  `Id_Marca` varchar(100) NOT NULL,
  `Id_Categoria` varchar(100) NOT NULL,
  `Id_CategoriaSub` varchar(100) NOT NULL,
  `Precio` float NOT NULL,
  `Moneda` varchar(20) NOT NULL,
  `Descargas` int(100) NOT NULL,
  `Estatus` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `Productos` (`id`, `Id_Producto`, `Producto`, `Id_Marca`, `Id_Categoria`, `Id_CategoriaSub`, `Precio`, `Moneda`, `Descargas`, `Estatus`) VALUES
(1,	'cosa-1-735b9161-bd03-f33e-507d-29c6763188bc',	'Cosa 1',	'',	'general-902e5774-a872-25ac-7802-be233cb5552e',	'',	1,	'MXN',	0,	'Activo'),
(2,	'felicidad-1dce6189-9f44-efa5-ce2e-642d288f473a',	'Felicidad',	'',	'general-902e5774-a872-25ac-7802-be233cb5552e',	'',	0,	'MXN',	0,	'Activo');

DROP TABLE IF EXISTS `Productos_Categorias`;
CREATE TABLE `Productos_Categorias` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `Id_Categoria` varchar(100) NOT NULL,
  `Categoria` varchar(100) NOT NULL,
  `Estatus` varchar(20) NOT NULL DEFAULT 'Activo',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `Productos_Categorias` (`id`, `Id_Categoria`, `Categoria`, `Estatus`) VALUES
(1,	'general-902e5774-a872-25ac-7802-be233cb5552e',	'General',	'Activo');

DROP TABLE IF EXISTS `Productos_CategoriasSub`;
CREATE TABLE `Productos_CategoriasSub` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `Id_Categoria` varchar(100) NOT NULL,
  `Categoria` varchar(100) NOT NULL,
  `Estatus` varchar(20) NOT NULL DEFAULT 'Activo',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `Productos_Competencia`;
CREATE TABLE `Productos_Competencia` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `Id_Competencia` varchar(100) NOT NULL,
  `Id_Categoria` varchar(100) NOT NULL COMMENT 'Id_Categoria nuestra',
  `Id_Producto` varchar(100) NOT NULL COMMENT 'Id_Producto nuestro',
  `Competencia` varchar(100) NOT NULL,
  `Presentacion` varchar(100) NOT NULL,
  `Estatus` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `Productos_Marcas`;
CREATE TABLE `Productos_Marcas` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `Id_Marca` varchar(100) NOT NULL,
  `Marca` varchar(100) NOT NULL,
  `Estatus` varchar(50) NOT NULL DEFAULT 'Activo',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `Temp_Uploads`;
CREATE TABLE `Temp_Uploads` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `Data_Usuario` varchar(200) NOT NULL,
  `Usuario` varchar(200) NOT NULL,
  `Archivo` varchar(500) NOT NULL,
  `Archivo_Source` varchar(500) NOT NULL,
  `FechaHora` varchar(25) NOT NULL,
  `IP` varchar(20) NOT NULL,
  `User_Agent` varchar(255) NOT NULL,
  `Tag` varchar(255) NOT NULL,
  `result` mediumtext NOT NULL,
  `result_url` mediumtext NOT NULL,
  `Path` varchar(500) NOT NULL,
  `Estatus` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Registro de cargas de archivos';


DROP TABLE IF EXISTS `Usuarios`;
CREATE TABLE `Usuarios` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `FechaRegistro` varchar(20) NOT NULL,
  `Usuario` varchar(100) NOT NULL,
  `Usuario_Login` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Apellido_Paterno` varchar(100) NOT NULL,
  `Apellido_Materno` varchar(100) NOT NULL,
  `Telefono` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Direccion` varchar(200) NOT NULL,
  `Calle` varchar(100) NOT NULL,
  `Numero` varchar(100) NOT NULL,
  `Colonia` varchar(100) NOT NULL,
  `Municipio` varchar(100) NOT NULL,
  `CP` varchar(100) NOT NULL,
  `Estado` varchar(100) NOT NULL,
  `Lat` varchar(25) NOT NULL,
  `Lon` varchar(25) NOT NULL,
  `Validacion` varchar(50) NOT NULL,
  `User_Agent` varchar(100) NOT NULL,
  `IP` varchar(50) NOT NULL,
  `Fecha_LastSession` varchar(20) NOT NULL,
  `Token` varchar(50) NOT NULL,
  `Website` varchar(100) NOT NULL,
  `Permisos` varchar(100) NOT NULL,
  `Estatus` varchar(100) NOT NULL DEFAULT 'Activo',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `Usuarios` (`id`, `FechaRegistro`, `Usuario`, `Usuario_Login`, `Password`, `Nombre`, `Apellido_Paterno`, `Apellido_Materno`, `Telefono`, `Email`, `Direccion`, `Calle`, `Numero`, `Colonia`, `Municipio`, `CP`, `Estado`, `Lat`, `Lon`, `Validacion`, `User_Agent`, `IP`, `Fecha_LastSession`, `Token`, `Website`, `Permisos`, `Estatus`) VALUES
(1,	'1472125010',	'admin',	'admin',	'lol123456',	'Luigui',	'Maitret',	'',	'8331702869',	'maitret@myhostmx.com',	'Domicilio Conocido',	'',	'',	'',	'',	'',	'',	'',	'',	'OK',	'',	'',	'1485203192',	'c0e76d7277cfe9ef373ad6230ab7e3b984a69c94aea20dbd17',	'',	'director-general-641460be-051a-327b-6501-0bb0c28ab46b',	'');

DROP TABLE IF EXISTS `Usuarios_Puestos`;
CREATE TABLE `Usuarios_Puestos` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `Id_Puesto` varchar(100) NOT NULL,
  `Puesto` varchar(100) NOT NULL,
  `Estatus` varchar(20) NOT NULL DEFAULT 'Activo',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `Usuarios_Puestos` (`id`, `Id_Puesto`, `Puesto`, `Estatus`) VALUES
(1,	'director-general-641460be-051a-327b-6501-0bb0c28ab46b',	'Director General',	'Activo');

DROP TABLE IF EXISTS `Usuarios_Puestos_Rel`;
CREATE TABLE `Usuarios_Puestos_Rel` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `Id_Puesto` varchar(100) NOT NULL,
  `Usuario` varchar(100) NOT NULL,
  `Id_Sucursal` varchar(100) NOT NULL,
  `Estatus` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- 2017-01-23 21:01:57
