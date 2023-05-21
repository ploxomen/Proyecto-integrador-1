/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80033
 Source Host           : localhost:3307
 Source Schema         : bodegafast

 Target Server Type    : MySQL
 Target Server Version : 80033
 File Encoding         : 65001

 Date: 16/05/2023 23:20:58
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for acceso
-- ----------------------------
DROP TABLE IF EXISTS `acceso`;
CREATE TABLE `acceso`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `correo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `contrasena` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `estado` tinyint(1) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of acceso
-- ----------------------------
INSERT INTO `acceso` VALUES (1, 'bodegalucero@gmail.com', '$2y$10$tdrpW.jUUaVnsEcRDkkoXOlUBlTdMKBZluAA5frChR1/lxglvdmyC', '', 1);
INSERT INTO `acceso` VALUES (10, 'jeanpi.jpct@gmail.com', '$2y$10$.IfHkfpQFBxL8V1ak99pMeUTY6Xys/2df/nzPQFSUCDcvdwTamVzG', 'f30da93a38c0460592973d156c2758b1b7f2cec316f9ab02be52d10828ae4bd8af470f7aa4', 1);
INSERT INTO `acceso` VALUES (15, 'osbaldo@gmail.com', '$2y$10$tdrpW.jUUaVnsEcRDkkoXOlUBlTdMKBZluAA5frChR1/lxglvdmyC', '', 1);
INSERT INTO `acceso` VALUES (20, 'asdsadadssa@sac.com', '$2y$10$irH7vW12JBuq/5FV17R3QezPCUofFTvuGFBzV7s7n5TPnG5JBybma', '', 1);

-- ----------------------------
-- Table structure for administrativos
-- ----------------------------
DROP TABLE IF EXISTS `administrativos`;
CREATE TABLE `administrativos`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_acceso` int NULL DEFAULT NULL,
  `nombres` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `apellidos` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `celular` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `telefono` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_acceso`(`id_acceso`) USING BTREE,
  CONSTRAINT `administrativos_ibfk_1` FOREIGN KEY (`id_acceso`) REFERENCES `acceso` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of administrativos
-- ----------------------------
INSERT INTO `administrativos` VALUES (1, 10, 'Jean Pier', 'Carrasco Tamariz', NULL, NULL);

-- ----------------------------
-- Table structure for bodegas
-- ----------------------------
DROP TABLE IF EXISTS `bodegas`;
CREATE TABLE `bodegas`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_acceso` int NULL DEFAULT NULL,
  `ruc` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `direccion` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `telefono` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `celular` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `localizacion` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `dni_propietario` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `nombre_propietario` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `estado` tinyint(1) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_acceso`(`id_acceso`) USING BTREE,
  CONSTRAINT `bodegas_ibfk_1` FOREIGN KEY (`id_acceso`) REFERENCES `acceso` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bodegas
-- ----------------------------
INSERT INTO `bodegas` VALUES (1, 1, '20145151256', 'BODEGA LUCERO', NULL, NULL, NULL, NULL, NULL, NULL, 1);

-- ----------------------------
-- Table structure for categorias
-- ----------------------------
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `estado` tinyint(1) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categorias
-- ----------------------------
INSERT INTO `categorias` VALUES (1, 'Bebidas', 1);
INSERT INTO `categorias` VALUES (2, 'Golosinas', 1);
INSERT INTO `categorias` VALUES (3, 'Abarrotes', 1);
INSERT INTO `categorias` VALUES (4, 'Limpieza', 1);
INSERT INTO `categorias` VALUES (5, 'Carnes y pescados', 1);
INSERT INTO `categorias` VALUES (6, 'Lácteos', 1);
INSERT INTO `categorias` VALUES (7, 'Aseo personal', 1);

-- ----------------------------
-- Table structure for marcas
-- ----------------------------
DROP TABLE IF EXISTS `marcas`;
CREATE TABLE `marcas`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `estado` tinyint(1) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of marcas
-- ----------------------------
INSERT INTO `marcas` VALUES (1, 'Coca Cola', 1);
INSERT INTO `marcas` VALUES (2, 'Gloria', 1);
INSERT INTO `marcas` VALUES (3, 'Laive', 0);
INSERT INTO `marcas` VALUES (4, 'Nesstle', 1);
INSERT INTO `marcas` VALUES (5, 'asdasd', 0);
INSERT INTO `marcas` VALUES (6, 'Bimbo', 1);
INSERT INTO `marcas` VALUES (7, '', 0);
INSERT INTO `marcas` VALUES (8, 'Ajinomoto', 1);
INSERT INTO `marcas` VALUES (9, 'Colgate', 1);
INSERT INTO `marcas` VALUES (10, 'Inka cola', 1);
INSERT INTO `marcas` VALUES (11, 'Big Cola', 1);

-- ----------------------------
-- Table structure for productos
-- ----------------------------
DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_bodega` int NULL DEFAULT NULL,
  `id_marca` int NULL DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `descripcion` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `stock` decimal(11, 2) NULL DEFAULT NULL,
  `stock_minimo` decimal(11, 2) NULL DEFAULT NULL,
  `precio_compra` decimal(11, 2) NULL DEFAULT NULL,
  `precio_venta` decimal(11, 2) NULL DEFAULT NULL,
  `descuento` decimal(11, 2) NULL DEFAULT NULL,
  `img` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `estado` tinyint(1) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_marca`(`id_marca`) USING BTREE,
  INDEX `id_bodega`(`id_bodega`) USING BTREE,
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_bodega`) REFERENCES `bodegas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 44 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of productos
-- ----------------------------
INSERT INTO `productos` VALUES (44, 1, 2, 'Leche Gloria Azul de 400g', 'Leche gloria de etiqueta azul de 400 gramos', 10.00, 0.00, 3.50, 4.20, 0.00, '1684294698_leche_gloria.jpg', 1);
INSERT INTO `productos` VALUES (45, 1, 2, 'Leche Gloria Azul de 170g', 'Leche gloria azul de 170 gramos con abre fácil', 10.00, 0.00, 1.50, 2.20, 0.00, '1684294779_leche_gloria_chica.jpg', 1);
INSERT INTO `productos` VALUES (46, 1, 4, 'Café Instantáneo Nescafé Tradición Frasco 170g', '', 5.00, 0.00, 11.50, 15.00, 0.00, '1684295057_Mesa-de-trabajo-21-3.jpg', 1);

-- ----------------------------
-- Table structure for productos_categorias
-- ----------------------------
DROP TABLE IF EXISTS `productos_categorias`;
CREATE TABLE `productos_categorias`  (
  `id_producto` int NULL DEFAULT NULL,
  `id_categoria` int NULL DEFAULT NULL,
  INDEX `id_producto`(`id_producto`) USING BTREE,
  INDEX `id_categoria`(`id_categoria`) USING BTREE,
  CONSTRAINT `productos_categorias_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `productos_categorias_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of productos_categorias
-- ----------------------------
INSERT INTO `productos_categorias` VALUES (44, 6);
INSERT INTO `productos_categorias` VALUES (45, 6);
INSERT INTO `productos_categorias` VALUES (46, 3);

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_acceso` int NULL DEFAULT NULL,
  `nombres` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `apellidos` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `celular` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `direccion` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_acceso`(`id_acceso`) USING BTREE,
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_acceso`) REFERENCES `acceso` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES (1, 15, 'Osbaldo', 'Laurencio', NULL, NULL);
INSERT INTO `usuarios` VALUES (3, 20, 'sad', 'asd', '', '');

