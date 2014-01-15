<?
$foto 	= $_GET['img']; // Caminho da foto
$cortar = $_GET['corta'];
#$tam 	= $_GET['tam']; // Configuracao do tamanho da imagem final
$largura_moldura = $_GET['x'];
$altura_moldura = $_GET['y'];

//Recebe o nome da imagem
$imagem = $foto;

# x_y_corta_caminhoarq


function imageComposeAlpha( &$src, &$ovr, $ovr_x, $ovr_y, $ovr_w = false, $ovr_h = false)
{
	if( $ovr_w && $ovr_h )
		$ovr = imageResizeAlpha( $ovr, $ovr_w, $ovr_h );
 
	/* Noew compose the 2 images */
	imagecopy($src, $ovr, $ovr_x, $ovr_y, 0, 0, imagesx($ovr), imagesy($ovr) );
}

/**
 * Resize a PNG file with transparency to given dimensions
 * and still retain the alpha channel information
 * Author:  Alex Le - http://www.alexle.net
 */
function imageResizeAlpha(&$src, $w, $h)
{
		/* create a new image with the new width and height */
		$temp = imagecreatetruecolor($w, $h);
 
		/* making the new image transparent */
		$background = imagecolorallocate($temp, 0, 0, 0);
		ImageColorTransparent($temp, $background); // make the new temp image all transparent
		imagealphablending($temp, false); // turn off the alpha blending to keep the alpha channel
 
		/* Resize the PNG file */
		/* use imagecopyresized to gain some performance but loose some quality */
		imagecopyresized($temp, $src, 0, 0, 0, 0, $w, $h, imagesx($src), imagesy($src));
		/* use imagecopyresampled if you concern more about the quality */
		//imagecopyresampled($temp, $src, 0, 0, 0, 0, $w, $h, imagesx($src), imagesy($src));
		return $temp;
}
	

$proporcao_moldura = $largura_moldura / $altura_moldura;
$proporcao_moldura = round($proporcao_moldura, 2);

list($largura_orig, $altura_orig) = getimagesize($imagem); // Largura e Altura originais

  if ($cortar==1) {} else {
	if (($largura_orig < $largura_moldura)&&($altura_orig < $altura_moldura)) {
		$theight = $altura_orig;
		$twidth = $largura_orig;

	} else {

		$theight = $largura_moldura * $altura_orig 	 / $largura_orig;
		$twidth = $largura_moldura;
		if ($theight > $altura_moldura) {
			$theight = $altura_moldura;
			$twidth = $altura_moldura * $largura_orig / $altura_orig; 
		 }
	}
	$altura_moldura = $theight;
	$largura_moldura = $twidth;
  }


$proporcao = $largura_orig / $altura_orig;
$proporcao = round($proporcao, 2);


if ($proporcao == $proporcao_moldura) { // Se a proporção da imagem for IGUAL que 4/3
	$largura_dest = $largura_moldura;
	$altura_dest = $altura_moldura;
	$tipo = null;
} elseif ($proporcao < $proporcao_moldura) { // Se a proporção da imagem for MENOR que 4/3
	$altura_dest = ($largura_moldura * $altura_orig) / $largura_orig;
	$altura_dest = round($altura_dest, 0);
	$largura_dest = $largura_moldura;
	
	$tipo = "p";
}
else { // Se a proporção da imagem for MAIOR que 4/3
	$largura_dest = ($altura_moldura * $largura_orig) / $altura_orig;
	$largura_dest = round($largura_dest, 0);
	$altura_dest = $altura_moldura;
	
	$tipo = "r";
} 
	
	#die($tipo."|");

if ($tipo == "r") { // Se a foto é do tipo RETRATO (Vertical)
	$x = $largura_dest - $largura_moldura;
	$x = $x / 2;
	$x = $x * (-1);
	$y = 0;
} 
elseif ($tipo == "p") { // Se a foto é do tipo PAISAGEM (Horizontal)
	$y = $altura_dest - $altura_moldura;
	$y = $y / 2;
	$y = $y * (-1);
	$x = 0;

} else {
	$y = $altura_dest - $altura_moldura;
	$x = $y;
}

$Extensao = strtolower(substr($foto,strlen($foto)-3,3));

// Início da Geração da Imagem
header('Content-type: image/jpeg');


//$imagem_dest = imagecreatetruecolor($largura_moldura, $altura_moldura);
$imagem_dest = imagecreatetruecolor($largura_moldura, $altura_moldura);

if ($Extensao=='gif') $imagem_orig = imagecreatefromgif($imagem);
else if ($Extensao=='png') $imagem_orig = imagecreatefrompng($imagem);
else $imagem_orig = imagecreatefromjpeg($imagem);



//imagecopyresized($imagem_dest, $imagem_orig, 0, 0, 0, 0, $largura_dest, $altura_dest, $largura_moldura, $altura_moldura);
imagecopyresampled($imagem_dest, $imagem_orig, $x, $y, 0, 0, $largura_dest, $altura_dest, $largura_orig, $altura_orig);

if ($Logomarca) {
	$LogomarcaImg = imagecreatefrompng($LogomarcaArquivo);
	$LogomarcaDimensoes = getimagesize($LogomarcaArquivo);
	$LogomarcaX = 0;
	$LogomarcaY = $altura_dest - $LogomarcaDimensoes[1];
	imageComposeAlpha( $imagem_dest, $LogomarcaImg, $LogomarcaX, $LogomarcaY);
}

// Output
imagejpeg($imagem_dest, null, 80);



exit;

?> 