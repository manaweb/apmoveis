<?php
	header('Content-type:text/html;charset=ISO-8859-1');
	define('ID_MODULO',0,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	include('../includes/tinyMCE_advanced.php');

	if ($_SESSION['Admin']['id_usuario'] != 1) die('Você não tem permissão para acessar esta página'); 

	$Config = array(
		'arquivo'=>'_usuarios',
		'tabela'=>'adm_usuarios',
		'titulo'=>'nome',
		'id'=>'id_usuario',
		'urlfixo'=>'', 
		'pasta'=>'',
	);


	if ($_GET['ID']>0) $dados = db_dados("SELECT * FROM ".$Config['tabela']." WHERE ".$Config['id']."=".(int)$_GET['ID']." LIMIT 1;");
	$dados['senha']='';

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Editar administrador</h2>
                    </div>
<div id="conteudo">
<?

 

	# Status
	if ($dados['flag_status']=='') $dados['flag_status']=1;


	# Montando os Dados
	$campos = array(
		#	0=>Tipo			1=>Titulo		2=>Nome Campo		3=>Tamanho(px)	4=>CampoExtra		5=>Comentário								6=>Atributos
		array('text',		'Nome',			'nome',				'500',			'',					'',											''),
		array('text',		'Login',		'login',			'200',			'',					'',											''),
		array('password',	'Senha',		'senha',			'200',			'',					'',											''),
		array('text',		'E-mail',		'email',			'500',			'',					'',											''),
		array('flag',		'Ativo?',		'flag_status',		'500',			'',					'',											''),
		array('manual',		'Permiss&otilde;es',	'permissoes',		'500',			'',					'',											''),
	);


	# Permissões
	$dados['permissoes'] = '';
	$consulta = db_consulta("SELECT * FROM adm_menu WHERE dentro_id=0 ORDER BY titulo ASC");
	while ($linha = db_lista($consulta)) {
		$dados['permissoes'].='<label><input type=checkbox name="permissoes[]" value="'.$linha['id_menu'].'"';
		if (usuarioPermissao($dados['id_usuario'],$linha['id_menu'])) $dados['permissoes'].= ' checked="checked" ';
		$dados['permissoes'].='> '.utf8_encode($linha['titulo']).'</label><br />';
	}

	# Exibindo os campos
	echo adminCampos($campos,$Config,$dados);






?>
</div>
<?
	include('../includes/Rodape.php');
?>