-- ----------------------------
-- Procedure structure for SP_C_T_ACCESO_USUARIO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_C_T_ACCESO_USUARIO`;
delimiter ;;
CREATE PROCEDURE `SP_C_T_ACCESO_USUARIO`(IN _correo VARCHAR(255), IN _contrasena VARCHAR(255), IN _nombres VARCHAR(255), IN _apellidos VARCHAR(255), IN _celular VARCHAR(20), IN _direccion VARCHAR(255))
BEGIN
	DECLARE _idAcceso INT;
	START TRANSACTION;
		INSERT INTO acceso(correo,contrasena) VALUES(_correo,_contrasena);
		SET _idAcceso = LAST_INSERT_ID();
		INSERT INTO usuarios(id_acceso,nombres,apellidos,celular,direccion)
		VALUES(_idAcceso,_nombres,_apellidos,_celular,_direccion);
	COMMIT;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_C_T_BODEGAS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_C_T_BODEGAS`;
delimiter ;;
CREATE PROCEDURE `SP_C_T_BODEGAS`(IN _ruc VARCHAR(20), IN _nombre VARCHAR(255), IN _direccion VARCHAR(255), IN _telefono VARCHAR(10), IN _celular VARCHAR(15), IN _localizacion VARCHAR(255), IN _dniPropietario VARCHAR(8), IN _nombrePropietario VARCHAR(255), IN _password VARCHAR(255), IN _correo VARCHAR(255))
BEGIN
	DECLARE _idAcceso INT;
	START TRANSACTION;
	INSERT INTO acceso(correo,contrasena) VALUES(_correo,_password);
	SET _idAcceso = LAST_INSERT_ID();
	INSERT INTO bodegas(id_acceso,ruc,nombre,direccion,telefono,celular,localizacion,dni_propietario,nombre_propietario) VALUES(_idAcceso,_ruc,_nombre,_direccion,_telefono,_celular,_localizacion,_dniPropietario,_nombrePropietario);
	COMMIT;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_C_T_CATEGORIAS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_C_T_CATEGORIAS`;
delimiter ;;
CREATE PROCEDURE `SP_C_T_CATEGORIAS`(IN _nombre VARCHAR(255))
BEGIN
	INSERT INTO categorias(nombre) VALUES(_nombre);
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_C_T_MARCAS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_C_T_MARCAS`;
delimiter ;;
CREATE PROCEDURE `SP_C_T_MARCAS`(IN _nombre VARCHAR(255))
BEGIN
	INSERT INTO marcas(nombre) VALUES(_nombre);
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_C_T_PRODUCTOS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_C_T_PRODUCTOS`;
delimiter ;;
CREATE PROCEDURE `SP_C_T_PRODUCTOS`(IN _idBodega INT,IN _idMarca INT, _nombre VARCHAR(255),IN _descripcion VARCHAR(255), IN _stock DECIMAL(11,2), IN _stockMinimo DECIMAL(11,2),IN _precioCompra DECIMAL(11,2),IN _precioVenta DECIMAL(11,2),IN _descuento DECIMAL(11,2),IN _img VARCHAR(255), IN _listaCategorias JSON)
BEGIN
/*DECLARAMOS LAS VARIABLES NECESARIAS
PARA ASIGNAR VARIAS CATEGORIAS A UN PRODUCTO
*/
DECLARE i INT DEFAULT 0;
DECLARE idProducto INT;
DECLARE idCategoria INT;
DECLARE numItems INT DEFAULT JSON_LENGTH(_listaCategorias);
/*INICIAMOS LA TRANSACCION*/
START TRANSACTION;
	/*INSERTAMOS A LA TABLA PRODUCTOS*/
	INSERT productos(id_bodega,id_marca,nombre,descripcion,stock,stock_minimo,precio_compra,precio_venta,descuento,img)VALUES(_idBodega,_idMarca,_nombre,_descripcion,_stock,_stockMinimo,_precioCompra,_precioVenta,_descuento,_img);
	/*OBTENEMOS EL ID INSERTADO*/
	SET idProducto = LAST_INSERT_ID();
	/*RECORREMOS EL OBJETO CATEGORIA*/
	WHILE i < numItems DO
		/*EXTRAEMOS E INSERTAMOS*/
		SET idCategoria = JSON_EXTRACT(_listaCategorias,CONCAT('$[', i, '].categoria'));
		INSERT INTO productos_categorias VALUES(idProducto,idCategoria);
		/*SUMAMOS EN UNO PARA QUE EL WHILE CONTINUE*/
		SET i = i + 1;
	END WHILE;
/*SI TODO ESTA BIEN SE GUARDA LOS CAMBIOS*/
COMMIT;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_D_T_CATEGORIAS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_D_T_CATEGORIAS`;
delimiter ;;
CREATE PROCEDURE `SP_D_T_CATEGORIAS`(IN _idCategoria INT)
BEGIN
	UPDATE categorias SET  estado=0 WHERE id = _idCategoria;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_D_T_MARCAS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_D_T_MARCAS`;
delimiter ;;
CREATE PROCEDURE `SP_D_T_MARCAS`(IN _idMarca INT)
BEGIN
	UPDATE marcas SET estado = 0 WHERE id = _idMarca;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_D_T_PRODUCTOS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_D_T_PRODUCTOS`;
