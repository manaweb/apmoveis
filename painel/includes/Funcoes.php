<?php

// ------------------------------------------------------------------------------
// * processaString: tira caracteres que s�o incluidos automaticamente no envio de um form
// ------------------------------------------------------------------------------
function processaString($fonte) {
	$fonte = str_replace('\\"','"',$fonte);
	$fonte = str_replace('\\\\','\\',$fonte);
	return $fonte;
}

// ------------------------------------------------------------------------------
// * Criando imagem de v�deos do youtube e vimeo
// ------------------------------------------------------------------------------
function video_imagem($url){
    $url_imagem = parse_url($url);
    if($url_imagem['host'] == 'www.youtube.com' || $url_imagem['host'] == 'youtube.com'){
        $array = explode("&", $url_imagem['query']);
        return "http://img.youtube.com/vi/".substr($array[0], 2)."/0.jpg";
    } else if($url_imagem['host'] == 'www.vimeo.com' || $url_imagem['host'] == 'vimeo.com'){
        $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".substr($url_imagem['path'], 1).".php"));
        return $hash[0]["thumbnail_small"];
    }
}

// ------------------------------------------------------------------------------
// * tiraCaracteres: Deixa somente caracteres a-z A-Z 0-9 (com acentos)
// ------------------------------------------------------------------------------
function tiraCaracteres($aonde) {
	$texto = preg_replace("/[^a-zA-Z�-�0-9\s]/"," ",$aonde);
	while (strpos($texto,"  ")) $texto=str_replace("  "," ",$texto);
	return trim($texto);
}

// ------------------------------------------------------------------------------
// * Retira acentos de uma string
// ------------------------------------------------------------------------------
function retiraAcentos($texto) {

	$array1 = array( "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�" );
	$array2 = array( "a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c", "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C" );

	return str_replace( $array1, $array2, $texto );

}


// -----------------------------------------------------------------------------------------------------------
// * tiraRepetidos: Tira repetidos dentro de um array
// -----------------------------------------------------------------------------------------------------------
function tiraRepetidos($fonte) {
	asort($fonte);
	return array_unique($fonte);
}


// ------------------------------------------------------------------------------
// * soNumeros: Deixa somente n�meros em uma string
// ------------------------------------------------------------------------------
function soNumeros($fonte) {
	return preg_replace("/[^0-9]/","",$fonte);
}


// ------------------------------------------------------------------------------
// * formataValor: Formata um n�mero para reais (1000.00 -> 1.000,00)
// ------------------------------------------------------------------------------
function formataValor($valor){
	
	if (!empty($valor)){
		return number_format($valor,2,',','.');
	} else {
		return "0,00";
	}
}


// ------------------------------------------------------------------------------
// * pesquisaQuery: Monta uma query de pesquisa para MySQL. Retorna ARRAY
//	Requer: tiraCaracteres
// ------------------------------------------------------------------------------
function pesquisaQuery($colunas,$termos,$prefixo="%",$sufixo="%") {

	$termos = tiraCaracteres($termos);
	$buscastr = "";

	if (strlen($termos)>0) {
		$chaves = array_unique(explode(" ",$termos));
		if(sizeof($chaves)) {
			foreach($chaves as $chave) {	
				if (strlen($chave)>0) { 
					$pesquisado .= $chave." ";
					if (is_array($colunas)) {
						
						$buscastr .=  " AND  (1=2 ";;
						foreach ($colunas as $coluna) {
							$buscastr .=  " OR  ".$coluna." LIKE '".$prefixo.$chave.$sufixo."'";
						}
						$buscastr .=  ")";

					} else $buscastr .=  " AND  ".$coluna." LIKE '".$prefixo.$chave.$sufixo."'";
				}
			}
		}
	}
	
	return array($pesquisado,$buscastr);

}


// -----------------------------------------------------------------------------------------------------------
// * Paginacao: Gera pagina��o
//	Requer: db_lista() e db_consulta() em BancoDeDados.php, paginar() - logo abaixo
// -----------------------------------------------------------------------------------------------------------
class Consulta {
	var $sql;
	var $pp;
	var $pgatual;
	var $total_dados;
	var $pgtotal;
	var $consulta;

