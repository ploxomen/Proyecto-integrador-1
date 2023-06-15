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

 Date: 14/06/2023 21:36:10
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
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of acceso
-- ----------------------------
INSERT INTO `acceso` VALUES (1, 'bodegalucero@gmail.com', '$2y$10$tdrpW.jUUaVnsEcRDkkoXOlUBlTdMKBZluAA5frChR1/lxglvdmyC', '', 1);
INSERT INTO `acceso` VALUES (10, 'jeanpi.jpct@gmail.com', '$2y$10$tdrpW.jUUaVnsEcRDkkoXOlUBlTdMKBZluAA5frChR1/lxglvdmyC', '', 1);
INSERT INTO `acceso` VALUES (15, 'osbaldo@gmail.com', '$2y$10$tdrpW.jUUaVnsEcRDkkoXOlUBlTdMKBZluAA5frChR1/lxglvdmyC', '', 1);
INSERT INTO `acceso` VALUES (20, 'emersonloc@yopmail.com', '$2y$10$irH7vW12JBuq/5FV17R3QezPCUofFTvuGFBzV7s7n5TPnG5JBybma', '', 1);
INSERT INTO `acceso` VALUES (21, 'jeanherrera11@yotmail.com', '$2y$10$Um0IajFhJs4cZcYIhINH8e52.hiB9eDIjXc9y3klm1LsnpDCPr30i', '', 1);
INSERT INTO `acceso` VALUES (22, 'luisalcantara@yopmail.com', '$2y$10$tdrpW.jUUaVnsEcRDkkoXOlUBlTdMKBZluAA5frChR1/lxglvdmyC', '36810c79359d944cc9afa32dcab78754a1956224045745fdfa20c49393454803056d1ae6e1', 1);
INSERT INTO `acceso` VALUES (23, 'yosimardensel@gmail.com', '$2y$10$ePVwX9bFhrFywDK7hATMRuMvS7RDcKIw9WDukAiDGVTEKNsJqe14y', '', 1);

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

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
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

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
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

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
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of marcas
-- ----------------------------
INSERT INTO `marcas` VALUES (1, 'Coca Cola', 1);
INSERT INTO `marcas` VALUES (2, 'Gloria', 1);
INSERT INTO `marcas` VALUES (3, 'Laive', 0);
INSERT INTO `marcas` VALUES (4, 'Nestle', 1);
INSERT INTO `marcas` VALUES (5, 'Lays', 0);
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
) ENGINE = InnoDB AUTO_INCREMENT = 62 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of productos
-- ----------------------------
INSERT INTO `productos` VALUES (44, 1, 2, 'Leche Gloria Azul de 400g', 'Leche gloria de etiqueta azul de 400 gramos', 10.00, 0.00, 3.50, 4.50, 1.00, '1684294698_leche_gloria.jpg', 1);
INSERT INTO `productos` VALUES (45, 1, 2, 'Leche Gloria Azul de 170g', 'Leche gloria azul de 170 gramos con abre fácil', 10.00, 0.00, 1.50, 2.20, 0.00, '1684294779_leche_gloria_chica.jpg', 1);
INSERT INTO `productos` VALUES (46, 1, 4, 'Café Instantáneo Nescafé Tradición Frasco 170g', '', 9.00, 0.00, 11.50, 15.00, 0.00, '1684295057_Mesa-de-trabajo-21-3.jpg', 1);
INSERT INTO `productos` VALUES (47, 1, 4, 'zzz', 'z', 5.00, 0.00, 11.50, 6.00, 0.00, '1684295057_Mesa-de-trabajo-21-3.jpg', 0);
INSERT INTO `productos` VALUES (48, 1, 2, 'Yogurt ', '', 100.00, 10.00, 3.50, 3.90, 0.00, '1684722119_Yogurt Gloria.jpg', 0);
INSERT INTO `productos` VALUES (49, 1, 2, 'Atun ', '', 50.00, 5.00, 4.00, 4.50, 0.00, '1684722166_Atun Gloria.jpg', 0);
INSERT INTO `productos` VALUES (50, 1, 2, 'Atun Gloria', '', 0.00, 5.00, 4.00, 4.50, 0.00, '1684722316_Atun Gloria.jpg', 1);
INSERT INTO `productos` VALUES (51, 1, 4, 'Leche condensada 185g', '', 10.00, 5.00, 5.00, 5.20, 0.00, '1684722522_Leche condensada Nestle.png', 1);
INSERT INTO `productos` VALUES (52, 1, 4, 'Sublime 30g', '', 10.00, 5.00, 0.80, 1.00, 0.00, '1684722730_Sublime.jpeg', 1);
INSERT INTO `productos` VALUES (53, 1, 10, 'Inca Kola 1.5L', '', 10.00, 10.00, 5.50, 6.00, 0.00, '1684722860_Inca Kola.jpg', 1);
INSERT INTO `productos` VALUES (54, 1, 11, 'Big Cola 3L', '', 100.00, 5.00, 6.80, 7.00, 0.00, '1684725886_big-cola 3L.png', 0);
INSERT INTO `productos` VALUES (55, 1, 11, 'Big Cola 3L', '', 0.00, 5.00, 7.90, 8.00, 0.00, '1684726207_big-cola 3L.png', 1);
INSERT INTO `productos` VALUES (56, 1, 9, 'Colgate Triple Accion 150ml', '', 6.00, 2.00, 3.90, 4.50, 0.00, '1684726256_Colgate Triple Accion.jpg', 1);
INSERT INTO `productos` VALUES (57, 1, 9, 'Colgate Luminus White 150ml', '', 7.00, 10.00, 6.20, 6.70, 0.00, '1684726298_Colgate Luminus White.jpg', 1);
INSERT INTO `productos` VALUES (58, 1, 4, 'Lentejas Nestle  16g', '', 10.00, 5.00, 0.90, 1.00, 0.00, '1684726344_lentejasss-16g.jpg', 1);
INSERT INTO `productos` VALUES (59, 1, 4, 'Morochas 240g', '', 10.00, 3.00, 0.80, 1.20, 0.00, '1684726405_morochas-240g.jpg', 1);
INSERT INTO `productos` VALUES (60, 1, 6, 'Pan Bimbo 480g', '', 10.00, 10.00, 5.50, 6.00, 0.00, '1684726461_Pan Bimbo 480g.jpeg', 1);
INSERT INTO `productos` VALUES (61, 1, 6, 'Paneton Bimbo 900g', '', 10.00, 5.00, 20.00, 25.00, 0.00, '1684726503_Paneton Bimbo 900g.png', 1);

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
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of productos_categorias
-- ----------------------------
INSERT INTO `productos_categorias` VALUES (44, 6);
INSERT INTO `productos_categorias` VALUES (45, 6);
INSERT INTO `productos_categorias` VALUES (46, 3);
INSERT INTO `productos_categorias` VALUES (47, 3);
INSERT INTO `productos_categorias` VALUES (48, 6);
INSERT INTO `productos_categorias` VALUES (49, 5);
INSERT INTO `productos_categorias` VALUES (50, 5);
INSERT INTO `productos_categorias` VALUES (51, 6);
INSERT INTO `productos_categorias` VALUES (52, 2);
INSERT INTO `productos_categorias` VALUES (53, 1);
INSERT INTO `productos_categorias` VALUES (54, 1);
INSERT INTO `productos_categorias` VALUES (55, 1);
INSERT INTO `productos_categorias` VALUES (56, 7);
INSERT INTO `productos_categorias` VALUES (57, 7);
INSERT INTO `productos_categorias` VALUES (58, 2);
INSERT INTO `productos_categorias` VALUES (59, 2);
INSERT INTO `productos_categorias` VALUES (60, 3);
INSERT INTO `productos_categorias` VALUES (61, 3);

