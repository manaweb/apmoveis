<?php


function _listNews($categoryID,$quantity=-1) {
	$html = '';
	$limit = '';
	if ($quantity > 0) 
			$limit = "LIMIT $quantity";

	$consultaImagens = mysql_query("
		SELECT `tbnoticias_imagens`.imagem, `tbnoticias`.*
		FROM tbnoticias INNER JOIN tbnoticias_imagens
		ON `tbnoticias_imagens`.id_noticia = `tbnoticias`.id_noticia
		WHERE `tbnoticias`.id_categoria = $categoryID ORDER BY id_noticia DESC $limit
	");

	switch($categoryID) {

		case 29:
			while ($fetchs = mysql_fetch_assoc($consultaImagens)) {
				$titulo = utf8_encode($fetchs['titulo']);
				$dateFormat = date('d/m/Y',strtotime($fetchs['data']));
				$html .= '<li>
							<a href="editoriais/'.$dateFormat.'/'.$fetchs['tituloURL'].'" title="'.$titulo.'">
								<img src="'.DOMAIN.'painel/arquivos/noticias/_miniaturas/'.$fetchs['imagem'].'" alt="'.$titulo.'"/>
								<div class="globalTexto">
									<h4>'.substr($titulo,0,60).'</h4>
										<span>
											<span class="data">'.$dateFormat.'</span>
											'.utf8_encode($fetchs['subtitulo']).'
										</span>
								</div>
							</a>
						</li>';
			}
		break;

		case 30:
			while ($fetchs = mysql_fetch_assoc($consultaImagens)) {
				$titulo = utf8_encode($fetchs['titulo']);
				$dateFormat = date('d/m/Y',strtotime($fetchs['data']));
				$html .= '<li>
								<a href="jornal101fm/'.$dateFormat.'/'.$fetchs['tituloURL'].'" title="'.$titulo.'">
									<img src="'.DOMAIN.'painel/arquivos/noticias/_miniaturas/'.$fetchs['imagem'].'" alt="'.$titulo.'" />
									<div class="globalTexto">
										<span class="desc">'.utf8_encode(substr($fetchs['subtitulo'],0,35)).'</span>
										<h4>'.substr($titulo,0,70).'</h4>
									</div>
								</a>
						</li>';
			}
		break;

		case 31:
			while ($fetchs = mysql_fetch_assoc($consultaImagens)) {
				$titulo = utf8_encode($fetchs['titulo']);
				$dateFormat = date('d/m/Y',strtotime($fetchs['data']));
				$html .= '<div id="vereadorAcaoPost">
								<a href="vereadoremacao/'.$dateFormat.'/'.$fetchs['tituloURL'].'" title="'.$titulo.'">
									<img src="'.DOMAIN.'painel/arquivos/noticias/_miniaturas/'.$fetchs['imagem'].'" alt="'.$titulo.'" />
									<div class="globalTexto">
										<h2>
											'.$titulo.'
										</h2>
										<span id="tmpText">
											'.utf8_encode(substr($fetchs['texto'],0,563)).'
										</span>
									</div>
								</a>
							</div>';
			}
		break;

		case 33:
		while ($fetchs = mysql_fetch_assoc($consultaImagens)) {
				$titulo = utf8_encode($fetchs['titulo']);
				$dateFormat = date('d/m/Y',strtotime($fetchs['data']));
				$html .= '<a href="especial/'.$dateFormat.'/'.$fetchs['tituloURL'].'" title="'.$titulo.'">
							<img src="'.DOMAIN.'painel/arquivos/noticias/_miniaturas/'.$fetchs['imagem'].'" alt="'.$titulo.'"  />
								<div class="clear globalTexto">
									<h4>'.substr($titulo,0,50).'...</h4>
										<span>
											<span class="data">'.$dateFormat.'</span>
											'.utf8_encode(substr($fetchs['subtitulo'],0,50)).'...
										</span>
								</div>
							</a>';
			}
		break;
		case 34:
			while ($fetchs = mysql_fetch_assoc($consultaImagens)) {
				$titulo = utf8_encode($fetchs['titulo']);
				$dateFormat = date('d/m/Y',strtotime($fetchs['data']));
				$html .= '<a href="resumodasemana/'.$dateFormat.'/'.$fetchs['tituloURL'].'" title="'.$titulo.'">
							<img src="'.DOMAIN.'painel/arquivos/noticias/_miniaturas/'.$fetchs['imagem'].'" alt="'.$titulo.'"  />
								<div class="clear globalTexto">
									<h4>'.substr($titulo,0,50).'...</h4>
										<span>
											<span class="data">'.$dateFormat.'</span>
											'.utf8_encode(substr($fetchs['subtitulo'],0,50)).'...
										</span>
								</div>
							</a>';
			}
		break;
	}
	return $html;
}