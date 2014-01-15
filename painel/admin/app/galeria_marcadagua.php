<? 
	define('ID_MODULO',0,true);
	include("../includes/Config.php");
	foreach ($_POST as $campo => $valor) $$campo = processaString($valor);
	
	$Config = array(
		'arquivo'=>'galeria_marcadagua',
		'urlfixo'=>'', 
		'pasta'=>'galeria/_marcadagua',
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
		if (  (! validaTipoArquivo($_FILES['imagem']['name'],1)) && (empty($posicao)) ) $Erros .= "- Imagem|";
		if ( !($posicao >= 1 && $posicao <= 7  )) $Erros .= "- Posição|";
		if ( !($opacidade >= 1 && $opacidade <= 100  )) $Erros .= "- Opacidade|";
		if ( !($distancia >= 0 && $distancia <= 300  )) $Erros .= "- Distância da Margem|";


		# Se houver erro, SAI
		if (strlen($Erros)) { header('Location: ../sys/'.$Config['arquivo'].'_dados.php?ID='.$$cnf['id'].$Config['urlfixo'].'&erro='.urlencode("<b>Dados inválidos:</b>|".$Erros),true); exit; }


		# Arquivos
		if (!empty($_FILES['imagem']['name'])) {
			$Arquivo = processaArquivo('imagem',$Config,$_FILES);
			if ($Arquivo==false) { header("Location: ../sys/".$Config['arquivo'].".php?erro=".urlencode('Erro processando Imagem.'),true); exit; }
		}


		# Atualizando BD
		if (!empty($Arquivo)) db_executa('tbgalerias_config',array('valor'=>$Arquivo),'update', "campo LIKE 'marcadagua_arquivo'");
		db_executa('tbgalerias_config',array('valor'=>$posicao),'update', "campo LIKE 'marcadagua_posicao'");
		db_executa('tbgalerias_config',array('valor'=>$opacidade),'update', "campo LIKE 'marcadagua_opacidade'");
		db_executa('tbgalerias_config',array('valor'=>$distancia),'update', "campo LIKE 'marcadagua_distancia'");


		header("Location: ../sys/".$Config['arquivo'].".php?msg=".urlencode('Feito.'),true); exit;

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







	// Se nada for feito...
	header("Location: ../sys/".$Config['arquivo'].".php?info=".urlencode('Nada feito'),true); exit;
	
?>