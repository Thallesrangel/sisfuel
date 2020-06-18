-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 18/06/2020 às 05:19
-- Versão do servidor: 10.4.11-MariaDB
-- Versão do PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sisfuel`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbabastecimento`
--

CREATE TABLE `tbabastecimento` (
  `id_abastecimento` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_fornecedor` int(11) DEFAULT NULL,
  `quantidade` float NOT NULL,
  `data_hora` datetime NOT NULL,
  `comprovante` varchar(255) DEFAULT NULL,
  `km` float NOT NULL,
  `id_motorista` int(11) NOT NULL,
  `id_combustivel` int(11) NOT NULL,
  `id_veiculo` int(11) NOT NULL,
  `flag_excluido` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbcartao_virtual`
--

CREATE TABLE `tbcartao_virtual` (
  `id_cartao` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `valor_limite` decimal(10,2) NOT NULL,
  `data_validade` date NOT NULL,
  `id_motorista` int(11) NOT NULL,
  `id_cartao_situacao` int(11) NOT NULL,
  `id_cartao_renovacao` int(11) NOT NULL,
  `flag_excluido` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `tbcartao_virtual`
--

INSERT INTO `tbcartao_virtual` (`id_cartao`, `id_cliente`, `id_usuario`, `valor_limite`, `data_validade`, `id_motorista`, `id_cartao_situacao`, `id_cartao_renovacao`, `flag_excluido`) VALUES
(6, 12, 49, '200.00', '2020-06-24', 40, 1, 1, 1),
(7, 11, 48, '123.00', '2020-07-02', 41, 1, 1, 1),
(8, 11, 48, '123.00', '2020-06-25', 41, 1, 1, 1),
(9, 11, 48, '1.00', '2020-06-17', 41, 1, 1, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbcartao_virtual_movimentos`
--

CREATE TABLE `tbcartao_virtual_movimentos` (
  `id_cartao_movimentos` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  `id_veiculo` int(11) NOT NULL,
  `id_combustivel` int(11) NOT NULL,
  `quantidade` decimal(10,2) NOT NULL,
  `valor_unitario` decimal(10,2) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `id_cartao_movimento_situacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbcartao_virtual_movimentos_situacao`
--

CREATE TABLE `tbcartao_virtual_movimentos_situacao` (
  `id_cartao_movimento_situacao` int(11) NOT NULL,
  `movimento_situacao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `tbcartao_virtual_movimentos_situacao`
--

INSERT INTO `tbcartao_virtual_movimentos_situacao` (`id_cartao_movimento_situacao`, `movimento_situacao`) VALUES
(1, 'registrado'),
(2, 'cancelado'),
(3, 'aguardando análise');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbcartao_virtual_renovacao`
--

CREATE TABLE `tbcartao_virtual_renovacao` (
  `id_cartao_renovacao` int(11) NOT NULL,
  `cartao_renovacao` varchar(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `tbcartao_virtual_renovacao`
--

INSERT INTO `tbcartao_virtual_renovacao` (`id_cartao_renovacao`, `cartao_renovacao`) VALUES
(1, 'não renovar'),
(2, 'semanal'),
(3, 'quinzenal'),
(4, 'mensal'),
(5, 'anual');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbcartao_virtual_situacao`
--

CREATE TABLE `tbcartao_virtual_situacao` (
  `id_cartao_situacao` int(11) NOT NULL,
  `cartao_situacao` varchar(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `tbcartao_virtual_situacao`
--

INSERT INTO `tbcartao_virtual_situacao` (`id_cartao_situacao`, `cartao_situacao`) VALUES
(1, 'liberado'),
(2, 'cancelado');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbcategoria_combustivel`
--

CREATE TABLE `tbcategoria_combustivel` (
  `id_combustivel` int(1) NOT NULL,
  `categoria_combustivel` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `tbcategoria_combustivel`
--

INSERT INTO `tbcategoria_combustivel` (`id_combustivel`, `categoria_combustivel`) VALUES
(43, 'Diesel comum'),
(44, 'Diesel aditivado'),
(45, 'Gasolina comum'),
(46, 'Gasolina aditivada'),
(49, 'Biodiesel'),
(50, 'Etanol comum'),
(51, 'Etanol aditivado'),
(53, 'Flex');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbcategoria_veiculo`
--

CREATE TABLE `tbcategoria_veiculo` (
  `id_categoria_veiculo` int(1) NOT NULL,
  `categoria_veiculo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `tbcategoria_veiculo`
--

INSERT INTO `tbcategoria_veiculo` (`id_categoria_veiculo`, `categoria_veiculo`) VALUES
(34, 'Oficial'),
(35, 'Particular'),
(36, 'Aprendizagem'),
(38, 'Alugado'),
(39, 'Fretado'),
(41, 'Terceiro');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbclientes`
--

CREATE TABLE `tbclientes` (
  `id_cliente` int(11) NOT NULL,
  `id_plano` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `razao_social_cliente` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `documento` varchar(100) NOT NULL,
  `flag_tanque` int(11) NOT NULL,
  `flag_excluido` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `tbclientes`
--

INSERT INTO `tbclientes` (`id_cliente`, `id_plano`, `id_tipo`, `razao_social_cliente`, `email`, `documento`, `flag_tanque`, `flag_excluido`) VALUES
(11, 2, 1, 'Forte Boi Indústria Alimentos LTDA', 'adm@forteboi.com.br', '81382461000178', 1, 0),
(12, 1, 1, 'Impacta LTDA', 'impacta@hotmail.com', '213612736127369', 0, 0),
(13, 1, 2, 'Paulo Santa', 'santa@gmail.com', '321134324324', 0, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbclientes_tipo`
--

CREATE TABLE `tbclientes_tipo` (
  `id_tipo` int(11) NOT NULL,
  `cliente_tipo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `tbclientes_tipo`
--

INSERT INTO `tbclientes_tipo` (`id_tipo`, `cliente_tipo`) VALUES
(1, 'Empresarial'),
(2, 'Pessoal');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbfabricante_veiculo`
--

CREATE TABLE `tbfabricante_veiculo` (
  `id_fabricante` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `nome_fabricante` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `tbfabricante_veiculo`
--

INSERT INTO `tbfabricante_veiculo` (`id_fabricante`, `id_cliente`, `nome_fabricante`) VALUES
(1, NULL, 'Ford'),
(2, NULL, 'Scania'),
(3, NULL, 'Jeep'),
(4, NULL, ''),
(5, NULL, 'Fordzinho'),
(6, NULL, 'Fiatinho'),
(7, NULL, 'Fsas');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbfornecedor`
--

CREATE TABLE `tbfornecedor` (
  `id_fornecedor` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `razao_social` varchar(220) NOT NULL,
  `cnpj` varchar(50) NOT NULL,
  `id_area_atuacao` int(11) NOT NULL,
  `flag_excluido` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `tbfornecedor`
--

INSERT INTO `tbfornecedor` (`id_fornecedor`, `id_cliente`, `razao_social`, `cnpj`, `id_area_atuacao`, `flag_excluido`) VALUES
(14, 11, 'Petrobras', '81382461000172', 1, 0),
(15, 11, 'Petrobras', '81382461000172', 1, 1),
(16, 11, 'Petrobras', '81382461000172', 1, 1),
(17, 11, 'Seg', '21381293812931', 2, 0),
(18, 11, '', '0', 1, 1),
(19, 12, 'seg', '2134123123', 2, 0),
(20, 12, 'Pedra Branca', '213123123123123', 1, 0),
(21, 12, 'Pedra Branca', '213123123123123', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbfornecedor_atuacao`
--

CREATE TABLE `tbfornecedor_atuacao` (
  `id_area_atuacao` int(11) NOT NULL,
  `area_atuacao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `tbfornecedor_atuacao`
--

INSERT INTO `tbfornecedor_atuacao` (`id_area_atuacao`, `area_atuacao`) VALUES
(1, 'fornecedor combustível'),
(2, 'seguradora');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbipva`
--

CREATE TABLE `tbipva` (
  `id_ipva` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_veiculo` int(11) NOT NULL,
  `data_vencimento` date NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `id_situacao` int(11) NOT NULL,
  `flag_excluido` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbmanutencao_tipo`
--

CREATE TABLE `tbmanutencao_tipo` (
  `id_manutencao_tipo` int(11) NOT NULL,
  `tipo_manutencao` varchar(220) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `tbmanutencao_tipo`
--

INSERT INTO `tbmanutencao_tipo` (`id_manutencao_tipo`, `tipo_manutencao`) VALUES
(1, 'troca de óleo'),
(2, 'troca de pneu'),
(3, 'fluido de freio');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbmanutencao_veiculo`
--

CREATE TABLE `tbmanutencao_veiculo` (
  `id_manutencao` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `titulo` varchar(110) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  `id_veiculo` int(11) NOT NULL,
  `id_manutencao_tipo` int(11) NOT NULL,
  `data_vencimento` date NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `descricao` varchar(220) DEFAULT NULL,
  `id_situacao` int(11) NOT NULL,
  `flag_excluido` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `tbmanutencao_veiculo`
--

INSERT INTO `tbmanutencao_veiculo` (`id_manutencao`, `id_cliente`, `titulo`, `id_fornecedor`, `id_veiculo`, `id_manutencao_tipo`, `data_vencimento`, `valor`, `descricao`, `id_situacao`, `flag_excluido`) VALUES
(3, 48, 'Titulo', 17, 42, 1, '2020-06-12', '21.00', 'Descrição', 1, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbmodelo_veiculo`
--

CREATE TABLE `tbmodelo_veiculo` (
  `id_modelo` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `modelo_veiculo` varchar(220) NOT NULL,
  `id_fabricante` int(11) NOT NULL,
  `flag_excluido` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `tbmodelo_veiculo`
--

INSERT INTO `tbmodelo_veiculo` (`id_modelo`, `id_cliente`, `modelo_veiculo`, `id_fabricante`, `flag_excluido`) VALUES
(2, 11, 'Galhardo', 2, 0),
(3, 11, 'Pálio', 6, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbmotorista`
--

CREATE TABLE `tbmotorista` (
  `id_motorista` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `nome_motorista` varchar(50) NOT NULL,
  `cnh` varchar(255) NOT NULL,
  `data_vencimento_cnh` date NOT NULL,
  `cpf` varchar(255) NOT NULL,
  `data_nascimento` date NOT NULL,
  `flag_excluido` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `tbmotorista`
--

INSERT INTO `tbmotorista` (`id_motorista`, `id_cliente`, `nome_motorista`, `cnh`, `data_vencimento_cnh`, `cpf`, `data_nascimento`, `flag_excluido`) VALUES
(40, 12, 'Thalles Rangel', '12312321', '2022-10-07', '123123213213', '1998-10-08', 0),
(41, 11, 'Humberto Martins', '2132837118', '2022-10-07', '123126631253', '1998-10-07', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbmov_entrada`
--

CREATE TABLE `tbmov_entrada` (
  `id_entrada` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `nota_fiscal` int(50) DEFAULT NULL,
  `quantidade` double(10,2) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  `id_tanque` int(11) NOT NULL,
  `motorista` varchar(60) NOT NULL,
  `data_entrada` datetime NOT NULL,
  `placa` varchar(45) NOT NULL,
  `valor_unitario` decimal(10,2) NOT NULL DEFAULT 0.00,
  `valor_total` decimal(10,2) DEFAULT 0.00,
  `flag_excluido` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `tbmov_entrada`
--

INSERT INTO `tbmov_entrada` (`id_entrada`, `id_cliente`, `nota_fiscal`, `quantidade`, `id_fornecedor`, `id_tanque`, `motorista`, `data_entrada`, `placa`, `valor_unitario`, `valor_total`, `flag_excluido`) VALUES
(183, 11, 30, 10000.00, 14, 40, 'Luan Roberto Ribeiro', '2020-06-09 06:15:00', 'PPS2314', '3.20', '32000.00', 1),
(184, 11, 21321, 123.00, 14, 40, 'thalles', '2020-06-09 11:04:00', 'PPS1232', '10.00', '1230.00', 1),
(185, 11, 12, 10.00, 14, 41, 'Paulino', '2020-11-06 02:52:00', 'PPS21312', '2.00', '20.00', 1),
(186, 11, 123, 10000.00, 14, 45, 'Paulina Robertina', '2020-11-06 04:11:00', 'PPPS123', '3.00', '30000.00', 1),
(187, 11, 22, 100.00, 14, 40, '22', '2020-11-06 04:15:00', '2', '2.00', '200.00', 1),
(188, 11, 21123, 490.00, 14, 41, 'Palunioa', '2020-11-06 04:25:00', 'PPS2', '2.00', '980.00', 1),
(189, 11, 82782, 20000.00, 14, 46, 'Motoro', '2020-11-06 04:28:00', 'PPS23', '3.20', '64000.00', 1),
(190, 11, 213, 100.00, 14, 48, 'Thalles', '2020-12-06 03:52:00', 'PPS232', '22.00', '2200.00', 1),
(191, 11, 12, 1000.00, 14, 50, 'Humberto', '1970-01-01 01:00:00', 'PPP2342', '2.30', '2300.00', 1),
(192, 11, 10000, 1.00, 14, 73, '0000', '1970-01-01 01:00:00', 'ppPP2', '1.20', '1.20', 1),
(193, 11, 1000, 1.00, 14, 73, 'Talll', '1970-01-01 01:00:00', 'PPS2342', '2.02', '2.02', 1),
(194, 11, 29388, 100.00, 14, 73, 'Paulo', '1970-01-01 01:00:00', 'ppps2', '2.22', '222.00', 1),
(195, 11, 1223, 1000.00, 14, 74, 'Jonas', '1970-01-01 01:00:00', 'PPPS231', '3.20', '3200.00', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbmov_saida`
--

CREATE TABLE `tbmov_saida` (
  `id_saida` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_veiculo` int(11) NOT NULL,
  `id_tanque` int(11) NOT NULL,
  `id_motorista` int(11) NOT NULL,
  `km` float NOT NULL,
  `quantidade` float NOT NULL,
  `data_hora` datetime NOT NULL,
  `flag_excluido` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `tbmov_saida`
--

INSERT INTO `tbmov_saida` (`id_saida`, `id_cliente`, `id_veiculo`, `id_tanque`, `id_motorista`, `km`, `quantidade`, `data_hora`, `flag_excluido`) VALUES
(51, 11, 42, 40, 41, 123, 100, '2020-06-11 00:00:00', 1),
(52, 11, 42, 50, 41, 2500, 100, '2020-06-13 00:00:00', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbmov_transito`
--

CREATE TABLE `tbmov_transito` (
  `id_transito` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  `quantidade` double NOT NULL,
  `data_hora` datetime NOT NULL,
  `comprovante` varchar(220) NOT NULL,
  `km` float NOT NULL,
  `id_motorista` int(11) NOT NULL,
  `id_combustivel` int(11) NOT NULL,
  `id_veiculo` int(11) NOT NULL,
  `flag_excluido` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbnivel_acesso`
--

CREATE TABLE `tbnivel_acesso` (
  `id_acesso` int(1) NOT NULL,
  `nome_acesso` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `tbnivel_acesso`
--

INSERT INTO `tbnivel_acesso` (`id_acesso`, `nome_acesso`) VALUES
(2, 'administrador'),
(3, 'motorista'),
(5, 'padrão');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbpagamento_situacao`
--

CREATE TABLE `tbpagamento_situacao` (
  `id_situacao` int(11) NOT NULL,
  `situacao` varchar(220) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `tbpagamento_situacao`
--

INSERT INTO `tbpagamento_situacao` (`id_situacao`, `situacao`) VALUES
(1, 'pago'),
(2, 'aguardando'),
(3, 'cancelado');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbpermissoes`
--

CREATE TABLE `tbpermissoes` (
  `id_permissao` int(11) NOT NULL,
  `permissao` varchar(220) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `tbpermissoes`
--

INSERT INTO `tbpermissoes` (`id_permissao`, `permissao`) VALUES
(1, 'movimento de entrada'),
(2, 'movimento de saída'),
(3, 'abastecimento'),
(4, 'movimento em trânsito'),
(5, 'ticket abastecimento'),
(6, 'cartão virtual'),
(7, 'seguros'),
(8, 'ipva'),
(9, 'manutenção'),
(10, 'usuários'),
(11, 'suporte');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbplanos`
--

CREATE TABLE `tbplanos` (
  `id_plano` int(11) NOT NULL,
  `plano` varchar(220) NOT NULL,
  `valor_plano` decimal(10,2) NOT NULL,
  `veiculo_limite` int(11) NOT NULL,
  `valor_veiculo_excedido` decimal(10,2) NOT NULL,
  `flag_excluido` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `tbplanos`
--

INSERT INTO `tbplanos` (`id_plano`, `plano`, `valor_plano`, `veiculo_limite`, `valor_veiculo_excedido`, `flag_excluido`) VALUES
(1, 'Padrão', '2.00', 3, '2.00', 0),
(2, 'Plus', '20.00', 15, '23.00', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbseguro`
--

CREATE TABLE `tbseguro` (
  `id_seguro` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `apolice` varchar(220) NOT NULL,
  `id_veiculo` int(11) NOT NULL,
  `data_vencimento` date NOT NULL,
  `valor` double NOT NULL,
  `id_situacao` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  `flag_excluido` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `tbseguro`
--

INSERT INTO `tbseguro` (`id_seguro`, `id_cliente`, `apolice`, `id_veiculo`, `data_vencimento`, `valor`, `id_situacao`, `id_fornecedor`, `flag_excluido`) VALUES
(7, 12, '123', 43, '2020-06-11', 222, 1, 19, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbsuporte`
--

CREATE TABLE `tbsuporte` (
  `id_suporte` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `requerente` varchar(255) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `arquivo` varchar(255) DEFAULT NULL,
  `resposta` varchar(255) DEFAULT NULL,
  `id_suporte_situacao` int(11) DEFAULT 1,
  `flag_excluido` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `tbsuporte`
--

INSERT INTO `tbsuporte` (`id_suporte`, `id_cliente`, `requerente`, `titulo`, `descricao`, `arquivo`, `resposta`, `id_suporte_situacao`, `flag_excluido`) VALUES
(9, 48, '48', '', 'Houve algo em algum lugar que eu preciso da sua ajuda..', NULL, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbsuporte_situacao`
--

CREATE TABLE `tbsuporte_situacao` (
  `id_suporte_situacao` int(11) NOT NULL,
  `situacao` varchar(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `tbsuporte_situacao`
--

INSERT INTO `tbsuporte_situacao` (`id_suporte_situacao`, `situacao`) VALUES
(1, 'Aguardando'),
(2, 'Finalizado'),
(3, 'Cancelado');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbtanque`
--

CREATE TABLE `tbtanque` (
  `id_tanque` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `nome_tanque` varchar(50) NOT NULL,
  `capacidade` double(10,2) NOT NULL,
  `alerta_limite` double(10,2) NOT NULL DEFAULT 0.00,
  `id_combustivel` int(11) NOT NULL,
  `id_medida` int(11) NOT NULL,
  `flag_excluido` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `tbtanque`
--

INSERT INTO `tbtanque` (`id_tanque`, `id_cliente`, `nome_tanque`, `capacidade`, `alerta_limite`, `id_combustivel`, `id_medida`, `flag_excluido`) VALUES
(40, 11, 'TAN. 01', 2000.02, 0.00, 43, 4, 1),
(41, 11, 'T-003', 1000.00, 0.00, 45, 4, 1),
(42, 11, 'BioD 02', 1000.00, 0.00, 49, 4, 1),
(43, 11, 'Dev H2', 11000.00, 0.00, 43, 4, 1),
(44, 11, 'p23', 2200.00, 0.00, 45, 4, 1),
(45, 11, 'GAS BR 2927 RI', 20000.00, 0.00, 46, 4, 1),
(46, 11, 'Petro Brasil 28236 Es - 9', 2000000.00, 0.00, 50, 4, 1),
(47, 11, 'T43', 20000.00, 0.00, 45, 4, 1),
(48, 11, 'T223', 1000.00, 0.00, 43, 4, 1),
(49, 11, 'THAL 2', 20000.00, 30.00, 43, 4, 1),
(50, 11, 'T-01', 20000.00, 30.00, 43, 4, 1),
(51, 11, 'TT', 22.00, 22.00, 43, 13, 1),
(52, 11, 'ttt', 222.00, 12.00, 43, 13, 1),
(53, 11, 'tanque', 20000.00, 30.00, 43, 13, 1),
(54, 11, 'TESTETAN', 100000.00, 30.00, 43, 4, 1),
(55, 11, 'Tanque2q', 10000.00, 3030.00, 43, 4, 1),
(56, 11, 'tanque', 10000.00, 2000.00, 43, 13, 1),
(57, 11, 'T02-11', 10000.00, 20.00, 43, 4, 1),
(58, 11, 'TTT', 20000.00, 30.00, 43, 4, 1),
(59, 11, 't', 100000.00, 22.00, 43, 13, 1),
(60, 11, 'tan teste 01', 200000.00, 30.00, 43, 4, 1),
(61, 11, 'TANQ', 200000.00, 20.00, 43, 4, 1),
(62, 11, 'TAN222', 100000.00, 20.00, 43, 4, 1),
(63, 11, 'RRR3', 200000.00, 22.00, 43, 13, 1),
(64, 11, 'OOOO', 2000.00, 20.00, 43, 13, 1),
(65, 11, 'pppp', 1000.00, 20.00, 43, 4, 1),
(66, 11, 'PPPP', 10000.00, 239.00, 43, 4, 1),
(67, 11, 'RRRTEA', 2000.20, 20.00, 43, 8, 1),
(68, 11, 'THALL', 1000.00, 30.00, 43, 4, 1),
(69, 11, 'TAN', 2000.00, 2000.00, 43, 13, 1),
(70, 11, 'TYY', 2000.00, 20.00, 43, 13, 1),
(71, 11, 'KKKK', 2220.00, 20.00, 43, 13, 1),
(72, 11, 'TANQ', 2000.00, 10000.00, 43, 5, 1),
(73, 11, 'TTT', 200.00, 20.00, 43, 13, 0),
(74, 11, 'OOOO', 2000.00, 12.22, 43, 4, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbticket`
--

CREATE TABLE `tbticket` (
  `id_ticket` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `quantidade` double NOT NULL,
  `data_entrada` date NOT NULL,
  `id_veiculo` int(11) NOT NULL,
  `id_motorista` int(11) NOT NULL,
  `id_combustivel` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  `flag_excluido` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `tbticket`
--

INSERT INTO `tbticket` (`id_ticket`, `id_cliente`, `quantidade`, `data_entrada`, `id_veiculo`, `id_motorista`, `id_combustivel`, `id_fornecedor`, `flag_excluido`) VALUES
(18, 11, 123, '2020-06-12', 42, 41, 43, 14, 1),
(19, 11, 50, '2020-06-13', 42, 41, 45, 14, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbunidade_medida`
--

CREATE TABLE `tbunidade_medida` (
  `id_medida` int(11) NOT NULL,
  `unidade_medida` varchar(50) NOT NULL,
  `abreviacao_medida` varchar(50) NOT NULL,
  `tipo_medida` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `tbunidade_medida`
--

INSERT INTO `tbunidade_medida` (`id_medida`, `unidade_medida`, `abreviacao_medida`, `tipo_medida`) VALUES
(1, 'Quilolitro', 'Kl', 'capacidade'),
(2, 'Hectolitro', 'Hl', 'capacidade'),
(3, 'Decalitro', 'Dal', 'capacidade'),
(4, 'Litro', 'L', 'capacidade'),
(5, 'Decilitro', 'Dl', 'capacidade'),
(6, 'Centilitro', 'Cl', 'capacidade'),
(7, 'Mililitro', 'Ml', 'capacidade'),
(8, 'Quilograma', 'Kg', 'massa'),
(9, 'Hectograma', 'Hg', 'massa'),
(10, 'Decagrama', 'Dag', 'massa'),
(11, 'Grama', 'G', 'massa'),
(12, 'Decigrama', 'Dg', 'massa'),
(13, 'Centigrama', 'Cg', 'massa'),
(14, 'Miligrama', 'Mg', 'massa'),
(15, 'Quilômetro', 'km', 'comprimento'),
(16, 'Hectômetro', 'Hm', 'comprimento'),
(17, 'Decâmetro', 'Dam', 'comprimento'),
(18, 'Metro', 'M', 'comprimento'),
(19, 'Decímetro', 'Dm', 'comprimento'),
(20, 'Centímetro', 'Cm', 'comprimento'),
(21, 'Milímetro', 'Mm', 'comprimento');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbusuarios`
--

CREATE TABLE `tbusuarios` (
  `id_usuario` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `nome_usuario` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `id_acesso` int(1) DEFAULT NULL,
  `permissoes` text DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'ativado'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `tbusuarios`
--

INSERT INTO `tbusuarios` (`id_usuario`, `id_cliente`, `nome_usuario`, `email`, `senha`, `id_acesso`, `permissoes`, `status`) VALUES
(48, 11, 'Administrativo', 'adm@forteboi.com.br', '202cb962ac59075b964b07152d234b70', 2, NULL, 'ativado'),
(49, 12, 'Thalles Rangel', 'impacta@hotmail.com', '202cb962ac59075b964b07152d234b70', 2, NULL, 'ativado'),
(50, 12, 'Thalles Rangel', 'rangelthr@gmail.com', 'd9b1d7db4cd6e70935368a1efb10e377', 3, NULL, 'ativado'),
(51, 13, 'Paulo Santa', 'santa@gmail.com', '202cb962ac59075b964b07152d234b70', 2, NULL, 'ativado'),
(53, 11, 'Thalles Parão', 'padraothalles@gmail.com', '202cb962ac59075b964b07152d234b70', 5, 'a:2:{i:0;s:1:\"1\";i:1;s:1:\"5\";}', 'ativado'),
(54, 11, 'Humberto Martins', 'humberto@gmail.com', 'd9b1d7db4cd6e70935368a1efb10e377', 3, NULL, 'ativado');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbveiculo`
--

CREATE TABLE `tbveiculo` (
  `id_veiculo` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `placa` varchar(25) NOT NULL,
  `renavam` varchar(30) NOT NULL,
  `id_fabricante` int(11) NOT NULL,
  `id_combustivel` int(11) NOT NULL,
  `id_categoria_veiculo` int(11) NOT NULL,
  `flag_excluido` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `tbveiculo`
--

INSERT INTO `tbveiculo` (`id_veiculo`, `id_cliente`, `placa`, `renavam`, `id_fabricante`, `id_combustivel`, `id_categoria_veiculo`, `flag_excluido`) VALUES
(42, 11, 'PPS232', '213123213128', 1, 43, 35, 0),
(43, 12, 'pps223', '231283728\'', 1, 43, 34, 0);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `tbabastecimento`
--
ALTER TABLE `tbabastecimento`
  ADD PRIMARY KEY (`id_abastecimento`),
  ADD KEY `id_veiculo` (`id_veiculo`),
  ADD KEY `id_combustivel` (`id_combustivel`),
  ADD KEY `id_motorista` (`id_motorista`),
  ADD KEY `id_fornecedor` (`id_fornecedor`);

--
-- Índices de tabela `tbcartao_virtual`
--
ALTER TABLE `tbcartao_virtual`
  ADD PRIMARY KEY (`id_cartao`),
  ADD KEY `id_motorista` (`id_motorista`),
  ADD KEY `id_cartao_situacao` (`id_cartao_situacao`),
  ADD KEY `id_cartao_renovacao` (`id_cartao_renovacao`);

--
-- Índices de tabela `tbcartao_virtual_movimentos`
--
ALTER TABLE `tbcartao_virtual_movimentos`
  ADD PRIMARY KEY (`id_cartao_movimentos`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_fornecedor` (`id_fornecedor`),
  ADD KEY `id_veiculo` (`id_veiculo`),
  ADD KEY `id_combustivel` (`id_combustivel`),
  ADD KEY `id_cartao_movimento_situacao` (`id_cartao_movimento_situacao`);

--
-- Índices de tabela `tbcartao_virtual_movimentos_situacao`
--
ALTER TABLE `tbcartao_virtual_movimentos_situacao`
  ADD PRIMARY KEY (`id_cartao_movimento_situacao`);

--
-- Índices de tabela `tbcartao_virtual_renovacao`
--
ALTER TABLE `tbcartao_virtual_renovacao`
  ADD PRIMARY KEY (`id_cartao_renovacao`);

--
-- Índices de tabela `tbcartao_virtual_situacao`
--
ALTER TABLE `tbcartao_virtual_situacao`
  ADD PRIMARY KEY (`id_cartao_situacao`);

--
-- Índices de tabela `tbcategoria_combustivel`
--
ALTER TABLE `tbcategoria_combustivel`
  ADD PRIMARY KEY (`id_combustivel`);

--
-- Índices de tabela `tbcategoria_veiculo`
--
ALTER TABLE `tbcategoria_veiculo`
  ADD PRIMARY KEY (`id_categoria_veiculo`);

--
-- Índices de tabela `tbclientes`
--
ALTER TABLE `tbclientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `id_tipo` (`id_tipo`),
  ADD KEY `id_plano` (`id_plano`);

--
-- Índices de tabela `tbclientes_tipo`
--
ALTER TABLE `tbclientes_tipo`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Índices de tabela `tbfabricante_veiculo`
--
ALTER TABLE `tbfabricante_veiculo`
  ADD PRIMARY KEY (`id_fabricante`);

--
-- Índices de tabela `tbfornecedor`
--
ALTER TABLE `tbfornecedor`
  ADD PRIMARY KEY (`id_fornecedor`),
  ADD KEY `id_area_atuacao` (`id_area_atuacao`);

--
-- Índices de tabela `tbfornecedor_atuacao`
--
ALTER TABLE `tbfornecedor_atuacao`
  ADD PRIMARY KEY (`id_area_atuacao`);

--
-- Índices de tabela `tbipva`
--
ALTER TABLE `tbipva`
  ADD PRIMARY KEY (`id_ipva`),
  ADD KEY `id_situacao` (`id_situacao`),
  ADD KEY `id_veiculo` (`id_veiculo`);

--
-- Índices de tabela `tbmanutencao_tipo`
--
ALTER TABLE `tbmanutencao_tipo`
  ADD PRIMARY KEY (`id_manutencao_tipo`);

--
-- Índices de tabela `tbmanutencao_veiculo`
--
ALTER TABLE `tbmanutencao_veiculo`
  ADD PRIMARY KEY (`id_manutencao`),
  ADD KEY `id_fornecedor` (`id_fornecedor`),
  ADD KEY `id_veiculo` (`id_veiculo`),
  ADD KEY `id_manutencao_tipo` (`id_manutencao_tipo`),
  ADD KEY `id_situacao` (`id_situacao`);

--
-- Índices de tabela `tbmodelo_veiculo`
--
ALTER TABLE `tbmodelo_veiculo`
  ADD PRIMARY KEY (`id_modelo`),
  ADD KEY `id_fabricante` (`id_fabricante`);

--
-- Índices de tabela `tbmotorista`
--
ALTER TABLE `tbmotorista`
  ADD PRIMARY KEY (`id_motorista`);

--
-- Índices de tabela `tbmov_entrada`
--
ALTER TABLE `tbmov_entrada`
  ADD PRIMARY KEY (`id_entrada`),
  ADD KEY `id_fornecedor` (`id_fornecedor`),
  ADD KEY `id_tanque` (`id_tanque`);

--
-- Índices de tabela `tbmov_saida`
--
ALTER TABLE `tbmov_saida`
  ADD PRIMARY KEY (`id_saida`),
  ADD KEY `id_veiculo` (`id_veiculo`),
  ADD KEY `id_tanque` (`id_tanque`),
  ADD KEY `id_motorista` (`id_motorista`);

--
-- Índices de tabela `tbmov_transito`
--
ALTER TABLE `tbmov_transito`
  ADD PRIMARY KEY (`id_transito`),
  ADD KEY `id_veiculo` (`id_veiculo`),
  ADD KEY `id_combustivel` (`id_combustivel`),
  ADD KEY `id_motorista` (`id_motorista`),
  ADD KEY `id_fornecedor` (`id_fornecedor`);

--
-- Índices de tabela `tbnivel_acesso`
--
ALTER TABLE `tbnivel_acesso`
  ADD PRIMARY KEY (`id_acesso`);

--
-- Índices de tabela `tbpagamento_situacao`
--
ALTER TABLE `tbpagamento_situacao`
  ADD PRIMARY KEY (`id_situacao`);

--
-- Índices de tabela `tbpermissoes`
--
ALTER TABLE `tbpermissoes`
  ADD PRIMARY KEY (`id_permissao`);

--
-- Índices de tabela `tbplanos`
--
ALTER TABLE `tbplanos`
  ADD PRIMARY KEY (`id_plano`);

--
-- Índices de tabela `tbseguro`
--
ALTER TABLE `tbseguro`
  ADD PRIMARY KEY (`id_seguro`),
  ADD KEY `id_situacao` (`id_situacao`),
  ADD KEY `id_fornecedor` (`id_fornecedor`),
  ADD KEY `id_veiculo` (`id_veiculo`);

--
-- Índices de tabela `tbsuporte`
--
ALTER TABLE `tbsuporte`
  ADD PRIMARY KEY (`id_suporte`),
  ADD KEY `id_suporte_situacao` (`id_suporte_situacao`);

--
-- Índices de tabela `tbsuporte_situacao`
--
ALTER TABLE `tbsuporte_situacao`
  ADD PRIMARY KEY (`id_suporte_situacao`);

--
-- Índices de tabela `tbtanque`
--
ALTER TABLE `tbtanque`
  ADD PRIMARY KEY (`id_tanque`),
  ADD KEY `id_combustivel` (`id_combustivel`);

--
-- Índices de tabela `tbticket`
--
ALTER TABLE `tbticket`
  ADD PRIMARY KEY (`id_ticket`),
  ADD KEY `id_veiculo` (`id_veiculo`),
  ADD KEY `id_motorista` (`id_motorista`),
  ADD KEY `id_combustivel` (`id_combustivel`),
  ADD KEY `id_fornecedor` (`id_fornecedor`);

--
-- Índices de tabela `tbunidade_medida`
--
ALTER TABLE `tbunidade_medida`
  ADD PRIMARY KEY (`id_medida`);

--
-- Índices de tabela `tbusuarios`
--
ALTER TABLE `tbusuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_acesso` (`id_acesso`);

--
-- Índices de tabela `tbveiculo`
--
ALTER TABLE `tbveiculo`
  ADD PRIMARY KEY (`id_veiculo`),
  ADD KEY `id_modelo` (`id_fabricante`),
  ADD KEY `id_combustivel` (`id_combustivel`),
  ADD KEY `id_categoria_veiculo` (`id_categoria_veiculo`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `tbabastecimento`
--
ALTER TABLE `tbabastecimento`
  MODIFY `id_abastecimento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `tbcartao_virtual`
--
ALTER TABLE `tbcartao_virtual`
  MODIFY `id_cartao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `tbcartao_virtual_movimentos`
--
ALTER TABLE `tbcartao_virtual_movimentos`
  MODIFY `id_cartao_movimentos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbcartao_virtual_movimentos_situacao`
--
ALTER TABLE `tbcartao_virtual_movimentos_situacao`
  MODIFY `id_cartao_movimento_situacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tbcartao_virtual_renovacao`
--
ALTER TABLE `tbcartao_virtual_renovacao`
  MODIFY `id_cartao_renovacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tbcartao_virtual_situacao`
--
ALTER TABLE `tbcartao_virtual_situacao`
  MODIFY `id_cartao_situacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tbcategoria_combustivel`
--
ALTER TABLE `tbcategoria_combustivel`
  MODIFY `id_combustivel` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de tabela `tbcategoria_veiculo`
--
ALTER TABLE `tbcategoria_veiculo`
  MODIFY `id_categoria_veiculo` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de tabela `tbclientes`
--
ALTER TABLE `tbclientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `tbclientes_tipo`
--
ALTER TABLE `tbclientes_tipo`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tbfabricante_veiculo`
--
ALTER TABLE `tbfabricante_veiculo`
  MODIFY `id_fabricante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tbfornecedor`
--
ALTER TABLE `tbfornecedor`
  MODIFY `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `tbfornecedor_atuacao`
--
ALTER TABLE `tbfornecedor_atuacao`
  MODIFY `id_area_atuacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tbipva`
--
ALTER TABLE `tbipva`
  MODIFY `id_ipva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tbmanutencao_tipo`
--
ALTER TABLE `tbmanutencao_tipo`
  MODIFY `id_manutencao_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tbmanutencao_veiculo`
--
ALTER TABLE `tbmanutencao_veiculo`
  MODIFY `id_manutencao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tbmodelo_veiculo`
--
ALTER TABLE `tbmodelo_veiculo`
  MODIFY `id_modelo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tbmotorista`
--
ALTER TABLE `tbmotorista`
  MODIFY `id_motorista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de tabela `tbmov_entrada`
--
ALTER TABLE `tbmov_entrada`
  MODIFY `id_entrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT de tabela `tbmov_saida`
--
ALTER TABLE `tbmov_saida`
  MODIFY `id_saida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de tabela `tbmov_transito`
--
ALTER TABLE `tbmov_transito`
  MODIFY `id_transito` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbnivel_acesso`
--
ALTER TABLE `tbnivel_acesso`
  MODIFY `id_acesso` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tbpagamento_situacao`
--
ALTER TABLE `tbpagamento_situacao`
  MODIFY `id_situacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tbpermissoes`
--
ALTER TABLE `tbpermissoes`
  MODIFY `id_permissao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `tbplanos`
--
ALTER TABLE `tbplanos`
  MODIFY `id_plano` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tbseguro`
--
ALTER TABLE `tbseguro`
  MODIFY `id_seguro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tbsuporte`
--
ALTER TABLE `tbsuporte`
  MODIFY `id_suporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `tbsuporte_situacao`
--
ALTER TABLE `tbsuporte_situacao`
  MODIFY `id_suporte_situacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tbtanque`
--
ALTER TABLE `tbtanque`
  MODIFY `id_tanque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de tabela `tbticket`
--
ALTER TABLE `tbticket`
  MODIFY `id_ticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `tbunidade_medida`
--
ALTER TABLE `tbunidade_medida`
  MODIFY `id_medida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `tbusuarios`
--
ALTER TABLE `tbusuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de tabela `tbveiculo`
--
ALTER TABLE `tbveiculo`
  MODIFY `id_veiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `tbabastecimento`
--
ALTER TABLE `tbabastecimento`
  ADD CONSTRAINT `tbabastecimento_ibfk_1` FOREIGN KEY (`id_veiculo`) REFERENCES `tbveiculo` (`id_veiculo`),
  ADD CONSTRAINT `tbabastecimento_ibfk_2` FOREIGN KEY (`id_combustivel`) REFERENCES `tbcategoria_combustivel` (`id_combustivel`),
  ADD CONSTRAINT `tbabastecimento_ibfk_3` FOREIGN KEY (`id_motorista`) REFERENCES `tbmotorista` (`id_motorista`),
  ADD CONSTRAINT `tbabastecimento_ibfk_4` FOREIGN KEY (`id_fornecedor`) REFERENCES `tbfornecedor` (`id_fornecedor`);

--
-- Restrições para tabelas `tbcartao_virtual`
--
ALTER TABLE `tbcartao_virtual`
  ADD CONSTRAINT `tbcartao_virtual_ibfk_1` FOREIGN KEY (`id_motorista`) REFERENCES `tbmotorista` (`id_motorista`),
  ADD CONSTRAINT `tbcartao_virtual_ibfk_2` FOREIGN KEY (`id_cartao_situacao`) REFERENCES `tbcartao_virtual_situacao` (`id_cartao_situacao`),
  ADD CONSTRAINT `tbcartao_virtual_ibfk_3` FOREIGN KEY (`id_cartao_renovacao`) REFERENCES `tbcartao_virtual_renovacao` (`id_cartao_renovacao`);

--
-- Restrições para tabelas `tbcartao_virtual_movimentos`
--
ALTER TABLE `tbcartao_virtual_movimentos`
  ADD CONSTRAINT `tbcartao_virtual_movimentos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tbusuarios` (`id_usuario`),
  ADD CONSTRAINT `tbcartao_virtual_movimentos_ibfk_2` FOREIGN KEY (`id_fornecedor`) REFERENCES `tbfornecedor` (`id_fornecedor`),
  ADD CONSTRAINT `tbcartao_virtual_movimentos_ibfk_3` FOREIGN KEY (`id_veiculo`) REFERENCES `tbveiculo` (`id_veiculo`),
  ADD CONSTRAINT `tbcartao_virtual_movimentos_ibfk_4` FOREIGN KEY (`id_combustivel`) REFERENCES `tbcategoria_combustivel` (`id_combustivel`),
  ADD CONSTRAINT `tbcartao_virtual_movimentos_ibfk_5` FOREIGN KEY (`id_cartao_movimento_situacao`) REFERENCES `tbcartao_virtual_movimentos_situacao` (`id_cartao_movimento_situacao`);

--
-- Restrições para tabelas `tbclientes`
--
ALTER TABLE `tbclientes`
  ADD CONSTRAINT `tbclientes_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `tbclientes_tipo` (`id_tipo`),
  ADD CONSTRAINT `tbclientes_ibfk_2` FOREIGN KEY (`id_plano`) REFERENCES `tbplanos` (`id_plano`);

--
-- Restrições para tabelas `tbfornecedor`
--
ALTER TABLE `tbfornecedor`
  ADD CONSTRAINT `tbfornecedor_ibfk_1` FOREIGN KEY (`id_area_atuacao`) REFERENCES `tbfornecedor_atuacao` (`id_area_atuacao`);

--
-- Restrições para tabelas `tbipva`
--
ALTER TABLE `tbipva`
  ADD CONSTRAINT `tbipva_ibfk_1` FOREIGN KEY (`id_situacao`) REFERENCES `tbpagamento_situacao` (`id_situacao`),
  ADD CONSTRAINT `tbipva_ibfk_2` FOREIGN KEY (`id_veiculo`) REFERENCES `tbveiculo` (`id_veiculo`);

--
-- Restrições para tabelas `tbmanutencao_veiculo`
--
ALTER TABLE `tbmanutencao_veiculo`
  ADD CONSTRAINT `tbmanutencao_veiculo_ibfk_1` FOREIGN KEY (`id_fornecedor`) REFERENCES `tbfornecedor` (`id_fornecedor`),
  ADD CONSTRAINT `tbmanutencao_veiculo_ibfk_2` FOREIGN KEY (`id_veiculo`) REFERENCES `tbveiculo` (`id_veiculo`),
  ADD CONSTRAINT `tbmanutencao_veiculo_ibfk_3` FOREIGN KEY (`id_manutencao_tipo`) REFERENCES `tbmanutencao_tipo` (`id_manutencao_tipo`),
  ADD CONSTRAINT `tbmanutencao_veiculo_ibfk_4` FOREIGN KEY (`id_situacao`) REFERENCES `tbpagamento_situacao` (`id_situacao`);

--
-- Restrições para tabelas `tbmodelo_veiculo`
--
ALTER TABLE `tbmodelo_veiculo`
  ADD CONSTRAINT `tbmodelo_veiculo_ibfk_1` FOREIGN KEY (`id_fabricante`) REFERENCES `tbfabricante_veiculo` (`id_fabricante`);

--
-- Restrições para tabelas `tbmov_entrada`
--
ALTER TABLE `tbmov_entrada`
  ADD CONSTRAINT `tbmov_entrada_ibfk_1` FOREIGN KEY (`id_fornecedor`) REFERENCES `tbfornecedor` (`id_fornecedor`),
  ADD CONSTRAINT `tbmov_entrada_ibfk_2` FOREIGN KEY (`id_tanque`) REFERENCES `tbtanque` (`id_tanque`);

--
-- Restrições para tabelas `tbmov_saida`
--
ALTER TABLE `tbmov_saida`
  ADD CONSTRAINT `tbmov_saida_ibfk_1` FOREIGN KEY (`id_veiculo`) REFERENCES `tbveiculo` (`id_veiculo`),
  ADD CONSTRAINT `tbmov_saida_ibfk_2` FOREIGN KEY (`id_tanque`) REFERENCES `tbtanque` (`id_tanque`),
  ADD CONSTRAINT `tbmov_saida_ibfk_3` FOREIGN KEY (`id_motorista`) REFERENCES `tbmotorista` (`id_motorista`);

--
-- Restrições para tabelas `tbmov_transito`
--
ALTER TABLE `tbmov_transito`
  ADD CONSTRAINT `tbmov_transito_ibfk_1` FOREIGN KEY (`id_veiculo`) REFERENCES `tbveiculo` (`id_veiculo`),
  ADD CONSTRAINT `tbmov_transito_ibfk_2` FOREIGN KEY (`id_combustivel`) REFERENCES `tbcategoria_combustivel` (`id_combustivel`),
  ADD CONSTRAINT `tbmov_transito_ibfk_3` FOREIGN KEY (`id_motorista`) REFERENCES `tbmotorista` (`id_motorista`),
  ADD CONSTRAINT `tbmov_transito_ibfk_4` FOREIGN KEY (`id_fornecedor`) REFERENCES `tbfornecedor` (`id_fornecedor`);

--
-- Restrições para tabelas `tbseguro`
--
ALTER TABLE `tbseguro`
  ADD CONSTRAINT `tbseguro_ibfk_1` FOREIGN KEY (`id_situacao`) REFERENCES `tbpagamento_situacao` (`id_situacao`),
  ADD CONSTRAINT `tbseguro_ibfk_2` FOREIGN KEY (`id_fornecedor`) REFERENCES `tbfornecedor` (`id_fornecedor`),
  ADD CONSTRAINT `tbseguro_ibfk_3` FOREIGN KEY (`id_veiculo`) REFERENCES `tbveiculo` (`id_veiculo`);

--
-- Restrições para tabelas `tbsuporte`
--
ALTER TABLE `tbsuporte`
  ADD CONSTRAINT `tbsuporte_ibfk_1` FOREIGN KEY (`id_suporte_situacao`) REFERENCES `tbsuporte_situacao` (`id_suporte_situacao`);

--
-- Restrições para tabelas `tbtanque`
--
ALTER TABLE `tbtanque`
  ADD CONSTRAINT `tbtanque_ibfk_1` FOREIGN KEY (`id_combustivel`) REFERENCES `tbcategoria_combustivel` (`id_combustivel`);

--
-- Restrições para tabelas `tbticket`
--
ALTER TABLE `tbticket`
  ADD CONSTRAINT `tbticket_ibfk_1` FOREIGN KEY (`id_veiculo`) REFERENCES `tbveiculo` (`id_veiculo`),
  ADD CONSTRAINT `tbticket_ibfk_2` FOREIGN KEY (`id_motorista`) REFERENCES `tbmotorista` (`id_motorista`),
  ADD CONSTRAINT `tbticket_ibfk_3` FOREIGN KEY (`id_combustivel`) REFERENCES `tbcategoria_combustivel` (`id_combustivel`),
  ADD CONSTRAINT `tbticket_ibfk_4` FOREIGN KEY (`id_fornecedor`) REFERENCES `tbfornecedor` (`id_fornecedor`);

--
-- Restrições para tabelas `tbusuarios`
--
ALTER TABLE `tbusuarios`
  ADD CONSTRAINT `tbusuarios_ibfk_1` FOREIGN KEY (`id_acesso`) REFERENCES `tbnivel_acesso` (`id_acesso`);

--
-- Restrições para tabelas `tbveiculo`
--
ALTER TABLE `tbveiculo`
  ADD CONSTRAINT `tbveiculo_ibfk_1` FOREIGN KEY (`id_fabricante`) REFERENCES `tbfabricante_veiculo` (`id_fabricante`),
  ADD CONSTRAINT `tbveiculo_ibfk_2` FOREIGN KEY (`id_combustivel`) REFERENCES `tbcategoria_combustivel` (`id_combustivel`),
  ADD CONSTRAINT `tbveiculo_ibfk_3` FOREIGN KEY (`id_categoria_veiculo`) REFERENCES `tbcategoria_veiculo` (`id_categoria_veiculo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
