<? 
	include('../includes/Config2.php');
	include ('../../paginas/validar_session3.php');
	foreach ($_POST as $campo => $valor) $$campo = processaString($valor);
	
	$Config = array(
		'arquivo'=>'dados_usuario_editar',
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
		if (strlen($nome) < 0) $Erros .= "Ocorreu um erro, você não inseriu seu nome";
		if (  (! validaTipoArquivo($_FILES['imagem']['name'],1)) && (!($id>0)) ) $Erros .= "<br>Tipo de arquivo não aceito! Envie JPG, GIF ou PNG";
	

		# Se houver erro, SAI
		if (strlen($Erros)) { header('Location: ../sys/'.$Config['arquivo'].'_dados.php?ID='.$$cnf['id'].$Config['urlfixo'].'&erro='.urlencode("<b>Dados inválidos:</b>|".$Erros),true); exit; }


				# Dados
		$dados = array( 


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
			if ($dados['imagem']==false) { header("Location: ../sys/".$Config['arquivo'].".php?erro=".urlencode('Ocoreu um erro ao atualizar a sua foto, tente novamente.'),true); exit; }
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


		header("Location: ../sys/".$Config['arquivo'].".php?msg=".urlencode('Parabéns, seus dados foram atualizados com sucesso.'),true); exit;

	}







	// Se nada for feito...
	header("Location: ../sys/".$Config['arquivo'].".php?info=".urlencode('Ocorreu um erro durante a atualização de seus dados!'),true); exit;
	
?>