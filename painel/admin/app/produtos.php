<? 
	define('ID_MODULO',0,true);
	include("../../../php/config/config.php");
	include("../includes/Config.php");
	foreach ($_POST as $campo => $valor) $$campo = processaString($valor);
	#print_r($_POST); exit;


	$Config = array(
		'arquivo'=>'produtos',
		'tabela'=>'tbprodutos',
		'titulo'=>'produtos',
		'id'=>'id',
		'urlfixo'=>'', 
		'pasta'=>'produtos',
		'imagem'=>array(
			'x'=>1920, 'y'=>1080, 'corte'=>0, 
			'mini'=>array(
				'x'=>193, 'y'=>193, 'corte'=>1
			)
		)
	);

	$Config2 = array(
		'arquivo'=>'produtos',
		'tabela'=>'tbprodutos',
		'titulo'=>'produtos',
		'id'=>'id',
		'urlfixo'=>'', 
		'pasta'=>'produtos_mini',
		'imagem'=>array(
			'x'=>80, 'y'=>80, 'corte'=>1,
			'mini'=>array(
				'x'=>80, 'y'=>80, 'corte'=>1
			)
		)
	);



	// -----------------------------------------------------------------------------------------------------------
	// Incluir ou alterar dados no banco de dados
	// -----------------------------------------------------------------------------------------------------------
	if ($_GET['faz']=="dados") {
		# Testes
		$Erros='';
		//if (strlen($nome) < 2) $Erros .= "- Nome|";
		//if ((!$dimx>10)) $Erros .= "- Largura X|";
		//if (!($dimy>10)) $Erros .= "- Largura Y|";
		//if ( (empty($_FILES['foto1']['name']) && empty($_FILES['foto4']['name']) && empty($_FILES['foto3']['name']) && empty($_FILES['foto2']['name'])) && (!($$Config['id']>0)) ) $Erros .= "Selecione uma imagem";
		//if (  (! validaTipoArquivo($_FILES['imagem']['name'],1)) ) $Erros .= "<br>Tipo de arquivo n&atilde;o aceito! Envie JPG, GIF ou PNG";


		# Se houver erro, SAI
		if (strlen($Erros)) { header('Location: ../sys/'.$Config['arquivo'].'_dados.php?ID='.$$cnf['id'].$Config['urlfixo'].'&erro='.urlencode("<b>Dados inv&aacute;lidos:</b>|".$Erros).$Config['urlfixo'],true); exit; }
			$checkbox = null;
			for($i = 0; $i < sizeof($variacoes); $i++){
				if($i == 0)
					$checkbox .= " ".$variacoes[$i];
				else
					$checkbox .= "; ".$variacoes[$i];
			}
			$dados = array('id_subcategoria'=>$id_subcategoria, 'nome'=>$nome, /*'preco'=>$preco,*/ 'descricao'=>$descricao, 'emOferta' => $emOferta);
		# Arquivo
		for($i = 1; $i <= 5; $i++){
			if (!empty($_FILES["foto$i"]['name'])) {
				$dados["foto$i"] = processaArquivo("foto$i",$Config,$_FILES,1,'imagem');
				echo Miniatura("../../arquivos/tmp/".$dados["foto$i"] , "../../arquivos/".$Config2['pasta']."/_miniaturas/".$dados["foto$i"], $Config2['imagem']['mini']['x'], $Config2['imagem']['mini']['y'], $Config2['imagem']['mini']['corte'], 0);
				if ($dados["foto$i"] == false) { header("Location: ../sys/".$Config2['arquivo'].".php?erro=".urlencode('Erro processando Imagem.'),true); exit; }
			}	
		}	
		
		# Executando 
		if ($$Config['id']>0) {
				# Apagando a Imagem se houver uma nova cadastrada
			for($i = 1; $i <= 5; $i++){
				if (strlen($dados["foto$i"])>0) {
					db_apagaArquivo("foto$i",$Config,$$Config['id']);
					db_apagaArquivo("foto$i",$Config2,$$Config['id']);
				}
			}
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
			for($i = 1; $i <= 5; $i++){
				db_apagaArquivo("foto$i",$Config,$$Config['id']);
			}
			# Excluindo do Bando de dados
			db_consulta("DELETE FROM ".$Config['tabela']." WHERE ".$Config['id']."=".$id);
			db_consulta("DELETE FROM ".$Config2['tabela']." WHERE ".$Config2['id']."=".$id);

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
				for($i = 1; $i <= 5; $i++){ 
					db_apagaArquivo("foto$i",$Config,$id);
				}
	
				# Excluindo do Bando de dados
				db_consulta("DELETE FROM ".$Config['tabela']." WHERE ".$Config['id']."=".$id);
				db_consulta("DELETE FROM ".$Config2['tabela']." WHERE ".$Config2['id']."=".$id);

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