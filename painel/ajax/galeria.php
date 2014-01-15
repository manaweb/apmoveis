<?
	include ('../includes/BancoDeDados.php'); 
	include ('../includes/Funcoes.php'); 
	include ('../includes/Config.php'); 



// ------------------------------------------------------------------------------
// * Paginação - Galeria de Fotos
// ------------------------------------------------------------------------------
function PaginarGaleria_link($pagina,$atual,$prox=0,$link_pg,$pgtotal) {
	$link_pg = $link_pg."&pg=".$pagina;
// <td><a href="#">02</a></td>

	// Começa
	$resposta = '<td';
	if ($pagina == $atual) $resposta .=  ' class="paginaativo"';
	$resposta .= '>';

	$resposta .= '<a href="javascript:void(null)" onclick="galeriaCarregaPag('.$pagina.');">'.( (strlen($pagina)<2)?'0':'').$pagina.'</a>';

	// Termina
	$resposta .= '</td>';

	return $resposta;
}

function PaginarGaleria($pgatual,$pgtotal) {
	//<th class="naveg-dir"><a href="#">Próxima Página &gt;</a></th>
	$resposta .= '	<table id="galpaginacao"><tr>';


	$inicio = 1;
	$fim = $pgtotal;
	if ($pgtotal > 5) {
		$inicio=$pgatual - 4;
		$fim = $pgatual + 5;
		if ($inicio < 1) {
			$fim=$fim - $inicio +1;
			$inicio = 1;
		}
		if ($fim > $pgtotal) {
			$fim = $pgtotal;
			$inicio = $fim - 9; 
		}
		
	}
	$resposta .= '<th class="naveg-esq">';
	if ($pgatual > 1) $resposta .=  '<a href="javascript:void(null)" onclick="galeriaMiniAnte();">';
	$resposta .=  '&lt; P&aacute;gina Anterior';
	if ($pgatual > 1) $resposta .=  '</a>';
	$resposta .= '</th>';

	for ($i=$inicio;    $i <= $fim    ; $i++) {
		if ( ($i < 1)||($i > $pgtotal) ) {}
		else $resposta .= PaginarGaleria_link($i,$pgatual,0,$link_pg,$pgtotal);
	}



	$resposta .= '<th class="naveg-dir">';
	if ($pgatual < $pgtotal) $resposta .=  '<a href="javascript:void(null)" onclick="galeriaMiniProx();">';
	$resposta .=  'Pr&oacute;xima P&aacute;gina &gt;';
	if ($pgatual < $pgtotal) $resposta .=  '</a>';
	$resposta .= '</th>';


	$resposta .= '</tr></table>';

	return $resposta;
}






































	#sleep(1);

	if ($_GET['faz'] == 'foto') {
		list($codigo) = db_lista(db_consulta("SELECT codigo FROM tbgalerias WHERE id_galeria=".(int)$_GET['id_galeria']." LIMIT 1;"));
		list($imagem,$legenda, $id_foto) = db_lista(db_consulta("SELECT imagem, legenda, id_foto FROM tbgalerias_fotos WHERE id_galeria=".(int)$_GET['id_galeria']." AND flag_status=1 ORDER BY posicao ASC, id_foto ASC LIMIT ".(int)( $_GET['pos']-1 ).",1"));
		db_consulta("UPDATE tbgalerias_fotos SET contador=contador+1 WHERE id_foto=".$id_foto." LIMIT 1;");
		?>
        	<a href="javascript:galeriaProxFoto()"><img src="../arquivos/galeria/<?=$codigo;?>/fotos/<?=$imagem;?>" class="foto" /></a>
            <div class="legenda"><?=$legenda;?></div>
		<?		
	}




	if ($_GET['faz'] == 'mini') {
	
		list($codigo) = db_lista(db_consulta("SELECT codigo FROM tbgalerias WHERE id_galeria=".(int)$_GET['id_galeria']." LIMIT 1;"));
		$inicio = (int)$_GET['pp'] * ( (int)$_GET['pag']-1 );
        $minis = db_consulta("SELECT imagem, legenda FROM tbgalerias_fotos WHERE id_galeria=".(int)$_GET['id_galeria']." AND flag_status=1 ORDER BY posicao ASC, id_foto ASC LIMIT ".$inicio.",".(int)$_GET['pp']);

		echo '<table id="galeriaMiniaturas"><tr>';

		$i=$inicio;
		$cont=0;
		while (list($imagem,$legenda) = db_lista($minis)) { $i++; $cont++;

			?>
        		<td><a href="javascript:void(null);" onclick="galeriaCarregaFoto(<?=$i;?>);"><img id="miniatura<?=$i;?>" class="normal" onmouseout="if (this.className!='ativo') this.className='normal';" onmouseover="if (this.className!='ativo') this.className='selecionado';" src="../arquivos/galeria/<?=$codigo;?>/miniaturas/<?=$imagem;?>" /></a></td>
            <?
			if (($cont%9)==0) echo '</tr><tr>';
		}
		echo '</tr></table>';
		echo PaginarGaleria($_GET['pag'],$_GET['pagtotal']);
	}






	if ($_GET['faz'] == 'comentarios') {
        $i=0;
        $SQL = "SELECT tbgalerias_comentarios.*,tbusuarios.*, DATE_FORMAT(datahora,'%H:%i do dia %d/%m/%Y') as data1 FROM tbgalerias_comentarios INNER JOIN tbusuarios ON (tbusuarios.id_usuario = tbgalerias_comentarios.id_usuario) WHERE id_galeria=".$_GET['id_galeria']." AND flag_status=1 ORDER BY datahora DESC ";

        # Paginação
        $PP=4;
        $Paginacao = new Paginacao($SQL, $PP ,$_GET['pag']);

		$procurar   = array('[8)]','[:(]','[:x]','[:)]','[;)]','[:D]','[:o]','[:P]','[/)]',);
		$substituir = array('<img src="../img/smiles/feliz.gif">','<img src="../img/smiles/triste.gif">','<img src="../img/smiles/nervoso.gif">',
		'<img src="../img/smiles/alegre.gif">','<img src="../img/smiles/piscando.gif">','<img src="../img/smiles/doido.gif">','<img src="../img/smiles/surpreso.gif">',
		'<img src="../img/smiles/divertido.gif">','<img src="../img/smiles/confuso.gif">');

        $consulta = db_consulta($SQL.' LIMIT '.$Paginacao->registroInicial().','.$PP);
		while ($linha = db_lista($consulta)) {
			$linha['mensagem'] = str_replace($procurar,$substituir,$linha['mensagem']);

			echo utf8_encode('<div class="item"><h5>Enviado por <u>'.$linha['nome'].'</u>, &agrave;s '.$linha['data1'].'</h5>'.$linha['mensagem'].'</div>');

		}

		if (db_linhas($consulta)>0) {

			echo utf8_encode('<div class="paginacao"><b>Páginas: </b>'.PaginarComentarios($_GET['pag'],$Paginacao->totalPaginas(),$_GET['id_galeria'],'galComentarios').'</div>');

		} else echo '<div style="padding:10px;">Nenhum comentario cadastrado.</div>';

	}





?>