-- ----------------------------
-- Table structure for productos_historial
-- ----------------------------
DROP TABLE IF EXISTS `productos_historial`;
CREATE TABLE `productos_historial`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_producto` int NULL DEFAULT NULL,
  `fecha_creada` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `cantidad` decimal(11, 2) NULL DEFAULT NULL,
  `precio_venta` decimal(11, 2) NULL DEFAULT NULL,
  `descuento` decimal(11, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_producto`(`id_producto`) USING BTREE,
  CONSTRAINT `productos_historial_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of productos_historial
-- ----------------------------
INSERT INTO `productos_historial` VALUES (1, 44, '2023-06-14 15:42:11', 222.00, 12.00, 0.00);
INSERT INTO `productos_historial` VALUES (2, 44, '2023-06-14 16:01:25', 15.00, 4.50, 1.00);
INSERT INTO `productos_historial` VALUES (3, 44, '2023-06-14 16:02:34', 3.00, 4.50, 1.00);

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
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES (1, 15, 'Osbaldo', 'Laurencio', '984545451', 'Av. los jasmines 351 - Comas');
INSERT INTO `usuarios` VALUES (3, 20, 'Emerso', 'Carranza', '984784512', 'Av. larco 141 - Los Olivos');
INSERT INTO `usuarios` VALUES (4, 21, 'Jean Pier', 'Herrera', '987845121', 'Av. san luis 123 - San Martin');
INSERT INTO `usuarios` VALUES (5, 22, 'Luis', 'Alcantara', '996521451', 'Av. los girasoles 123 - Puente Piedra');
INSERT INTO `usuarios` VALUES (6, 23, 'Yosimar', 'Ramirez', '987845123', 'AV. Los libertadores 14 - Carabayllo');

-- ----------------------------
-- Table structure for ventas
-- ----------------------------
DROP TABLE IF EXISTS `ventas`;
CREATE TABLE `ventas`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuarios` int NULL DEFAULT NULL,
  `direccion` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `celular` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `metodo_envio` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `metodo_pago` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `responsable_venta` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `subtotal` decimal(10, 2) NULL DEFAULT NULL,
  `igv` decimal(10, 2) NULL DEFAULT NULL,
  `envio` decimal(10, 2) NULL DEFAULT NULL,
  `total` decimal(10, 2) NULL DEFAULT NULL,
  `estado` tinyint(1) NULL DEFAULT 1,
  `fecha_venta` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_usuarios`(`id_usuarios`) USING BTREE,
  CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_usuarios`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ventas
