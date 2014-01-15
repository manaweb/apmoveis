<? 
	define('ID_MODULO',9,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	include('../includes/tinyMCE_advanced.php');

	$Config = array(
		'arquivo'=>'galeria_marcadagua',
		'urlfixo'=>'', 
		'pasta'=>'galeria/_marcadagua',
	);

	function GaleriaConfigValor($s) {
		list($valor) = db_lista(db_consulta("SELECT valor FROM tbgalerias_config WHERE campo LIKE '".$s."' LIMIT 1;"));
		return $valor;
	}

	$dados = array(	'imagem'=>GaleriaConfigValor('marcadagua_arquivo'), 
					'posicao'=>GaleriaConfigValor('marcadagua_posicao'),
					'opacidade'=>GaleriaConfigValor('marcadagua_opacidade'), 
					'distancia'=>GaleriaConfigValor('marcadagua_distancia')
				);


?>
<div id="acessibilidade">
	Voc&ecirc; est&aacute; aqui: <a href="galeria.php">Galeria</a> &rsaquo; Marca D'&Aacute;gua
</div>
<div id="conteudo">
<?

	include('../includes/Mensagem.php');


	if (!empty($dados['arquivo'])) { ?>
    	<input type=button value="Deletar Marca D'Água" onclick="window.location='../app/galeria.php?faz=marcadaguaDelete';"><br><br>
    <? } 

	if ($dados['posicao']=="") $dados['posicao']=7;
	if ($dados['opacidade']=="") $dados['opacidade']=100;
	if ($dados['distancia']=="") $dados['distancia']=0;


	# Posições da Marca D'Agua
	$Posicoes = array('Superior, Esquerda'=>1, 'Superior, Centro'=>2,'Superior, Direita'=>3,'Centro'=>4,'Inferior, Esquerda'=>5,'Inferior, Centro'=>6,'Inferior, Direita'=>7);


	# Montando os Dados
	$campos = array(
		#	0=>Tipo			1=>Titulo		2=>Nome Campo		3=>Tamanho(px)	4=>CampoExtra		5=>Comentário								6=>Atributos
		array('select',		'Posição',		'posicao',			'200',			$Posicoes,			'',											''),
		array('text',		'Opacidade',	'opacidade',		'100',			'',					'',											''),
		array('text',		'Distância',	'distancia',		'100',			'',					'',											''),
		array('file',		'Imagem',		'imagem',			'350',			1,					'',											''),
	);


	# Exibindo os campos
	echo adminCampos($campos,$Config,$dados);






?>
</div>
<?
	include('../includes/Rodape.php');
?>