<? 
	include("../includes/Config.php");
	foreach ($_POST as $campo => $valor) $$campo = processaString($valor);
	
	$Config = array(
		'arquivo'=>'loja_categorias',
		'tabela'=>'tbloja_categorias',
		'titulo'=>'categoria',
		'id'=>'id_categoria',
		'urlfixo'=>'', 
		'pasta'=>'loja',
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
		if (strlen($categoria) < 1) $Erros .= "Por favor, insira a categoria";


		# Se houver erro, SAI
		if (strlen($Erros)) { header('Location: ../sys/'.$Config['arquivo'].'_dados.php?ID='.$$cnf['id'].$Config['urlfixo'].'&erro='.urlencode("<b>Preencha os campos a seguir corretamente:</b>".$Erros),true); exit; }


		# Dados
		$dados = array('categoria'=>$categoria);





		# Executando 
		if ($$Config['id']>0) {


			db_executa($Config['tabela'],$dados,'update', $Config['id'].'='.$$Config['id']);

		} else {

			$dados['id_categoria']=$_SESSION['Admin']['id_categoria'];
			db_executa($Config['tabela'],$dados);

		}


		header("Location: ../sys/".$Config['arquivo'].".php?msg=".urlencode('Operação efetuada com sucesso!.'),true); exit;

	}












	// -----------------------------------------------------------------------------------------------------------
	// Excluir um registro e seus arquivos
	// -----------------------------------------------------------------------------------------------------------
	if ($_GET['faz']=="excluir") {
		$id=(int)$_GET['id'];
		if ($id>0) {


			#Excluindo do Banco de dados
			db_consulta("DELETE FROM ".$Config['tabela']." WHERE ".$Config['id']."=".$id);
			header("Location: ../sys/".$Config['arquivo'].".php?msg=".urlencode('Excluido com sucesso.'),true); exit;

		}
	}






	// -----------------------------------------------------------------------------------------------------------
	// Apaga vários itens de uma vez só
	// -----------------------------------------------------------------------------------------------------------
	if ($_GET['faz']=="excluir_massa") {
	
		if (is_array($check)) 
		foreach ($check as $id) {
			if ($id>0) {

				# Excluindo do Bando de dados
				db_consulta("DELETE FROM ".$Config['tabela']." WHERE ".$Config['id']."=".$id);

				# Histórico
				cadHistorico(ID_MODULO,4,$id);

			}
		}
		header("Location: ../sys/".$Config['arquivo'].".php?msg=".urlencode('Operação efetuada com sucesso!').$Config['urlfixo'],true); exit;
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
	header("Location: ../sys/".$Config['arquivo'].".php?info=".urlencode('Ocorreu um erro durante o processo, por favor tente novamente.'),true); exit;
	
?>