delimiter ;;
CREATE PROCEDURE `SP_D_T_PRODUCTOS`(IN _idProducto INT, IN _idBodega INT)
BEGIN
	/*HACEMOS UN UPDATE EN ESTADO PARA QUE SE OCULTE */
	UPDATE 	productos SET estado = 0 
	/*APLICANDO LA CONDICIONAL PARA OBTENER EL PRODUCTO*/
	WHERE id = _idProducto AND id_bodega = _idBodega;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_R_T_ACCESO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_R_T_ACCESO`;
delimiter ;;
CREATE PROCEDURE `SP_R_T_ACCESO`(IN _token VARCHAR(255))
BEGIN
	SELECT 
	c.id AS idAcceso,
	CASE 
		WHEN b.id IS NOT NULL THEN b.id
		WHEN a.id IS NOT NULL THEN a.id
		WHEN u.id IS NOT NULL THEN u.id
		ELSE NULL
	END AS idAccesoRol,
	CASE 
		WHEN b.id IS NOT NULL THEN 'rol_bodega'
		WHEN a.id IS NOT NULL THEN 'rol_administrador'
		WHEN u.id IS NOT NULL THEN 'rol_usuario'
		ELSE NULL
		END AS rol,
	CASE 
		WHEN b.id IS NOT NULL THEN b.nombre
		WHEN a.id IS NOT NULL THEN a.nombres
		WHEN u.id IS NOT NULL THEN u.nombres
		ELSE NULL
		END AS nombres,
		CASE 
		WHEN b.id IS NOT NULL THEN NULL
		WHEN a.id IS NOT NULL THEN a.apellidos
		WHEN u.id IS NOT NULL THEN u.apellidos
		ELSE NULL
		END AS apellidos
 FROM acceso c 
 LEFT JOIN bodegas b 
 ON b.id_acceso = c.id 
 LEFT JOIN administrativos a 
 ON a.id_acceso = c.id 
 LEFT JOIN usuarios u ON u.id_acceso = c.id
 WHERE c.token = _token AND _token != '' LIMIT 1;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_R_T_ACCESO_VERIFICAR_DUPLICIDAD_CORREO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_R_T_ACCESO_VERIFICAR_DUPLICIDAD_CORREO`;