	# Construtor
	function Consulta($a,$b,$c) {
		$this->sql = $a;
		$this->pp = $b;
		$this->pgatual = $c;
		$this->total = db_linhas(db_consulta($a));

		if (($this->total % $this->pp)==0) $this->pgtotal = ($this->total / $this->pp);
		else $this->pgtotal = (int)($this->total / $this->pp) +1;

		$this->consulta = db_consulta($this->sql.' LIMIT '.$this->registroInicial().','.$this->pp);

		return true;
	}

	# Registro Inicial
	function registroInicial() {
		return ($this->pp * ($this->pgatual-1));
	}

	# Total de p�ginas
	function totalPaginas() {
		return $this->pgtotal;
	}

	# Total de p�ginas
	function geraPaginacao() {
		return paginar($this->pgatual,$this->pgtotal);
	}

}


// ------------------------------------------------------------------------------
// * paginar: Monta pagina��o
// ------------------------------------------------------------------------------
function paginar($atual,$qt) {

	# URL
	if (!strpos($_SERVER ['REQUEST_URI'],"/")) $url = "".utf8_decode($dadosconfig['url'])."".$_SERVER ['REQUEST_URI']."/"; else $url = $_SERVER ['REQUEST_URI'];
	$url = str_replace(array("/pg/".$atual,"/pg/".$atual),"",$url);
	$url = substr($url,strrpos($url,'')+0,strlen($url));

	# Inicio - Fim
	$inicio = 1;
	$fim = $qt;
	if ($qt > 10) {
		$inicio=$atual - 4;
		$fim = $atual + 5;
		if ($inicio < 1) {
			$fim=$fim - $inicio +1;
			$inicio = 1;
		}
		if ($fim > $qt) {
			$fim = $qt;
			$inicio = $fim - 9; 
		}
	}

	# Bot�o -Anterior-
	$saida .= '<a ';
	if ($atual>1) $saida .= ' href="'.$url.'pg/'.($atual-1).'" ';
	$saida .= ' class="pg-naveg-ante">Anterior</a>';

	# Pagina��o
	for ($i=$inicio;$i<=$fim;$i++) {
		$saida .= '<a href="'.$url.'pg/'.$i.'"';
		if ($i==$atual) $saida .= ' class="atual" ';
		$saida .= ' class="num" >'.$i.'</a>';
	}

	# Bot�o -Pr�xima-
	$saida .= '<a ';
	if ($atual<$qt) $saida .= ' href="'.$url.'pg/'.($atual+1).'" ';
	$saida .= ' class="pg-naveg-prox">Pr&oacute;xima</a>';



	return $saida;
}


// ------------------------------------------------------------------------------
// * dataDMY_YMD e dataYMD_DMY: Converte datas.
// ------------------------------------------------------------------------------
function dataDMY_YMD($fonte){
	return substr($fonte,6,4)."-".substr($fonte,3,2)."-".substr($fonte,0,2);
}
function dataYMD_DMY($fonte){ 
	return substr($fonte,8,2)."/".substr($fonte,5,2)."/".substr($fonte,0,4);
}


// ------------------------------------------------------------------------------
// * nomeDia: retorna o dia da semana (1-dom , 7-s�b)
// ------------------------------------------------------------------------------
function nomeDia($dia) { 
	switch($dia) {
		case 1: return "Domingo"; break;
		case 2: return "Segunda-feira"; break;
		case 3: return "Ter�a-feria"; break;
		case 4: return "Quarta-feira"; break;
		case 5: return "Quinta-feira"; break;
		case 6: return "Sexta-feira"; break;
		case 7: return "S�bado"; break;
	}			
}

// ------------------------------------------------------------------------------
// * nomeMes: retorna o m�s do ano
// ------------------------------------------------------------------------------
function nomeMes($mes) { 
	switch($mes) {
		case 1: return "Janeiro"; break;
		case 2: return "Fevereiro"; break;
		case 3: return "Mar�o"; break;
		case 4: return "Abril"; break;
		case 5: return "Maio"; break;
		case 6: return "Junho"; break;
		case 7: return "Julho"; break;
		case 8: return "Agosto"; break;
		case 9: return "Setembro"; break;
		case 10: return "Outubro"; break;
		case 11: return "Novembro"; break;
		case 12: return "Dezembro"; break;
	}			
}






