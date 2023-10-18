DROP DATABASE IF EXISTS marcas;

CREATE DATABASE marcas;

USE marcas;


CREATE TABLE `categorias`  (
  `id_categoria` int(11) AUTO_INCREMENT,
  `nome` varchar(100)  NOT NULL,
  `data_criacao` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id_categoria`)
);



CREATE TABLE `produtos`  (
  `id_produto` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` text,
  `preco` decimal(10, 0) NULL DEFAULT 0,
  `url_image` varchar(250) DEFAULT '',
  `id_categoria` int(11) NOT NULL,
  `data_criacao` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id_produto`),
  INDEX `id_categoria`(`id_categoria`),
  FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`)
);



INSERT INTO `categorias` VALUES (1, 'Verão', '2023-10-01 11:01:26');
INSERT INTO `categorias` VALUES (2, 'Nike', '2023-10-01 11:01:26');
INSERT INTO `categorias` VALUES (3, 'Adidas', '2023-10-01 11:01:26');
INSERT INTO `categorias` VALUES (4, 'Desporto', '2023-10-01 11:01:26');
INSERT INTO `categorias` VALUES (5, 'Sapatos', '2023-10-01 11:01:26');



INSERT INTO `produtos` VALUES (1, 'Air Jordan 1 High MM', 'Men\'s Tennis Shoes 7 Colors', 155, 'prod651948a8cc96c.png', 2, '2023-10-01 11:23:36');

INSERT INTO `produtos` VALUES (2, 'Essentials Big Logo Tee', 'Men\'s Tennis Shoes 7 Colors', 30, 'prod6519492f9bf76.png', 2, '2023-10-01 11:25:51');

INSERT INTO `produtos` VALUES (3, 'INTER MIAMI CF 22-23 HOME JERSEY', 'Men\'s Tennis Shoes 7 Colors', 90, 'prod6519498cdf03d.png', 4, '2023-10-01 11:27:24');

INSERT INTO `produtos` VALUES (4, 'Jordan Dri-FIT Sport', 'Men\'s Tennis Shoes 7 Colors', 50, 'prod651949be83886.png', 4, '2023-10-01 11:28:14');

INSERT INTO `produtos` VALUES (5, 'Jordan Essentials', 'Men\'s Tennis Shoes 7 Colors', 68, 'prod65194a293d438.png', 2, '2023-10-01 11:30:01');

INSERT INTO `produtos` VALUES (6, 'Jumpman MVP', 'Men\'s Tennis Shoes 7 Colors', 68, 'prod65194a55dd13a.png', 2, '2023-10-01 11:30:45');

INSERT INTO `produtos` VALUES (7, 'Nike Brasilia 9.5', 'Men\'s Tennis Shoes 7 Colors', 52, 'prod65194a8d7e83f.png', 4, '2023-10-01 11:31:41');

INSERT INTO `produtos` VALUES (8, 'Nike Club', 'Men\'s Tennis Shoes 7 Colors', 26, 'prod65194aba344e8.png', 4, '2023-10-01 11:32:26');

INSERT INTO `produtos` VALUES (9, 'Nike Elemental', 'Men\'s Tennis Shoes 7 Colors', 31, 'prod65194ae50c28b.png', 4, '2023-10-01 11:33:09');

INSERT INTO `produtos` VALUES (10, 'Prime Backpack', 'Men\'s Tennis Shoes 7 Colors', 31, 'prod65194b0fa1016.png', 4, '2023-10-01 11:33:51');

INSERT INTO `produtos` VALUES (11, 'Zion', 'Men\'s Tennis Shoes 7 Colors', 35, 'prod65194b325ce26.png', 1, '2023-10-01 11:34:26');

INSERT INTO `produtos` VALUES (12, 'NikeCourt Air Zoom Lite 4', 'Men\'s Tennis Shoes 7 Colors', 75, 'prod65194b641466b.png', 2, '2023-10-01 11:35:16');

INSERT INTO `produtos` VALUES (13, 'NikeCourt Air Zoom Lite 4', NULL, 75, 'prod651b1a53c77bc.png', 2, '2023-10-02 20:30:27');