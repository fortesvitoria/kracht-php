-- USUARIOS

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `dt_nascimento` date NOT NULL,
  `is_admin` tinyint(1) NOT NULL COMMENT '0 - false: usuario, 1 - true : admin',
  `imagem` varchar(50) NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `usuarios` (`id`, `nome`, `sobrenome`, `email`, `senha`, `dt_nascimento`, `is_admin`, `imagem`) VALUES
(1, 'Vitoria', 'Fortes', 'vitoria@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1991-07-07', 1, '6929a16b7bc85.jpg'),
(3, 'Eduardo', 'Riguera', 'eduardo@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1984-08-25', 0, '2148563418.jpg'),
(8, 'Michelle', 'Viscardi', 'michelle@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1990-02-10', 0, '6925b2a3b4a53.jpg');

 
-- PRODUTOS

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `marca` varchar(100) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `valor` float NOT NULL,
  `imagem` varchar(50) NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `produtos` (`id`, `nome`, `marca`, `tipo`, `valor`, `imagem`) VALUES
(6, 'Spark 900 Ultimate TR', 'SCOTT', 'bicicleta', 59000, '6925eb326a34b.jpeg'),
(7, 'Plasma RC Ultimate', 'SCOTT', 'bicicleta', 4580, '6929a0db26def.jpeg'),
(8, 'Speedster 10', 'SCOTT', 'bicicleta', 13000, '6925eb967a357.jpeg'),
(9, 'Sub Cross 40 Lady', 'SCOTT', 'bicicleta', 4500, '6925ebc303b48.jpeg'),
(13, 'STRIPE Racecut', 'Merida', 'roupas', 450, '6929a770b8a76.jpg'),
(14, 'CHARGER Helmet', 'Merida', 'acessorios', 259, '6929a7aab8b2f.jpg'),
(15, 'CX Man', 'Merida', 'roupas', 450, '6929a7d9b5f80.jpg'),
(16, 'PRO RACE Sunglasses', 'Merida', 'acessorios', 1250, '6929a7fe71d36.jpg'),
(17, 'COMP Shoe MTB', 'Merida', 'calcados', 550, '6929a81af3aad.jpeg'),
(18, 'TRAVEL Forkbag', 'Merida', 'acessorios', 850, '6929a84085e95.jpeg'),
(19, 'CAMOU Gravel Bretelle', 'Merida', 'roupas', 1699, '6929a885b7a2c.jpg');