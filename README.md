# Delivery

=================== Senha Administrador ===================
Usuario: admin
Senha: admin

=================== Tabelas SQL para o projeto funcionar corretamente ===================

CREATE TABLE `itens_cardapio` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`img` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`produto` VARCHAR(25) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`descricao` TEXT NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`valor` DECIMAL(5,2) NOT NULL,
	`categoria` VARCHAR(25) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`numero_pedido` INT(10) NULL DEFAULT '1',
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_0900_ai_ci'
ENGINE=InnoDB
AUTO_INCREMENT=23
;


CREATE TABLE `pedidos` (
	`id` INT(10) NOT NULL,
	`img` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`produto` VARCHAR(25) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`descricao` TEXT NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`valor` DECIMAL(5,2) NOT NULL,
	`categoria` VARCHAR(25) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`numero_pedido` INT(10) NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_0900_ai_ci'
ENGINE=InnoDB
;