-- ----------------------------
INSERT INTO `ventas` VALUES (23, 6, 'AV. Los libertadores 14 - Carabayllo', '987845123', 'DELIVERY', 'EFECTIVO', 'CLIENTE', 24.00, 4.32, 10.00, 34.00, 1, '2023-06-02 11:13:14');
INSERT INTO `ventas` VALUES (24, 6, 'AV. Los libertadores 14 - Carabayllo', '987845123', 'DELIVERY', 'EFECTIVO', 'BODEGA', 6.40, 1.15, 10.00, 16.40, 1, '2023-06-14 13:15:11');
INSERT INTO `ventas` VALUES (25, 1, 'Av. los jasmines 351 - Comas', '984545451', 'DELIVERY', 'CARD', 'CLIENTE', 29.50, 5.31, 10.00, 39.50, 1, '2023-06-14 19:06:25');
INSERT INTO `ventas` VALUES (26, 1, 'Av. los jasmines 351 - Comas', '984545451', 'DELIVERY', 'CARD', 'CLIENTE', 0.00, 0.00, 10.00, 10.00, 1, '2023-06-14 19:10:40');
INSERT INTO `ventas` VALUES (27, 1, 'Av. los jasmines 351 - Comas', '984545451', 'DELIVERY', 'CARD', 'CLIENTE', 4.50, 0.81, 10.00, 14.50, 1, '2023-06-14 19:15:37');
INSERT INTO `ventas` VALUES (28, 1, 'Av. los jasmines 351 - Comas', '984545451', 'DELIVERY', 'CARD', 'CLIENTE', 4.50, 0.81, 10.00, 14.50, 1, '2023-06-14 19:17:29');
INSERT INTO `ventas` VALUES (29, 1, 'Av. los jasmines 351 - Comas', '984545451', 'DELIVERY', 'CARD', 'CLIENTE', 4.50, 0.81, 10.00, 14.50, 1, '2023-06-14 19:18:43');
INSERT INTO `ventas` VALUES (30, 1, 'Av. los jasmines 351 - Comas', '984545451', 'DELIVERY', 'CARD', 'CLIENTE', 4.50, 0.81, 10.00, 14.50, 1, '2023-06-14 19:20:01');
INSERT INTO `ventas` VALUES (31, 1, 'Av. los jasmines 351 - Comas', '984545451', 'DELIVERY', 'CARD', 'CLIENTE', 4.50, 0.81, 10.00, 14.50, 1, '2023-06-14 19:21:50');
INSERT INTO `ventas` VALUES (32, 1, 'Av. los jasmines 351 - Comas', '984545451', 'DELIVERY', 'CARD', 'CLIENTE', 4.50, 0.81, 10.00, 14.50, 1, '2023-06-14 19:25:34');
INSERT INTO `ventas` VALUES (33, 1, 'Av. los jasmines 351 - Comas', '984545451', 'DELIVERY', 'CARD', 'CLIENTE', 16.00, 2.88, 10.00, 26.00, 1, '2023-06-14 19:31:40');
INSERT INTO `ventas` VALUES (34, 1, 'Av. los jasmines 351 - Comas', '984545451', 'DELIVERY', 'CARD', 'CLIENTE', 8.00, 1.44, 10.00, 18.00, 1, '2023-06-14 19:52:21');
INSERT INTO `ventas` VALUES (35, 1, 'Av. los jasmines 351 - Comas', '984545451', 'DELIVERY', 'CARD', 'CLIENTE', 8.00, 1.44, 10.00, 18.00, 1, '2023-06-14 19:57:42');
INSERT INTO `ventas` VALUES (36, 1, 'Av. los jasmines 351 - Comas', '984545451', 'DELIVERY', 'CARD', 'CLIENTE', 4.50, 0.81, 10.00, 14.50, 1, '2023-06-14 20:17:22');
INSERT INTO `ventas` VALUES (37, 1, 'Av. los jasmines 351 - Comas', '984545451', 'DELIVERY', 'CARD', 'CLIENTE', 12.50, 2.25, 10.00, 22.50, 1, '2023-06-14 20:19:56');
INSERT INTO `ventas` VALUES (38, 1, 'Av. los jasmines 351 - Comas', '984545451', 'DELIVERY', 'CARD', 'CLIENTE', 20.50, 3.69, 10.00, 30.50, 1, '2023-06-14 20:32:48');
INSERT INTO `ventas` VALUES (39, 1, 'Av. los jasmines 351 - Comas', '984545451', 'DELIVERY', 'CARD', 'CLIENTE', 8.00, 1.44, 10.00, 18.00, 1, '2023-06-14 20:33:36');
INSERT INTO `ventas` VALUES (40, 1, 'Av. los jasmines 351 - Comas', '984545451', 'DELIVERY', 'CARD', 'CLIENTE', 16.00, 2.88, 10.00, 26.00, 1, '2023-06-14 20:34:31');
INSERT INTO `ventas` VALUES (41, 1, 'Av. los jasmines 351 - Comas', '984545451', 'DELIVERY', 'CARD', 'CLIENTE', 20.10, 3.62, 10.00, 30.10, 1, '2023-06-14 20:35:48');
INSERT INTO `ventas` VALUES (42, 1, 'Av. los jasmines 351 - Comas', '984545451', 'DELIVERY', 'CARD', 'CLIENTE', 4.50, 0.81, 10.00, 14.50, 1, '2023-06-14 20:38:14');
INSERT INTO `ventas` VALUES (43, 1, 'Av. los jasmines 351 - Comas', '984545451', 'DELIVERY', 'CARD', 'CLIENTE', 9.00, 1.62, 10.00, 19.00, 1, '2023-06-14 20:41:31');
INSERT INTO `ventas` VALUES (44, 5, 'Av. los girasoles 123 - Puente Piedra', '996521451', 'DELIVERY', 'CARD', 'CLIENTE', 19.50, 3.51, 10.00, 29.50, 1, '2023-06-14 21:32:49');
INSERT INTO `ventas` VALUES (45, 5, 'Av. los girasoles 123 - Puente Piedra', '996521451', 'DELIVERY', 'CARD', 'CLIENTE', 4.50, 0.81, 10.00, 14.50, 1, '2023-06-14 21:35:14');

