<? 
	define('ID_MODULO',0,true);
	include("../includes/Config.php");
	foreach ($_POST as $campo => $valor) $$campo = processaString($valor);
	
	$Config = array(
		'arquivo'=>'galeria',
		'tabela'=>'tbgalerias',
		'titulo'=>'titulo',
		'id'=>'id_galeria',
		'urlfixo'=>'', 
		'pasta'=>'galeria',
		'imagem'=>array(
			'x'=>250, 'y'=>140, 'corte'=>1, 
		),
	);

	function GaleriaConfigValor($s) {
		list($valor) = db_lista(db_consulta("SELECT valor FROM tbgalerias_config WHERE campo LIKE '".$s."' LIMIT 1;"));
		return $valor;
	}




	// -----------------------------------------------------------------------------------------------------------
	// Incluir ou alterar dados no banco de dados
	// -----------------------------------------------------------------------------------------------------------
	if ($_GET['faz']=="dados") {


		# Testes
		$Erros='';
		if (strlen($titulo) < 2) $Erros .= "- Título|";
		if (! validaData($data)) $Erros .= "- Data|";
		if (  (! validaTipoArquivo($_FILES['imagem']['name'],1)) && (!($id_galeria>0)) ) $Erros .= "Tipo de arquivo não aceito! Envie JPG, GIF ou PNG";


		# Se houver erro, SAI
		if (strlen($Erros)) { header('Location: ../sys/'.$Config['arquivo'].'_dados.php?ID='.$$Config['id'].$Config['urlfixo'].'&erro='.urlencode("<b>Dados inválidos:</b>|".$Erros),true); exit; }


		# Dados
		$dados = array( 'titulo'=>$titulo, 'local'=>$local, 'data'=>dataDMY_YMD($data), 'descricao'=>$descricao, 'flag_status'=>$flag_status );


		# Arquivos
		if (!empty($_FILES['imagem']['name'])) {
			$Capa = processaArquivo('imagem',$Config,$_FILES);
			if ($Capa==false) { header("Location: ../sys/".$Config['arquivo'].".php?erro=".urlencode('Erro processando Imagem.'),true); exit; }
		}


		# Se for adicionar, crias as pastas, etc
		if ($$Config['id']>0) {
		
			list($codigo) = db_lista(db_consulta("SELECT codigo FROM ".$Config['tabela']." WHERE ".$Config['id']."=".(int)$$Config['id']));

		} else {

			$codigo = md5(date('Ymdhis').rand(10000,99999));
			$dados['codigo']=$codigo;
			@mkdir('../../arquivos/galeria/'.$codigo.'/');
			@mkdir('../../arquivos/galeria/'.$codigo.'/fotos/');
			@mkdir('../../arquivos/galeria/'.$codigo.'/miniaturas/');

		}
		
		# Capa
		if (strlen($Capa)>5) {
			@unlink('../../arquivos/galeria/'.$codigo.'/capa.jpg');
			@rename('../../arquivos/galeria/'.$Capa,'../../arquivos/galeria/'.$codigo.'/capa.jpg');
		}


		# Executando 
		if ($$Config['id']>0) {

			db_executa($Config['tabela'],$dados,'update', $Config['id'].'='.$$Config['id']);
			header("Location: ../sys/".$Config['arquivo'].".php?msg=".urlencode('Atualizado.'),true); exit;

		} else {

			db_executa($Config['tabela'],$dados);
			header("Location: ../sys/".$Config['arquivo']."_fotos.php?id_galeria=".db_insert_id(),true); exit;

		}


		

	}







	// -----------------------------------------------------------------------------------------------------------
	// Excluir um registro e seus arquivos
	// -----------------------------------------------------------------------------------------------------------
	if ($_GET['faz']=="excluir") {
		$id=(int)$_GET['id'];
		if ($id>0) {

			$galeria = db_dados("SELECT * FROM ".$Config['tabela']." WHERE ".$Config['id']."=".(int)$id);
			if (strlen($galeria['codigo'])==32) {
				apagarDir("../../arquivos/galeria/".$galeria['codigo']."/");
				# Excluindo do Banco de dados
				db_consulta("DELETE FROM ".$Config['tabela']." WHERE ".$Config['id']."=".$id);
				db_consulta("DELETE FROM tbgalerias_fotos WHERE ".$Config['id']."=".$id);

			}
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












	/*	FORMULARIO DE ENVIO DAS FOTOS  */
	if ($_GET['faz']=="fotosForm") {

		# Pegando a pasta da galeria
		list($codigo) = db_lista(db_consulta("SELECT codigo FROM ".$Config['tabela']." WHERE ".$Config['id']."=".(int)$$Config['id']));
		$ArqMarcadagua = GaleriaConfigValor('marcadagua_arquivo');
		if (!empty($ArqMarcadagua)) $ArqMarcadagua = '../../arquivos/galeria/_marcadagua/'.$ArqMarcadagua;
		


		# Testes
		$Erros='';
		if (! ($id_galeria > 0)) $Erros .= "- ID da Galeria|";
		if (strlen($codigo) != 32) $Erros .= "- Pasta da Galeria |";


		# Se houver erro, SAI
		if (strlen($Erros)) { header('Location: ../sys/galeria_fotos.php?id_galeria='.$$Config['id'].'&erro='.urlencode("<b>Dados inválidos:</b>|".$Erros),true); exit; }

		# Pegando as fotos do formulario
		for ($num=1;$num<=8;$num++) {
			if (strlen($_FILES['imagem'.$num]['name']) > 4) {

				$novoArquivo = time().rand(100000,999999).'.'.extensaoArquivo($_FILES['imagem'.$num]['name']);
				$Arquivo = FazerUpload($_FILES['imagem'.$num],"../../arquivos/tmp/");
				if ($Arquivo != false) {
					if (Miniatura("../../arquivos/tmp/".$Arquivo, "../../arquivos/galeria/".$codigo."/miniaturas/".$novoArquivo, 56, 56, 1, 0)) {

						if (Miniatura("../../arquivos/tmp/".$Arquivo, "../../arquivos/galeria/".$codigo."/fotos/".$novoArquivo, 500, 375, 0, 1, $ArqMarcadagua, GaleriaConfigValor('marcadagua_distancia'),GaleriaConfigValor('marcadagua_posicao'),GaleriaConfigValor('marcadagua_opacidade'))) {

							$dados = array('id_galeria'=>$id_galeria, 'imagem'=>$novoArquivo, 'legenda'=>$legenda[$num], 'contador'=>0, 'flag_status'=>1, 'posicao'=>1000);
							db_executa('tbgalerias_fotos',$dados);

						}
					}
				}
			}
		}

		# Saindo		
		header("Location: ../sys/galeria_fotos.php?id_galeria=".$id_galeria."&msg=".urlencode('Feito.'),true); exit;

	}









	/*	FORMULARIO DE ENVIO DAS FOTOS  */
	if ($_GET['faz']=="fotosFtp") {

		# Pegando a pasta da galeria
		list($codigo) = db_lista(db_consulta("SELECT codigo FROM ".$Config['tabela']." WHERE ".$Config['id']."=".(int)$$Config['id']));
		$ArqMarcadagua = GaleriaConfigValor('marcadagua_arquivo');
		if (!empty($ArqMarcadagua)) $ArqMarcadagua = '../../arquivos/galeria/_marcadagua/'.$ArqMarcadagua;


		# Testes
		$Erros='';
		if (! ($id_galeria > 0)) $Erros .= "- ID da Galeria|";
		if (strlen($codigo) != 32) $Erros .= "- Pasta da Galeria |";


		# Se houver erro, SAI
		if (strlen($Erros)) { header('Location: ../sys/galeria_fotos.php?id_galeria='.$$Config['id'].'&erro='.urlencode("<b>Dados Inválidos:</b>|".$Erros),true); exit; }


		# Listando a pasta
		$Arquivos = ListaDiretorio('../../arquivos/ftp/'.$pasta.'/');
		$i=0;
		foreach ($Arquivos as $arquivo) {
			if (validaTipoArquivo($arquivo, 1))  { $i++;

				$novoArquivo = time().rand(100000,999999).'.'.extensaoArquivo($arquivo);
				if (Miniatura('../../arquivos/ftp/'.$pasta.'/'.$arquivo, "../../arquivos/galeria/".$codigo."/miniaturas/".$novoArquivo, 56, 56, 1, 0)) {
	
					if (Miniatura('../../arquivos/ftp/'.$pasta.'/'.$arquivo, '../../arquivos/galeria/'.$codigo.'/fotos/'.$novoArquivo, 500, 375, 0, 1, $ArqMarcadagua, GaleriaConfigValor('marcadagua_distancia'),GaleriaConfigValor('marcadagua_posicao'),GaleriaConfigValor('marcadagua_opacidade'))) {

						$dados = array('id_galeria'=>$id_galeria, 'imagem'=>$novoArquivo, 'legenda'=>$legenda[$num], 'contador'=>0, 'flag_status'=>1, 'posicao'=>1000);
						db_executa('tbgalerias_fotos',$dados);
					}
				}
			}
		}
		
		if ( ($i>0)&& (strlen($pasta)>0) ) apagarDir('../../arquivos/ftp/'.$pasta.'/');

		# Saindo		
		header("Location: ../sys/galeria_fotos.php?id_galeria=".$id_galeria."&msg=".urlencode('Feito.'),true); exit;

	}






	/*	AÇÃO DA LISTAGEM DAS FOTOS  */
	if ($_GET['faz']=="photosAction") {

		# Pegando a pasta da galeria
		list($codigo) = db_lista(db_consulta("SELECT codigo FROM ".$Config['tabela']." WHERE ".$Config['id']."=".(int)$$Config['id']));


		# Testes
		$Erros='';
		if (! ($id_galeria > 0)) $Erros .= "- ID da Galeria|";
		if (strlen($codigo) != 32) $Erros .= "- Pasta da Galeria |";


		# Se houver erro, SAI
		if (strlen($Erros)) { header('Location: ../sys/galeria_fotos.php?id_galeria='.$$Config['id'].'&erro='.urlencode("<b>Dados inválidos:</b>|".$Erros),true); exit; }

		#echo '<pre>'; print_r($_POST); exit;
		if (is_array($foto)) 
		foreach ($foto as $cod => $ativo) {
		
			if ($ativo==1) {

				if ($opcao == 'delete') {

					list($imagem) = db_lista(db_consulta('SELECT imagem FROM tbgalerias_fotos WHERE id_galeria='.(int)$id_galeria.' AND id_foto='.(int)$cod));
					@unlink('../../arquivos/galeria/'.$codigo.'/miniaturas/'.$imagem);
					@unlink('../../arquivos/galeria/'.$codigo.'/fotos/'.$imagem);
					db_consulta('DELETE FROM tbgalerias_fotos WHERE id_galeria='.(int)$id_galeria.' AND id_foto='.(int)$cod);

				} else if ($opcao=='update') {

					$dados = array('posicao'=>$posicao[$cod], 'legenda'=>$legenda[$cod]);
					db_executa('tbgalerias_fotos',$dados,'update','id_galeria='.$id_galeria.' AND id_foto='.$cod);

				} else {
					header("Location: ../sys/galeria_fotos.php?id_galeria=".$id_galeria."&erro=".urlencode('Opção selecionada inválida.'),true); exit;
				}
			}
		}


		# Saindo		
		header("Location: ../sys/galeria_fotos.php?id_galeria=".$id_galeria."&msg=".urlencode('Feito.'),true); exit;

	}













	// Se nada for feito...
	header("Location: ../sys/".$Config['arquivo'].".php?info=".urlencode('Nada feito'),true); exit;
	
?>