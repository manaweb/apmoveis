<style>#btn, #btnalt {border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px; }</style>
<?

header('Content-type: text/html;charset=iso-8859-1');

// -----------------------------------------------------------------------------------------------------------
// * PreencheUrl: Troca os {valor} pelo valor correspondente a um índice dentro de um array
// -----------------------------------------------------------------------------------------------------------
function PreencheUrl($url,$fonte) {

  while (strpos($url,"{")>0) {
	if ( (strpos($url,"{")>0)&&(strpos($url,"}")>0) ) {
		$qual = substr($url,strpos($url,"{")+1,strpos($url,"}")-strpos($url,"{")-1);
		$url = str_replace("{".$qual."}",$fonte[$qual],$url);
	}
	}
	return $url;
}


// -----------------------------------------------------------------------------------------------------------
// * adminCampos: Cria os campos para formulário
// -----------------------------------------------------------------------------------------------------------
function adminCampos($campos,$config,$dados) {

	// Campos -->
	// array(
	//	0=> Tipo (texto,flag,imagem,resumo)
	//	1=> Título do TH
	//	2=> Nome do campo
	//	3=> Tamanho (em pixels)
	//	4=> Opções (select, radio, checkbox)
	//	5=> Comentário
	//	6=> Atributos
	//)
	


	$saida  = '<form name="frmDados" action="../app/'.$config['arquivo'].'.php?faz=dados'.$config['urlfixo'].'" method="post" enctype="multipart/form-data">';
	$saida .= '<input type="hidden" name="'.$config['id'].'" value="'.$dados[$config['id']].'">';
	$saida .= '<fieldset class="adicionar"><legend>Informa&ccedil;&otilde;es</legend><table>';

	foreach ($campos as $campo) {
		if (!in_array($campo[0],array('hidden','branco'))) $saida .= '<tr class="'.$campo[2].'"><th>'.$campo[1].':</th><td class="'.$campo[2].'">';
	
		switch ($campo[0]) {
		
			case 'text':
			case 'password':
			case 'hidden':
				$saida .= '<input type="'.$campo[0].'" name="'.$campo[2].'" value="'.$dados[$campo[2]].'" style="width:'.$campo[3].'px;" '.$campo[6].' onfocus="this.className=\'focus\';" onblur="this.className=\'\';" />';
				break;
			case 'checkbox':
				$checks = explode(',',$campo[6]);
				$loop = sizeof($checks);
				for ($i = 0;$i < $loop;$i++)
					$saida .= '<input type="'.$campo[0].'" name="'.$campo[2].'" style="width:'.$campo[3].'px;" '.$checks[$i].' onfocus="this.className=\'focus\';" onblur="this.className=\'\';" />'.ucfirst(preg_replace('/id=|"/','',$checks[$i]));
			break;
			
			case 'file':
				$saida .= '<input type="file" name="'.$campo[2].'" style="width:'.$campo[3].'px;" '.$campo[6].' />';
				$saida .= '<div class="arquivo"><a href="../../arquivos/'.$config['pasta'].'/'.$dados[$campo[2]].'" target="_blank">';
				if (!empty($dados[$campo[2]])) {
					if (validaTipoArquivo($dados[$campo[2]],1)) {
						$saida .= '<img vspace=2 src="../../arquivos/'.$config['pasta']."/".$dados[$campo[2]].'" alt="">';
					} else $saida .= 'Ver arquivo';
					$saida .= '</a>';
					$saida .= '</div>';
				}
				break;


			case 'ftp':
				$saida .= '<label><input checked="checked" type="radio" name="'.$campo[2].'_metodo" value="0" onclick="document.getElementById(\''.$campo[2].'\').style.display=\'block\';document.getElementById(\''.$campo[2].'_ftp\').style.display=\'none\';"> Formulário </label> ';
				$saida .= '<label><input type="radio" name="'.$campo[2].'_metodo" value="1" onclick="document.getElementById(\''.$campo[2].'\').style.display=\'none\';document.getElementById(\''.$campo[2].'_ftp\').style.display=\'block\';"> FTP </label><br />';

				// Input
				$saida .= '<input type="file" name="'.$campo[2].'" id="'.$campo[2].'" style="width:'.$campo[3].'px;" '.$campo[6].' />';

				// Ftp
				$saida .= '<select name="'.$campo[2].'_ftp" id="'.$campo[2].'_ftp" style="display:none"> ';
				$d = @dir("../../arquivos/ftp/");
				while ($arquivo = $d->read()) {
					if (@is_file("../../arquivos/ftp/".$arquivo)) $saida .=  '<option value="'.$arquivo.'">'.$arquivo.'</option>';
				} 
				$d->close(); 
				$saida .= '</select>';

				$saida .= '<div class="arquivo"><a href="../../arquivos/'.$config['pasta'].'/'.$dados[$campo[2]].'" target="_blank">';
				if (!empty($dados[$campo[2]])) {
					if (validaTipoArquivo($dados[$campo[2]],1)) {
						$saida .= '<img vspace=2 src="../../img.php?img=arquivos/'.$config['pasta'].'/'.$dados[$campo[2]].'&x=100&y=100&corta=0">';
					} else $saida .= 'Ver arquivo';
					$saida .= '</a>';
					if ($campo[4]!=1) $saida .= ' &lsaquo; <a href="../app/'.$config['arquivo'].'.php?faz=apaga_arquivo&coluna='.$campo[2].'&id='.$dados[$config['id']].'" style="color:#f00">Excluir</a> ';
					$saida .= '</div>';
				}
				break;

/*
		case 'ftp':
			$saida .= '<label><input checked="checked" type="radio" name="'.$opcoes[2].'_metodo" value="0" onclick="document.getElementById(\''.$opcoes[2].'\').style.display=\'block\';document.getElementById(\''.$opcoes[2].'_ftp\').style.display=\'none\';"> Formulário </label> ';
			$saida .= '<label><input type="radio" name="'.$opcoes[2].'_metodo" value="1" onclick="document.getElementById(\''.$opcoes[2].'\').style.display=\'none\';document.getElementById(\''.$opcoes[2].'_ftp\').style.display=\'block\';"> FTP </label><br />';
			$saida .= '<input type="file" name="'.$opcoes[2].'" id="'.$opcoes[2].'" size="'.$opcoes[3].'" '.$opcoes[7].'>';

			// Ftp
			$saida .= '<select name="'.$opcoes[2].'_ftp" id="'.$opcoes[2].'_ftp" style="display:none"> ';
			$d = dir("../../arquivos/ftp/");
			while ($arquivo = $d->read()) {
				if (is_file("../../arquivos/ftp/".$arquivo)) $saida .=  '<option value="'.$arquivo.'">'.$arquivo.'</option>';
			} 
			$d->close(); 
			$saida .= '</select>';

			if (is_file('../../'.$opcoes[5])) {
				if (ChecaTipoArquivo($opcoes[5],1)) {
					$saida .= '<br /><img src="../../img.php?x=100&y=100&corta=0&img='.$opcoes[5].'">';
				} else $saida .= '<br /><a href="../../'.$opcoes[5].'">Download</a>';
			}

			break;
*/



			case 'textarea':
				$saida .= '<textarea class="text-input textarea" id="wysiwyg"   name="'.$campo[2].'" rows="'.$campo[3][1].'" cols="'.$campo[3][0].'" '.$campo[6].' onfocus="this.className=\'focus\';" onblur="this.className=\'\';">'.$dados[$campo[2]].'</textarea>';
				break;

			case 'manual':
				$saida .= $dados[$campo[2]];
				break;
				
			case 'a':
				$saida .= '<br /><a id="btnalt" href="javascript:void(0)" style="top: -10px;position: relative;"><img src="../img/add.png" align="absmiddle"> Adicionar Cor</a><br />';
				break;	

			case 'flag':
				$saida .= '<label><input type="radio" name="'.$campo[2].'" '.$campo[6].' value="1" '.(($dados[$campo[2]]==1)?' checked="checked"':'').'> Sim </label> &nbsp; <label><input type="radio" name="'.$campo[2].'" '.$campo[6].' value="0" '.(($dados[$campo[2]]!=1)?' checked="checked"':'').'> N&atilde;o </label>';
				break;

			case 'checkbox2':
				$saida .= '';
				if (is_array($campo[4]))
				foreach ($campo[4] as $texto => $valor) {
					$saida .= '<input type="checkbox" id="checkbox_'.$valor.'" value="'.$valor.'" name="'.$campo[2].'[]"/>'.$texto;
				}
				break;

			case 'select':
				$saida .= '<select name="'.$campo[2].'" '.$campo[6].' style="width:'.$campo[3].'px;">';
				if (is_array($campo[4]))
				foreach ($campo[4] as $texto => $valor) {
					if (is_array($valor)) {
						$saida .= '<optgroup title="'.$texto.'" label="'.$texto.'">';
						foreach ($valor as $texto2 => $valor2) {
							$saida .= '<option value="'.$valor2.'"';
							if ((int)$dados[$campo[2]]==$valor2) $saida .= ' selected="selected" ';
							$saida .= '>'.$texto2."</option>\n";
						}
						$saida .= "</optgroup>\n";
					} else {
						$saida .= '<option value="'.$valor.'"';
						if ((int)$dados[$campo[2]]==$valor) $saida .= ' selected="selected" ';
						$saida .= '>'.$texto."</option>\n";
					}
				}
				$saida .= '</select>';
				break;

			case 'radio':
				if (is_array($campo[4]))
				foreach ($campo[4] as $valor => $texto) {
					$saida .= '<label><input type="radio" name="'.$campo[2].'" value="'.$valor.'"';
					if ((int)$dados[$campo[2]]==$valor) $saida .= ' checked="checked" ';
					$saida .= ' /> '.$texto." </label>\n";
				}
			break;
			

			case 'data':
				$saida .= '<input type="'.$campo[0].'" name="'.$campo[2].'" value="'.$dados[$campo[2]].'" readonly="readonly" size="10" onfocus="this.className=\'focus\';" onblur="this.className=\'\';" '.$campo[6].' /> ';
				$saida .= '<a href="javascript:abrirCalendario(\'\', \'frmDados\', \''.$campo[2].'\', \'date\')"><img src="../img/calendario.gif" align="absmiddle" /></a>';
				break;

			default: break;
		
		
		}
	
		if (!in_array($campo[0],array('hidden','branco'))) $saida .= $campo[5].'</td></tr>';
	}


	$saida .= '<tr><th></th><td class="botoes"><input type="submit" style="height:35px!important;" height="35px" id="btn" value="salvar"   />';
	$saida .= '<input type="button" value="cancelar" id="btnalt"  style="height:35px!important;" height="35px"  onclick="window.location=\''.$config['arquivo'].'.php?'.$config['urlfixo'].'\'" /></td></tr></table></fieldset></form>';

	return $saida;
}

