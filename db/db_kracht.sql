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

-- ADMIN - senha admin123
INSERT INTO `usuarios` (`id`, `nome`, `sobrenome`, `email`, `senha`, `dt_nascimento`, `is_admin`, `imagem`) VALUES
(1, 'Vitoria', 'Fortes', 'vitoria@gmail.com', 'f865b53623b121fd34ee5426c792e5c33af8c227', '1991-07-07', 1, '2152009570.jpg');

-- USUARIO COMUM - senha 1234
INSERT INTO `usuarios` (`id`, `nome`, `sobrenome`, `email`, `senha`, `dt_nascimento`, `is_admin`, `imagem`) VALUES (NULL, 'Eduardo', 'Riguera', 'eduardo@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1984/08/25', '0', '2148563418.jpg');

-- USUARIO COMUM - senha 1234
INSERT INTO `usuarios` (`id`, `nome`, `sobrenome`, `email`, `senha`, `dt_nascimento`, `is_admin`, `imagem`) VALUES (NULL, 'Michelle', 'Viscardi', 'michelle@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1984/08/25', '0', '6925b2a3b4a53.jpg');



CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `marca` varchar(100) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `valor` float NOT NULL,
  `imagem` varchar(50) NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `produtos`(`id`, `nome`,`marca`,`tipo`, `valor`, `imagem`) VALUES(NULL, 'Spark 900 Ultimate TR', 'SCOTT', 'bicicleta',59000, '6925eb326a34b.jpeg')

INSERT INTO `produtos`(`id`, `nome`,`marca`,`tipo`, `valor`, `imagem`) VALUES(NULL, 'Plasma RC Ultimate', 'SCOTT', 'bicicleta',15999, '6925eb5baf661.jpeg')

INSERT INTO `produtos`(`id`, `nome`,`marca`,`tipo`, `valor`, `imagem`) VALUES(NULL, 'Speedster 10', 'SCOTT', 'bicicleta',13000,'6925eb967a357.jpeg')

INSERT INTO `produtos`(`id`, `nome`,`marca`,`tipo`, `valor`, `imagem`) VALUES(NULL, 'Sub Cross 40 Lady', 'SCOTT', 'bicicleta',4500,'6925ebc303b48.jpeg')