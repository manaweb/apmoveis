<? 
	define('ID_MODULO',0,true);
	include("../../../php/config/config.php");
	include("../includes/Config.php");
	foreach ($_POST as $campo => $valor) $$campo = processaString($valor);
	#print_r($_POST); exit;


	$Config = array(
		'arquivo'=>'produtos_subcategorias',
		'tabela'=>'tbprodutos_subcategorias',
		'nome'=>'subcategorias',
		'id'=>'id_subcategoria',
		'urlfixo'=>'', 
		'pasta'=>'',
	);



	// -----------------------------------------------------------------------------------------------------------
	// Incluir ou alterar dados no banco de dados
	// -----------------------------------------------------------------------------------------------------------
	if ($_GET['faz']=="dados") {

		# Testes
		$Erros='';
		//if (strlen($subcategoria) < 2) $Erros .= "- Categoria|";
		//if ((!$dimx>10)) $Erros .= "- Largura X|";
		//if (!($dimy>10)) $Erros .= "- Largura Y|";
		//if ( (empty($_FILES['arquivo']['name'])) && (!($$Config['id']>0)) ) $Erros .= "Selecione uma imagem";
		//if (  (! validaTipoArquivo($_FILES['imagem']['name'],1)) ) $Erros .= "<br>Tipo de arquivo n&atilde;o aceito! Envie JPG, GIF ou PNG";


		# Se houver erro, SAI
		//if (strlen($Erros)) { header('Location: ../sys/'.$Config['arquivo'].'_dados.php?ID='.$$cnf['id'].$Config['urlfixo'].'&erro='.urlencode("<b>Dados inv&aacute;lidos:</b>|".$Erros).$Config['urlfixo'],true); exit; }


		# Dados
		$dados = array('subcategoria'=>$subcategoria, 'categoria'=>$categoria);

		# Executando 
		if ($$Config['id']>0) {
			
			# Apagando a Imagem se houver uma nova cadastrada
			//if (strlen($dados['arquivo'])>0) db_apagaArquivo('arquivo',$Config,$$Config['id']);

			db_executa($Config['tabela'],$dados,'update', $Config['id'].'='.$$Config['id']);

		} else {

			db_executa($Config['tabela'],$dados);

			# Hist�rico
			cadHistorico(ID_MODULO,1,db_insert_id());
		}


		header("Location: ../sys/".$Config['arquivo'].".php?msg=".urlencode('Feito.').$Config['urlfixo'],true); exit;

	}







	// -----------------------------------------------------------------------------------------------------------
	// Excluir um registro e seus arquivos
	// -----------------------------------------------------------------------------------------------------------
	if ($_GET['faz']=="excluir") {
		$id=(int)$_GET['id'];
		if ($id>0) {

			# Apagando os arquivos 
			//db_apagaArquivo('arquivo',$Config,$id);

			# Excluindo do Bando de dados
			db_consulta("DELETE FROM ".$Config['tabela']." WHERE ".$Config['id']."=".$id);
			db_consulta("DELETE FROM tbprodutos where id_subcategoria = ".$id);

			# Hist�rico
			cadHistorico(ID_MODULO,4,$id);

			header("Location: ../sys/".$Config['arquivo'].".php?msg=".urlencode('Exclu&iacute;do.').$Config['urlfixo'],true); exit;

		}
	}









	// -----------------------------------------------------------------------------------------------------------
	// Apaga v�rios itens de uma vez s�
	// -----------------------------------------------------------------------------------------------------------
	if ($_GET['faz']=="excluir_massa") {
		if (is_array($check)) 
		foreach ($check as $id) {
			if ($id>0) {

				# Apagando os arquivos 
				//db_apagaArquivo('arquivo',$Config,$id);
	
				# Excluindo do Bando de dados
				db_consulta("DELETE FROM ".$Config['tabela']." WHERE ".$Config['id']."=".$id);

				# Hist�rico
				cadHistorico(ID_MODULO,4,$id);

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
		
		# Hist�rico
		cadHistorico(ID_MODULO,3,$_GET['id']);

		db_executa($Config['tabela'],array($_GET['flag']=>$valor),'update', $Config['id'].'='.$_GET['id']);
		header("Location: ".urldecode($_GET['origem'])."?&msg=Atualizado".$Config['urlfixo'],true); exit;
	}






	// Se nada for feito...
	header("Location: ../sys/".$Config['arquivo'].".php?info=".urlencode('Nada feito').$Config['urlfixo'],true); exit;
	
?>