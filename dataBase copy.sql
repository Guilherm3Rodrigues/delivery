/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `telefone` varchar(16) DEFAULT NULL,
  `rua` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `numero` varchar(6) DEFAULT NULL,
  `bairro` varchar(70) DEFAULT NULL,
  `complemento` text,
  PRIMARY KEY (`id_cliente`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

INSERT INTO `clientes` (`id_cliente`, `nome`, `telefone`, `rua`, `numero`, `bairro`, `complemento`) VALUES
	(43, 'EX: Cayo Rodrigues', '77', 'JK', '350', 'Centro', 'Proximo a Loterica'),
	(46, '111', '111', 'testeando1', '11', '321', '123'),
	(57, 'teste', '5467', NULL, NULL, NULL, NULL),
	(58, 'Guilherme teste', '35988999749', '', '', 'Centro', 'Proximo a Loterica'),
	(62, 'EX: Cayo Rodrigues', '9999-9999', '', '', 'Centro', 'Proximo a Loterica'),
	(63, 'capeta', '0999969966', '', '', '', ''),
	(64, 'www', '666', '', '', 'Centro', 'Proximo a Loterica'),
	(65, 'capeta', '0066', '', '', 'Centro', 'Proximo a Loterica'),
	(66, 'EX: Cayo Rodrigues', '123123', 'jk', '23123', 'Centro', 'Proximo a Loterica'),
	(67, 'teste', '2323', 'asdasd', 'asdasd', 'Centro', 'Proximo a Loterica'),
	(68, '222', '222', '222', '231', '132', '222'),
	(69, '333', '333', '333', '333', '333', '333'),
	(70, '44', '4444', '444', '444', '444', '444'),
	(71, 'teste do cayne', '4537357', 'testeando12', '12', 'CentroTeste', 'Proximo a Loterica do teste'),
	(72, 'Gui', '7777', '', '', 'Centro', 'Proximo a Loterica'),
	(73, 'asdasdw', '1314', '', '', 'Centro', 'Proximo a Loterica'),
	(74, 'qqq', '777', '', '', 'Centro', 'Proximo a Loterica'),
	(75, 'lol', '696', '', '', 'Centro', 'Proximo a Loterica'),
	(76, 'celio', '119', '', '', 'Centro', 'Proximo a Loterica'),
	(77, 'mila', '240', '', '', 'Centro', 'Proximo a Loterica'),
	(78, 'Cayo', '876', '', '', 'Centro', 'Proximo a Loterica'),
	(79, 'Gui', '4', '', '', 'Centro', 'Proximo a Loterica'),
	(80, 'Bee Rod', '2', '', '', 'Centro', 'Proximo a Loterica'),
	(81, 'teste entrega', '415', 'asdasd', '222', 'Centro', 'Proximo a Loterica'),
	(82, 'motoboy', '654375', 'rua das motos', '90', 'motoLand', 'Proximo a moto do zé'),
	(83, 'aaaaaaaaaaaaa', '000000000', 'aaaaaaaaaaaaaaaaaaaaaaa', '666', 'Centro', 'Proximo a Loterica'),
	(84, 'aaawn', '879876546546', '', '', 'Centro', 'Proximo a Loterica'),
	(85, 'tempo 1', '111111111110', '', '', 'Centro', 'Proximo a Loterica'),
	(86, 'tempo 2', '222222222221', '', '', 'Centro', 'Proximo a Loterica'),
	(87, 'tempoo 1', '111111111112', '', '', 'Centro', 'Proximo a Loterica'),
	(88, '19062024', '190620241', '', '', 'Centro', 'Proximo a Loterica');

CREATE TABLE IF NOT EXISTS `info_estabelecimento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `telefone` varchar(16) DEFAULT NULL,
  `rua` varchar(50) DEFAULT NULL,
  `bairro` varchar(30) DEFAULT NULL,
  `dia_inicial` varchar(8) NOT NULL,
  `dia_final` varchar(8) NOT NULL,
  `hor_funcionamento_ini` varchar(8) NOT NULL,
  `hor_funcionamento_fec` varchar(8) NOT NULL,
  `frete` decimal(5,2) DEFAULT NULL,
  `freteMotoboy` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `info_estabelecimento` (`id`, `nome`, `telefone`, `rua`, `bairro`, `dia_inicial`, `dia_final`, `hor_funcionamento_ini`, `hor_funcionamento_fec`, `frete`, `freteMotoboy`) VALUES
	(1, 'Bobs', '(35) 9 9944-5697', 'Rua: Exemplo de Rua, Nº 6eOnibuss', 'Vila do Chaves', 'segunda', 'domingo', '09:00', '00:00', 5.50, 3.00);

CREATE TABLE IF NOT EXISTS `itens_cardapio` (
  `id` int NOT NULL AUTO_INCREMENT,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `produto` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `descricao` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `valor` decimal(5,2) NOT NULL,
  `categoria` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `numero_pedido` int DEFAULT '1',
  `ordem` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

INSERT INTO `itens_cardapio` (`id`, `img`, `produto`, `descricao`, `valor`, `categoria`, `numero_pedido`, `ordem`) VALUES
	(72, NULL, 'Massuda', 'Só massa', 1.00, 'Pizza', 1, 8),
	(73, NULL, 'Massmolho', 'Massa com molho', 2.00, 'Pizza', 1, 8),
	(74, NULL, 'Calabresa', 'Massa com molho e Calabresa (no singular)', 3.00, 'Pizza', 1, 8),
	(75, NULL, 'Pizza', 'contem Pizza', 10.50, 'Pasteis', 1, 2),
	(76, NULL, 'teste5', 'testando5', 5.00, 'Teste', 1, 1),
	(77, NULL, 'teste6', 'testando6', 6.00, 'Teste', 1, 1),
	(78, NULL, 'X-Pobre', 'Hamburguer (80g), Maionese, Queijo Prado', 8.00, 'Lanches', 1, 10),
	(79, NULL, 'X-BACON', 'Haburguer (80g), Queijo prado, bacon, molho da casa e cebola caramelizada', 15.00, 'Lanches', 1, 10);

CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `img` varchar(255) DEFAULT NULL,
  `produto` varchar(25) NOT NULL,
  `descricao` text,
  `valor` decimal(5,2) NOT NULL,
  `categoria` varchar(25) NOT NULL,
  `numero_pedido` int DEFAULT '1',
  `id_cliente` int DEFAULT NULL,
  `data_insercao` datetime DEFAULT CURRENT_TIMESTAMP,
  `entrega` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cliente` (`id_cliente`),
  CONSTRAINT `fk_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=180 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `pedidos` (`id`, `img`, `produto`, `descricao`, `valor`, `categoria`, `numero_pedido`, `id_cliente`, `data_insercao`, `entrega`) VALUES
	(1, NULL, 'teste6', 'testando6', 6.00, 'teste6', 1, 64, '2024-03-13 14:24:17', 0.00),
	(2, NULL, 'teste4', 'testando4', 4.00, 'teste4', 1, 64, '2024-03-13 14:24:17', 0.00),
	(3, NULL, 'a', 'a', 8.00, 'teste', 1, 64, '2024-03-13 14:24:17', 0.00),
	(4, NULL, 'teste6', 'testando6', 6.00, 'teste6', 1, 74, '2024-03-13 14:24:28', 0.00),
	(5, NULL, 'a', 'a', 8.00, 'teste', 1, 74, '2024-03-13 14:24:28', 0.00),
	(6, NULL, 'a', 'a', 8.00, 'teste', 1, 62, '2024-03-13 14:24:47', 0.00),
	(7, NULL, 'a', 'a', 8.00, 'teste', 1, 75, '2024-03-13 14:25:20', 0.00),
	(8, NULL, 'Hamburguer', 'Haburguer (80g), Queijo prado, bacon, molho da casa e cebola caramelizada', 9.00, 'Lanches', 3, 75, '2024-03-13 14:25:20', 0.00),
	(9, NULL, 'teste6', 'testando6', 6.00, 'teste6', 1, 75, '2024-03-13 14:25:20', 0.00),
	(10, NULL, 'teste4', 'testando4', 4.00, 'teste4', 1, 75, '2024-03-13 14:25:20', 0.00),
	(131, NULL, 'teste6', 'testando6', 6.00, 'teste6', 1, 64, '2024-03-14 14:24:17', 0.00),
	(132, NULL, 'teste4', 'testando4', 4.00, 'teste4', 1, 64, '2024-03-14 14:24:17', 0.00),
	(133, NULL, 'a', 'a', 8.00, 'teste', 1, 64, '2024-03-14 14:24:17', 0.00),
	(134, NULL, 'teste6', 'testando6', 6.00, 'teste6', 1, 74, '2024-03-14 14:24:28', 0.00),
	(135, NULL, 'a', 'a', 8.00, 'teste', 1, 74, '2024-03-14 14:24:28', 0.00),
	(136, NULL, 'a', 'a', 8.00, 'teste', 1, 62, '2024-03-14 14:24:47', 0.00),
	(137, NULL, 'a', 'a', 8.00, 'teste', 1, 75, '2024-03-14 14:25:20', 0.00),
	(138, NULL, 'Hamburguer', 'Haburguer (80g), Queijo prado, bacon, molho da casa e cebola caramelizada', 9.00, 'Lanches', 3, 75, '2024-03-14 14:25:20', 0.00),
	(139, NULL, 'teste6', 'testando6', 6.00, 'teste6', 1, 75, '2024-03-14 14:25:20', 0.00),
	(140, NULL, 'teste4', 'testando4', 4.00, 'teste4', 1, 75, '2024-03-14 14:25:20', 0.00),
	(141, NULL, 'Hamburguer', 'Haburguer (80g), Queijo prado, bacon, molho da casa e cebola caramelizada', 9.00, 'Lanches', 1, 76, '2024-03-15 10:47:13', 0.00),
	(142, NULL, 'teste6', 'testando6', 6.00, 'teste6', 1, 76, '2024-03-15 10:47:13', 0.00),
	(143, NULL, 'teste5', 'testando5', 5.00, 'teste5', 1, 76, '2024-03-15 10:47:13', 0.00),
	(144, NULL, 'teste4', 'testando4', 4.00, 'teste4', 1, 76, '2024-03-15 10:47:14', 0.00),
	(161, NULL, 'Hamburguer', 'Haburguer (80g), Queijo prado, bacon, molho da casa e cebola caramelizada', 9.00, 'Lanches', 1, 62, '2024-03-18 08:33:21', 0.00),
	(162, NULL, 'teste6', 'testando6', 6.00, 'teste6', 1, 62, '2024-03-19 08:33:21', 5.50),
	(163, NULL, 'teste6', 'testando6', 6.00, 'teste6', 1, 62, '2024-03-19 08:33:27', 5.50),
	(165, NULL, 'a', 'a', 8.00, 'teste', 1, 82, '2024-03-19 08:46:44', 5.50),
	(166, NULL, 'Hamburguer', 'Haburguer (80g), Queijo prado, bacon, molho da casa e cebola caramelizada', 9.00, 'Lanches', 1, 82, '2024-03-19 08:46:44', 5.50),
	(167, NULL, 'Hamburguer', 'Haburguer (80g), Queijo prado, bacon, molho da casa e cebola caramelizada', 9.00, 'Lanches', 1, 83, '2024-03-20 09:20:21', 5.50),
	(168, NULL, 'a', 'a', 8.00, 'teste', 1, 62, '2024-06-17 10:04:07', 0.00),
	(169, NULL, 'teste', 'testando', 1.00, 'teste', 1, 62, '2024-06-17 10:04:07', 0.00),
	(170, NULL, 'Hamburguer', 'Haburguer (80g), Queijo prado, bacon, molho da casa e cebola caramelizada', 9.00, 'Lanches', 2, 58, '2024-06-17 10:06:56', 0.00),
	(171, NULL, 'Hamburguer', 'Haburguer (80g), Queijo prado, bacon, molho da casa e cebola caramelizada', 9.00, 'Lanches', 2, 62, '2024-06-17 10:07:28', 0.00),
	(172, NULL, 'Massmolho', 'Massa com molho', 2.00, 'Pizza', 1, 84, '2024-06-18 14:15:44', 0.00),
	(173, NULL, 'Calabresa', 'Massa com molho e Calabresa (no singular)', 3.00, 'Pizza', 1, 84, '2024-06-18 14:15:44', 0.00),
	(174, NULL, 'X-Pobre', 'Hamburguer (80g), Maionese, Queijo Prado', 8.00, 'Lanches', 1, 84, '2024-06-18 14:15:44', 0.00),
	(175, NULL, 'teste4', 'testando4', 4.00, 'Teste', 1, 62, '2024-06-18 14:51:08', 0.00),
	(176, NULL, 'X-Pobre', 'Hamburguer (80g), Maionese, Queijo Prado', 8.00, 'Lanches', 1, 85, '2024-06-18 15:21:08', 0.00),
	(177, NULL, 'teste4', 'testando4', 4.00, 'Teste', 1, 86, '2024-06-18 15:24:18', 0.00),
	(178, NULL, 'X-Pobre', 'Hamburguer (80g), Maionese, Queijo Prado', 8.00, 'Lanches', 1, 87, '2024-06-18 15:24:18', 0.00),
	(179, NULL, 'teste4', 'testando4', 4.00, 'Teste', 1, 88, '2024-06-19 08:26:46', 0.00);

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_cliente` int NOT NULL AUTO_INCREMENT,
  `nomeProprietario` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `telefone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `loginNome` varchar(20) DEFAULT NULL,
  `loginSenha` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `acesso` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '',
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `usuarios` (`id_cliente`, `nomeProprietario`, `telefone`, `loginNome`, `loginSenha`, `acesso`) VALUES
	(9, 'Guilherme', '35988999749', 'MaidenEmily', '1532974680,-Delivery', 'Qw3Rt0'),
	(10, 'Cayo', '066613', 'kayxd', '123456', 'Qw3Rt0'),
	(11, 'Admin', '54753735', 'admin', 'admin', 'Qw3Rt0');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