delimiter ;;
CREATE PROCEDURE `SP_R_T_ACCESO_VERIFICAR_DUPLICIDAD_CORREO`(IN _correo VARCHAR(255))
BEGIN
	SELECT correo FROM acceso WHERE correo LIKE CONCAT('%',_correo,'%');

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_R_T_BODEGAS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_R_T_BODEGAS`;
delimiter ;;
CREATE PROCEDURE `SP_R_T_BODEGAS`()
BEGIN
	SELECT 
	b.id,b.ruc,b.nombre,b.direccion,a.correo,b.telefono,b.celular,b.nombre_propietario 
	FROM bodegas b
	INNER JOIN acceso a
	ON b.id_acceso = a.id
	;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_R_T_CATEGORIAS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_R_T_CATEGORIAS`;
delimiter ;;
CREATE PROCEDURE `SP_R_T_CATEGORIAS`()
BEGIN
	SELECT id,nombre AS nombreCategoria FROM categorias WHERE estado = 1;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_R_T_MARCAS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_R_T_MARCAS`;
delimiter ;;
CREATE PROCEDURE `SP_R_T_MARCAS`()
BEGIN
	SELECT id,nombre AS nombreMarca FROM marcas WHERE estado = 1;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_R_T_PRODUCTOS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_R_T_PRODUCTOS`;
