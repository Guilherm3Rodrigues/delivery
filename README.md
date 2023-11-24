# Delivery

=================== Senha Administrador ===================
Usuario: admin
Senha: admin

=================== Tabelas SQL para o projeto funcionar corretamente ===================

-- Copiando estrutura do banco de dados para db_delivery
CREATE DATABASE IF NOT EXISTS `db_delivery` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_delivery`;

-- Copiando estrutura para tabela db_delivery.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` int NOT NULL AUTO_INCREMENT,
  `id_itens` int NOT NULL,
  `categorias` varchar(25) NOT NULL,
  PRIMARY KEY (`id_categoria`),
  KEY `id_itens` (`id_itens`),
  CONSTRAINT `categorias_ibfk_1` FOREIGN KEY (`id_itens`) REFERENCES `itens_cardapio` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela db_delivery.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `telefone` int DEFAULT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela db_delivery.info_estabelecimento
CREATE TABLE IF NOT EXISTS `info_estabelecimento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `telefone` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `rua` varchar(50) DEFAULT NULL,
  `bairro` varchar(30) DEFAULT NULL,
  `data_funcionamento` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela db_delivery.itens_cardapio
CREATE TABLE IF NOT EXISTS `itens_cardapio` (
  `id` int NOT NULL AUTO_INCREMENT,
  `img` varchar(255) DEFAULT NULL,
  `produto` varchar(25) NOT NULL,
  `descricao` text,
  `valor` decimal(5,2) NOT NULL,
  `categoria` varchar(25) NOT NULL,
  `numero_pedido` int DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela db_delivery.pedidos
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `produto` varchar(25) NOT NULL,
  `descricao` text,
  `valor` decimal(5,2) NOT NULL,
  `categoria` varchar(25) NOT NULL,
  `numero_pedido` int DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Exportação de dados foi desmarcado.
