-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 
-- Versão do Servidor: 5.5.25a
-- Versão do PHP: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `painel`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm_faq`
--

CREATE TABLE IF NOT EXISTS `adm_faq` (
  `id_faq` int(11) NOT NULL AUTO_INCREMENT,
  `pergunta` varchar(255) NOT NULL,
  `resposta` text NOT NULL,
  PRIMARY KEY (`id_faq`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `adm_faq`
--

INSERT INTO `adm_faq` (`id_faq`, `pergunta`, `resposta`) VALUES
(2, 'Como inserir notícias no meu site?', 'No menu lateral do painel, clique em > Notícias > Adicionar.'),
(3, 'Como faço para inserir um novo departamento em meu site?', 'No menu lateral do painel, clique em > Departamentos > Ver Departamentos > Inserir novo departamento.'),
(4, 'Como faço para alterar a minha senha?', 'Abaixo da logo iGresoft no canto superior esquerdo do painel existe um menu "OPÇ?ES", clique e escolha a opç?o > Alterar Senha'),
(5, 'Quero inserir novos administradores, mas n?o sei como fazer', 'Abaixo da logo iGresoft no canto superior esquerdo do painel existe um menu "OPÇ?ES", clique e escolha a opç?o > Administradores'),
(6, 'Como faço para enviar e-mails para todos os membros da minha igreja?', 'No menu lateral acesse > Lista de E-mails > Exportar E-mails, copie todos os e-mails e cole no campo CCO do seu E-mail. (CCO significa Cópia Oculta, é importante para n?o mostrar os e-mails para os destinatários e evitar expor os e-mails)'),
(7, 'Criei uma galeria, mas gostaria de inserir mais fotos, como faço?', 'Acesse no menu lateral > Galeria de Fotos > Ver Galerias > Escolha a galeria desejada e clique no ícone <img src="../img/btfotos.gif" /> para adicionar mais fotos.'),
(8, 'Como insiro novos compromissos em meu calendário?', 'No menu lateral acesse > Calendário > Adicionar Novo Compromisso'),
(9, 'O que é URL?', 'URL é o endereço completo da página incluindo http:// ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm_historico`
--