// ------------------------------------------------------------------------------
// * Gera sa�da para publicidade (imagem ou flash)
// ------------------------------------------------------------------------------
function mostraBanner($arq,$x,$y, $destino) {

	$extensao = explode(".", $arq);
	$fimarray = (count($extensao) - 1);

	if ($extensao[$fimarray]=='swf') {

		$arq = substr($arq,0,strlen($arq)-4);

		return  '<script type="text/javascript">
	          		AC_FL_RunContent(\'codebase\',\'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0\',\'width\',\''.$x.'\',\'height\',\''.$y.'\',\'src\',\''.$arq.'\',\'quality\',\'high\',\'pluginspage\',\'http://www.macromedia.com/go/getflashplayer\',\'movie\',\''.$arq.'\',\'wmode\',\'transparent\' );
            	</script>
				<noscript>
					<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" 
            	    width="'.$x.'" height="'.$y.'"><param name="movie" value="'.$arq.'.swf" /><param name="quality" value="high" /><embed src="'.$arq.'.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" 
            	    width="'.$x.'" height="'.$y.'"></embed></object>
				</noscript>';

	} else 	if ($extensao[$fimarray]=='html') {

		if (file_exists($arq)) {
			return file_get_contents($arq);
		}

	} else  {

		$saida = '<img src="'.$arq.'" width="'.$x.'" height="'.$y.'">';
		if (strlen($destino)>0) $saida = '<a href="'.$destino.'" target="_blank">'.$saida.'</a>';
		return $saida;
	
	}

}

// ------------------------------------------------------------------------------
// * senhaAleatoria: Gera uma senha aleat�ria.
// ------------------------------------------------------------------------------
function senhaAleatoria($tamanho=8) {
    $chars = "abcdefghijkmnopqrstuvwxyz023456789";
    srand((double)microtime()*1000000);
    $i = 1;
    $pass = '' ;
    while ($i <= $tamanho) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }
    return $pass;
}


// ------------------------------------------------------------------------------
// * zeraSessao: Zera uma sess�o.
// ------------------------------------------------------------------------------
function zeraSessao() {
	foreach ($_SESSION as $campo => $valor) {
		session_unregister($campo);
	}
}


// ------------------------------------------------------------------------------
// * urlOrigem: Retorna a url atual
// ------------------------------------------------------------------------------
function urlOrigem() {

	$get = $_GET;
	$Proibidos=array('erro','msg','ok');	
	$get2='';

	foreach ($get as $a=>$b) {
		if (!in_array($a,$Proibidos)) $get2.="&".$a."=".$b;
	}

	return $_SERVER['PHP_SELF']."?".$get2;

}


// ------------------------------------------------------------------------------
// * ExtensaoArquivo: retorna a extens�o de um arquivo								
// ------------------------------------------------------------------------------
function extensaoArquivo($nomearquivo) {
	$extensao = explode(".", $nomearquivo);
	$fimarray = (count($extensao) - 1);
	return strtolower($extensao[$fimarray]);
}


// ------------------------------------------------------------------------------
// * FazerUpload: faz um upload				
// ------------------------------------------------------------------------------
function FazerUpload($arquivo,$destino,$nome_arquivo='',$tamanhomax=0) {

	// Tamanho do arquivo em bytes
	if ( ($arquivo["size"] > $tamanhomax) && ($tamanhomax > 0 ) ) return false;

	// Definindo o nome do arquivo
	if ($nome_arquivo == "") { 
		$nome_arquivo = md5(uniqid(time())). "." . strtolower(extensaoArquivo($arquivo['name'])); 
	}

	move_uploaded_file($arquivo["tmp_name"], $destino.$nome_arquivo); // Fazendo o upload
	
	return $nome_arquivo;

}

function fazerUpload2($arquivo) {
	$local =  str_replace(' ', '', "../../arquivos/banner/");
	$nomeArquivo = str_replace(' ', '', microtime().$arquivo["name"]);
	if(move_uploaded_file($arquivo["tmp_name"], $local.$nomeArquivo)){
		return $nomeArquivo;
	} // Fazendo o upload
	
	return false;
}

function fazerUploadProdutos($arquivo) {
	$local =  str_replace(' ', '', "../../arquivos/produtos/");
	$nomeArquivo = str_replace(' ', '', microtime().$arquivo["name"]);
	if(move_uploaded_file($arquivo["tmp_name"], $local.$nomeArquivo)){
		return $nomeArquivo;
	} // Fazendo o upload
	
	return false;
}


