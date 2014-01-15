<? 
	define('ID_MODULO',0,true);
	include("../includes/Config.php");
	foreach ($_POST as $campo => $valor) $$campo = processaString($valor);
	
	$Config = array(
		'arquivo'=>'conteudo',
		'tabela'=>'tbconteudo',
		'titulo'=>'titulo',
		'id'=>'id_conteudo',
		'urlfixo'=>'', 
		'pasta'=>'conteudo',
		'imagem'=>array(
			'x'=>400, 'y'=>400, 'corte'=>0, 
			'mini'=>array(
				'x'=>100, 'y'=>100, 'corte'=>1
			)
		),
	);




	// -----------------------------------------------------------------------------------------------------------
	// Incluir ou alterar dados no banco de dados
	// -----------------------------------------------------------------------------------------------------------
	if ($_GET['faz']=="dados") {


		# Testes
		$Erros='';
		if (  (! validaTipoArquivo($_FILES['imagem']['name'],1)) && (!($id_conteudo>0)) ) $Erros .= "<br>Tipo de arquivo não aceito! Envie JPG, GIF ou PNG";


		# Se houver erro, SAI
		if (strlen($Erros)) { header('Location: ../sys/'.$Config['arquivo'].'_dados.php?ID='.$$cnf['id'].$Config['urlfixo'].'&erro='.urlencode("<b>Dados inválidos:</b>|".$Erros),true); exit; }


		# Dados
		$dados = array('texto'=>$texto);




		# Executando 
		if ($$Config['id']>0) {


			db_executa($Config['tabela'],$dados,'update', $Config['id'].'='.$$Config['id']);

		} else {

			$dados['id_conteudo']=$_SESSION['Admin']['id_conteudo'];
			db_executa($Config['tabela'],$dados);

		}


		header("Location: ../sys/".$Config['arquivo'].".php?msg=".urlencode('Feito.'),true); exit;

	}












	// -----------------------------------------------------------------------------------------------------------
	// Excluir um registro e seus arquivos
	// -----------------------------------------------------------------------------------------------------------
	if ($_GET['faz']=="excluir") {
		$id=(int)$_GET['id'];
		if ($id>0) {

			#Excluindo do Banco de dados
			db_consulta("DELETE FROM ".$Config['tabela']." WHERE ".$Config['id']."=".$id);
			header("Location: ../sys/".$Config['arquivo'].".php?msg=".urlencode('Excluido.'),true); exit;

		}
	}









	// -----------------------------------------------------------------------------------------------------------
	// Alterando flags
	// -----------------------------------------------------------------------------------------------------------
	if ($_GET['faz']=="flag") {
		list($valor) = db_dados("SELECT ".$_GET['flag']." FROM ".$Config['tabela']." WHERE ".$Config['id']."=".(int)$_GET['id']);
		if ($valor==1) $valor='0'; else $valor='1';
		
		db_executa($Config['tabela'],array($_GET['flag']=>$valor),'update', $Config['id'].'='.$_GET['id']);
		header("Location: ".urldecode($_GET['origem'])."?&msg=Atualizado",true); exit;
	}






	// Se nada for feito...
	header("Location: ../sys/".$Config['arquivo'].".php?info=".urlencode('Nada feito'),true); exit;
	
?>