<? 
	define('ID_MODULO',0,true);
	include("../includes/Config.php");
	foreach ($_POST as $campo => $valor) $$campo = processaString($valor);
	
	$Config = array(
		'arquivo'=>'produtos_categorias',
		'tabela'=>'tbprodutos_categorias',
		'titulo'=>'categoria',
		'id'=>'id_categoria',
		'urlfixo'=>'', 
		'pasta'=>'',
	);




	// -----------------------------------------------------------------------------------------------------------
	// Incluir ou alterar dados no banco de dados
	// -----------------------------------------------------------------------------------------------------------
	if ($_GET['faz']=="dados") {


		# Testes
		$Erros='';
		if (strlen($categoria) < 2) $Erros .= "Por favor, insira a categoria";


		# Se houver erro, SAI
		if (strlen($Erros)) { header('Location: ../sys/'.$Config['arquivo'].'_dados.php?ID='.$$cnf['id'].$Config['urlfixo'].'&erro='.urlencode("<b>Preencha os campos a seguir corretamente:</b>".$Erros),true); exit; }


		# Dados
		$dados = array('categoria'=>$categoria);





		# Executando 
		if ($$Config['id']>0) {


			db_executa($Config['tabela'],$dados,'update', $Config['id'].'='.$$Config['id']);

		} else {
			db_executa($Config['tabela'],$dados);

		}


		header("Location: ../sys/".$Config['arquivo'].".php?msg=".urlencode('Opera&ccedil;&atilde;o efetuada com sucesso!.'),true); exit;

	}












	// -----------------------------------------------------------------------------------------------------------
	// Excluir um registro e seus arquivos
	// -----------------------------------------------------------------------------------------------------------
	if ($_GET['faz']=="excluir") {
		$id=(int)$_GET['id'];
		if ($id>0) {


			#Excluindo do Banco de dados
			db_consulta("DELETE FROM ".$Config['tabela']." WHERE ".$Config['id']."=".$id);
			$resultSubcategorias = db_consulta("select * from tbprodutos_subcategorias where categoria = ".$id);
			while($dados = mysql_fetch_array($resultSubcategorias)){
				db_consulta("DELETE FROM tbprodutos where id_subcategoria = ".$dados['id_subcategoria']);
				db_consulta("DELETE FROM tbprodutos_subcategorias where id_subcategoria = ".$dados['id_subcategoria']);	
			} 
			header("Location: ../sys/".$Config['arquivo'].".php?msg=".urlencode('Exclu&iacute;do com sucesso.'),true); exit;

		}
	}






	// -----------------------------------------------------------------------------------------------------------
	// Apaga v�rios itens de uma vez s�
	// -----------------------------------------------------------------------------------------------------------
	if ($_GET['faz']=="excluir_massa") {
	
		if (is_array($check)) 
		foreach ($check as $id) {
			if ($id>0) {

				# Excluindo do Bando de dados
				db_consulta("DELETE FROM ".$Config['tabela']." WHERE ".$Config['id']."=".$id);

				# Hist�rico
				cadHistorico(ID_MODULO,4,$id);

			}
		}
		header("Location: ../sys/".$Config['arquivo'].".php?msg=".urlencode('Opera��o efetuada com sucesso!').$Config['urlfixo'],true); exit;
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