function adminCampos2($campos,$config,$dados, $idOrcamento) {

	// Campos -->
	// array(
	//	0=> Tipo (texto,flag,imagem,resumo)
	//	1=> Título do TH
	//	2=> Nome do campo
	//	3=> Tamanho (em pixels)
	//	4=> Opções (select, radio, checkbox)
	//	5=> Comentário
	//	6=> Atributos
	//)
	


	$saida  = '<form name="frmDados" action="../app/'.$config['arquivo'].'.php?faz=dados'.$config['urlfixo'].'" method="post" enctype="multipart/form-data">';
	$saida .= '<input type="hidden" name="'.$config['id'].'" value="'.$dados[$config['id']].'">';
	$saida .= '<fieldset class="adicionar"><legend>Informa&ccedil;&otilde;es</legend><table>';

	foreach ($campos as $campo) {
		if (!in_array($campo[0],array('hidden','branco'))) $saida .= '<tr class="'.$campo[2].'"><th>'.$campo[1].':</th><td class="'.$campo[2].'">';
	
		switch ($campo[0]) {
		
			case 'text':
			case 'password':
			case 'hidden':
				$saida .= '<input type="'.$campo[0].'" name="'.$campo[2].'" value="'.$dados[$campo[2]].'" style="width:'.$campo[3].'px;" '.$campo[6].' readonly onfocus="this.className=\'focus\';" onblur="this.className=\'\';" />';
				break;
			case 'checkbox':
				$checks = explode(',',$campo[6]);
				$loop = sizeof($checks);
				for ($i = 0;$i < $loop;$i++)
					$saida .= '<input type="'.$campo[0].'" name="'.$campo[2].'" style="width:'.$campo[3].'px;" '.$checks[$i].' onfocus="this.className=\'focus\';" onblur="this.className=\'\';" checked="checked" />'.ucfirst(preg_replace('/id=|"/','',$checks[$i]));
			break;
			
			case 'file':
				$saida .= '<input type="file" name="'.$campo[2].'" style="width:'.$campo[3].'px;" '.$campo[6].' />';
				$saida .= '<div class="arquivo"><a href="../../arquivos/'.$config['pasta'].'/'.$dados[$campo[2]].'" target="_blank">';
				if (!empty($dados[$campo[2]])) {
					if (validaTipoArquivo($dados[$campo[2]],1)) {
						$saida .= '<img vspace=2 src="'.$dados[$campo[2]].'" alt="">';
					} else $saida .= 'Ver arquivo';
					$saida .= '</a>';
					$saida .= '</div>';
				}
				break;


			case 'ftp':
				$saida .= '<label><input checked="checked" type="radio" name="'.$campo[2].'_metodo" value="0" onclick="document.getElementById(\''.$campo[2].'\').style.display=\'block\';document.getElementById(\''.$campo[2].'_ftp\').style.display=\'none\';"> Formulário </label> ';
				$saida .= '<label><input type="radio" name="'.$campo[2].'_metodo" value="1" onclick="document.getElementById(\''.$campo[2].'\').style.display=\'none\';document.getElementById(\''.$campo[2].'_ftp\').style.display=\'block\';"> FTP </label><br />';

				// Input
				$saida .= '<input type="file" name="'.$campo[2].'" id="'.$campo[2].'" style="width:'.$campo[3].'px;" '.$campo[6].' />';

				// Ftp
				$saida .= '<select name="'.$campo[2].'_ftp" id="'.$campo[2].'_ftp" style="display:none"> ';
				$d = @dir("../../arquivos/ftp/");
				while ($arquivo = $d->read()) {
					if (@is_file("../../arquivos/ftp/".$arquivo)) $saida .=  '<option value="'.$arquivo.'">'.$arquivo.'</option>';
				} 
				$d->close(); 
				$saida .= '</select>';

				$saida .= '<div class="arquivo"><a href="../../arquivos/'.$config['pasta'].'/'.$dados[$campo[2]].'" target="_blank">';
				if (!empty($dados[$campo[2]])) {
					if (validaTipoArquivo($dados[$campo[2]],1)) {
						$saida .= '<img vspace=2 src="../../img.php?img=arquivos/'.$config['pasta'].'/'.$dados[$campo[2]].'&x=100&y=100&corta=0">';
					} else $saida .= 'Ver arquivo';
					$saida .= '</a>';
					if ($campo[4]!=1) $saida .= ' &lsaquo; <a href="../app/'.$config['arquivo'].'.php?faz=apaga_arquivo&coluna='.$campo[2].'&id='.$dados[$config['id']].'" style="color:#f00">Excluir</a> ';
					$saida .= '</div>';
				}
				break;

/*
		case 'ftp':
			$saida .= '<label><input checked="checked" type="radio" name="'.$opcoes[2].'_metodo" value="0" onclick="document.getElementById(\''.$opcoes[2].'\').style.display=\'block\';document.getElementById(\''.$opcoes[2].'_ftp\').style.display=\'none\';"> Formulário </label> ';
			$saida .= '<label><input type="radio" name="'.$opcoes[2].'_metodo" value="1" onclick="document.getElementById(\''.$opcoes[2].'\').style.display=\'none\';document.getElementById(\''.$opcoes[2].'_ftp\').style.display=\'block\';"> FTP </label><br />';
			$saida .= '<input type="file" name="'.$opcoes[2].'" id="'.$opcoes[2].'" size="'.$opcoes[3].'" '.$opcoes[7].'>';

			// Ftp
			$saida .= '<select name="'.$opcoes[2].'_ftp" id="'.$opcoes[2].'_ftp" style="display:none"> ';
			$d = dir("../../arquivos/ftp/");
			while ($arquivo = $d->read()) {
				if (is_file("../../arquivos/ftp/".$arquivo)) $saida .=  '<option value="'.$arquivo.'">'.$arquivo.'</option>';
			} 
			$d->close(); 
			$saida .= '</select>';

			if (is_file('../../'.$opcoes[5])) {
				if (ChecaTipoArquivo($opcoes[5],1)) {
					$saida .= '<br /><img src="../../img.php?x=100&y=100&corta=0&img='.$opcoes[5].'">';
				} else $saida .= '<br /><a href="../../'.$opcoes[5].'">Download</a>';
			}

			break;
*/



			case 'textarea':
				$saida .= '<textarea class="text-input textarea" id="wysiwyg"   name="'.$campo[2].'" rows="'.$campo[3][1].'" cols="'.$campo[3][0].'" '.$campo[6].' onfocus="this.className=\'focus\';" onblur="this.className=\'\';">'.$dados[$campo[2]].'</textarea>';
				break;

			case 'manual':
				$saida .= $dados[$campo[2]];
				break;
				
			case 'a':
				$saida .= '<br /><a id="btnalt" href="javascript:void(0)" style="top: -10px;position: relative;"><img src="../img/add.png" align="absmiddle"> Adicionar Cor</a><br />';
				break;	

			case 'flag':
				$saida .= '<label><input type="radio" name="'.$campo[2].'" '.$campo[6].' value="1" '.(($dados[$campo[2]]==1)?' checked="checked"':'').'> Sim </label> &nbsp; <label><input type="radio" name="'.$campo[2].'" '.$campo[6].' value="0" '.(($dados[$campo[2]]!=1)?' checked="checked"':'').'> N&atilde;o </label>';
				break;

			case 'checkbox2':
				$saida .= '';
				if (is_array($campo[4]))
				foreach ($campo[4] as $texto => $valor) {
					$saida .= '<input type="checkbox" id="checkbox_'.$valor.'" value="'.$valor.'" name="'.$campo[2].'[]"/>'.$texto;
				}
				break;

			case 'select':
				$saida .= '<select name="'.$campo[2].'" '.$campo[6].' style="width:'.$campo[3].'px;">';
				if (is_array($campo[4]))
				foreach ($campo[4] as $texto => $valor) {
					if (is_array($valor)) {
						$saida .= '<optgroup title="'.$texto.'" label="'.$texto.'">';
						foreach ($valor as $texto2 => $valor2) {
							$saida .= '<option value="'.$valor2.'"';
							if ((int)$dados[$campo[2]]==$valor2) $saida .= ' selected="selected" ';
							$saida .= '>'.$texto2."</option>\n";
						}
						$saida .= "</optgroup>\n";
					} else {
						$saida .= '<option value="'.$valor.'"';
						if ((int)$dados[$campo[2]]==$valor) $saida .= ' selected="selected" ';
						$saida .= '>'.$texto."</option>\n";
					}
				}
				$saida .= '</select>';
				break;

			case 'radio':
				if (is_array($campo[4]))
				foreach ($campo[4] as $valor => $texto) {
					$saida .= '<label><input type="radio" name="'.$campo[2].'" value="'.$valor.'"';
					if ((int)$dados[$campo[2]]==$valor) $saida .= ' checked="checked" ';
					$saida .= ' /> '.$texto." </label>\n";
				}
			break;
			

			case 'data':
				$saida .= '<input type="'.$campo[0].'" name="'.$campo[2].'" value="'.$dados[$campo[2]].'" readonly="readonly" size="10" onfocus="this.className=\'focus\';" onblur="this.className=\'\';" '.$campo[6].' /> ';
				$saida .= '<a href="javascript:abrirCalendario(\'\', \'frmDados\', \''.$campo[2].'\', \'date\')"><img src="../img/calendario.gif" align="absmiddle" /></a>';
				break;

			default: break;
		
		
		}
	
		if (!in_array($campo[0],array('hidden','branco'))) $saida .= $campo[5].'</td></tr>';
	}


	$saida .= '</table>';

	$resultProdutos = db_consulta("SELECT tbprodutos.nome as NomeProduto, tbitensorcamento.id_orcamento as IdOrc, tbitensorcamento.quantidade as quantidade, tbitensorcamento.variacao as variacao
								FROM tbitensorcamento LEFT JOIN tbprodutos ON tbprodutos.id = tbitensorcamento.id_produto
								where tbitensorcamento.id_orcamento = $idOrcamento");
	$saida .= '
				<table class="consulta">
					<tr>
						<th>Produto</th>
						<th>Quantidade</th>
						<th>Varia&ccedil;&atilde;o</th>
					</tr>
					<tbody>';
	while($dadosProduto = mysql_fetch_array($resultProdutos)){
		$saida .=
						'<tr>
							<td>'.$dadosProduto['NomeProduto'].'</td>
							<td>'.$dadosProduto['quantidade'].'</td>
							<td>'.$dadosProduto['variacao'].'</td>
						</tr>';
	}
	$saida.=		
					'</tbody>
				</table></fieldset></form>';

	return $saida;
}

// -----------------------------------------------------------------------------------------------------------
// * adminLista: Lista valores para atualizações no sistema
// -----------------------------------------------------------------------------------------------------------
function adminLista($campos,$dados,$acoes,$config,$excluir_massa=true) {
	
	// Campos -->
	// array(
	//	0=> Tipo (texto,flag,imagem,resumo)
	//	1=> Título do TH
	//	2=> Nome da fonte
	//	3=> Link
	//)
	
	// Ações --> Tipos: excluir, editar, status
	// array()

	$saida .= '<form name="frmConsulta" action="../app/'.$config['arquivo'].'.php?faz=excluir_massa'.$config['urlfixo'].'" method="post" onsubmit="if (!confirm(\'Tem certeza que deseja excluir os itens selecionados?\')) return false;"><table class="consulta"><tr>';

	# Excluir em massa
	if ($excluir_massa) $saida .= '<th><input type="checkbox" onclick="consultaSelTodos(this.checked)" /></th>';

	# Ações
	$tamanhoAcoes=0;
	if (in_array('excluir',$acoes)) $tamanhoAcoes=$tamanhoAcoes+30;
	if (in_array('editar',$acoes)) $tamanhoAcoes=$tamanhoAcoes+30;
	if (in_array('status',$acoes)) $tamanhoAcoes=$tamanhoAcoes+30;
	if (in_array('fotos',$acoes)) $tamanhoAcoes=$tamanhoAcoes+30;
	if (in_array('visualizar',$acoes)) $tamanhoAcoes=$tamanhoAcoes+30;
	if (count($acoes)>0) $saida .= '<th style="min-width:'.$tamanhoAcoes.'px">OP&Ccedil;&Otilde;ES</th>';

	# Montando os campos
	foreach ($campos as $campo){
	
		$saida .= '<th>'.$campo[1].'</th>';
	
	}
	$saida .= '</tr>';

	# Alimentando a lista
	$i=0;
	if (!count($dados)) {
	
		$saida .= '<tr><td colspan=20>Nenhum registro encontrado.</td></tr>';
	
	} else
	foreach ($dados as $dado) { $i++;
	
		$saida .= '<tr ';

		# Bloqueado
		if ($dado['flag_status']=='0') {
			$classetr="bloqueado";
		} else {
			$classetr="";
			# Cor sim / Cor Não
			if (($i%2)==0) $classetr="corsim";
		}
		$saida .= 'class="'.$classetr.'" onmouseout="this.className=\''.$classetr.'\';" onmouseover="this.className=\'mousesobre\';">';

		# Excluir em massa
		if ($excluir_massa) $saida .= '<td><input type="checkbox" name="check[]" id="check'.$i.'" value="'.$dado[$config['id']].'" /></td>';
		
		# Ações
		if (count($acoes)>0) {
			$saida .= '<td>';
			if (in_array('excluir',$acoes)) $saida .= '<a class="excluir" href="../app/'.$config['arquivo'].'.php?faz=excluir&id='.$dado[$config['id']].''.$config['urlfixo'].'" title="Excluir" onclick="if (!confirm(\'Tem certeza que deseja excluir?\')) return false;">Excluir</a>';
			if (in_array('editar',$acoes)) $saida .= '<a class="editar" href="'.$config['arquivo'].'_dados.php?ID='.$dado[$config['id']].''.$config['urlfixo'].'" title="Editar">Editar</a>';
			if (in_array('status',$acoes)) $saida .= '<a class="status'.(int)$dado['flag_status'].'" href="../app/'.$config['arquivo'].'.php?faz=flag&flag=flag_status&id='.$dado[$config['id']].'&origem='.urlencode(urlOrigem()).''.$config['urlfixo'].'" title="Status">Status</a>';
			if (in_array('fotos',$acoes)) $saida .= '<a class="fotos" href="'.$config['arquivo'].'_fotos.php?'.$config['id'].'='.$dado[$config['id']].''.$config['urlfixo'].'" title="Fotos">Fotos</a>';
			if (in_array('visualizar',$acoes)) $saida .= '<a class="visualizar" href="'.$config['arquivo'].'_visualizar.php?ID='.$dado[$config['id']].''.$config['urlfixo'].'" title="Visualizar">Visualizar</a>';
			if (in_array('imprimir',$acoes)) $saida .= '<a class="imprimir" href="'.$config['arquivo'].'_imprimir.php?ID='.$dado[$config['id']].''.$config['urlfixo'].'"  target="_blank" title="imprimir">Imprimir</a>';
			$saida .= '</td>';
		}
		
		# Listando os itens
		foreach ($campos as $campo) {
			$saida .= '<td>';
			# Link
			if (strlen($campo[3])>0) $saida .= '<a href="'.PreencheUrl($campo[3],$dado).'">';
			
			switch ($campo[0]) {
			
				case 'resumo':
					$saida .= substr(strip_tags($dado[$campo[2]]),0,100).( (strlen($dado[$campo[2]])>100)?'...':'');
					break;
			
				case 'flag': // '../app/'.$FileName.".php?faz=status&id={".$cnf['id']."}&atual={flag_status}&origem=".urlencode($_SERVER['REQUEST_URI']
					$saida .= '<a class="status'.(int)$dado[$campo[2]].'" href="../app/'.$config['arquivo'].'.php?faz=flag&flag='.$campo[2].'&id='.$dado[$config['id']].'&origem='.urlencode(urlOrigem()).''.$config['urlfixo'].'" title="'.$campo[1].'">'.(int)$dado[$campo[2]].'</a>';
					break;
				
				case 'foto':
					$imagem = $dado[$campo[2]] == '' ? '../../arquivos/produtos/sem-foto.png': $dado[$campo[2]] ;
					$saida .= '<a href="../../arquivos/'.$config['arquivo'].'/'.$imagem.'" target="_blank"><img src="../../arquivos/'.$config['arquivo'].'/'.$imagem.'" width="80px" height="80px" /></a>';
					break;
			
				default:
					$saida .= $dado[$campo[2]];
					break;
			}
			$saida .= '</td>';
		}
		$saida .= '</tr>';
	}

	$saida .= '</table>';

	# Excluir em massa
	if ($excluir_massa && count($dados)) $saida .= '<div id="consulta_selecionados"><input value="excluir" type="submit" style="height:35px!important;" height="35px" id="btn"  ></div>';
	
	$saida .= '</form>';


	return $saida;

}


// -----------------------------------------------------------------------------------------------------------
// * db_apagaArquivo: Apaga um arquivo cadastrado no banco de dados
// -----------------------------------------------------------------------------------------------------------
function adminBusca($campos, $config, $dados, $metodo='get', $onsubmit='') {
	
	// Campos -->
	// array(
	//	0=> Tipo (texto,flag,imagem,resumo)
	//	1=> Título do TH
	//	2=> Nome do campo
	//	3=> Tamanho (em pixels)
	//	4=> Opções (select, radio, checkbox)
	//	5=> Comentário
	//	6=> Atributos
	//)
	
	$saida  = '<form name="frmBusca" action="../sys/'.$config['arquivo'].'.php?faz=busca" method="'.$metodo.'" enctype="multipart/form-data" onsubmit="'.$onsubmit.'">';
	$saida .= '<fieldset class="busca"><legend>Busca</legend><table>';


	foreach ($campos as $campo) {
		if (!in_array($campo[0],array('hidden','branco'))) $saida .= '<tr><th>'.$campo[1].':</th><td>';

		switch ($campo[0]) {

			case 'text':
			case 'password':
			case 'hidden':
				$saida .= '<input type="'.$campo[0].'" name="'.$campo[2].'" value="'.$dados[$campo[2]].'" style="width:'.$campo[3].'px;" '.$campo[6].' onfocus="this.className=\'focus\';" onblur="this.className=\'\';" />';
				break;

			case 'file':
				$saida .= '<input type="file" name="'.$campo[2].'" style="width:'.$campo[3].'px;" '.$campo[6].' />';
				$saida .= '<div class="arquivo"><a href="../../arquivos/'.$config['pasta'].'/'.$dados[$campo[2]].'" target="_blank">';
				if (!empty($dados[$campo[2]])) {
					if (validaTipoArquivo($dados[$campo[2]],1)) {
						$saida .= '<img vspace=2 src="../../img.php?img=arquivos/'.$config['pasta'].'/'.$dados[$campo[2]].'&x=100&y=100&corta=0">';
					} else $saida .= 'Ver arquivo';
					$saida .= '</a>';
					if ($campo[4]!=1) $saida .= ' &lsaquo; <a href="../app/'.$config['arquivo'].'.php?faz=apaga_arquivo&coluna='.$campo[2].'&id='.$dados[$config['id']].'" style="color:#f00">Excluir</a> ';
					$saida .= '</div>';
				}
				break;

			case 'textarea':
				$saida .= '<textarea class="text-input textarea" id="wysiwyg"   name="'.$campo[2].'" rows="'.$campo[3][1].'" cols="'.$campo[3][0].'" '.$campo[6].' onfocus="this.className=\'focus\';" onblur="this.className=\'\';">'.$dados[$campo[2]].'</textarea>';
				break;

			case 'manual':
				$saida .= $dados[$campo[2]];
				break;

			case 'flag':
				$saida .= '<label><input type="radio" name="'.$campo[2].'" '.$campo[6].' value="1" '.(($dados[$campo[2]]==1)?' checked="checked"':'').'> Sim </label> &nbsp; <label><input type="radio" name="'.$campo[2].'" '.$campo[6].' value="0" '.(($dados[$campo[2]]!=1)?' checked="checked"':'').'> Naa </label>';
				break;

			case 'select':
				$saida .= '<select name="'.$campo[2].'" '.$campo[6].' style="width:'.$campo[3].'px;">';
				if (is_array($campo[4]))
				foreach ($campo[4] as $texto => $valor) {
					if (is_array($valor)) {
						$saida .= '<optgroup title="'.$texto.'" label="'.$texto.'">';
						foreach ($valor as $texto2 => $valor2) {
							$saida .= '<option value="'.$valor2.'"';
							if ((int)$dados[$campo[2]]==$valor2) $saida .= ' selected="selected" ';
							$saida .= '>'.$texto2."</option>\n";
						}
						$saida .= "</optgroup>\n";
					} else {
						$saida .= '<option value="'.$valor.'"';
						if ((int)$dados[$campo[2]]==$valor) $saida .= ' selected="selected" ';
						$saida .= '>'.$texto."</option>\n";
					}
				}
				$saida .= '</select>';
				break;


			case 'radio':
				if (is_array($campo[4]))
				foreach ($campo[4] as $valor => $texto) {
					$saida .= '<label><input type="radio" name="'.$campo[2].'" value="'.$valor.'"';
					if ((int)$dados[$campo[2]]==$valor) $saida .= ' checked="checked" ';
					$saida .= ' /> '.$texto." </label>\n";
				}
				break;

			case 'data':
				if (empty($dados[$campo[2]])) $dados[$campo[2]]=date('d/m/Y');
				$saida .= '<input type="'.$campo[0].'" name="'.$campo[2].'" value="'.$dados[$campo[2]].'" readonly="readonly" size="10" onfocus="this.className=\'focus\';" onblur="this.className=\'\';" '.$campo[6].' /> ';
				$saida .= '<a href="javascript:abrirCalendario(\'\', \'frmBusca\', \''.$campo[2].'\', \'date\')"><img src="../img/calendario.gif" align="absmiddle" /></a> &nbsp; <label><input type="checkbox" name="'.$campo[2].'_filtrar" value="1" ';
				if ($dados[$campo[2].'_filtrar']==1) $saida .= ' checked="checked" ';
				$saida .= '> Filtrar</label>';
				break;

			default: break;
		
		
		}
	
		if (!in_array($campo[0],array('hidden','branco'))) $saida .= '</td></tr>';
	}


	$saida .= '<tr><th></th><td class="botoes"><input type="submit" style="height:35px!important;" height="35px" id="btn" value="buscar"  />';
	$saida .= '<input type="button" value="cancelar" id="btnalt" style="height:35px!important;" height="35px"   onclick="window.location=\''.$config['arquivo'].'.php?'.$config['urlfixo'].'\'" /></td></tr></table></fieldset></form>';

	return $saida;


}



// -----------------------------------------------------------------------------------------------------------
// * db_apagaArquivo: Apaga um arquivo cadastrado no banco de dados
// -----------------------------------------------------------------------------------------------------------
function db_apagaArquivo($nome,$config,$id,$img=NULL) {

	list($arquivo) = db_dados("SELECT ".$nome." FROM ".$config['tabela']." WHERE ".$config['id']."=".(int)$id);
	if (is_array($img)) {
		for ($i = 0;$i < sizeof($img);$i++) {
			@unlink("../../arquivos/".$config['pasta']."/".$img[$i]);
			@unlink("../../arquivos/".$config['pasta']."/_miniaturas/".$img[$i]);
		}
	}else {
		@unlink("../../arquivos/".$config['pasta']."/".$arquivo);
		@unlink("../../arquivos/".$config['pasta']."/_miniaturas/".$arquivo);
	}

}


// -----------------------------------------------------------------------------------------------------------
// * processaArquivo: Processa um arquivo. Cria miniaturas, etc
// -----------------------------------------------------------------------------------------------------------
function processaArquivo($nome,$config,$file,$tipoNomeArq=1,$configNome=NULL) {
	
	if ($configNome == NULL)
		$configNome = $nome;

	if (!empty($file[$nome]["name"])) {
		$novoNome = NULL;
		switch ($tipoNomeArq) {
			case 2: $NovoNome = md5(uniqid(time())); break;
			case 3: $NovoNome = uniqid(time()); break;
			default: $NovoNome = md5(uniqid(time())).nomeArquivo($file[$nome]['name'],"../../arquivos/".$config['pasta']."/"); break;
		}

		# Se for imagem
		if (validaTipoArquivo($file[$nome]['name'], 1) && $config[$configNome]['x'] > 0 && $config[$configNome]['y'] > 0 ) {

			$Arquivo = FazerUpload($file[$nome],"../../arquivos/tmp/",$NovoNome,0);
			
			
			if ($Arquivo != false) {
				# Criando miniatura
				if ($config[$configNome]['mini']['x']>0 && $config[$configNome]['mini']['y']>0) {
					$miniatura2 = Miniatura("../../arquivos/tmp/".$Arquivo , "../../arquivos/".$config['pasta']."/_miniaturas/".$Arquivo, $config[$configNome]['mini']['x'], $config[$configNome]['mini']['y'], $config[$configNome]['mini']['corte'], 0);
					if ($miniatura2) { # faz nada
					} else return false;
				}
				$miniatura = Miniatura("../../arquivos/tmp/".$Arquivo , "../../arquivos/".$config['pasta']."/".$Arquivo, $config[$configNome]['x'], $config[$configNome]['y'], $config[$configNome]['corte'], 1);
				if ($miniatura) { # faz nada
				} else return false;
			} else return false;

		# Arquivos
		} else {
			$Arquivo = FazerUpload($file[$nome],"../../arquivos/".$config['pasta']."/",$NovoNome,0);
			if ($Arquivo != false) {} else return false;

		}



	} else return false;

	return $Arquivo;
}






// -----------------------------------------------------------------------------------------------------------
// * usuarioPermissao: Verifica se o usuario tem permissao para acessar um certo módulo
// -----------------------------------------------------------------------------------------------------------
function usuarioPermissao($usuario,$menu) {

	if ($usuario==1) return true;
	if ($menu==0) return true;

	$permitido = db_linhas(db_consulta("SELECT * FROM adm_permissoes WHERE id_usuario=".(int)$usuario." AND id_menu=".(int)$menu));
	if ($permitido > 0) {
		return true;
	} else {
		return false;
	}

}






// -----------------------------------------------------------------------------------------------------------
// * cadHistorico: Cadastra uma nova ação no histórico
// -----------------------------------------------------------------------------------------------------------
function cadHistorico($menu, $acao, $ref) {

	db_executa('adm_historico', array('id_usuario'=>$_SESSION['Admin']['id_usuario'], 'id_menu'=> $menu, 'id_acao'=>$acao, 'id_ref'=>$ref, 'data'=>'now()'));

}

















?>