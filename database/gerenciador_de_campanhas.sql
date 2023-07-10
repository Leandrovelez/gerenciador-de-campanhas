-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.28-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.2.0.6576
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Copiando estrutura para tabela gerenciador_de_campanhas.campanhas
CREATE TABLE IF NOT EXISTS `campanhas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(250) NOT NULL,
  `descricao` varchar(250) NOT NULL,
  `empresa_id` int(11) NOT NULL DEFAULT 0,
  `data_inicio` date NOT NULL,
  `data_termino` date NOT NULL,
  KEY `Index 1` (`id`),
  KEY `empresa_id` (`empresa_id`),
  CONSTRAINT `empresa_id` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela gerenciador_de_campanhas.empresas
CREATE TABLE IF NOT EXISTS `empresas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `razao_social` varchar(250) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  `endereco` varchar(250) NOT NULL,
  `nome_responsavel` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  KEY `Index 1` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela gerenciador_de_campanhas.participantes
CREATE TABLE IF NOT EXISTS `participantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `email` varchar(250) NOT NULL,
  `campanha_id` int(11) NOT NULL,
  KEY `Index 1` (`id`),
  KEY `FK_participantes_campanhas` (`campanha_id`),
  CONSTRAINT `FK_participantes_campanhas` FOREIGN KEY (`campanha_id`) REFERENCES `campanhas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Exportação de dados foi desmarcado.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
