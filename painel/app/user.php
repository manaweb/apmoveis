<? 
	define('ID_MODULO',0,true);
	include("../includes/Config.php");
	foreach ($_POST as $campo => $valor) $$campo = processaString($valor);
	
	$Config = array(
		'arquivo'=>'dados_usuario',
		'tabela'=>'user',
		'titulo'=>'nome',
		'id'=>'id',
		'urlfixo'=>'', 
		'pasta'=>'user',
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
		if (strlen($nome) < 2) $Erros .= "Ocorreu um erro";
		if (!ChecaTipoArquivo($_FILES['imagem']['name'],1)) $Erros .= "Tipo de arquivo não aceito! Envie JPG, GIF ou PNG";


		# Se houver erro, SAI
		if (strlen($Erros)) { header('Location: ../sys/'.$Config['arquivo'].'_dados.php?ID='.$$cnf['id'].$Config['urlfixo'].'&erro='.urlencode("<b>Dados inválidos:</b>|".$Erros),true); exit; }


				# Dados
		$dados = array( 

	'login'=>$login, 
   'senha'=>$senha,
   'nome'=>$nome, 
   'sobrenome'=>$sobrenome,
   
   'mae'=>$mae, 
   'pai'=>$pai, 
   'naturalde'=>$naturalde,
   'nacional'=>$nacional, 
   'nascimento'=>dataDMY_YMD($nascimento), 
   'estadocivil'=>$estadocivil, 
   'conjuge'=>$conjuge,
   'conjugecrente'=>$conjugecrente,
   'igrejaconjuge'=>$igrejaconjuge,
   
   'filhos'=>$filhos, 
   'profissao'=>$profissao, 
   'empresa'=>$empresa, 
   'telcomercial'=>$telcomercial, 
   'enderecoempresa'=>$enderecoempresa, 
   'identidade'=>$identidade, 
   'cpf'=>$cpf, 
   'grau'=>$grau, 
   'endereco'=>$endereco, 
   'cep'=>$cep, 
   'bairro'=>$bairro, 
   'cidade'=>$cidade, 
   'estado'=>$estado, 
   'telefone'=>$telefone, 
   'celular'=>$celular, 
   'email'=>$email, 
   'twitter'=>$twitter, 
   'facebook'=>$facebook,
	'orkut'=>$orkut,   
   'datafe'=>dataDMY_YMD($datafe), 
   'databatismo'=>dataDMY_YMD($databatismo), 
   'igrejabatismo'=>$igrejabatismo, 
   'cidadeigreja'=>$cidadeigreja, 
   'estadoigreja'=>$estadoigreja, 
   'pastorbatismo'=>$pastorbatismo, 
   'modocomoentrou'=>$modocomoentrou, 
   'dataentrou'=>dataDMY_YMD($dataentrou), 
   'musicapreferida'=>$musicapreferida, 
   'bibliapreferida'=>$bibliapreferida, 
   'dizimista'=>$dizimista, 
   'ministerio'=>$ministerio, 
   'talentos'=>$talentos, 
   'posicaoeclisiastica'=>$posicaoeclisiastica, 
   'gostariatrabalhar'=>$gostariatrabalhar,
 
		
		);


		# Arquivos
		if (!empty($_FILES['imagem']['name'])) {
			$dados['imagem'] = processaArquivo('imagem',$Config,$_FILES);
			if ($dados['imagem']==false) { header("Location: ../sys/".$Config['arquivo'].".php?erro=".urlencode('Erro processando Imagem.'),true); exit; }
		}


		# Executando 
		if ($$Config['id']>0) {

			# Apagando a Imagem se houver uma nova cadastrada
			if (strlen($dados['imagem'])>0) db_apagaArquivo('imagem',$Config,$$Config['id']);

			db_executa($Config['tabela'],$dados,'update', $Config['id'].'='.$$Config['id']);

		} else {

			$dados['data']='now()';
			$dados['id']=$_SESSION['Admin']['id'];
			db_executa($Config['tabela'],$dados);


		}


		header("Location: ../sys/".$Config['arquivo'].".php?msg=".urlencode('Feito.'),true); exit;

	}












	// -----------------------------------------------------------------------------------------------------------
	// Excluir um registro e seus arquivos
	// -----------------------------------------------------------------------------------------------------------
	if ($_GET['faz']=="excluir") {
		$id=(int)$_GET['id'];
		if ($id>0) {

			# Apagando os arquivos 
			db_apagaArquivo('imagem',$Config,$id);

			# Excluindo do Bando de dados
			db_consulta("DELETE FROM ".$Config['tabela']." WHERE login = '$login_usuario'");
			header("Location: ../sys/".$Config['arquivo'].".php?msg=".urlencode('Excluido.'),true); exit;

		}
	}






	// -----------------------------------------------------------------------------------------------------------
	// Apaga vários itens de uma vez só
	// -----------------------------------------------------------------------------------------------------------
	if ($_GET['faz']=="excluir_massa") {
	
		if (is_array($check)) 
		foreach ($check as $id) {
			if ($id>0) {

				# Apagando os arquivos 
				db_apagaArquivo('imagem',$Config,$id);
	
				# Excluindo do Bando de dados
				db_consulta("DELETE FROM ".$Config['tabela']." WHERE login = '$login_usuario'");

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
		
		db_executa($Config['tabela'],array($_GET['flag']=>$valor),'update', "login = '$login_usuario'");
		header("Location: ".urldecode($_GET['origem'])."?&msg=Atualizado",true); exit;
	}






	// Se nada for feito...
	header("Location: ../sys/".$Config['arquivo'].".php?info=".urlencode('Nada feito'),true); exit;
	
?>