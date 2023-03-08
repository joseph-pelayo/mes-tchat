/*
 Navicat Premium Data Transfer

 Source Server         : Linux xToff [Debian 9]
 Source Server Type    : MySQL
 Source Server Version : 100148
 Source Host           : 192.168.56.3:3306
 Source Schema         : cdui_0323

 Target Server Type    : MySQL
 Target Server Version : 100148
 File Encoding         : 65001

 Date: 23/02/2023 15:30:37
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for t_menu
-- ----------------------------
DROP TABLE IF EXISTS `t_menu`;
CREATE TABLE `t_menu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `ordre` int(11) NULL DEFAULT NULL,
  `fk_parent` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_menu
-- ----------------------------
INSERT INTO `t_menu` VALUES (1, 'HOME', 'index.php', 1, 0);
INSERT INTO `t_menu` VALUES (2, 'BOUTIQUE', 'index.php?to=boutique', 2, 0);
INSERT INTO `t_menu` VALUES (3, 'DIAPORAMA', 'index.php?to=diaporama', 3, 0);
INSERT INTO `t_menu` VALUES (5, 'Livres', 'index.php?to=boutique&cat=1', 1, 2);
INSERT INTO `t_menu` VALUES (6, 'Jeux', 'index.php?to=boutique&cat=2', 2, 2);
INSERT INTO `t_menu` VALUES (7, 'Manga', 'index.php?to=boutique&cat=3', 3, 2);
INSERT INTO `t_menu` VALUES (8, 'Voyage', 'index.php?to=boutique&cat=4', 1, 3);

-- ----------------------------
-- Table structure for t_mosaic
-- ----------------------------
DROP TABLE IF EXISTS `t_mosaic`;
CREATE TABLE `t_mosaic`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_fichier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `r` int(11) NULL DEFAULT NULL,
  `g` int(11) NULL DEFAULT NULL,
  `b` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for t_pays
-- ----------------------------
DROP TABLE IF EXISTS `t_pays`;
CREATE TABLE `t_pays`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_pays
-- ----------------------------
INSERT INTO `t_pays` VALUES (1, 'France');
INSERT INTO `t_pays` VALUES (2, 'USA');
INSERT INTO `t_pays` VALUES (6, 'Australie');
INSERT INTO `t_pays` VALUES (7, 'Nouvelle Zélande');

-- ----------------------------
-- Table structure for t_photo
-- ----------------------------
DROP TABLE IF EXISTS `t_photo`;
CREATE TABLE `t_photo`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_fichier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `ordre` int(11) NULL DEFAULT NULL,
  `fk_user` int(11) NULL DEFAULT NULL,
  `titre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for t_user
-- ----------------------------
DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `user_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `login` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `adresse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `code_postal` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `fk_ville` int(11) NULL DEFAULT NULL,
  `fk_pays` int(11) NULL DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_user
-- ----------------------------
INSERT INTO `t_user` VALUES (1, 'Christophe', 'christophe.thibault@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Rue des Hauts', '97432', 5, 1, 'img_63ec927e3ae8b.jpg');
INSERT INTO `t_user` VALUES (2, 'Tao', 't.t@t.com', 'tao', '60784186ea5b29f3f7e16238805ab329', 'Rue des Bas', '97555', 2, 2, NULL);
INSERT INTO `t_user` VALUES (3, 'Marina', 'm.m@m.com', 'marina', 'parian_password', 'Rue du Centre', '97521', 5, 2, NULL);

-- ----------------------------
-- Table structure for t_ville
-- ----------------------------
DROP TABLE IF EXISTS `t_ville`;
CREATE TABLE `t_ville`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_ville
-- ----------------------------
INSERT INTO `t_ville` VALUES (1, 'Paris');
INSERT INTO `t_ville` VALUES (2, 'New York');
INSERT INTO `t_ville` VALUES (3, 'Auckland');
INSERT INTO `t_ville` VALUES (4, 'Sydney');
INSERT INTO `t_ville` VALUES (5, 'Saint Pierre');

SET FOREIGN_KEY_CHECKS = 1;