delimiter ;;
CREATE PROCEDURE `SP_R_T_PRODUCTOS`()
BEGIN
/*SELECCIONAMOS LOS CAMPOS NECESARIOS*/
	SELECT p.nombre,descripcion,GROUP_CONCAT(c.nombre SEPARATOR ';') AS categorias,m.nombre AS nombre_marca,
	precio_compra,precio_venta,stock,stock_minimo,p.id AS id_producto
FROM productos p 
/*RELACIONAMOS CON LA TABLA DETALLE CATEGORIAS*/
	INNER JOIN productos_categorias pc
	ON p.id = pc.id_producto
/*RELACIONAMOS CON LAS CATEGORIAS*/
	INNER JOIN categorias c
	ON c.id = pc.id_categoria
/*RELACIONAMOS CON LA TABLA MARCA*/
	INNER JOIN marcas m
	ON m.id = p.id_marca
/*SOLO MOSTRAMOS LOS QUE ESTAN ACTIVOS*/
	WHERE p.estado = 1 GROUP BY p.id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_U_T_CATEGORIAS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_U_T_CATEGORIAS`;
delimiter ;;
CREATE PROCEDURE `SP_U_T_CATEGORIAS`(IN _idCategoria INT, IN _nombre VARCHAR(255))
BEGIN
	UPDATE categorias SET  nombre=_nombre WHERE id = _idCategoria;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_U_T_MARCAS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_U_T_MARCAS`;
delimiter ;;
CREATE PROCEDURE `SP_U_T_MARCAS`(IN _idMarca INT, IN _nombre VARCHAR(255))
BEGIN
	UPDATE marcas SET  nombre=_nombre WHERE id=_idMarca;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_U_T_PRODUCTOS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_U_T_PRODUCTOS`;
delimiter ;;
CREATE PROCEDURE `SP_U_T_PRODUCTOS`(IN _idProducto INT, IN _idBodega INT,IN _idMarca INT, _nombre VARCHAR(255),IN _descripcion VARCHAR(255), IN _stock DECIMAL(11,2), IN _stockMinimo DECIMAL(11,2),IN _precioCompra DECIMAL(11,2),IN _precioVenta DECIMAL(11,2),IN _descuento DECIMAL(11,2),IN _img VARCHAR(255), IN _listaCategorias JSON)
BEGIN
/*DECLARAMOS LAS VARIABLES NECESARIAS
PARA ASIGNAR VARIAS CATEGORIAS A UN PRODUCTO
*/
DECLARE i INT DEFAULT 0;
DECLARE idCategoria INT;
DECLARE numItems INT DEFAULT JSON_LENGTH(_listaCategorias);
/*INICIAMOS LA TRANSACCION*/
START TRANSACTION;
	/*ACTUALIZAMOS LA TABLA PRODUCTOS CONDICIONANDO SU ID Y SU ID BODEGA*/
	UPDATE productos SET id_marca = _idMarca,nombre=_nombre,descripcion=_descripcion,stock=_stock,stock_minimo=_stockMinimo,precio_compra=_precioCompra,precio_venta=_precioVenta,descuento=_descuento,img=_img WHERE id = _idProducto AND id_bodega = _idBodega;
	/*ELIMINAMOS TODOS LOS DETALLES DE LA CATEGORIA*/
	DELETE FROM productos_categorias WHERE id_producto = _idProducto;
	/*RECORREMOS EL OBJETO CATEGORIA PARA INSERTAR LAS CATEGORIAS NUEVAS*/
	WHILE i < numItems DO
		/*EXTRAEMOS E INSERTAMOS*/
		SET idCategoria = JSON_EXTRACT(_listaCategorias,CONCAT('$[', i, '].categoria'));
		INSERT INTO productos_categorias VALUES(_idProducto,idCategoria);
		/*SUMAMOS EN UNO PARA QUE EL WHILE CONTINUE*/
		SET i = i + 1;
	END WHILE;
/*SI TODO ESTA BIEN SE GUARDA LOS CAMBIOS*/
COMMIT;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
