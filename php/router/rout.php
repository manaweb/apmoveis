<?php

include 'php/classes/filter.class.php';
include 'respect/vendor/autoload.php';

use Respect\Rest\Router;
use Respect\Relational\Sql;
use Respect\Relational\Mapper;
use Respect\Validation\Validator as v;

function captcha () {
	require_once ('captcha/recaptchalib.php');
	$public_key = "6LeV7OYSAAAAAHwJhgNBBTrxvcdthtZObYJdldj2";
	return recaptcha_get_html($public_key);
}


$r3 = new Router;
$r3->isAutoDispatched = false;

$r3->get('/101fm/*/*/*/*/*', function($materia,$dia,$mes,$ano,$noticia) {
 	$dateFormat = "$ano-$mes-$dia";
 	if (v::string()->alnum('-')->notEmpty()->noWhitespace()->lowercase()->length(1,255)->validate($noticia) === true && v::date()->validate($dateFormat) === true) {
	 		$filtrar = new Filters();	
			$arq = $filtrar->_paraURL($materia);
			$data = $dateFormat;
			$title = $noticia;
			$originalTitle = $noticia;
			$title = $filtrar->_paraURL($title);
			$titleHash = md5($title);
			$formatName = "{$arq}-{$title}_{$data}.html";
			$tmpHeader = new Headers;

			if (file_exists("cache/$formatName")) {
				$tmpHeader->_setHeader('formatName',"cache/header-$formatName");
				$cache = file_get_contents("cache/$formatName");
				return $cache;
			}
			else {
				if (isset($arq) && isset($data) && isset($title)) {

					switch($arq) {
						case 'editoriais':
							$_SESSION['cor'][0] = 'vermelhoEscuro';
							$_SESSION['cor'][1] = $_SESSION['cor'][0];
						break;
						case 'jornal101fm':
							$_SESSION['cor'][0] = 'verdeEscuro';
							$_SESSION['cor'][1] = 'claro';
						break;
						case 'especial':
							$_SESSION['cor'][0] = 'laranja';
							$_SESSION['cor'][1] = $_SESSION['cor'][0];
						break;
						case 'resumodasemana':
							$_SESSION['cor'][0] = 'cinza';
							$_SESSION['cor'][1] = $_SESSION['cor'][0];
						break;
						case 'vereadoremacao':
							$_SESSION['cor'][0] = 'azul';
							$_SESSION['cor'][1] = $_SESSION['cor'][0];
						break;
					}

					$mapper = new Mapper(new PDO("mysql:host=".DB_SERVIDOR.";dbname=".DB_BANCO."",DB_USUARIO,DB_SENHA));
					$gNews = $mapper->tbnoticias->fetchAll(Sql::where("DATE_FORMAT(data,'%Y-%m-%d') = '$data' AND tituloHash='$titleHash'"));
					$gCat = $mapper->tbnoticias_categorias->fetchAll();
					
					$tmpHeader->_setHeader('title',"101FM Jornal - ".utf8_encode($gNews[0]->titulo)."");
					$tmpHeader->_setHeader('formatName',"cache/header-$formatName");
					
					foreach($gCat as $categoria) {
						$cat = $filtrar->_paraEliminar($filtrar->_paraURL($filtrar->_paraRetirarAcentos($categoria->categoria)),'-,.');
						if (v::equals($cat)->validate($arq) === true && v::equals($categoria->id_categoria)->validate($gNews[0]->id_categoria)) {
							$catid = $categoria->id_categoria;
							$sessoes = '';
							$gSessoes = $mapper->tbnoticias->fetchAll(Sql::where("id_categoria = $catid"));
							$gSessoesImg = $mapper->tbnoticias_imagens->fetchAll(Sql::where("id_categoria = $catid"));
							$tmpArray = array();
							foreach($gSessoesImg as $gImg)
								$tmpArray[] = $gImg->imagem;
							$i = 0;
							foreach($gSessoes as $sessions) {
								$sessoes .= '<li>
											<a href="javascript:void(0);">
												<img src="'.DOMAIN.'painel/arquivos/noticias/_miniaturas/'.$tmpArray[$i].'">
												<span class="containerTexto">
													'.utf8_encode($sessions->titulo).'
												</span>
											</a>
										</li>';
										$i++;
									}
							$tmpDir = html_entity_decode($categoria->categoria);
							$_SESSION['sessao'] = mb_strtoupper($tmpDir,'UTF-8');
							$gImagens = $mapper->tbnoticias_imagens->fetchAll(Sql::where("id_noticia = {$gNews[0]->id_noticia}"));
							$html = '<div class="header">
										<h4 class="reduzirEspaco">'.date('H:i d/m/Y',strtotime($gNews[0]->data)).' / Enviado por: <b>'.utf8_encode($gNews[0]->creditos).'</b></h4>
										<h1>'.utf8_encode($gNews[0]->titulo).'</h1>
										<h3 class="reduzirEspaco">'.utf8_encode($gNews[0]->subtitulo).'</h3>
									</div>
									<div id="share">
									<!-- AddThis Button BEGIN -->
										<div class="addthis_toolbox addthis_default_style">
											<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
											<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
											<a class="addthis_button_tweet"></a>
										</div>
										<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
										<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-521f46ce34b9465b"></script>
										<!-- AddThis Button END -->
									</div>
									<div id="sessoes">
										<ul class="sessoes">
											<li>
												<a href="javascript:void(0);" title="Ouvir reportagem">AUDIOS</a>
											</li>
											<li>
												<a href="javascript:void(0);" class="video" title="Visualizar videos">VIDEOS</a>
											</li>
											<li>
												<a href="javascript:void(0);" class="fotos" title="Ver fotos">FOTOS</a>
											</li>
											<li>
												<a href="javascript:void(0);" class="baixar" title="Baixar">BAIXAR</a>
											</li>
										</ul>
											<div id="fontes">
												<ul class="sessoes">
													<li>
														<a href="javascript:void(0);" title="Aumentar fonte" id="aumentarFonte">+A</a>
													</li>
													<li>
														<a href="javascript:void(0);" title="Reduzir fonte" id="reduzirFonte">-A</a>
													</li>
													<li>
														<a href="javascript:window.print()" class="imprimir"></a>
													</li>
												</ul>
											</div>
										</div>
										<div id="noticiaTexto">
											<img src="'.DOMAIN.'painel/arquivos/noticias/'.$gImagens[0]->imagem.'">
											<span class="texto">
												'.utf8_encode($gNews[0]->texto).'
											</span>
										</div>
										<div id="comentarios">
								<h2>COMENTÁRIOS</h2>
								<h3>Seja o primeiro a comentar</h3>
								<form action="" method="POST" class="comentarios">
									<fieldset>	
										<div id="campos" class="arredondar">
											<label for="nome">Nome:</label>
											<label for="email">E-mail:</label>
											<input type="text" name="nome" id="nome" maxlength="40" class="text" placeholder="Digite seu nome..." />
											<input type="mail" name="email" id="email" maxlength="200" class="text" placeholder="Digite seu e-mail..." />
											<label for="comentario">Seu comentário:</label>
											<textarea id="comentario" name="comentario" placeholder="Entre com o seu comentário" class="textarea"></textarea>
										</div>
										<div id="captcha">'.captcha().'</div>
										<div id="texto_termos">
											<input type="checkbox" id="termos" name="termos" />&nbsp;Aceito os <a href="javascript:void(0);">termos de uso</a>
										</div>
										<input type="submit" class="btn" value="Enviar" />
									</fieldset>
								</form>
							</div>
						</div>
						<div id="outrasNoticias" class="direita '.$_SESSION['cor'][0].'">
							<div class="mark '.$_SESSION['cor'][1].'"></div>
							<h3 class="reduzirEspaco">'.$_SESSION['sessao'].'</h3>
							<div class="containerRight">
								<a href="javascript:void(0)" class="btn btn_topo" id="btn_topo"></a>
								<div class="contentContainer">
									<ul>
										'.$sessoes.'
									</ul>
								</div>
								<a href="javascript:void(0)" class="btn btn_baixo" id="btn_baixo"></a>
							</div>
						</div>';
							file_put_contents("cache/$formatName",$html);
							return $html;
							break;
						}
					}
				}
											
			}
		}
		header('Location: 404.php');
		return false;
});

@session_destroy();

$result = $r3->run();