<? 
	define('ID_MODULO',0,true);
	include("../Config.php");
	foreach ($_POST as $campo => $valor) $$campo = processaString($valor);

	# Tirar o time limit
	if (function_exists("set_time_limit")==1 and get_cfg_var("safe_mode")==0) @set_time_limit(0);


	$FileName = 'galeria';
	$cnf['id'] = 'id_galeria';
	$cnf['tabela'] = 'tbgalerias';
	
	# Dimensão da Miniatura
	$cnf['capa'] = array('x'=>75, 'y'=>60 );
	$cnf['mini'] = array('x'=>56, 'y'=>56 );
	$cnf['gran'] = array('x'=>500,'y'=>375);

	function GaleriaConfigValor($s) {
		list($valor) = db_lista(db_consulta("SELECT valor FROM tbgalerias_config WHERE campo LIKE '".$s."' LIMIT 1;"));
		return $valor;
	}



	# Marca D'Água
	if ($_GET['faz']=="marcadagua") {

		# Testes
		$Erros='';
		if (! validaTipoArquivo($_FILES['imagem']['name'],1)) $Erros .= "- Imagem|";
		if ( !($posicao >= 1 && $posicao <= 7  )) $Erros .= "- Posição|";
		if ( !($opacidade >= 1 && $opacidade <= 100  )) $Erros .= "- Opacidade|";
		if ( !($distancia >= 1 && $distancia <= 300  )) $Erros .= "- Distância da Margem|";

		# Se houver erro, SAI
		if (strlen($Erros)) { header('Location: ../sys/'.$FileName.'_marcadagua.php?erro='.urlencode("<b>Dados inválidos:</b>|".$Erros),true); exit; }

		# Imagem
		$Arquivo = FazerUpload($_FILES["imagem"],"../../arquivos/galeria/_marcadagua/");
		if ($Arquivo != false) {
			@unlink('../../arquivos/galeria/_marcadagua/'.GaleriaConfigValor('marcadagua_arquivo'));
		} else { header("Location: ../sys/".$FileName."_marcadagua.php?erro=".urlencode('Erro durante upload.'),true); exit; }

		# Atualizando BD
		db_executa('tbgalerias_config',array('valor'=>$Arquivo),'update', "campo LIKE 'marcadagua_arquivo'");
		db_executa('tbgalerias_config',array('valor'=>$posicao),'update', "campo LIKE 'marcadagua_posicao'");
		db_executa('tbgalerias_config',array('valor'=>$opacidade),'update', "campo LIKE 'marcadagua_opacidade'");
		db_executa('tbgalerias_config',array('valor'=>$distancia),'update', "campo LIKE 'marcadagua_distancia'");

		# Saindo
		header("Location: ../sys/".$FileName."_marcadagua.php?msg=".urlencode('Feito.'),true); exit;

	}




	# Marca D'Água
	if ($_GET['faz']=="marcadaguaDelete") {

		@unlink('../../arquivos/galeria/_marcadagua/'.GaleriaConfigValor('marcadagua_arquivo'));
		# Atualizando BD
		db_executa('tbgalerias_config',array('valor'=>''),'update', "campo LIKE 'marcadagua_arquivo'");
		db_executa('tbgalerias_config',array('valor'=>''),'update', "campo LIKE 'marcadagua_posicao'");
		db_executa('tbgalerias_config',array('valor'=>''),'update', "campo LIKE 'marcadagua_opacidade'");
		db_executa('tbgalerias_config',array('valor'=>''),'update', "campo LIKE 'marcadagua_distancia'");

		# Saindo
		header("Location: ../sys/".$FileName."_marcadagua.php?msg=".urlencode('Feito.'),true); exit;

	}






	# INCLUIR/ALTERAR
	if ($_GET['faz']=="dados") {


		# Testes
		$Erros='';
		if (strlen($titulo) < 2) $Erros .= "- Título|";
		if (isData($data)==false) $Erros .= "- Data|";
		if (  (!validaTipoArquivo($_FILES['imagem']['name'],1)) && (!($$cnf['id']>0)) ) $Erros .= "- Imagem|";


		# Se houver erro, SAI
		if (strlen($Erros)) { header('Location: ../sys/'.$FileName.'_dados.php?ID='.$$cnf['id'].'&erro='.urlencode("<b>Dados inválidos:</b>|".$Erros),true); exit; }


		# Dados
		$dados = array(	$cnf['id']=>'', 'titulo'=>$titulo, 'local'=>$local, 'data'=>dataDMY_YMD($data), 'descricao'=>$descricao, 'flag_status'=>$flag_status);


		# Se for adicionar, crias as pastas, etc
		if ($$cnf['id']>0) {
		
			list($codigo) = db_lista(db_consulta("SELECT codigo FROM ".$cnf['tabela']." WHERE ".$cnf['id']."=".(int)$$cnf['id']));
		
		} else {

			$codigo = md5(date('Ymdhis').rand(10000,99999));
			$dados['codigo']=$codigo;
			@mkdir('../../arquivos/galeria/'.$codigo.'/');
			@mkdir('../../arquivos/galeria/'.$codigo.'/fotos/');
			@mkdir('../../arquivos/galeria/'.$codigo.'/miniaturas/');

		}


		# Capa
		if (!empty($_FILES["imagem"]["tmp_name"])) {
			$Arquivo = FazerUpload($_FILES["imagem"],"../../arquivos/tmp/");
			if ($Arquivo != false) {
				@unlink('../../arquivos/galeria/'.$codigo.'/capa.jpg');
				if (Miniatura("../../arquivos/tmp/".$Arquivo, "../../arquivos/galeria/".$codigo."/capa.jpg", $cnf['capa']['x'], $cnf['capa']['y'], 1, 1)) {

					// faz nada

				} else  { header("Location: ../sys/".$FileName."_dados.php?erro=".urlencode('Erro durante o processamento da imagem.'),true); exit; }
			} else { header("Location: ../sys/".$FileName."_dados.php?erro=".urlencode('Erro durante o upload.'),true); exit; }
		}


		# Executando 
		if ($$cnf['id']>0) {

			unset($dados[$cnf['id']]);
			db_executa($cnf['tabela'],$dados,'update', $cnf['id'].'='.$$cnf['id']);
			header("Location: ../sys/".$FileName.".php?msg=".urlencode('Alterado.'),true); exit;

		} else {

			db_executa($cnf['tabela'],$dados);
			header("Location: ../sys/".$FileName.".php?msg=".urlencode('Adicionado.'),true); exit;

		}

	}






	/*	FORMULARIO DE ENVIO DAS FOTOS  */
	if ($_GET['faz']=="fotosForm") {

		# Pegando a pasta da galeria
		list($codigo) = db_lista(db_consulta("SELECT codigo FROM ".$cnf['tabela']." WHERE ".$cnf['id']."=".(int)$$cnf['id']));
		$ArqMarcadagua = GaleriaConfigValor('marcadagua_arquivo');
		if (!empty($ArqMarcadagua)) $ArqMarcadagua = '../../arquivos/galeria/_marcadagua/'.$ArqMarcadagua;
		


		# Testes
		$Erros='';
		if (! ($id_galeria > 0)) $Erros .= "- ID da Galeria|";
		if (strlen($codigo) != 32) $Erros .= "- Pasta da Galeria |";


		# Se houver erro, SAI
		if (strlen($Erros)) { header('Location: ../sys/'.$FileName.'_fotos.php?ID='.$$cnf['id'].'&erro='.urlencode("<b>Dados inválidos:</b>|".$Erros),true); exit; }

		# Pegando as fotos do formulario
		for ($num=1;$num<=8;$num++) {
			if (strlen($_FILES['imagem'.$num]['name']) > 4) {

				$novoArquivo = time().rand(100000,999999).'.'.ExtensaoArquivo($_FILES['imagem'.$num]['name']);
				$Arquivo = FazerUpload($_FILES['imagem'.$num],"../../arquivos/tmp/");
				if ($Arquivo != false) {
					if (Miniatura("../../arquivos/tmp/".$Arquivo, "../../arquivos/galeria/".$codigo."/miniaturas/".$novoArquivo, $cnf['mini']['x'], $cnf['mini']['y'], 1, 0)) {

						if (Miniatura("../../arquivos/tmp/".$Arquivo, "../../arquivos/galeria/".$codigo."/fotos/".$novoArquivo, $cnf['gran']['x'], $cnf['gran']['y'], 0, 1, $ArqMarcadagua, GaleriaConfigValor('marcadagua_distancia'),GaleriaConfigValor('marcadagua_posicao'),GaleriaConfigValor('marcadagua_opacidade'))) {
						
							$dados = array('id_foto'=>'', 'id_galeria'=>$id_galeria, 'imagem'=>$novoArquivo, 'legenda'=>$legenda[$num], 'contador'=>0, 'flag_status'=>1, 'posicao'=>1000);
							db_executa('tbgalerias_fotos',$dados);
						}
					}
				}
			}
		}


		# Saindo		
		header("Location: ../sys/".$FileName."_fotos.php?ID=".$id_galeria."&msg=".urlencode('Feito.'),true); exit;

	}









	/*	FORMULARIO DE ENVIO DAS FOTOS  */
	if ($_GET['faz']=="fotosFtp") {

		# Pegando a pasta da galeria
		list($codigo) = db_lista(db_consulta("SELECT codigo FROM ".$cnf['tabela']." WHERE ".$cnf['id']."=".(int)$$cnf['id']));
		$ArqMarcadagua = GaleriaConfigValor('marcadagua_arquivo');
		if (!empty($ArqMarcadagua)) $ArqMarcadagua = '../../arquivos/galeria/_marcadagua/'.$ArqMarcadagua;


		# Testes
		$Erros='';
		if (! ($id_galeria > 0)) $Erros .= "- ID da Galeria|";
		if (strlen($codigo) != 32) $Erros .= "- Pasta da Galeria |";


		# Se houver erro, SAI
		if (strlen($Erros)) { header('Location: ../sys/'.$FileName.'_fotos.php?ID='.$$cnf['id'].'&erro='.urlencode("<b>Dados Inválidos:</b>|".$Erros),true); exit; }


		# Listando a pasta
		$Arquivos = ListaDiretorio('../../arquivos/ftp/'.$pasta.'/');
		$i=0;
		foreach ($Arquivos as $arquivo) {
			if (  ($arquivo, 1))  { $i++;

				$novoArquivo = time().rand(100000,999999).'.'.ExtensaoArquivo($arquivo);
				if (Miniatura('../../arquivos/ftp/'.$pasta.'/'.$arquivo, "../../arquivos/galeria/".$codigo."/miniaturas/".$novoArquivo, $cnf['mini']['x'], $cnf['mini']['y'], 1, 0)) {
	
					if (Miniatura('../../arquivos/ftp/'.$pasta.'/'.$arquivo, '../../arquivos/galeria/'.$codigo.'/fotos/'.$novoArquivo, $cnf['gran']['x'], $cnf['gran']['y'], 0, 1, $ArqMarcadagua, GaleriaConfigValor('marcadagua_distancia'),GaleriaConfigValor('marcadagua_posicao'),GaleriaConfigValor('marcadagua_opacidade'))) {

						$dados = array('id_foto'=>'', 'id_galeria'=>$id_galeria, 'imagem'=>$novoArquivo, 'legenda'=>$legenda[$num], 'contador'=>0, 'flag_status'=>1, 'posicao'=>1000);
						db_executa('tbgalerias_fotos',$dados);
					}
				}
			}
		}
		
		if ( ($i>0)&& (strlen($pasta)>0) ) apagarDir('../../arquivos/ftp/'.$pasta.'/');

		# Saindo		
		header("Location: ../sys/".$FileName."_fotos.php?ID=".$id_galeria."&msg=".urlencode('Feito.'),true); exit;

	}






	/*	AÇÃO DA LISTAGEM DAS FOTOS  */
	if ($_GET['faz']=="photosAction") {

		# Pegando a pasta da galeria
		list($codigo) = db_lista(db_consulta("SELECT codigo FROM ".$cnf['tabela']." WHERE ".$cnf['id']."=".(int)$$cnf['id']));


		# Testes
		$Erros='';
		if (! ($id_galeria > 0)) $Erros .= "- ID da Galeria|";
		if (strlen($codigo) != 32) $Erros .= "- Pasta da Galeria |";


		# Se houver erro, SAI
		if (strlen($Erros)) { header('Location: ../sys/'.$FileName.'_fotos.php?ID='.$$cnf['id'].'&erro='.urlencode("<b>Dados inválidos:</b>|".$Erros),true); exit; }

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
					header("Location: ../sys/".$FileName."_fotos.php?ID=".$id_galeria."&erro=".urlencode('Opção selecionada inválida.'),true); exit;
				}
			}
		}


		# Saindo		
		header("Location: ../sys/".$FileName."_fotos.php?ID=".$id_galeria."&msg=".urlencode('Feito.'),true); exit;

	}





	/*	DELETAR  GALERIA  !! apagarDir !! */
	if ($_GET['faz']=="deletar") {

		if ((int)$_GET['id']>0) {

			# Apagando imagem atual
			$galeria = db_lista(db_consulta("SELECT * FROM ".$cnf['tabela']." WHERE ".$cnf['id']."=".(int)$_GET['id']));
			if (strlen($galeria['codigo'])==32) {
				apagarDir("../../arquivos/galeria/".$galeria['codigo']."/");
				db_consulta("DELETE FROM ".$cnf['tabela']." WHERE ".$cnf['id']."=".(int)$_GET['id']);
				db_consulta("DELETE FROM tbgalerias_fotos WHERE ".$cnf['id']."=".(int)$_GET['id']);
			}

			header("Location: ../sys/".$FileName.".php?msg=".urlencode('Apagado.'),true); exit;

		} else {
			header("Location: ../sys/".$FileName.".php?erro=".urlencode('Erro!'),true); exit;
		}

	}






	/*	Alterando FLAG STATUS */
	if (($_GET['faz']=="status")&&($_GET['id']>0)&&(($_GET['atual']=="0")||($_GET['atual']=="1"))) {
		if ($_GET['atual']==1) $novo = "0"; else $novo = "1";
		db_executa($cnf['tabela'],array('flag_status'=>$novo),'update', $cnf['id'].'='.$_GET['id']);
		header("Location: ".urldecode($_GET['origem'])."?&msg=Atualizado",true); exit;
	}








	// Se nada for feito...
	header("Location: ../sys/".$FileName.".php",true); exit;
	
?>