-- ----------------------------
-- Table structure for ventas_detalle
-- ----------------------------
DROP TABLE IF EXISTS `ventas_detalle`;
CREATE TABLE `ventas_detalle`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_venta` int NULL DEFAULT NULL,
  `id_producto` int NULL DEFAULT NULL,
  `precio_venta` decimal(10, 2) NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT NULL,
  `subtotal` decimal(10, 2) NULL DEFAULT NULL,
  `estado` tinyint(1) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_venta`(`id_venta`) USING BTREE,
  INDEX `id_producto`(`id_producto`) USING BTREE,
  CONSTRAINT `ventas_detalle_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `ventas_detalle_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ventas_detalle
-- ----------------------------
INSERT INTO `ventas_detalle` VALUES (37, 23, 55, 8.00, 3, 24.00, 1);
INSERT INTO `ventas_detalle` VALUES (38, 24, 44, 4.20, 1, 4.20, 1);
INSERT INTO `ventas_detalle` VALUES (39, 24, 45, 2.20, 1, 2.20, 1);
INSERT INTO `ventas_detalle` VALUES (40, 25, 50, 4.50, 3, 13.50, 1);
INSERT INTO `ventas_detalle` VALUES (41, 25, 55, 8.00, 2, 16.00, 1);
INSERT INTO `ventas_detalle` VALUES (42, 26, 50, 4.50, NULL, NULL, 1);
INSERT INTO `ventas_detalle` VALUES (43, 26, 55, 8.00, NULL, NULL, 1);
INSERT INTO `ventas_detalle` VALUES (44, 26, 46, 15.00, NULL, NULL, 1);
INSERT INTO `ventas_detalle` VALUES (45, 26, 57, 6.70, NULL, NULL, 1);
INSERT INTO `ventas_detalle` VALUES (46, 26, 56, 4.50, NULL, NULL, 1);
INSERT INTO `ventas_detalle` VALUES (47, 26, 53, 6.00, NULL, NULL, 1);
INSERT INTO `ventas_detalle` VALUES (48, 26, 51, 5.20, NULL, NULL, 1);
INSERT INTO `ventas_detalle` VALUES (49, 26, 45, 2.20, NULL, NULL, 1);
INSERT INTO `ventas_detalle` VALUES (50, 26, 44, 4.50, NULL, NULL, 1);
INSERT INTO `ventas_detalle` VALUES (51, 26, 58, 1.00, NULL, NULL, 1);
INSERT INTO `ventas_detalle` VALUES (52, 26, 59, 1.20, NULL, NULL, 1);
INSERT INTO `ventas_detalle` VALUES (53, 26, 60, 6.00, NULL, NULL, 1);
INSERT INTO `ventas_detalle` VALUES (54, 26, 61, 25.00, NULL, NULL, 1);
INSERT INTO `ventas_detalle` VALUES (55, 26, 52, 1.00, NULL, NULL, 1);
INSERT INTO `ventas_detalle` VALUES (56, 27, 50, 4.50, 1, 4.50, 1);
INSERT INTO `ventas_detalle` VALUES (57, 28, 50, 4.50, 1, 4.50, 1);
INSERT INTO `ventas_detalle` VALUES (58, 29, 50, 4.50, 1, 4.50, 1);
INSERT INTO `ventas_detalle` VALUES (59, 30, 50, 4.50, 1, 4.50, 1);
INSERT INTO `ventas_detalle` VALUES (60, 31, 50, 4.50, 1, 4.50, 1);
INSERT INTO `ventas_detalle` VALUES (61, 32, 50, 4.50, 1, 4.50, 1);
INSERT INTO `ventas_detalle` VALUES (62, 33, 55, 8.00, 2, 16.00, 1);
INSERT INTO `ventas_detalle` VALUES (63, 34, 55, 8.00, 1, 8.00, 1);
INSERT INTO `ventas_detalle` VALUES (64, 35, 55, 8.00, 1, 8.00, 1);
INSERT INTO `ventas_detalle` VALUES (65, 36, 50, 4.50, 1, 4.50, 1);
INSERT INTO `ventas_detalle` VALUES (66, 37, 50, 4.50, 1, 4.50, 1);
INSERT INTO `ventas_detalle` VALUES (67, 37, 55, 8.00, 1, 8.00, 1);
INSERT INTO `ventas_detalle` VALUES (68, 38, 50, 4.50, 1, 4.50, 1);
INSERT INTO `ventas_detalle` VALUES (69, 38, 55, 8.00, 2, 16.00, 1);
INSERT INTO `ventas_detalle` VALUES (70, 39, 55, 8.00, 1, 8.00, 1);
INSERT INTO `ventas_detalle` VALUES (71, 40, 55, 8.00, 2, 16.00, 1);
INSERT INTO `ventas_detalle` VALUES (72, 41, 57, 6.70, 3, 20.10, 1);
INSERT INTO `ventas_detalle` VALUES (73, 42, 56, 4.50, 1, 4.50, 1);
INSERT INTO `ventas_detalle` VALUES (74, 43, 56, 4.50, 2, 9.00, 1);
INSERT INTO `ventas_detalle` VALUES (75, 44, 46, 15.00, 1, 15.00, 1);
INSERT INTO `ventas_detalle` VALUES (76, 44, 56, 4.50, 1, 4.50, 1);
INSERT INTO `ventas_detalle` VALUES (77, 45, 50, 4.50, 1, 4.50, 1);

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
-- Procedure structure for SP_C_T_PRODUCTOS_HISTORIAL
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_C_T_PRODUCTOS_HISTORIAL`;
delimiter ;;
CREATE PROCEDURE `SP_C_T_PRODUCTOS_HISTORIAL`(IN _producto INT,
	IN _cantidad DECIMAL(11,2),
	IN _descuento DECIMAL(11,2),
	IN _precio_venta DECIMAL(11,2))
BEGIN
START TRANSACTION;
	INSERT INTO productos_historial(id_producto,cantidad,precio_venta,descuento)
	VALUES(_producto,_cantidad,_precio_venta,_descuento);
	
	UPDATE productos SET stock = _cantidad,precio_venta=_precio_venta,descuento=_descuento
	WHERE id = _producto;
COMMIT;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_C_T_VENTAS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_C_T_VENTAS`;
delimiter ;;
CREATE PROCEDURE `SP_C_T_VENTAS`(IN _idUsuario INT,
IN _direccion VARCHAR(255),
IN _celular VARCHAR(20), 
IN _metodoEnvio VARCHAR(50),
IN _metodoPago VARCHAR(50),
IN _responsableVenta VARCHAR(50),
IN _subtotal DECIMAL(10,2),
IN _envio DECIMAL(10,2),
IN _total DECIMAL(10,2),
IN _igv DECIMAL(10,2),
IN _detalleVentas JSON)
BEGIN
/*DECLARAMOS LAS VARIABLES NECESARIAS
PARA ASIGNAR VARIOS DETALLES A UNA VENTA
*/
DECLARE i INT DEFAULT 0;
DECLARE idVenta INT;
DECLARE idProducto INT;
DECLARE precioVenta,cantidad,subTotal DECIMAL(10,2);
DECLARE numItems INT DEFAULT JSON_LENGTH(_detalleVentas);
/*INICIAMOS LA TRANSACCION*/
START TRANSACTION;
	/*INSERTAMOS A LA TABLA VENTAS*/
	INSERT ventas(id_usuarios,direccion,celular,metodo_envio,metodo_pago,responsable_venta,subtotal,envio,total,igv)VALUES(_idUsuario,_direccion,_celular,_metodoEnvio,_metodoPago,_responsableVenta,_subtotal,_envio,_total,_igv);
	/*OBTENEMOS EL ID INSERTADO*/
	SET idVenta = LAST_INSERT_ID();
	/*RECORREMOS EL OBJETO DETALLE VENTAS*/
	WHILE i < numItems DO
		/*EXTRAEMOS E INSERTAMOS*/
		SET idProducto = JSON_EXTRACT(_detalleVentas,CONCAT('$[', i, '].id'));
		SET precioVenta = JSON_EXTRACT(_detalleVentas,CONCAT('$[', i, '].precio_venta'));
		SET cantidad = JSON_EXTRACT(_detalleVentas,CONCAT('$[', i, '].cantidad'));
		SET subTotal = JSON_EXTRACT(_detalleVentas,CONCAT('$[', i, '].sub_total'));
		INSERT INTO ventas_detalle(id_venta,id_producto,precio_venta,cantidad,subtotal) VALUES(idVenta,idProducto,precioVenta,cantidad,subTotal);
		/*SUMAMOS EN UNO PARA QUE EL WHILE CONTINUE*/
		UPDATE productos SET stock = stock - cantidad WHERE id = idProducto AND estado = 1;
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
		END AS apellidos,
	CASE 
		WHEN b.id IS NOT NULL THEN NULL
		WHEN a.id IS NOT NULL THEN NULL
		WHEN u.id IS NOT NULL THEN u.direccion
		ELSE NULL
		END AS direccion,
	CASE 
		WHEN b.id IS NOT NULL THEN NULL
		WHEN a.id IS NOT NULL THEN NULL
		WHEN u.id IS NOT NULL THEN u.celular
		ELSE NULL
		END AS celular,
	c.correo
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
-- Procedure structure for SP_R_T_CATEGORIAS_PRODUCTOS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_R_T_CATEGORIAS_PRODUCTOS`;
delimiter ;;
CREATE PROCEDURE `SP_R_T_CATEGORIAS_PRODUCTOS`()
BEGIN
	SELECT c.id,c.nombre AS categoria,COUNT(*) AS numeroProductos FROM categorias c
	INNER JOIN productos_categorias pc
	ON c.id = pc.id_categoria
	INNER JOIN productos p
	ON p.id = pc.id_producto
	WHERE c.estado = 1
	AND p.estado = 1 GROUP BY c.id ORDER BY c.nombre ASC;
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
-- Procedure structure for SP_R_T_MARCAS_PRODUCTOS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_R_T_MARCAS_PRODUCTOS`;
delimiter ;;
CREATE PROCEDURE `SP_R_T_MARCAS_PRODUCTOS`()
BEGIN
	SELECT m.id,m.nombre AS marcas,COUNT(*) AS numeroProductos FROM marcas m
	INNER JOIN productos p
	ON p.id_marca = m.id
	WHERE m.estado = 1
	AND p.estado = 1 GROUP BY m.id ORDER BY m.nombre ASC;
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
-- Procedure structure for SP_R_T_PRODUCTOS_BODEGA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_R_T_PRODUCTOS_BODEGA`;
delimiter ;;
CREATE PROCEDURE `SP_R_T_PRODUCTOS_BODEGA`(IN _bodega INT,
	IN _idProducto INT)
BEGIN
	SELECT id,nombre,stock,precio_venta,descuento FROM productos p
	WHERE id_bodega = _bodega AND IF(_idProducto = 0, p.id LIKE CONCAT('%','','%'),p.id = _idProducto) AND estado = 1;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_R_T_PRODUCTOS_COMPRAS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_R_T_PRODUCTOS_COMPRAS`;
