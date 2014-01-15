<? 
	define('ID_MODULO',0,true);
	include("../includes/Config.php");
	foreach ($_POST as $campo => $valor) $$campo = processaString($valor);
	#print_r($_POST); exit;
	if ($_SESSION['Admin']['id_usuario'] != 1) die('Você não tem permissão para acessar esta página'); 

	
	$Config = array(
		'arquivo'=>'_usuarios',
		'tabela'=>'adm_usuarios',
		'titulo'=>'nome',
		'id'=>'id_usuario',
		'urlfixo'=>'', 
		'pasta'=>'',
	);



	// -----------------------------------------------------------------------------------------------------------
	// Incluir ou alterar dados no banco de dados
	// -----------------------------------------------------------------------------------------------------------
	if ($_GET['faz']=="dados") {


		# Testes
		$Erros='';
		if (strlen($nome) < 2) $Erros .= "- Nome|";
		if (strlen($login) < 2) $Erros .= "- Login|";
		if (  (empty($senha)) && (!($$Config['id']>0)) ) $Erros .= "- Senha|";


		# Se houver erro, SAI
		if (strlen($Erros)) { header('Location: ../sys/'.$Config['arquivo'].'_dados.php?ID='.$$cnf['id'].$Config['urlfixo'].'&erro='.urlencode("<b>Dados inválidos:</b>|".$Erros).$Config['urlfixo'],true); exit; }


		# Dados
		$dados = array(	'nome'=>$nome, 'login'=>$login, 'email'=>$email, 'flag_status'=>$flag_status);
		if (strlen($senha)>3) $dados['senha']=md5($senha);


		# Executando 
		if ($$Config['id']>0) {

			db_executa($Config['tabela'],$dados,'update', $Config['id'].'='.$$Config['id']);

		} else {

			$dados['data_login']='now()';
			db_executa($Config['tabela'],$dados);
			$$Config['id'] = db_insert_id();

		}


		# Permissões
		db_consulta("DELETE FROM adm_permissoes WHERE id_usuario=".$$Config['id']);
		foreach ($permissoes as $valor) {
			if ($valor > 0) db_executa('adm_permissoes',array('id_usuario'=>$$Config['id'], 'id_menu'=>$valor));
		
		}



		header("Location: ../sys/".$Config['arquivo'].".php?msg=".urlencode('Feito.').$Config['urlfixo'],true); exit;

	}












	// -----------------------------------------------------------------------------------------------------------
	// Excluir um registro e seus arquivos
	// -----------------------------------------------------------------------------------------------------------
	if ($_GET['faz']=="excluir") {
		$id=(int)$_GET['id'];
		if ($id>0) {

			# Apagando vínculos 
			db_consulta("DELETE FROM adm_permissoes WHERE id_usuario=".$id);
			db_consulta("DELETE FROM adm_historico WHERE id_usuario=".$id);

			# Excluindo do Banco de dados
			db_consulta("DELETE FROM ".$Config['tabela']." WHERE ".$Config['id']."=".$id);
			header("Location: ../sys/".$Config['arquivo'].".php?msg=".urlencode('Excluido.').$Config['urlfixo'],true); exit;

		}
	}









	// -----------------------------------------------------------------------------------------------------------
	// Apaga vários itens de uma vez só
	// -----------------------------------------------------------------------------------------------------------
	if ($_GET['faz']=="excluir_massa") {
		if (is_array($check)) 
		foreach ($check as $id) {
			if ($id>0) {

				# Apagando vínculos 
				db_consulta("DELETE FROM adm_permissoes WHERE id_usuario=".$id);
				db_consulta("DELETE FROM adm_historico WHERE id_usuario=".$id);

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
		header("Location: ".urldecode($_GET['origem'])."?&msg=Atualizado".$Config['urlfixo'],true); exit;
	}






	// Se nada for feito...
	header("Location: ../sys/".$Config['arquivo'].".php?info=".urlencode('Nada feito').$Config['urlfixo'],true); exit;
	
?>