<? 
	define('ID_MODULO',0,true);
	include("../includes/Config.php");
	foreach ($_POST as $campo => $valor) $$campo = processaString($valor);
	#print_r($_POST); exit;


	$Config = array(
		'arquivo'=>'_historico',
		'tabela'=>'adm_historico',
		'titulo'=>'titulo',
		'id'=>'id_historico',
		'urlfixo'=>'&usuario='.$_GET['usuario'], 
		'pasta'=>'',
	);




	// -----------------------------------------------------------------------------------------------------------
	// Excluir um registro e seus arquivos
	// -----------------------------------------------------------------------------------------------------------
	if ($_GET['faz']=="excluir") {
		$id=(int)$_GET['id'];
		if ($id>0) {

			# Excluindo do Bando de dados
			db_consulta("DELETE FROM ".$Config['tabela']." WHERE ".$Config['id']."=".$id);

			header("Location: ../sys/".$Config['arquivo'].".php?msg=".urlencode('Exclu�do.').$Config['urlfixo'],true); exit;

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








	// Se nada for feito...
	header("Location: ../sys/".$Config['arquivo'].".php?info=".urlencode('Nada feito'),true); exit;
	
?>