// ------------------------------------------------------------------------------
// * ListaDiretorio: lista o conte�do de um diret�rio									
// ------------------------------------------------------------------------------
function ListaDiretorio($diretorio, $tipoarquivo=null){ 
	$d = dir($diretorio); // Abrindo diret�rio 
	// Fazendo buscar por um arquivo ou diretorio de cada vez que estejam dentro da pasta especificada 
	while (false !== ($entry = $d->read())) {
		if ($tipoarquivo == '') {
			$array[] = $entry;
		}
		else if ($tipoarquivo == 'dir') {  
			// Verificando se o que foi encontrado � um diretorio 
			if (substr_count($entry, '.') == 0){
				// Se sim colocando na matriz 
				$array[] = $entry;
			}
		}
		else { 
			// Verificando se o que foi encontrado um arquivo especifico 
			if (substr_count($entry, $tipoarquivo) == 1) {
				// Se sim colocando na matriz 
				$array[] = $entry; 
			} // end if
		} // end if
	} // end while

	//Fechando diretorio 
	$d->close(); 
	if ($array=='') { 
		$array = false; 
	}
	else { 			
		sort ($array); // Colocando em ordem alfabetica 
		reset ($array); // Voltando o ponteiro para o inicio da matriz 
	} 
	return $array; // Retornado resultado final 
}


// ------------------------------------------------------------------------------
// * apagarDir: Apaga um diret�rio completo !! CUIDADO !!				
// ------------------------------------------------------------------------------
function apagarDir($dir){
	if(is_dir($dir)) { // verifica se realmente � uma pasta
		if($handle = opendir($dir)) {
			while(false !== ($file = readdir($handle))) { // varre cada um dos arquivos da pasta
				if(($file == ".") or ($file == "..")) {
					continue;
				}
				if(is_dir($dir."/".$file)) { // verifica se o arquivo atual � uma pasta
					// caso seja uma pasta, faz a chamada para a funcao novamente
					apagarDir($dir."/".$file);
				} else {
					// caso seja um arquivo, exclui ele
					@unlink($dir."/".$file);
				}
			}
		} else {
			return false;
		}
	
		// fecha a pasta aberta
		closedir($handle);

		// apaga a pasta, que agora esta vazia
		@rmdir($dir);
	} else {
		return false;
	}
}




// ------------------------------------------------------------------------------
// * Gera um nome para arquivo v�lido
// Requer: retiraAcentos()
// ------------------------------------------------------------------------------
function nomeArquivo($orig,$pasta='') {

	preg_match_all('.[[:alnum:]\(\)_\.\[\]\- ].', $orig, $saida); 
	$saida = implode($saida[0]);
	$saida = str_replace(' ','_',$saida);
	$saida = retiraAcentos($saida);

	if ($pasta!="") {

		$arqExtensao = substr($saida,strrpos($saida,'.'),strlen($saida));
		$arqNome = substr(str_replace($arqExtensao,'',$saida),0,90);

		$i=0;
		while (is_file($pasta.$saida)) { $i++;
			$saida = $arqNome . '(' .$i . ')' . strtolower($arqExtensao);

			if ($i>1000) break;
		}
	
	}

	return $saida ;

}










// ------------------------------------------------------------------------------
// * CriarImagem: classe que gera uma imagem de confirma��o
// ------------------------------------------------------------------------------
class CriarImagem{ 
   // Matriz para criar o texto para imagem 
   var $str="123456789ABCDEFGHJKLMNPQRSTUVWXYZ"; 
   var $width = 100;//Largura da imagem 
   var $height = 30;//Altura da imagem 

   // Arquivos com Fontes TrueType 
   var $fonts = array('../avgardd.ttf','../bankgthd.ttf', '../bauhausb.ttf', '../goldminn.ttf'); 

   // Cores no formato hexadecimal
   #var $hexcolors = array("#003300", "#000033", "#910202", "#333333", "#663300");
   var $linecolors = array("#bb0000", "#00bb00", "#0000bb");
   #var $hexcolors = array("#FFFFFF", "#000000", "#003399", "#0000FF", "#990000", "#E60000", "#006600", "#9900FF", "#DF5900", "#646464", "#FFFF00", "#993366", "#440088");
   var $hexcolors = array("#005500", "#000055", "#550000", "#555500", "#550055", "#005555"); 

