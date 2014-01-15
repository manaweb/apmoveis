<?
	include ('../includes/BancoDeDados.php'); 
	include ('../includes/Funcoes.php'); 
	include ('../includes/Config.php'); 

	#sleep(1);

	if ($_GET['faz'] == 'foto') {
		list($codigo) = db_lista(db_consulta("SELECT codigo FROM tbgalerias WHERE id_galeria=".(int)$_GET['id_galeria']." LIMIT 1;"));
		list($imagem,$legenda) = db_lista(db_consulta("SELECT imagem, legenda FROM tbgalerias_fotos WHERE id_galeria=".(int)$_GET['id_galeria']." AND flag_status=1 ORDER BY posicao ASC, id_foto ASC LIMIT ".(int)( $_GET['pos']-1 ).",1"));
		?>
        	<img src="../arquivos/galeria/<?=$codigo;?>/fotos/<?=$imagem;?>" class="foto" />
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
        		<td style="padding:2px;"><a href="javascript:void(null);" onclick="galeriaCarregaFoto(<?=$i;?>);"><img id="miniatura<?=$i;?>" class="normal" onmouseout="if (this.className!='ativo') this.className='normal';" onmouseover="if (this.className!='ativo') this.className='selecionado';" src="../arquivos/galeria/<?=$codigo;?>/miniaturas/<?=$imagem;?>" /></a></td>
            <?
			if (($cont%9)==0) echo '</tr><tr>';
		}
		echo '</tr></table>';
	}





?>