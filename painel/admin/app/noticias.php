<?php
	define('ID_MODULO',0,true);
	include("../../../php/config/config.php");
	include("../../../php/classes/filter.class.php");
	include("../includes/Config.php");
	
	$filtrar = new Filters();
	
	foreach ($_POST as $campo => $valor) $$campo = $valor;
	
	$Config = array(
		'tabela'=>'tbnoticias',
		'titulo'=>'titulo',
		'id'=>'id_noticia',
		'urlfixo'=>''
	);

	$Config2 = array(
		'arquivo'=>'noticias',
		'tabela'=>'tbnoticias_imagens',
		'id'=>'id_img',
		'urlfixo'=>'', 
		'pasta'=>'noticias',
		'imagem'=>array(
			'x'=>602, 'y'=>452, 'corte'=>0, 
			'mini'=>array(
				'x'=>145, 'y'=>90, 'corte'=>0
			)
		),
	);

	$size = NULL;

	// -----------------------------------------------------------------------------------------------------------
	// Incluir ou alterar dados no banco de dados
	// -----------------------------------------------------------------------------------------------------------
	if ($_GET['faz']=="dados") {

		# Testes
		$Erros='';
		$size = sizeof($_FILES['foto']['name']);
		if (strlen($titulo) < 2) $Erros .= "- Título|";
		for ($i = 0;$i < $size;$i++)
			if (  (! validaTipoArquivo($_FILES['foto']['name'][$i],1)) && (!($id_noticia>0)) ) $Erros .= "<br>Tipo de arquivo não aceito! Envie JPG, GIF ou PNG";


		# Se houver erro, SAI
		if (strlen($Erros)) { header('Location: ../sys/'.$Config2['arquivo'].'_dados.php?ID='.$$cnf['id'].$Config['urlfixo'].'&erro='.urlencode("<b>Dados inválidos:</b>|".$Erros),true); exit; }

		switch($id_categoria) {

			case 29:
				$Config2['imagem']['mini']['x'] = 208;
				$Config2['imagem']['mini']['y'] = 162;
			break;

			case 31:
				$Config2['imagem']['mini']['x'] = 238;
				$Config2['imagem']['mini']['y'] = 210;
			break;

			case 33:
			case 34:
				$Config2['imagem']['mini']['x'] = 264;
				$Config2['imagem']['mini']['y'] = 180;
			break;
		}

		
		# Dados;
		$tituloURL = $filtrar->_paraURL($titulo);
		$dados = array( 'id_categoria'=>$id_categoria, 'titulo'=>$titulo, 'creditos'=>$creditos, 'subtitulo'=>$subtitulo, 'texto'=>$texto,'tituloURL'=>$tituloURL,'tituloHash'=>md5($tituloURL));
		$dados2 = array('id_noticia' => 0, 'id_categoria' => $id_categoria, 'imagem' => array());

		# Arquivos
		
		for ($i = 0;$i < $size;$i++) {
			if (!empty($_FILES['foto']['name'][$i])) {
				$dados2['imagem'][$i] = processaArquivo('foto',$Config2,$_FILES,1,$i,'imagem');
				if ($dados2['imagem'][$i] == false) { header("Location: ../sys/".$Config2['arquivo'].".php?erro=".urlencode('Erro processando Imagem.'),true); exit; }
			}
		}

		# Executando 
		if ($$Config['id']>0) {

			# Apagando a Imagem se houver uma nova cadastrada
			for ($i = 0;$i < $size;$i++)
				if (strlen($dados2['imagem'][$i])>0) db_apagaArquivo('imagem',$Config2,$$Config['id']);

			db_executa($Config['tabela'],$dados,'update', $Config['id'].'='.$$Config['id']);

		} else {

			$dados['data']='now()';
			$dados['id_noticia']=$_SESSION['Admin']['id_noticia'];
			db_executa($Config['tabela'],$dados);
			
			$result = mysql_query("SHOW TABLE STATUS LIKE '".$Config['tabela']."'");
			$row = mysql_fetch_array($result);
			$nextId = $row['Auto_increment']-1;
			mysql_free_result($result);

			$dados2['id_noticia'] = $nextId;
			$consulta = db_consulta("SELECT id_img FROM tbnoticias_imagens");
			$tmpDados = $dados2;
			for ($i = 0; $i < $size;$i++) {
				$tmpVar = $tmpDados['imagem'][$i];
				$dados2['imagem'] = $tmpVar;
				db_executa($Config2['tabela'],$dados2);
			}
			
			# Cadastrar novo endereço
			$dados_end = array('id_categoria'=>$id_categoria);


		}


		header("Location: ../sys/".$Config2['arquivo'].".php?msg=".urlencode('Feito.'),true); exit;

	}


	// -----------------------------------------------------------------------------------------------------------
	// Excluir um registro e seus arquivos
	// -----------------------------------------------------------------------------------------------------------
	if ($_GET['faz']=="excluir") {
		$id=(int)$_GET['id'];
		$consultaImagens = mysql_query("
			SELECT `tbnoticias_imagens`.imagem, `tbnoticias`.tituloURL
			FROM tbnoticias INNER JOIN tbnoticias_imagens
			ON `tbnoticias_imagens`.id_noticia = `tbnoticias`.id_noticia
			WHERE `tbnoticias`.id_noticia = $id;
		");
		$arquivos = array();
		while ($c = mysql_fetch_array($consultaImagens)) {
			$arquivos[] = $c['imagem'];
			unlink(DOMAIN."cache/$tituloURL");
		}
		if ($id>0) {
			# Apagando os arquivos
			db_apagaArquivo('imagem',$Config2,$id,$arquivos);

			# Excluindo do Bando de dados
			db_consulta("DELETE FROM ".$Config2['tabela']." WHERE id_noticia=$id");
			db_consulta("DELETE FROM ".$Config['tabela']." WHERE ".$Config['id']."=".$id);
			header("Location: ../sys/".$Config2['arquivo'].".php?msg=".urlencode('Excluido.'),true); exit;

		}
	}








	// -----------------------------------------------------------------------------------------------------------
	// Apaga vários itens de uma vez só
	// -----------------------------------------------------------------------------------------------------------
	if ($_GET['faz']=="excluir_massa") {
		
		if (is_array($check)) 
		foreach ($check as $id) {
			$consultaImagens = mysql_query("
				SELECT `tbnoticias_imagens`.imagem, `tbnoticias`.tituloURL 
				FROM tbnoticias INNER JOIN tbnoticias_imagens
				ON `tbnoticias_imagens`.id_noticia = `tbnoticias`.id_noticia
				WHERE `tbnoticias`.id_noticia = $id;
			");
			$arquivos = array();
			while ($c = mysql_fetch_array($consultaImagens))
				$arquivos[] = $c['imagem'];
			if ($id>0) {

				# Apagando os arquivos 
				db_apagaArquivo('imagem',$Config2,$id,$arquivos);
	
				# Excluindo do Bando de dados
				db_consulta("DELETE FROM ".$Config2['tabela']." WHERE id_noticia=$id");
				db_consulta("DELETE FROM ".$Config['tabela']." WHERE ".$Config['id']."=".$id);
				

			}
		}
		header("Location: ../sys/".$Config2['arquivo'].".php?msg=".urlencode('Feito').$Config['urlfixo'],true); exit;
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