   var $image; 

   // Gera uma semente para ser utilizada pela fun��o srand 
   function make_seed() { 
	   list($usec, $sec) = explode(' ', microtime()); 
	   return (float) $sec + ((float) $usec * 100000); 
   } 

   // Converte hexadecimal para rgb 
   function hex2rgb($hex) { 
	   $hex = str_replace('#','',$hex); 
	   $rgb = array('r' => hexdec(substr($hex,0,2)), 
					'g' => hexdec(substr($hex,2,2)), 
					'b' => hexdec(substr($hex,4,2))); 
	   return $rgb; 
   } 
	
   // Aloca uma cor para imagem 
   function color($value){ 
	   $rgb = $this->hex2rgb($value); 
	   return ImageColorAllocate($this->image, $rgb['r'], $rgb['g'], $rgb['b']); 
   } 
	
   // Aloca uma cor aleat�ria para imagem 
   function randcolor(){ 
	   srand($this->make_seed()); 
	   shuffle($this->hexcolors); 
	   return $this->color($this->hexcolors[0]);    
   } 
	
   // Aloca uma cor aleat�ria para imagem 
   function randcolor2(){ 
	   srand($this->make_seed()); 
	   shuffle($this->linecolors); 
	   return $this->color($this->linecolors[0]);    
   } 

   // Cria uma linha em  posi��o e cor aleat�ria 
   function randline(){ 
	   srand($this->make_seed()); 
	   shuffle($this->hexcolors); 
	   $i=rand(0, $this->width); 
	   $k=rand(0, $this->width); 
	   imagesetthickness ($this->image, 2); 
	   imageline($this->image,$i,0,$k,$this->height,$this->randcolor2());    
   } 
	
   // Cria um quadrado 10x10 em posi��o e cor aleat�ria 
   function randsquare(){ 
	   imagesetthickness ($this->image, 1); 
	   srand($this->make_seed()); 
	   $x=rand(0, ($this->width-15)); 
	   $y=rand(0, ($this->height-15)); 
	   ImageRectangle( $this->image, $x, $y, $x+12, $y+12, $this->randcolor2()); 
	   //ImageRectangle( $this->image, $x+20, $y, $x, $y+20, $this->randcolor2()); 
   } 
	
   // Cria uma imagem com texto aleat�rio e retorno o texto 
   function output(){ 
	   $defstr=""; 
	   //$this->image = ImageCreate($this->width,$this->height); 
	   $this->image = imagecreatefromjpeg("../imgconfirm_bg.jpg"); 
	   //$background = $this->color('#DBDCD5');   
	   //ImageRectangle($this->image, 0,0,$this->width , $this->height, $background); 
	   //imageFilledRectangle($this->image, 0,0,$this->width , $this->height, $background); 
	   srand($this->make_seed());
	   shuffle($this->hexcolors);
	   shuffle($this->fonts);
	   for ($i=0;$i < 4;$i++) { 
			$this->str=str_shuffle($this->str); 
			//shuffle($this->hexcolors); 
			//shuffle($this->fonts); 
			$char=$this->str[0]; 
			$defstr.=$char; 
			imagettftext($this->image, 24, rand(-15,15), ($i*31+6), rand(35,($this->height-7)), $this->color($this->hexcolors[$i]), $this->fonts[$i],$char); 
	   } 

	   for ($k=0; $k < 3; $k++){ 
			$this->randline(); 
	   } 

	   for ($k=0; $k < 4; $k++){ 
			$this->randsquare(); 
	   } 
		
	   ImagePng($this->image); 
	   ImageDestroy($this->image);
	   return $defstr; 
   } 
} 


// ------------------------------------------------------------------------------
// * Gera um nome de url v�lido
// Requer: retiraAcentos()
// ------------------------------------------------------------------------------
function nomeURL($orig) {

	preg_match_all('.[[:alnum:]\(\)_\.\[\]\- ].', $orig, $saida); 
	$saida = implode($saida[0]);
	$saida = str_replace(' ','_',$saida);
	$saida = retiraAcentos($saida);

	return strtolower($saida);

}






?>