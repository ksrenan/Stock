-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 27-Ago-2015 às 17:03
-- Versão do servidor: 5.5.44-0+deb8u1
-- PHP Version: 5.6.9-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stock`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `entradas`
--

CREATE TABLE IF NOT EXISTS `entradas` (
`codigo_entrada` int(11) NOT NULL,
  `data_entrega` date DEFAULT NULL,
  `usuario` varchar(100) NOT NULL,
  `nf` varchar(100) NOT NULL,
  `empenho` varchar(100) NOT NULL,
  `requisicao` varchar(100) NOT NULL,
  `fornecedor` varchar(100) NOT NULL,
  `secretaria` varchar(150) DEFAULT NULL,
  `data_emissao` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedores`
--

CREATE TABLE IF NOT EXISTS `fornecedores` (
`codigo` int(11) NOT NULL,
  `razaoSocial` varchar(100) NOT NULL,
  `cnpj` varchar(30) NOT NULL,
  `ie` varchar(30) NOT NULL,
  `telefone` varchar(16) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `uf` char(2) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `contato` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens`
--

CREATE TABLE IF NOT EXISTS `itens` (
`codigo` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `observacao` varchar(200) DEFAULT NULL,
  `patrimoniar` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_entrada`
--

CREATE TABLE IF NOT EXISTS `itens_entrada` (
  `codigo` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `qtde` int(11) NOT NULL,
  `codigo_entrada` int(11) NOT NULL,
  `secretaria` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_estoque`
--

CREATE TABLE IF NOT EXISTS `itens_estoque` (
  `codigo` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `qtde` int(11) NOT NULL,
  `secretaria` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `saidas`
--

CREATE TABLE IF NOT EXISTS `saidas` (
`codigo_saida` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `codigo_item` int(11) NOT NULL,
  `qtde` int(11) NOT NULL,
  `patrimonio` varchar(50) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `observacao` varchar(200) NOT NULL,
  `numeroOS` int(11) NOT NULL,
  `tecnicoRetirou` varchar(50) NOT NULL,
  `secretaria` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `termos`
--

CREATE TABLE IF NOT EXISTS `termos` (
`id` int(11) NOT NULL,
  `nome` varchar(150) DEFAULT NULL,
  `matricula` varchar(50) DEFAULT NULL,
  `cpf` char(14) DEFAULT NULL,
  `secretaria` varchar(150) DEFAULT NULL,
  `depto_divisao` varchar(150) DEFAULT NULL,
  `local` varchar(150) DEFAULT NULL,
  `item` varchar(150) DEFAULT NULL,
  `patrimonio` varchar(50) DEFAULT NULL,
  `nSuporte` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`id` int(11) NOT NULL,
  `matricula` varchar(10) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `senha` varchar(8) NOT NULL,
  `nivelAcesso` varchar(100) NOT NULL,
  `alterarSenha` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `matricula`, `nome`, `senha`, `nivelAcesso`, `alterarSenha`) VALUES
(0, 'Admin', 'Administrador do Sistema', '5t0ck', 'cadFornecedor|cadUsuario|cadItem|regEntrada|regSaida|verRelatorios', 0),
(1, '804108', 'Renan Rodrigues de Oliveira', '1234', 'cadFornecedor|cadUsuario|cadItem|regEntrada|regSaida|verRelatorios', 0),
(2, '14003', 'Leonardo Scherner', '1234', 'cadFornecedor|cadUsuario|cadItem|regEntrada|regSaida|verRelatorios', 1),
(4, '18761', 'Evandro Novak', '1234', 'cadFornecedor|cadUsuario|cadItem|regEntrada|regSaida|verRelatorios', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `entradas`
--
ALTER TABLE `entradas`
 ADD PRIMARY KEY (`codigo_entrada`);

--
-- Indexes for table `fornecedores`
--
ALTER TABLE `fornecedores`
 ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `itens`
--
ALTER TABLE `itens`
 ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `itens_entrada`
--
ALTER TABLE `itens_entrada`
 ADD KEY `codigo_entrada` (`codigo_entrada`);

--
-- Indexes for table `saidas`
--
ALTER TABLE `saidas`
 ADD PRIMARY KEY (`codigo_saida`);

--
-- Indexes for table `termos`
--
ALTER TABLE `termos`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `entradas`
--
ALTER TABLE `entradas`
MODIFY `codigo_entrada` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `fornecedores`
--
ALTER TABLE `fornecedores`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `itens`
--
ALTER TABLE `itens`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `saidas`
--
ALTER TABLE `saidas`
MODIFY `codigo_saida` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `termos`
--
ALTER TABLE `termos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `itens_entrada`
--
ALTER TABLE `itens_entrada`
ADD CONSTRAINT `itens_entrada_ibfk_1` FOREIGN KEY (`codigo_entrada`) REFERENCES `entradas` (`codigo_entrada`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