CREATE TABLE IF NOT EXISTS `adm_historico` (
  `id_historico` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_acao` int(11) NOT NULL,
  `id_ref` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_historico`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=145 ;

--
-- Extraindo dados da tabela `adm_historico`
--

INSERT INTO `adm_historico` (`id_historico`, `id_usuario`, `id_menu`, `id_acao`, `id_ref`, `data`) VALUES
(131, 1, 0, 4, 2, '2011-09-03 15:07:38'),
(132, 1, 0, 4, 5, '2011-09-03 15:24:13'),
(133, 1, 0, 4, 4, '2011-09-03 15:24:13'),
(134, 1, 0, 4, 3, '2013-09-05 12:14:01'),
(135, 1, 0, 4, 1, '2013-09-05 12:14:01'),
(136, 1, 0, 4, 2, '2013-09-05 12:14:01'),
(137, 1, 0, 1, 19, '2013-09-05 13:57:12'),
(138, 1, 0, 4, 19, '2013-09-05 13:57:46'),
(139, 1, 0, 1, 20, '2013-09-05 14:06:16'),
(140, 1, 0, 4, 20, '2013-09-05 14:06:48'),
(141, 1, 0, 1, 21, '2013-09-05 17:42:12'),
(142, 1, 0, 1, 22, '2013-09-06 11:37:50'),
(143, 1, 0, 4, 22, '2013-09-06 11:37:58'),
(144, 1, 0, 4, 21, '2013-09-06 11:37:58');

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm_historico_acoes`
--

CREATE TABLE IF NOT EXISTS `adm_historico_acoes` (
  `id_acao` int(11) NOT NULL AUTO_INCREMENT,
  `acao` varchar(255) NOT NULL,
  PRIMARY KEY (`id_acao`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `adm_historico_acoes`
--

INSERT INTO `adm_historico_acoes` (`id_acao`, `acao`) VALUES
(1, 'Adicionar'),
(2, 'Editar'),
(3, 'Status'),
(4, 'Excluir'),
(5, 'Excluir arquivo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm_menu`
--

CREATE TABLE IF NOT EXISTS `adm_menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `destino` varchar(255) NOT NULL,
  `icone` varchar(100) NOT NULL,
  `dentro_id` int(11) NOT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86 ;

--
-- Extraindo dados da tabela `adm_menu`
--

INSERT INTO `adm_menu` (`id_menu`, `titulo`, `destino`, `icone`, `dentro_id`) VALUES
(21, 'Comentários', 'noticias_comentarios.php', '', 1),
(77, 'Notícias', '', '', 0),
(78, 'Adicionar notícia', 'noticias_dados.php', '', 77),
(79, 'Gerenciar notícias', 'noticias.php', '', 77),
(80, 'Adicionar categoria', 'noticias_categorias_dados.php', '', 77),
(81, 'Gerenciar categoria', 'noticias_categorias.php', '', 77),
(83, 'Banners', '', '', 0),
(84, 'Adicionar banner', 'banner_dados.php', '', 83),
(85, 'Gerenciar banners', 'banner.php', '', 83);

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm_permissoes`
--

CREATE TABLE IF NOT EXISTS `adm_permissoes` (
  `id_usuario` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `adm_permissoes`
--

INSERT INTO `adm_permissoes` (`id_usuario`, `id_menu`) VALUES
(11, 66),
(11, 23),
(11, 1),
(11, 35),
(11, 14),
(11, 63),
(11, 31),
(11, 9),
(11, 37),
(11, 17),
(11, 4),
(11, 44),
(11, 28),
(11, 60),
(11, 25),
(11, 41);

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm_usuarios`
--

CREATE TABLE IF NOT EXISTS `adm_usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `login` varchar(20) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `email` varchar(100) NOT NULL,
  `data_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `flag_status` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `adm_usuarios`
--

INSERT INTO `adm_usuarios` (`id_usuario`, `nome`, `login`, `senha`, `email`, `data_login`, `flag_status`) VALUES
(1, '101FM', 'admin', 'ad70b3bdb0fb1d5e71c58f829c788795', 'teoclyts@gmail.com', '2013-09-11 16:06:17', 1),
(11, 'demo', 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'teoclyts@gmail.com', '2013-04-07 23:10:40', 0),
(12, '101fm', '101fm', '85719be794b15d64a03c39eea84ff942', 'contato@101fm.com.br', '2013-09-06 10:55:03', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `nomeAlbum` char(40) NOT NULL,
  `descricaoAlbum` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `album`
--

INSERT INTO `album` (`id`, `nomeAlbum`, `descricaoAlbum`) VALUES
(1, 'Teste', 'Descriç?ozinha Testezinha'),
(2, 'BebÃªs', NULL),
(3, 'Rafael', NULL),
(4, 'assasas', NULL),
(5, 'O diÃ¡rio', 'Fotos do daniel');

-- --------------------------------------------------------

--
-- Estrutura da tabela `calendario`
--

CREATE TABLE IF NOT EXISTS `calendario` (
  `id_evento` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) CHARACTER SET latin1 NOT NULL,
  `data` date NOT NULL DEFAULT '0000-00-00',
  `descricao` longtext CHARACTER SET latin1 NOT NULL,
  `imagem` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_evento`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=21 ;

--
-- Extraindo dados da tabela `calendario`
--

INSERT INTO `calendario` (`id_evento`, `titulo`, `data`, `descricao`, `imagem`) VALUES
(8, 'Culto de Jovens', '2011-09-24', 'Ligar para Pastor - 3045-1565', ''),
(9, 'Culto de Liberta?§??o', '2011-09-30', 'Comprar ??leo', ''),
(10, 'Meu compromisso', '2011-09-01', 'Descri?§??o', ''),
(11, 'Compromisso', '2011-09-24', 'Urgente', ''),
(12, 'compromisso teste', '2011-12-27', 'teste', ''),
(14, 'Reuni??o Geral', '2012-09-26', 'Levem suas biblias', ''),
(15, 'testando', '2013-03-31', 'testando a agenda', ''),
(16, 'testando calend??rio', '2013-03-31', 'testeeee', '1314502740124427.jpg'),
(17, 'testando calend??rio2222', '2013-03-31', 'testando a agenda222', '1314502740449218.jpg'),
(18, 'testando calend??rio223333333', '2013-03-30', 'testando a agenda333333', '1314502740124427(1).jpg'),
(19, 'testando calend??rio4444444444', '2013-03-31', 'testando a agenda444444', ''),
(20, 'testando calend??rio5555', '2013-03-31', 'testando a agenda5555', '1314502740124427(2).jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbconfiguracoes`
--

CREATE TABLE IF NOT EXISTS `tbconfiguracoes` (
  `nomesite` varchar(255) CHARACTER SET latin1 NOT NULL,
  `slogansite` varchar(255) CHARACTER SET latin1 NOT NULL,
  `emailsite` varchar(255) CHARACTER SET latin1 NOT NULL,
  `telefone1` varchar(255) CHARACTER SET latin1 NOT NULL,
  `telefone2` varchar(255) CHARACTER SET latin1 NOT NULL,
  `telefone3` varchar(255) CHARACTER SET latin1 NOT NULL,
  `produtoservico` varchar(255) CHARACTER SET latin1 NOT NULL,
  `pagseguro` varchar(255) CHARACTER SET latin1 NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 NOT NULL,
  `twitter` varchar(255) CHARACTER SET latin1 NOT NULL,
  `facebook` varchar(255) CHARACTER SET latin1 NOT NULL,
  `youtube` varchar(255) CHARACTER SET latin1 NOT NULL,
  `imagem` varchar(255) CHARACTER SET latin1 NOT NULL,
  `endereco` longtext CHARACTER SET latin1 NOT NULL,
  `id_config` int(11) NOT NULL AUTO_INCREMENT,
  `corsite` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `url` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_config`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `tbconfiguracoes`
--

INSERT INTO `tbconfiguracoes` (`nomesite`, `slogansite`, `emailsite`, `telefone1`, `telefone2`, `telefone3`, `produtoservico`, `pagseguro`, `token`, `twitter`, `facebook`, `youtube`, `imagem`, `endereco`, `id_config`, `corsite`, `url`) VALUES
('101FM', '101FM', 'contato@101fm.com.br', '', '', '', '', '', '', '', '', '', 'logo101.png', '', 1, 'azul', 'localhost');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcontador`
--

CREATE TABLE IF NOT EXISTS `tbcontador` (
  `id_pagina` int(11) NOT NULL AUTO_INCREMENT,
  `acessos` varchar(255) NOT NULL,
  PRIMARY KEY (`id_pagina`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `tbcontador`
--

INSERT INTO `tbcontador` (`id_pagina`, `acessos`) VALUES
(1, '364');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbgalerias`
--

CREATE TABLE IF NOT EXISTS `tbgalerias` (
  `id_galeria` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL DEFAULT '',
  `local` varchar(255) NOT NULL DEFAULT '',
  `data` date NOT NULL DEFAULT '0000-00-00',
  `descricao` text NOT NULL,
  `codigo` varchar(32) NOT NULL DEFAULT '',
  `contador` int(11) NOT NULL DEFAULT '0',
  `flag_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_galeria`),
  KEY `id_galeria` (`id_galeria`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Extraindo dados da tabela `tbgalerias`
--

INSERT INTO `tbgalerias` (`id_galeria`, `titulo`, `local`, `data`, `descricao`, `codigo`, `contador`, `flag_status`) VALUES
(47, 'Show Fernandinho', 'Bras?­lia-DF', '2011-08-28', '', '2dde293a1f57bc78afe00b62e9b1bccc', 128, 1),
(48, 'David Quilan na Igreja', 'Igreja', '2011-08-28', '', 'fa12c886070c06fb6fbed6ada616a0c1', 132, 1),
(49, 'Culto na pra?§a', 'Pra?§a Central da Cidade', '2011-08-28', '', 'abd53b99b3010300f681a7a7ac959701', 80, 1),
(50, 'Evento da Igreja', 'Avenida Central', '2011-08-28', '', '7f8ce3ba9284f53d3e18a829ef1a9990', 134, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbgalerias_comentarios`
--

CREATE TABLE IF NOT EXISTS `tbgalerias_comentarios` (
  `id_comentario` int(11) NOT NULL AUTO_INCREMENT,
  `id_galeria` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mensagem` mediumtext NOT NULL,
  `datahora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(15) NOT NULL,
  `flag_status` char(1) NOT NULL,
  PRIMARY KEY (`id_comentario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Extraindo dados da tabela `tbgalerias_comentarios`
--

INSERT INTO `tbgalerias_comentarios` (`id_comentario`, `id_galeria`, `nome`, `email`, `mensagem`, `datahora`, `ip`, `flag_status`) VALUES
(12, 48, 'Weverson Ramos', 'senhorvip@gmail.com', 'Nosso Deus &eacute; poderoso pr&aacute; fazer\r<br>tudo muito mais abundantemente\r<br>daquilo que pedimos ou sonhamos!', '2011-08-29 22:33:33', '189.114.18.18', '1'),
(14, 50, 'Julia', 'jujuliada@yahoo.com.br', 'lindo site', '2013-03-30 04:50:21', '189.34.145.252', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbgalerias_config`
--

CREATE TABLE IF NOT EXISTS `tbgalerias_config` (
  `campo` varchar(255) NOT NULL DEFAULT '',
  `valor` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`campo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbgalerias_fotos`
--

CREATE TABLE IF NOT EXISTS `tbgalerias_fotos` (
  `id_foto` int(11) NOT NULL AUTO_INCREMENT,
  `id_galeria` int(11) NOT NULL DEFAULT '0',
  `imagem` varchar(100) NOT NULL DEFAULT '',
  `legenda` varchar(255) NOT NULL DEFAULT '',
  `contador` int(11) NOT NULL DEFAULT '0',
  `flag_status` int(1) NOT NULL DEFAULT '1',
  `posicao` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_foto`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1600 ;

--
-- Extraindo dados da tabela `tbgalerias_fotos`
--

INSERT INTO `tbgalerias_fotos` (`id_foto`, `id_galeria`, `imagem`, `legenda`, `contador`, `flag_status`, `posicao`) VALUES
(1573, 47, '1314502740796190.jpg', 'Legenda', 0, 1, 1000),
(1574, 47, '1314502740449218.jpg', 'Descri?§??o', 0, 1, 1000),
(1575, 47, '1314502740124427.jpg', 'Legenda', 0, 1, 1000),
(1576, 47, '1314502740518468.jpg', 'Descri?§??o', 0, 1, 1000),
(1577, 47, '1314502740856326.jpg', 'Legenda', 0, 1, 1000),
(1578, 47, '1314502740582371.jpg', 'Descri?§??o', 0, 1, 1000),
(1579, 48, '1314502814948407.jpg', 'Descri?§??o', 0, 1, 1000),
(1580, 48, '1314502814290998.jpg', 'legenda', 0, 1, 1000),
(1581, 48, '1314502814322363.jpg', 'Descri?§??o', 0, 1, 1000),
(1582, 48, '1314502814123019.jpg', 'legenda', 0, 1, 1000),
(1583, 48, '1314502814170730.jpg', 'Descri?§??o', 0, 1, 1000),
(1584, 48, '1314502814796383.jpg', 'legenda', 0, 1, 1000),
(1585, 50, '1314502936443737.jpg', 'Descri?§??o', 0, 1, 1000),
(1586, 50, '1314502936453347.jpg', 'Legenda', 0, 1, 1000),
(1587, 50, '1314502936862516.jpg', 'Descri?§??o', 0, 1, 1000),
(1588, 50, '1314502936980416.jpg', 'Legenda', 0, 1, 1000),
(1589, 50, '1314502937282605.jpg', 'Descri?§??o', 0, 1, 1000),
(1590, 50, '1314502937923507.jpg', 'Descri?§??o', 0, 1, 1000),
(1591, 49, '1314503022165934.jpg', 'teste de legenda', 0, 1, 1000),
(1592, 49, '1314503023636976.jpg', 'legenda', 0, 1, 1000),
(1593, 49, '1314503024745980.jpg', 'Descri?§??o', 0, 1, 1000),
(1594, 49, '1314503025377001.jpg', 'legenda', 0, 1, 1000),
(1595, 49, '1314503025770680.jpg', 'Descri?§??o', 0, 1, 1000),
(1596, 49, '1314503026921111.jpg', 'legenda', 0, 1, 1000),
(1599, 49, '1364702115926607.jpg', 'Iphone 5', 0, 1, 1000);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbmaterias`
--

CREATE TABLE IF NOT EXISTS `tbmaterias` (
  `id_materia` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `texto` text NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id_materia`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=204 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbmaterias_categorias`
--

CREATE TABLE IF NOT EXISTS `tbmaterias_categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `cat_img` varchar(100) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbmural`
--

CREATE TABLE IF NOT EXISTS `tbmural` (
  `id_mural` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mensagem` mediumtext NOT NULL,
  `datahora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `flag_status` char(1) NOT NULL,
  PRIMARY KEY (`id_mural`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbnoticias`
--

CREATE TABLE IF NOT EXISTS `tbnoticias` (
  `id_noticia` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `subtitulo` varchar(250) NOT NULL,
  `creditos` varchar(250) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `texto` text NOT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id_noticia`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Extraindo dados da tabela `tbnoticias`
--

INSERT INTO `tbnoticias` (`id_noticia`, `titulo`, `subtitulo`, `creditos`, `data`, `texto`, `id_categoria`) VALUES
(14, 'asdasd', 'asdasdsd', '', '2013-09-11 18:22:59', '<font face="Arial, Helvetica, sans-serif" size="2"><span style="line-height: 19.5px;">^((video))|(\\[|\\])+$</span></font>', 29),
(15, 'asdasda', 'asdasdds', '', '2013-09-11 18:31:07', '<div><font face="Arial, Helvetica, sans-serif" size="2"><span style="line-height: 19.5px;">&lt;?php</span></font></div><div><font face="Arial, Helvetica, sans-serif" size="2"><span style="line-height: 19.5px;"><br></span></font></div><div><font face="Arial, Helvetica, sans-serif" size="2"><span style="line-height: 19.5px;">include ''vendor/autoload.php'';</span></font></div><div><font face="Arial, Helvetica, sans-serif" size="2"><span style="line-height: 19.5px;"><br></span></font></div><div><font face="Arial, Helvetica, sans-serif" size="2"><span style="line-height: 19.5px;">use Respect\\Relational\\Mapper;</span></font></div><div><font face="Arial, Helvetica, sans-serif" size="2"><span style="line-height: 19.5px;"><br></span></font></div><div><font face="Arial, Helvetica, sans-serif" size="2"><span style="line-height: 19.5px;">$mapper = new Mapper(new PDO("mysql:host=127.0.0.1;dbname=painel",''root'',''''));</span></font></div><div><font face="Arial, Helvetica, sans-serif" size="2"><span style="line-height: 19.5px;"><br></span></font></div><div><font face="Arial, Helvetica, sans-serif" size="2"><span style="line-height: 19.5px;">$gNews = $mapper-&gt;tbnoticias-&gt;fetchAll();</span></font></div><div><font face="Arial, Helvetica, sans-serif" size="2"><span style="line-height: 19.5px;"><br></span></font></div><div><font face="Arial, Helvetica, sans-serif" size="2"><span style="line-height: 19.5px;">foreach($gNews as $news) {</span></font></div><div><font face="Arial, Helvetica, sans-serif" size="2"><span style="line-height: 19.5px;"><span class="Apple-tab-span" style="white-space:pre">	</span>echo $news-&gt;titulo.PHP_EOL;</span></font></div><div><font face="Arial, Helvetica, sans-serif" size="2"><span style="line-height: 19.5px;">}</span></font></div>', 30);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbnoticias_categorias`
--

CREATE TABLE IF NOT EXISTS `tbnoticias_categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(255) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Extraindo dados da tabela `tbnoticias_categorias`
--

INSERT INTO `tbnoticias_categorias` (`id_categoria`, `categoria`) VALUES
(29, 'Editoriais'),
(30, 'Jornal 101FM'),
(31, 'Vereador em A&ccedil;&atilde;o'),
(32, 'Videos'),
(33, 'Especial'),
(34, 'Resumo da Semana');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbnoticias_comentarios`
--

CREATE TABLE IF NOT EXISTS `tbnoticias_comentarios` (
  `id_comentario` int(11) NOT NULL AUTO_INCREMENT,
  `id_noticia` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mensagem` mediumtext NOT NULL,
  `datahora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(15) NOT NULL,
  `flag_status` char(1) NOT NULL,
  PRIMARY KEY (`id_comentario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Extraindo dados da tabela `tbnoticias_comentarios`
--

INSERT INTO `tbnoticias_comentarios` (`id_comentario`, `id_noticia`, `nome`, `email`, `mensagem`, `datahora`, `ip`, `flag_status`) VALUES
(12, 332, 'Weverson Ramos', 'senhorvip@gmail.com', 'Em 2008, os membros do Al-Shabaab deceparam a cabe&ccedil;a de Manssur Mohammed, de 25 anos de idade, por se converter ao cristianismo. De acordo com testemunhas, os militantes isl&acirc;micos circularam um v&iacute;deo para instigar o medo entre aqueles que contemplam a convers&atilde;o do islamismo para o cristianismo.', '2011-08-29 15:57:01', '189.114.18.18', '1'),
(19, 329, 'Marcos', 'email2@gmail.com', 'Boa materia', '2012-11-03 01:14:43', '177.5.71.74', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbnoticias_imagens`
--

CREATE TABLE IF NOT EXISTS `tbnoticias_imagens` (
  `id_img` int(11) NOT NULL AUTO_INCREMENT,
  `id_noticia` int(11) NOT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_img`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Extraindo dados da tabela `tbnoticias_imagens`
--

INSERT INTO `tbnoticias_imagens` (`id_img`, `id_noticia`, `imagem`) VALUES
(61, 14, 'bannerEditorial.jpg'),
(62, 14, 'bannerLikeGlobo3.jpg'),
(63, 14, 'bannerLikeGlobo4.jpg'),
(64, 15, 'bannerLikeGlobo3(1).jpg'),
(65, 15, 'bannerLikeGlobo4(1).jpg'),
(66, 15, 'bannerMeioPagina.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tboracao`
--

CREATE TABLE IF NOT EXISTS `tboracao` (
  `id_oracao` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `pedido` mediumtext CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `data` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id_oracao`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbpublicidade`
--

CREATE TABLE IF NOT EXISTS `tbpublicidade` (
  `id_publicidade` int(11) NOT NULL AUTO_INCREMENT,
  `id_area` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL DEFAULT '',
  `arquivo` varchar(100) NOT NULL DEFAULT '',
  `dimx` int(11) NOT NULL DEFAULT '0',
  `dimy` int(11) NOT NULL DEFAULT '0',
  `destino` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_publicidade`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbpublicidade_areas`
--

CREATE TABLE IF NOT EXISTS `tbpublicidade_areas` (
  `id_area` int(11) NOT NULL AUTO_INCREMENT,
  `area` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_area`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `tbpublicidade_areas`
--

INSERT INTO `tbpublicidade_areas` (`id_area`, `area`) VALUES
(1, 'Banner Topo 702x94px'),
(2, 'Banner Topo2 234x320px '),
(5, 'Banner Rotativo 957x256px'),
(6, 'Banner Publicidade 314x250px'),
(7, 'Banner Baixo 948x123px');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbvideos`
--

CREATE TABLE IF NOT EXISTS `tbvideos` (
  `id_video` int(11) NOT NULL AUTO_INCREMENT,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_categoria` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `titulo` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `video` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `descricao` mediumtext COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_video`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `tbvideos`
--

INSERT INTO `tbvideos` (`id_video`, `data`, `id_categoria`, `titulo`, `video`, `descricao`) VALUES
(2, '2011-08-26 20:53:27', '1', 'A Terra ?© quadrada!', '5nFIjalesDw', '<span class="Apple-style-span" style="font-family: arial, sans-serif; line-height: 18px; background-color: rgb(255, 255, 255); ">Um pastor de Goian?©sia afirma e prova com versiculos da Biblia que a terra ?© quadrada, que o sol gira em torno da Terra e que o homem veio do papagaio....</span>'),
(5, '2013-03-31 01:08:43', '2', 'Prega?§??o Chocante (Paul Washer)', 'N5lw809gB94', '<span class="Apple-style-span" style="font-family: arial, sans-serif; line-height: 18px; background-color: rgb(255, 255, 255); ">Este v?­deo foi traduzido do Ingl??s para o Portugu??s por Vinicius Pimentel e amigos e foi carregada para o meu canal por solicita?§??o dos mesmos. Eu sou grato que eu sou capaz de compartilhar este v?­deo com os meus irm??os e amigos Portugu??s.<br><br>Paul Washer prega uma Mensagem Chocante em uma Confer??ncia de Jovens sobre Evangelismo.<br><br><br><br><br>Este v?­deo foi legendado por F??bio Souza, Marcos Oliveira e Rafael Bello e revisado por Vin?­cius Pimentel e foi carregada em meu canal por solicita?§??o dos mesmos. Eu, Lane, sou grato por poder compartilhar este v?­deo com os meus irm??os e amigos que falam portugu??s.</span>'),
(6, '2013-03-31 01:08:56', '3', 'Pintura Digital', 'LZ7faDusC2s', 'Pintura Digital'),
(7, '2013-03-30 04:23:32', '3', 'Pintura Digital', 'g9tkraHbwIw', 'Pintura Digital'),
(8, '2013-03-30 04:25:46', '3', 'Pintura Digital Leticia', '-NBCITN48a8', 'Pintura Digital');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbvideos_categorias`
--

CREATE TABLE IF NOT EXISTS `tbvideos_categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `tbvideos_categorias`
--

INSERT INTO `tbvideos_categorias` (`id_categoria`, `categoria`) VALUES
(1, 'Engra?§ados'),
(2, 'Louvor'),
(3, 'Artes');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `sobrenome` varchar(255) NOT NULL,
  `mae` varchar(255) NOT NULL,
  `pai` varchar(255) NOT NULL,
  `naturalde` varchar(255) NOT NULL,
  `nacional` varchar(255) NOT NULL,
  `nascimento` date NOT NULL DEFAULT '0000-00-00',
  `estadocivil` varchar(50) NOT NULL,
  `conjuge` varchar(255) NOT NULL,
  `conjugecrente` varchar(10) NOT NULL,
  `igrejaconjuge` varchar(255) NOT NULL,
  `filhos` mediumtext NOT NULL,
  `profissao` varchar(255) NOT NULL,
  `empresa` varchar(255) NOT NULL,
  `telcomercial` varchar(100) NOT NULL,
  `enderecoempresa` varchar(255) NOT NULL,
  `identidade` varchar(11) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `grau` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `cep` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `datafe` date NOT NULL DEFAULT '0000-00-00',
  `databatismo` date NOT NULL DEFAULT '0000-00-00',
  `igrejabatismo` varchar(255) NOT NULL,
  `cidadeigreja` varchar(255) NOT NULL,
  `estadoigreja` varchar(255) NOT NULL,
  `pastorbatismo` varchar(255) NOT NULL,
  `modocomoentrou` varchar(255) NOT NULL,
  `dataentrou` date NOT NULL DEFAULT '0000-00-00',
  `musicapreferida` varchar(255) NOT NULL,
  `bibliapreferida` varchar(500) NOT NULL,
  `dizimista` varchar(25) NOT NULL,
  `ministerio` varchar(255) NOT NULL,
  `talentos` mediumtext NOT NULL,
  `posicaoeclisiastica` varchar(255) NOT NULL,
  `gostariatrabalhar` varchar(255) NOT NULL,
  `orkut` varchar(255) NOT NULL,
  `flag_status` int(11) NOT NULL DEFAULT '1',
  `login` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `aw` varchar(255) NOT NULL,
  `ae` varchar(255) NOT NULL,
  `ar` varchar(255) NOT NULL,
  `at` varchar(255) NOT NULL,
  `ay` varchar(255) NOT NULL,
  `au` varchar(255) NOT NULL,
  `ai` varchar(255) NOT NULL,
  `ao` varchar(255) NOT NULL,
  `ap` varchar(255) NOT NULL,
  `as` varchar(255) NOT NULL,
  `ad` varchar(255) NOT NULL,
  `data` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5459 ;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `nome`, `sobrenome`, `mae`, `pai`, `naturalde`, `nacional`, `nascimento`, `estadocivil`, `conjuge`, `conjugecrente`, `igrejaconjuge`, `filhos`, `profissao`, `empresa`, `telcomercial`, `enderecoempresa`, `identidade`, `cpf`, `grau`, `endereco`, `cep`, `bairro`, `cidade`, `estado`, `telefone`, `celular`, `email`, `twitter`, `facebook`, `imagem`, `datafe`, `databatismo`, `igrejabatismo`, `cidadeigreja`, `estadoigreja`, `pastorbatismo`, `modocomoentrou`, `dataentrou`, `musicapreferida`, `bibliapreferida`, `dizimista`, `ministerio`, `talentos`, `posicaoeclisiastica`, `gostariatrabalhar`, `orkut`, `flag_status`, `login`, `senha`, `aw`, `ae`, `ar`, `at`, `ay`, `au`, `ai`, `ao`, `ap`, `as`, `ad`, `data`) VALUES
(5453, 'Jo??o ', 'da Silva', 'Maria da Silva', 'Jos?© da Silva', 'Bras?­lia', 'Brasileiro', '1988-11-23', '2', 'Joana da Silva', '1', 'Igreja Crist?? Presbiteriana', 'N??o tem', 'Administrador', 'Google', '61 33333333', 'Shopping One, ??guas Claras', '26789876', '01678927626', '5', 'Rua 10 Lote 3', '71000000', 'Centro', 'Bras?­lia', 'DF', '33333333', '86868686', 'email@gmail.com', 'twitter.com/meutwitter', 'facebook.com/meufacebook', 'anonimo(1).jpg', '2003-08-13', '2003-12-20', 'Batista', 'Bras?­lia', 'DF', 'Pr Jo??o', 'Transfer??ncia', '2004-08-18', 'Eu tenho um chamado - 4 por 1', 'Romanos 8 - Porque estou certo de que, nem a morte, nem a vida, nem os anjos, nem os principados, nem as potestades, nem o presente...', '1', '1', 'Cantar, Cantor, Canto', '5', '9', 'n??o tem', 0, 'membro2', '123456789', '', '', '', '', '', '', '', '', '', '', '', '2011-08-24'),
(5457, 'Membro', 'Carvalho de Souza', 'Fulana Dias de Carvalho', 'Fulano de Souza Barbosa', 'Bras?­lia', 'Brasileira', '1977-08-01', '2', 'Beltrana Ramos ', '1', 'Igreja Crist?? Presbiteriana', 'Ciclano Ramos<div>Ciclana Ramos</div>', 'Empres??rio', 'TC', '', '', '', '', '5', '', '', '', '', '', '33333333', '98989898', 'teoclyts@yahoo.com.br', '', '', 'anonimo.jpg', '1995-12-10', '1996-04-21', 'Assembl?©ia de Deus', 'Planaltina', 'DF', 'Beltrano Xavier', '', '2011-08-26', '', '', '1', '10', '', '5', '5', '', 1, 'membro', '123456789', '', '', '', '', '', '', '', '', '', '', '', '2011-08-26');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(40) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `permissao` tinyint(1) DEFAULT '0',
  `foto` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `senha`, `permissao`, `foto`) VALUES
(1, 'renato_ingrato', 'fd566e23f40f0e24fdf99b827b6e52b3', 0, 'as23.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `visitantes`
--

CREATE TABLE IF NOT EXISTS `visitantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `contador` varchar(10) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=199 ;

--
-- Extraindo dados da tabela `visitantes`
--

INSERT INTO `visitantes` (`id`, `data`, `contador`) VALUES
(14, '0.000165755013923421', '181'),
(15, '0.000165755013923421', '51'),
(16, '0.000165755013923421', '50'),
(17, '0.000221006685231228', '35'),
(18, '0.000331510027846842', '116'),
(19, '0.000386761699154649', '57'),
(20, '0.000442013370462456', '1'),
(21, '0.000497265042267528', '79'),
(22, '0.000552516713575335', '2'),
(23, '0.000607768384883142', '26'),
(24, '0.000663020056190949', '2'),
(25, '0.000718271727498756', '183'),
(26, '0.000773523398806563', '53'),
(27, '0.000828775070114370', '33'),
(28, '0.000884026741422178', '16'),
(29, '0.000939278412729985', '6'),
(30, '0.001049781755842864', '14'),
(31, '0.001105033427150671', '1'),
(32, '0.001215536769766285', '25'),
(33, '0.001270788441074092', '7'),
(34, '0.001381291783689706', '1'),
(35, '0.001436543454997513', '7'),
(36, '0.001491795126802585', '3'),
(37, '0.001547046798110392', '2'),
(38, '0.001602298469418199', '1'),
(39, '0.001657550140726006', '6'),
(40, '0.000049726504226752', '1'),
(41, '0.000099453008453505', '2'),
(42, '0.000149179512680258', '30'),
(43, '0.000198906016907011', '7'),
(44, '0.000248632521133764', '6'),
(45, '0.000348085529587270', '6'),
(46, '0.000397812033814022', '3'),
(47, '0.000447538538040775', '11'),
(48, '0.000546991546494281', '3'),
(49, '0.000596718050721034', '60'),
(50, '0.000646444554947787', '58'),
(51, '0.000696171059174540', '43'),
(52, '0.000745897563401292', '48'),
(53, '0.000795624067628045', '29'),
(54, '0.000845350571854798', '16'),
(55, '0.000895077076081551', '3'),
(56, '0.000944803580308304', '8'),
(57, '0.000994530084535057', '9'),
(58, '0.001044256588761810', '4'),
(59, '0.001093983092988562', '16'),
(60, '0.001143709597215315', '6'),
(61, '0.001243162605668821', '34'),
(62, '0.001292889109895574', '22'),
(63, '0.001342615614122327', '26'),
(64, '0.001392342118349080', '4'),
(65, '0.001442068622575832', '11'),
(66, '0.001541521631029338', '7'),
(67, '0.000045205912481352', '3'),
(68, '0.000090411825459970', '9'),
(69, '0.000135617738438587', '24'),
(70, '0.000180823651417205', '6'),
(71, '0.000226029564395822', '6'),
(72, '0.000271235477374440', '3'),
(73, '0.000316441390353058', '1'),
(74, '0.000361647303331675', '5'),
(75, '0.000406853216310293', '4'),
(76, '0.000542470954748881', '78'),
(77, '0.000587676867727498', '9'),
(78, '0.000632882780706116', '5'),
(79, '0.000678088693684733', '1'),
(80, '0.000723294606663351', '33'),
(81, '0.000768500519641969', '1'),
(82, '0.000813706432620586', '18'),
(83, '0.000858912345599204', '2'),
(84, '0.000949324171556439', '2'),
(85, '0.001084941909995027', '7'),
(86, '0.001130147822973644', '1'),
(87, '0.001220559648930880', '1'),
(88, '0.001265765561909497', '2'),
(89, '0.001310971474888115', '17'),
(90, '0.000041438753356539', '3'),
(91, '0.000082877506713078', '8'),
(92, '0.000124316260566882', '6'),
(93, '0.000207193767279960', '2'),
(94, '0.000372948781700646', '18'),
(95, '0.000414387535057185', '68'),
(96, '0.000455826288413724', '3'),
(97, '0.000538703795624067', '445'),
(98, '0.000580142548980606', '32'),
(99, '0.000621581302834410', '6'),
(100, '0.000704458809547488', '30'),
(101, '0.000787336316757831', '17'),
(102, '0.000870213823968175', '1'),
(103, '0.000911652577324714', '4'),
(104, '0.001035968837891596', '3'),
(105, '0.001077407591248135', '6'),
(106, '0.001118846345101939', '59'),
(107, '0.001160285098458478', '2'),
(108, '0.001201723851815017', '2'),
(109, '0.001284601359025360', '2'),
(110, '0.000497017892644135', '309'),
(111, '0.000994035785288270', '42'),
(112, '0.001491053677932405', '18'),
(113, '0.001988071570576540', '56'),
(114, '0.002982107355864811', '21'),
(115, '0.003479125248508946', '10'),
(116, '0.003976143141153081', '9'),
(117, '0.004473161033797216', '24'),
(118, '0.004970178926441351', '17'),
(119, '0.005467196819085487', '6'),
(120, '0.005964214711729622', '56'),
(121, '0.006461232604373757', '20'),
(122, '0.006958250497017892', '21'),
(123, '0.007455268389662027', '13'),
(124, '0.007952286282306163', '160'),
(125, '0.008449304174950298', '8'),
(126, '0.008946322067594433', '2'),
(127, '0.005715705765407554', '29'),
(128, '0.006212723658051689', '9'),
(129, '0.006709741550695825', '8'),
(130, '0.007206759443339960', '8'),
(131, '0.000165672630715705', '5'),
(132, '0.000331345261431411', '9'),
(133, '0.000662690523359840', '5'),
(134, '0.000828363154075546', '14'),
(135, '0.001159708416003976', '27'),
(136, '0.001325381046719681', '6'),
(137, '0.001656726308648111', '5'),
(138, '0.001822398939363817', '2'),
(139, '0.002153744201292246', '8'),
(140, '0.002319416832007952', '9'),
(141, '0.002485089463220675', '81'),
(142, '0.002650762093936381', '7'),
(143, '0.002816434724652087', '11'),
(144, '0.003147779986580516', '11'),
(145, '0.003313452617296222', '114'),
(146, '0.003644797879224652', '11'),
(147, '0.003810470509940357', '26'),
(148, '0.004141815771868787', '56'),
(149, '0.004307488402584493', '11'),
(150, '0.004638833664512922', '15'),
(151, '0.004804506295228628', '34'),
(152, '0.005135851557157057', '1'),
(153, '0.000248508946322067', '17'),
(154, '0.001242544731610337', '10'),
(155, '0.002733598409542743', '1'),
(156, '0.002857852882703777', '20'),
(157, '0.003354870775347912', '18'),
(158, '0.003727634194831013', '2'),
(159, '0.000099403578528827', '8'),
(160, '0.001093439363817097', '8'),
(161, '0.001192842942345924', '1'),
(162, '0.001590457256461232', '1'),
(163, '0.001689860834990059', '3'),
(164, '0.002286282306163021', '16'),
(165, '0.003081510934393638', '3'),
(166, '0.001573889993041749', '1'),
(167, '0.000071002555666003', '1'),
(168, '0.000213007667992047', '2'),
(169, '0.000426015336481113', '7'),
(170, '0.000852030672962226', '6'),
(171, '0.001207043453280318', '2'),
(172, '0.002130076682405566', '3'),
(173, '0.000372763419483101', '4'),
(174, '0.000552242102882703', '2'),
(175, '0.001546277888170974', '3'),
(176, '0.000447316103379721', '5'),
(177, '0.000596421471172962', '1'),
(178, '0.000695825049701789', '2'),
(179, '0.000894632206759443', '2'),
(180, '0.001143141153081510', '7'),
(181, '0.000090366889165009', '86'),
(182, '0.000135550333996023', '77'),
(183, '0.000180733778827037', '139'),
(184, '0.000225917223658051', '326'),
(185, '0.000271100668489065', '59'),
(186, '0.000316284113320079', '77'),
(187, '0.000361467558151093', '71'),
(188, '0.004802119555886736', '14'),
(189, '0.004967709885742672', '537'),
(190, '0.005133300215101838', '318'),
(191, '0.000124192747143566', '62'),
(192, '0.000248385494287133', '15'),
(193, '0.000372578241430700', '18'),
(194, '0.000496770988574267', '60'),
(195, '0.000620963735717834', '153'),
(196, '0.000745156482861400', '50'),
(197, '0.000869349230004967', '41'),
(198, '0.000275983882265275', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
