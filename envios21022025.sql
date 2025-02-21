-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21/02/2025 às 22:21
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `envios`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `envios`
--

CREATE TABLE `envios` (
  `id` int(11) NOT NULL,
  `tipo` enum('Nacional','Internacional') NOT NULL,
  `codigo_rastreio` varchar(50) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `data_envio` date NOT NULL,
  `estado` varchar(50) NOT NULL,
  `pais` varchar(50) NOT NULL,
  `peso` decimal(10,4) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `observacao` text DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pendente',
  `modalidade` varchar(50) DEFAULT NULL,
  `feedback` enum('positivo','neutro','negativo') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `envios`
--

INSERT INTO `envios` (`id`, `tipo`, `codigo_rastreio`, `nome`, `telefone`, `data_envio`, `estado`, `pais`, `peso`, `valor`, `observacao`, `status`, `modalidade`, `feedback`) VALUES
(1, 'Nacional', 'JN973931214BR', 'Marcelo Toledo', '69999872682', '2025-02-14', 'RJ', 'Brasil', 0.0260, 10.15, 'CB 2001 escudo coritiba, gremio e botafogo-sp', ' Objeto postado', 'Impresso Registrado', NULL),
(3, 'Nacional', 'JN973931205BR', 'Aislan de Souza', '22998151292', '2025-02-14', 'RO', 'Brasil', 0.0270, 10.15, 'CB 2001 escudo e mascote botafogo', 'Objeto entregue ao destinatário', 'Impresso Registrado', 'positivo'),
(4, 'Nacional', 'JN973931174BR', 'Gefferson Lins', '81997114551', '2025-02-13', 'RJ', 'Brasil', 0.0190, 9.35, 'Cb 2001 escudo botafogo para Pedro', 'Objeto entregue ao destinatário', 'Impresso Registrado', 'positivo'),
(5, 'Nacional', 'JN973931165BR', 'Rafael Rezek', '61984062901', '2025-02-13', 'DF', 'Brasil', 0.0480, 10.15, 'CB 2001 Escudos, Mascote e Bandeiras', 'Objeto entregue ao destinatário', 'Impresso Registrado', 'positivo'),
(6, 'Nacional', 'AA955417285BR', 'Filipe Fernandes', '00000000000', '2025-02-13', 'PE', 'Brasil', 0.3280, 19.61, 'The last OLX', 'Objeto entregue ao destinatário', 'Sedex', 'positivo'),
(7, 'Internacional', 'RR056802073BR', 'Droppa Attila', '18026623595', '2025-02-13', 'Lebanon', 'United States', 0.0640, 25.70, 'Ebay attilahun19840205 telefone +1 802-662-3595', 'Objeto encaminhado', 'Impresso Registrado', NULL),
(8, 'Internacional', 'RR056802087BR', 'Alexander Rasi', '00000000000', '2025-02-13', 'Wedel', 'Alemanha', 0.0460, 22.60, 'Ebay alra-1974 telefone +49 162 3223057', 'Objeto encaminhado', 'Impresso Registrado', NULL),
(9, 'Internacional', 'RR056802095BR', 'Darlen Ballkaniku', '00000000000', '2025-02-13', 'Toronto', 'Canadá', 0.0530, 25.70, 'Ebay toselling telefone +1 416-909-5422', 'Objeto encaminhado', 'Impresso Registrado', NULL),
(11, 'Internacional', 'RR056804030BR', 'JOSE JESUS RAMIREZ OROZCO', '00000000000', '2025-02-15', 'Estado do Mexico', 'Mexico', 0.0850, 25.70, 'Ebay ramirezorozc-0  +52 722 425 6720', 'Encaminhado para fiscalização aduaneira', 'Impresso Registrado', NULL),
(12, 'Internacional', 'RR056804043BR', 'Ricardo daniel Moreno', '00000000000', '2025-02-15', 'Buenos Aires', 'Argentina', 0.0800, 23.70, 'Ebay e ZAP +54 9 11 6400-1239', 'Objeto postado após o horário limite da unidade', 'Impresso Registrado', NULL),
(13, 'Internacional', 'RR056804057BR', 'Helen Rende', '00000000000', '2025-02-15', 'ON', 'Canadá', 0.0570, 23.70, 'Ebay here3301 +1 416-834-8956', 'Encaminhado para fiscalização aduaneira', 'Impresso Registrado', NULL),
(14, 'Internacional', 'RR056804065BR', 'Eduardo Olivera', '00000000000', '2025-02-15', 'Uruguai', 'Uruguai', 0.0600, 23.70, 'Ebay e zap +598 99 955 413\r\n', 'Encaminhado para fiscalização aduaneira', 'Impresso Registrado', NULL),
(15, 'Internacional', 'RR056804026BR', 'Jr Guerra', '00000000000', '2025-02-10', 'United States', 'United States', 0.0670, 25.70, 'EBAY muzyka10 +1 559-393-8501', 'Objeto recebido em', 'Impresso Registrado', NULL),
(16, 'Internacional', 'RR056801991BR', 'Ray J Van Den Bossche', '00000000000', '2025-02-03', 'Canada', 'Canada', 0.0530, 25.70, 'EBAY cantona4ever +1 905-399-6125', 'Objeto encaminhado', 'Impresso Registrado', NULL),
(17, 'Internacional', 'RR056802008BR', 'Massimo Furlan', '00000000000', '2025-02-03', 'Italy', 'Italy', 0.0620, 27.90, 'EBAY jokerstore22 +39 340 407 8411', 'Objeto entregue ao destinatário', 'Impresso Registrado', 'positivo'),
(18, 'Internacional', 'RR056804012BR', 'Daniel Herpai', '00000000000', '2025-02-03', 'Canada', 'Canada', 0.0770, 25.70, 'EBAY bendan22 +1 204-230-2287', 'Objeto encaminhado', 'Impresso Registrado', NULL),
(19, 'Internacional', 'RR142729570BR', 'Ricardo daniel Moreno', '00000000000', '2025-01-10', 'Argentina', 'Argentina', 0.0680, 23.70, 'EBAY E ZAP +54 9 11 6400-1239', 'Objeto encaminhado', 'Impresso Registrado', 'positivo'),
(20, 'Internacional', 'RR256704765BR', 'Marián Ďurica', '00000000000', '2025-01-24', 'Slovakia', 'Eslovaquia', 0.1850, 44.45, 'ebay maur2911 +421 902 340 901', 'Objeto entregue ao destinatário', 'Impresso Registrado', 'positivo'),
(21, 'Internacional', 'RR056801965BR', 'Alexander Jochum', '00000000000', '2025-01-28', 'Germany', 'Germany', 0.1060, 44.45, 'EBAY alexj.82 +49 174 6889854 ', 'Fiscalização aduaneira finalizada no país de desti', 'Impresso Registrado', 'positivo'),
(22, 'Internacional', 'RR251245453BR', '湖 洪', '00000000000', '2025-01-30', 'China', 'China', 0.1000, 34.55, 'EBAY rgz-9083 +86 198 7420 5280 ', 'Objeto encaminhado', 'Impresso Registrado', NULL),
(23, 'Internacional', 'RR056799975BR', 'Ty Reamer', '00000000000', '2025-01-31', 'United States', 'United States', 0.4050, 64.25, 'EBAY ironl10nz10n +1 240-353-2767', 'Objeto recebido em', 'Impresso Registrado', NULL),
(24, 'Internacional', 'RR256704108BR', 'KUMARESAN ', '00000000000', '2025-02-17', 'Bedong Kedah', 'Malaysia', 0.1330, 58.00, 'EBAY +60 16-459 8341 santhanar2023', 'Objeto encaminhado', 'Impresso Registrado', NULL),
(25, 'Internacional', 'RR256705015BR', 'YuHang Wu', '00000000000', '2025-02-17', 'Jiang Su', 'China', 0.0900, 33.95, 'ebay 2014cntong +86 139 1428 9895', 'Objeto encaminhado', 'Impresso Registrado', NULL),
(26, 'Internacional', 'RR256704099BR', 'Igor Moskal', '00000000000', '2025-02-17', 'Ruda Śląska', 'Polônia', 0.1440, 44.45, 'Ebay igmos_0 +48 692 096 188', 'Objeto postado após o horário limite da unidade', 'Impresso Registrado', NULL),
(27, 'Internacional', 'RR256704085BR', 'Manuel Parraga', '00000000000', '2025-02-17', 'TX', 'United States', 0.0610, 25.70, 'EBAY manuelp189 +1 512-705-3378', 'Objeto encaminhado', 'Impresso Registrado', NULL),
(28, 'Internacional', 'RR256704071BR', 'Robert Ocytko', '00000000000', '2025-02-17', 'IL', 'United States', 0.0610, 25.70, 'EBAY bob2920 +1 847-867-3997', 'Objeto encaminhado', 'Impresso Registrado', NULL),
(29, 'Nacional', 'JN973931347BR', 'Fábio de Souza', '79999615341', '2025-02-21', 'SE', 'Brasil', 0.0360, 10.15, 'Cb 2001 Holograficas', ' Objeto postado', 'Impresso Registrado', NULL),
(30, 'Nacional', 'JN973931333BR', 'Carlos Alexandre', '11930414691', '2025-02-21', 'SP', 'Brasil', 0.0280, 10.15, 'lote fig mundial 2014', ' Objeto postado', 'Impresso Registrado', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `envios`
--
ALTER TABLE `envios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `envios`
--
ALTER TABLE `envios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