delimiter ;;
CREATE PROCEDURE `SP_R_T_PRODUCTOS_COMPRAS`(IN _nombreProduct VARCHAR(255), IN _ordenaras VARCHAR(255), IN _categorias VARCHAR(255), IN _marcas VARCHAR(255))
BEGIN
	/*AUTOR: JEAN PIER CARRASCO*/
	/*SELECCIONAMOS LAS COLUMNAS NECESARIAS*/
	SELECT p.id,p.nombre,p.img,p.precio_venta,p.stock,b.nombre AS bodega,m.nombre AS marca FROM productos p
	/*RELACIONAMOS CON LAS TABLAS CORRESPONDIENTES*/
	INNER JOIN productos_categorias pc
	ON pc.id_producto = p.id
	INNER JOIN bodegas b
	ON p.id_bodega = b.id
	INNER JOIN marcas m
	ON p.id_marca = m.id
	/*APLICAMOS LAS CONDICIONALES*/
	WHERE p.estado = 1 AND b.estado = 1 AND p.stock > 0
	AND IF(_categorias != '',FIND_IN_SET(pc.id_categoria,_categorias) > 0,p.id LIKE CONCAT('%','','%'))
	AND IF(_marcas != '',FIND_IN_SET(p.id_marca,_marcas) > 0,p.id LIKE CONCAT('%','','%'))
	AND p.nombre LIKE CONCAT('%',_nombreProduct,'%') 
	/*ORDENAMOS DE ACUERDO AL FILTRO */
	ORDER BY
	IF(_ordenaras = 'precio-menor',p.precio_venta,NULL) ASC,
	IF(_ordenaras = 'precio-mayor',p.precio_venta,NULL) DESC,
	IF(_ordenaras = 'nombre-asc',p.nombre,NULL) ASC,
	IF(_ordenaras = 'nombre-desc',p.nombre,NULL) DESC;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_R_T_PRODUCTOS_COMPRAS_CARRITO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_R_T_PRODUCTOS_COMPRAS_CARRITO`;
delimiter ;;
CREATE PROCEDURE `SP_R_T_PRODUCTOS_COMPRAS_CARRITO`(IN _idProductos VARCHAR(255))
BEGIN
	/*AUTOR: JEAN PIER CARRASCO*/
	/*SELECCIONAMOS LAS COLUMNAS NECESARIAS*/
	SELECT p.id,p.nombre,p.img,p.precio_venta,p.stock,b.nombre AS bodega FROM productos p
		/*RELACIONAMOS CON LAS TABLAS CORRESPONDIENTES*/
	INNER JOIN bodegas b
	ON p.id_bodega = b.id
		/*APLICAMOS LAS CONDICIONALES*/
	WHERE p.estado = 1 AND b.estado = 1 
	AND IF(_idProductos != '',FIND_IN_SET(p.id,_idProductos) > 0,p.id LIKE CONCAT('%','','%'))
	/*ORDENAMOS POR NOMBRE*/
	ORDER BY p.nombre;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_R_T_PRODUCTOS_HISTORIAL
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_R_T_PRODUCTOS_HISTORIAL`;
delimiter ;;
CREATE PROCEDURE `SP_R_T_PRODUCTOS_HISTORIAL`(IN _idProducto INT,
	IN _idBodega INT)
