-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 09-Jul-2024 às 15:02
-- Versão do servidor: 5.7.24
-- versão do PHP: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_delivery`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `telefone` varchar(16) DEFAULT NULL,
  `rua` varchar(100) DEFAULT NULL,
  `numero` varchar(6) DEFAULT NULL,
  `bairro` varchar(70) DEFAULT NULL,
  `complemento` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `telefone`, `rua`, `numero`, `bairro`, `complemento`) VALUES
(43, 'EX: Cayo Rodrigues', '77', 'JK', '350', 'Centro', 'Proximo a Loterica'),
(46, '111', '111', 'testeando1', '11', '321', '123'),
(57, 'teste', '5467', NULL, NULL, NULL, NULL),
(58, 'Guilherme teste', '35988999749', 'deve ser teste', '150', 'Centro', 'Proximo a Loterica'),
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

-- --------------------------------------------------------

--
-- Estrutura da tabela `info_estabelecimento`
--

CREATE TABLE `info_estabelecimento` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `telefone` varchar(16) DEFAULT NULL,
  `rua` varchar(50) DEFAULT NULL,
  `bairro` varchar(30) DEFAULT NULL,
  `data_funcionamento` text,
  `frete` decimal(5,2) DEFAULT NULL,
  `freteMotoboy` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `info_estabelecimento`
--

INSERT INTO `info_estabelecimento` (`id`, `nome`, `telefone`, `rua`, `bairro`, `data_funcionamento`, `frete`, `freteMotoboy`) VALUES
(1, 'Bobs', '(35) 9 9944-5697', 'Rua: Exemplo de Rua, Nº 6eOnibuss', 'Vila do Chaves', '{\"Mon\":[\"08:00\",\"18:00\"],\"Tue\":[\"08:00\",\"18:00\"],\"Wed\":[\"08:00\",\"18:00\"],\"Thu\":[\"08:00\",\"18:00\"],\"Fri\":[\"08:00\",\"18:00\"],\"Sat\":[\"10:00\",\"16:00\"],\"Sun\":[\"00:00\",\"00:00\"]}\n\n', '5.50', '3.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_cardapio`
--

CREATE TABLE `itens_cardapio` (
  `id` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `produto` varchar(25) NOT NULL,
  `descricao` text,
  `valor` decimal(5,2) NOT NULL,
  `categoria` varchar(25) NOT NULL,
  `numero_pedido` int(11) DEFAULT '1',
  `ordem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `itens_cardapio`
--

INSERT INTO `itens_cardapio` (`id`, `img`, `produto`, `descricao`, `valor`, `categoria`, `numero_pedido`, `ordem`) VALUES
(72, NULL, 'Massuda', 'Só massa', '1.00', 'Pizza', 1, 8),
(73, NULL, 'Massmolho', 'Massa com molho', '2.00', 'Pizza', 1, 8),
(74, NULL, 'Calabresa', 'Massa com molho e Calabresa (no singular)', '3.00', 'Pizza', 1, 8),
(75, NULL, 'Pizza', 'contem Pizza', '10.50', 'Pasteis', 1, 2),
(76, NULL, 'teste5', 'testando5', '5.00', 'Teste', 1, 1),
(77, NULL, 'teste6', 'testando6', '6.00', 'Teste', 1, 1),
(78, NULL, 'X-Pobre', 'Hamburguer (80g), Maionese, Queijo Prado', '8.00', 'Lanches', 1, 10),
(79, NULL, 'X-BACON', 'Haburguer (80g), Queijo prado, bacon, molho da casa e cebola caramelizada', '15.00', 'Lanches', 1, 10),
(80, NULL, '12', '4', '3.00', '1', 1, 12);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `valor` decimal(5,2) NOT NULL,
  `numero_pedido` int(11) DEFAULT '1',
  `id_cliente` int(11) DEFAULT NULL,
  `data_insercao` datetime DEFAULT CURRENT_TIMESTAMP,
  `paraEntregar` tinyint(1) NOT NULL,
  `observacao` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `valor`, `numero_pedido`, `id_cliente`, `data_insercao`, `paraEntregar`, `observacao`, `status`) VALUES
(180, '10.00', 1, 58, '2024-07-05 11:40:08', 1, '', ''),
(181, '55.00', 1, 70, '2024-07-08 11:46:56', 1, 'SEM MOLHO', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos_cardapio`
--

CREATE TABLE `pedidos_cardapio` (
  `ID` bigint(11) NOT NULL,
  `id_itensCardapio` int(11) NOT NULL,
  `id_pedidos` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedidos_cardapio`
--

INSERT INTO `pedidos_cardapio` (`ID`, `id_itensCardapio`, `id_pedidos`, `quantidade`) VALUES
(1, 76, 180, 10),
(2, 72, 180, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_cliente` int(11) NOT NULL,
  `nomeProprietario` varchar(100) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `loginNome` varchar(20) DEFAULT NULL,
  `loginSenha` varchar(100) DEFAULT NULL,
  `acesso` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_cliente`, `nomeProprietario`, `telefone`, `loginNome`, `loginSenha`, `acesso`) VALUES
(9, 'Guilherme', '35988999749', 'MaidenEmily', '1532974680,-Delivery', 'Qw3Rt0'),
(10, 'Cayo', '066613', 'kayxd', '123456', 'Qw3Rt0'),
(11, 'Admin', '54753735', 'admin', 'admin', 'Qw3Rt0');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Índices para tabela `info_estabelecimento`
--
ALTER TABLE `info_estabelecimento`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `itens_cardapio`
--
ALTER TABLE `itens_cardapio`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cliente` (`id_cliente`);

--
-- Índices para tabela `pedidos_cardapio`
--
ALTER TABLE `pedidos_cardapio`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_itensCardapio` (`id_itensCardapio`),
  ADD KEY `id_pedidos` (`id_pedidos`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_cliente`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de tabela `info_estabelecimento`
--
ALTER TABLE `info_estabelecimento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `itens_cardapio`
--
ALTER TABLE `itens_cardapio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT de tabela `pedidos_cardapio`
--
ALTER TABLE `pedidos_cardapio`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`);

--
-- Limitadores para a tabela `pedidos_cardapio`
--
ALTER TABLE `pedidos_cardapio`
  ADD CONSTRAINT `pedidos_cardapio_ibfk_1` FOREIGN KEY (`id_itensCardapio`) REFERENCES `itens_cardapio` (`id`),
  ADD CONSTRAINT `pedidos_cardapio_ibfk_2` FOREIGN KEY (`id_pedidos`) REFERENCES `pedidos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
