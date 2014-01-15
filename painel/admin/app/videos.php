<? 
	define('ID_MODULO',0,true);
	include("../includes/Config.php");
	foreach ($_POST as $campo => $valor) $$campo = processaString($valor);
	
	$Config = array(
		'arquivo'=>'videos',
		'tabela'=>'tbvideos',
		'titulo'=>'titulo',
		'id'=>'id_video',
		'urlfixo'=>'', 
		'pasta'=>'videos',
 
	);




	// -----------------------------------------------------------------------------------------------------------
	// Incluir ou alterar dados no banco de dados
	// -----------------------------------------------------------------------------------------------------------
	if ($_GET['faz']=="dados") {


		# Testes
		$Erros='';



		# Se houver erro, SAI
		if (strlen($Erros)) { header('Location: ../sys/'.$Config['arquivo'].'_dados.php?ID='.$$cnf['id'].$Config['urlfixo'].'&erro='.urlencode("<b>Dados inv&aacute;lidos:</b>|".$Erros),true); exit; }


		# Dados
		$dados = array( 'id_categoria'=>$id_categoria, 'titulo'=>$titulo, 'video'=>$video, 'descricao'=>$descricao);


	 


		# Executando 
		if ($$Config['id']>0) {

		 

			db_executa($Config['tabela'],$dados,'update', $Config['id'].'='.$$Config['id']);

		} else {

			$dados['id_video']=$_SESSION['Admin']['id_video'];
			db_executa($Config['tabela'],$dados);
			
			# Cadastrar novo endere�o
			$dados_end = array('id_video'=>$id_video);


		}


		header("Location: ../sys/".$Config['arquivo'].".php?msg=".urlencode('Feito.'),true); exit;

	}












	// -----------------------------------------------------------------------------------------------------------
	// Excluir um registro e seus arquivos
	// -----------------------------------------------------------------------------------------------------------
	if ($_GET['faz']=="excluir") {
		$id=(int)$_GET['id'];
		if ($id>0) {
 

			# Excluindo do Bando de dados
			db_consulta("DELETE FROM ".$Config['tabela']." WHERE ".$Config['id']."=".$id);
			header("Location: ../sys/".$Config['arquivo'].".php?msg=".urlencode('Exclu&iacute;do.'),true); exit;

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


			}
		}
		header("Location: ../sys/".$Config['arquivo'].".php?msg=".urlencode('Feito').$Config['urlfixo'],true); exit;
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