BEGIN
	SELECT ph.id,ph.cantidad,ph.descuento,ph.precio_venta,DATE_FORMAT(ph.fecha_creada,'%d/%m/%Y %h:%i %p')AS fechaHr FROM productos_historial ph 
	INNER JOIN productos p
	ON ph.id_producto = p.id
	WHERE ph.id_producto = _idProducto
	AND p.id_bodega = _idBodega ORDER BY ph.fecha_creada DESC;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_R_T_PRODUCTOS_VERIFICAR_CLIENTE
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_R_T_PRODUCTOS_VERIFICAR_CLIENTE`;
delimiter ;;
CREATE PROCEDURE `SP_R_T_PRODUCTOS_VERIFICAR_CLIENTE`(IN _idProducto VARCHAR(250))
BEGIN
	SELECT id,nombre,stock,precio_venta FROM productos p
	WHERE estado = 1 AND FIND_IN_SET(id,_idProducto) > 0;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_R_T_PRODUCTOS_VERIFICAR_STOCK
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_R_T_PRODUCTOS_VERIFICAR_STOCK`;
delimiter ;;
CREATE PROCEDURE `SP_R_T_PRODUCTOS_VERIFICAR_STOCK`(IN _bodega INT,
	IN _idProducto VARCHAR(255))
