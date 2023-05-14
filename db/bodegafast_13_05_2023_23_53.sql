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

 Date: 12/05/2023 23:59:48
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

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
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bodegas
-- ----------------------------
INSERT INTO `bodegas` VALUES (1, NULL, '20145151256', 'BODEGA LUCERO', NULL, NULL, NULL, NULL, NULL, NULL, 1);

-- ----------------------------
-- Table structure for categorias
-- ----------------------------
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `estado` tinyint(1) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categorias
-- ----------------------------
INSERT INTO `categorias` VALUES (1, 'Bebidas', 1);

-- ----------------------------
-- Table structure for marcas
-- ----------------------------
DROP TABLE IF EXISTS `marcas`;
CREATE TABLE `marcas`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `estado` tinyint(1) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of marcas
-- ----------------------------
INSERT INTO `marcas` VALUES (1, 'Coca Cola', 1);
INSERT INTO `marcas` VALUES (2, 'Gloria', 1);

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
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of productos
-- ----------------------------
INSERT INTO `productos` VALUES (35, 1, 1, 'Leche Gloria', '', 2.00, 0.00, 2.00, 2.00, 0.00, 'aas', 1);
INSERT INTO `productos` VALUES (36, 1, 2, 'Lucas', '', 3.00, 0.00, 5.00, 4.50, 0.00, 'aas', 1);

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
INSERT INTO `productos_categorias` VALUES (35, 1);
INSERT INTO `productos_categorias` VALUES (36, 1);

-- ----------------------------
-- Procedure structure for SP_C_T_PRODUCTOS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_C_T_PRODUCTOS`;
delimiter ;;
CREATE PROCEDURE `SP_C_T_PRODUCTOS`(IN _idBodega INT,IN _idMarca INT, _nombre VARCHAR(255),IN _descripcion VARCHAR(255), IN _stock DECIMAL(11,2), IN _stockMinimo DECIMAL(11,2),IN _precioCompra DECIMAL(11,2),IN _precioVenta DECIMAL(11,2),IN _descuento DECIMAL(11,2),IN _img VARCHAR(255), IN _listaCategorias JSON)
BEGIN
DECLARE i INT DEFAULT 0;
DECLARE idProducto INT;
DECLARE idCategoria INT;
DECLARE numItems INT DEFAULT JSON_LENGTH(_listaCategorias);
START TRANSACTION;
	INSERT productos(id_bodega,id_marca,nombre,descripcion,stock,stock_minimo,precio_compra,precio_venta,descuento,img)VALUES(_idBodega,_idMarca,_nombre,_descripcion,_stock,_stockMinimo,_precioCompra,_precioVenta,_descuento,_img);
	SET idProducto = LAST_INSERT_ID();
	WHILE i < numItems DO
		SET idCategoria = JSON_EXTRACT(_listaCategorias,CONCAT('$[', i, '].categoria'));
		INSERT INTO productos_categorias VALUES(idProducto,idCategoria);
		SET i = i + 1;
	END WHILE;
COMMIT;
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
	SELECT p.nombre,descripcion,GROUP_CONCAT(c.nombre SEPARATOR ';') AS categorias,m.nombre AS nombre_marca,
	precio_compra,precio_venta,stock,stock_minimo,p.id AS id_producto
FROM productos p 
	INNER JOIN productos_categorias pc
	ON p.id = pc.id_producto
	INNER JOIN categorias c
	ON c.id = pc.id_categoria
	INNER JOIN marcas m
	ON m.id = p.id_marca
	WHERE p.estado = 1 GROUP BY p.id;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
