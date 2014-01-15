<? 
	define('ID_MODULO',0,true);
	include("../includes/Config.php");
	foreach ($_POST as $campo => $valor) $$campo = processaString($valor);
	
	$Config = array(
		'arquivo'=>'configuracoes',
		'tabela'=>'tbconfiguracoes',
		'titulo'=>'nomesite',
		'id'=>'id_config',
		'urlfixo'=>'', 
		'pasta'=>'configuracoes',
		'imagem'=>array(
			'x'=>320, 'y'=>190, 'corte'=>1, 
			#'mini'=>array(
			#	'x'=>155, 'y'=>250, 'corte'=>1
			#)
		),
	);




	// -----------------------------------------------------------------------------------------------------------
	// Incluir ou alterar dados no banco de dados
	// -----------------------------------------------------------------------------------------------------------
	if ($_GET['faz']=="dados") {


		# Testes
		$Erros='';
		if (  (! validaTipoArquivo($_FILES['imagem']['name'],1)) && (!($id_config>0)) ) $Erros .= "<br>Tipo de arquivo não aceito! Envie JPG, GIF ou PNG";


		# Se houver erro, SAI
		if (strlen($Erros)) { header('Location: ../sys/'.$Config['arquivo'].'.php?ID='.$$cnf['id'].$Config['urlfixo'].'&erro='.urlencode("<b>Dados inválidos:</b>|".$Erros),true); exit; }


		# Dados
		$dados = array( 'id_config'=>$id_config, 'nomesite'=>$nomesite, 'slogansite'=>$slogansite, 'emailsite'=>$emailsite, 'telefone1'=>$telefone1, 'telefone2'=>$telefone2, 'telefone3'=>$telefone3, 'produtoservico'=>$produtoservico, 'pagseguro'=>$pagseguro, 'token'=>$token, 'twitter'=>$twitter, 'facebook'=>$facebook, 'youtube'=>$youtube, 'corsite'=>$corsite, 'endereco'=>$endereco, 'url'=>$url);


		# Arquivos
		if (!empty($_FILES['imagem']['name'])) {
			$dados['imagem'] = processaArquivo('imagem',$Config,$_FILES);
			if ($dados['imagem']==false) { header("Location: ../sys/".$Config['arquivo'].".php?erro=".urlencode('Erro ao processar a imagem.'),true); exit; }
		}


		# Executando 
		if ($$Config['id']>0) {

			# Apagando a Imagem se houver uma nova cadastrada
			if (strlen($dados['imagem'])>0) db_apagaArquivo('imagem',$Config,$$Config['id']);

			db_executa($Config['tabela'],$dados,'update', $Config['id'].'='.$$Config['id']);

		} else {

			$dados['id_config']=$_SESSION['Admin']['id_config'];
			db_executa($Config['tabela'],$dados);
			
			# Cadastrar novo endereço
			$dados_end = array('id_config'=>$id_config);


		}


		header("Location: ../sys/".$Config['arquivo'].".php?msg=".urlencode('Sucesso.'),true); exit;

	}


 



	// Se nada for feito...
	header("Location: ../sys/".$Config['arquivo'].".php?ID=1&info=".urlencode('Ocorreu um erro, tente novamente!'),true); exit;
	
?>