BEGIN
	SELECT id,nombre,stock,precio_venta FROM productos p
	WHERE id_bodega = _bodega AND estado = 1 AND FIND_IN_SET(id,_idProducto) > 0;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_R_T_USUARIOS_MOSTRAR_CLIENTES_BODEGA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_R_T_USUARIOS_MOSTRAR_CLIENTES_BODEGA`;
delimiter ;;
CREATE PROCEDURE `SP_R_T_USUARIOS_MOSTRAR_CLIENTES_BODEGA`(IN _idUsuario INT)
BEGIN
	SELECT u.id,u.celular,u.direccion,a.correo,u.nombres,u.apellidos FROM usuarios u
	INNER JOIN acceso a
	ON u.id_acceso = a.id 
	WHERE a.estado = 1 AND IF(_idUsuario = 0, u.id LIKE CONCAT('%','','%'),u.id = _idUsuario);

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_R_T_VENTAS_BODEGAS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_R_T_VENTAS_BODEGAS`;
delimiter ;;
CREATE PROCEDURE `SP_R_T_VENTAS_BODEGAS`(IN _bodega INT,
	IN _fechaInicio DATE,
	IN _fechaFin DATE)
BEGIN
	SELECT 
	v.id,
	DATE_FORMAT(v.fecha_venta,'%d/%m/%Y') AS fecha,
	LPAD(v.id,5,'0') AS nroVenta,
	CONCAT(u.nombres,' ',u.apellidos) AS nombresCliente,
	v.celular,
	v.metodo_pago,
	v.direccion,
	SUM(vd.cantidad) AS cantidadProductos,
	COUNT(vd.id) AS nroProductos,
	ROUND((SUM(vd.subtotal) - SUM(vd.subtotal) * 0.18),2) AS subtotal,
	ROUND((SUM(vd.subtotal) * 0.18),2) AS igv,
	SUM(vd.subtotal) AS total
	FROM ventas_detalle vd
	INNER JOIN ventas v
	ON vd.id_venta = v.id
	INNER JOIN productos p
	ON vd.id_producto = p.id
	INNER JOIN usuarios u
	ON u.id = v.id_usuarios
	WHERE v.estado != 0 AND p.id_bodega = _bodega AND DATE_FORMAT(v.fecha_venta,'%Y-%m-%d') BETWEEN _fechaInicio AND _fechaFin GROUP BY v.id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_R_T_VENTAS_PRODUCTOS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_R_T_VENTAS_PRODUCTOS`;
delimiter ;;
CREATE PROCEDURE `SP_R_T_VENTAS_PRODUCTOS`(IN _idVenta INT)
BEGIN
	SELECT p.nombre,vd.cantidad,vd.precio_venta,vd.subtotal FROM ventas_detalle vd
	LEFT JOIN productos p
	ON vd.id_producto = p.id
	WHERE vd.id_venta =  _idVenta AND vd.estado = 1;

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
