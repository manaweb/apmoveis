<? 
	define('ID_MODULO',0,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	
	if ($_SESSION['Admin']['id_usuario'] != 1) die('Você não tem permissão para acessar esta página'); 
	

	$Config = array(
		'arquivo'=>'_usuarios',
		'tabela'=>'adm_usuarios',
		'titulo'=>'nome',
		'id'=>'id_usuario',
		'urlfixo'=>'', 
		'pasta'=>'',
	);

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Administradores do site</h2>
                    </div>
<div id="conteudo">


<a id="btnalt"  href="_usuarios_dados.php"><img src="../img/inserir.gif" align="absmiddle" /> Novo administrador</a>
<br />
<br />

<?
	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título		2=>Fonte			3=>Url
		array('texto',		'NOME',			'nome',				''),
		array('texto',		'LOGIN',		'login',			''),
		array('texto',		'CRIPTOGRAFIA',		'senha',			''),
		array('texto',		'&Uacute;LTIMO LOGIN',	'data_login',		''),
		array('texto',		'PERMISS&Otilde;ES',		'acesso',			''),
	);


	# Consulta SQL
	$SQL = "SELECT *, DATE_FORMAT(data_login,'%d/%m/%Y %H:%i:%s') as data_login FROM adm_usuarios WHERE id_usuario NOT LIKE 1 ORDER BY nome ASC";



	# Processando os dados
	$Lista = new Consulta($SQL,20,$PGATUAL);
	while ($linha = db_lista($Lista->consulta)) {

		$linha['acesso'] = '';
		$i=0;
		$modulos = db_consulta("SELECT * FROM adm_menu WHERE dentro_id=0 ORDER BY titulo ASC");
		while ($modulo = db_lista($modulos)) {
			if (usuarioPermissao($linha['id_usuario'],$modulo['id_menu'])) { $i++; 
				if ($i>1) $linha['acesso'].=', ';
				$linha['acesso'] .= utf8_encode($modulo['titulo']);
			}
		}

		$dados[] = $linha;
	}


	# Listando
	echo adminLista($campos,$dados,array('excluir','editar','status'),$Config,false);



	# Paginação
	echo '<div class="paginacao">'.$Lista->geraPaginacao().'</div>';









?>
</div>
<? include('../includes/Rodape.php'); ?>