<?php


/* 
*	Trabalhar fotos 
*/
function Miniatura($origem, $destino, $largura, $altura, $corte=0, $apagar=0, $marcaArquivo="", $marcaDistancia="",$marcaPosicao="",$marcaOpacidade="") {


	if (file_exists($origem)) {
		$obj = new Redimensionar($origem);
		$obj->setImagemNova($destino);
		$obj->setCorte($corte);
		$obj->setProporcional($proporcional);
		$obj->setNovoTamanho($largura, $altura);

		if (!empty($marcaArquivo)) {
			$obj->setMarcadaguaDistancia($marcaDistancia);
			$obj->setMarcadaguaPosicao($marcaPosicao);
			$obj->setMarcadaguaOpacidade($marcaOpacidade);
			$obj->setMarcadaguaArquivo($marcaArquivo);
		}

		$obj->MandaBala();
		if ($apagar==1) @unlink($origem);
		return true;

	} else return false;
}




class Redimensionar {
	var $imagem;
	var $ImagemNova;
	var $ImagemTipo;
	var $altura;
	var $largura;
	var $AlturaTemp;
	var $LarguraTemp;
	var $novaAltura;
	var $novaLargura;
	var $AlturaFinal;
	var $LarguraFinal;
	var $proporcional=1;
	var $FlagProporcional="H";

	# Cortar a imagem
	var $Corte = 0;
	var $CorteTipo = 1; // 0 para TOP, 1 para MEIO, 2 para FIM
	var $novaAlturaCorte;
	var $novaLarguraCorte;

	/*--------------- 
	| 1		2	  3	|	
	|		4		|	MarcadaguaPosicao
	| 5		6  	  7	|
	---------------*/
	# Marca D'água
	var $MarcadaguaArquivo;
	var $MarcadaguaTipo;
	var $MarcadaguaLargura;
	var $MarcadaguaAltura;
	var $MarcadaguaPosicao = 7;
	var $MarcadaguaOpacidade = 50;
	var $MarcadaguaDistancia = 10;




	# Construtor
	function Redimensionar($imagem) {
        $this->setImagem($imagem);
        return true;
    }


	# Identificando a Imagem
    function setImagem($imagem) {
        $this->imagem = $imagem;

        if ($tmp = getimagesize($this->imagem) ) {
            $this->largura = $tmp[0];
            $this->altura = $tmp[1];
            $this->ImagemTipo = $tmp[2];
        } else die('Não foi possível identificar o tamanho da imagem original.');
    }

    function getImagem() {
        return $this->imagem;
    }

    function setImagemNova($ImagemNova) {
        $this->ImagemNova = $ImagemNova;
    }

    function getImagemNova() {
        return $this->ImagemNova;
    }
   

	# Marca D'água
    function setMarcadaguaArquivo($MarcadaguaArquivo) {
        $this->MarcadaguaArquivo = $MarcadaguaArquivo;
    }
   
    function getMarcadaguaArquivo() {
        return $this->MarcadaguaArquivo;
    }
   
    function setMarcadaguaPosicao($MarcadaguaPosicao) {
        if($MarcadaguaPosicao >= 1 || $MarcadaguaPosicao <= 7) {
            $this->MarcadaguaPosicao = $MarcadaguaPosicao;

        } else die("Posição da marca d'agua é inválida.");
    }

    function getMarcadaguaPosicao() {
        return $this->MarcadaguaPosicao;
    }
   
    function setMarcadaguaOpacidade($MarcadaguaOpacidade) {
        if($MarcadaguaOpacidade > 0 && $MarcadaguaOpacidade <= 100) {
            $this->MarcadaguaOpacidade = $MarcadaguaOpacidade;

        } else die('Opacidade informada é inválida. Use valores de 1 a 100.');
    }
   
    function getMarcadaguaOpacidade() {
        return $this->MarcadaguaOpacidade;
    }

    function setMarcadaguaDistancia($MarcadaguaDistancia) {
        $this->MarcadaguaDistancia = $MarcadaguaDistancia;
    }
   
    function getMarcadaguaDistancia() {
        return $this->MarcadaguaDistancia;
    }
   


	# Nova Imagem
    function setNovoTamanho($novaLargura, $novaAltura) {

		$diferenca = $this->largura - $this->altura;
	
		if($diferenca > 0) {
			$this->setFlagProporcional("H");
		} else {
			$this->setFlagProporcional("V");
		}

		if (($this->largura < $novaLargura)&&($this->altura < $novaAltura) ) {
    	    $this->novaAltura = $this->altura;
    	    $this->novaLargura = $this->largura;
		} else {
    	    $this->novaAltura = $novaAltura;
    	    $this->novaLargura = $novaLargura;
		}
    }

    function setProporcional($proporcional) {
        if($this->Corte == 0) {
            $this->proporcional = $proporcional;
        } else {
            $this->proporcional = 1;
        }
    }


    function getProporcional() {
        return $this->proporcional;
    }

    function setFlagProporcional($FlagProporcional) {
        $this->FlagProporcional = $FlagProporcional;
    }

    function getFlagProporcional() {
        return $this->FlagProporcional;
    }
   


    # Corte
    function setCorte($Corte) {
        if($Corte > 1 || $Corte < 0) {
            die('Valor para \$Corte deve ser 0 ou 1.');
        }
        $this->setProporcional(1);
        $this->Corte = $Corte;
    }
   
    function getCorte() {
        return $this->Corte;
    }

    function setCorteTipo($CorteTipo) {
        $this->CorteTipo = $CorteTipo;
    }
   
    function getCorteTipo() {
        return $this->CorteTipo;
    }



	# Copiando imagem
    function copiarImagem() {
        if(!empty($this->imagem) && !empty($this->ImagemNova)) {
            if(!@copy($this->getImagem(), $this->getImagemNova())) {
                die('Não foi possível copiar o arquivo.');
            }
            else {
                $this->setImagem($this->getImagemNova());
                $this->setImagemNova("");
                return true;
            }
        }
        else {
            die("Erro. Verifique os atributos 'imagem' e 'ImagemNova'.");
        }
    }
   
    function verificarAtributos() {
        if(empty($this->imagem)) {
            die("Atributo 'imagem' não definido.");
        }
        if(empty($this->ImagemTipo)) {
            die("Atributo 'ImagemTipo' não definido.");
        }
        if(empty($this->altura)) {
            die("Atributo 'altura' não definido.");
        }
        if(empty($this->largura)) {
            die("Atributo 'largura' não definido.");
        }
        if(empty($this->novaAltura)) {
            die("Atributo 'novaAltura' não definido.");
        }
        if(empty($this->novaLargura)) {
            die("Atributo 'novaLargura' não definido.");
        }
    }


    function verificarMarcadaguaAtributos() {
        if(empty($this->MarcadaguaArquivo)) {
            die("Atributo 'MarcadaguaArquivo' não definido.");
        }
        if(empty($this->MarcadaguaTipo)) {
            die("Atributo 'MarcadaguaTipo' não definido.");
        }
        if(empty($this->MarcadaguaAltura)) {
            die("Atributo 'MarcadaguaAltura' não definido.");
        }
        if(empty($this->MarcadaguaLargura)) {
            die("Atributo 'MarcadaguaLargura' não definido.");
        }
    }





	# 
	# METE BRONCA!
	#
    function MandaBala() {
        $this->verificarAtributos();

        if(!empty($this->ImagemNova)) {
            $this->copiarImagem();
        }


	  if ($this->getCorte() == 1) {} else {
		if (($this->largura < $this->novaLargura)&&($this->altura < $this->novaAltura)) {
			$this->AlturaTemp = $this->altura;
			$this->LarguraTemp = $this->largura;
	
		} else {
	
			$this->AlturaTemp = $this->novaLargura * $this->altura 	 / $this->largura;
			$this->LarguraTemp = $this->novaLargura;
			if ($this->AlturaTemp > $this->novaAltura) {
				$this->AlturaTemp = $this->novaAltura;
				$this->LarguraTemp = $this->novaAltura * $this->largura / $this->altura; 
			 }
		}
		$this->novaAltura = $this->AlturaTemp;
		$this->novaLargura = $this->LarguraTemp;
	  }
	
		$proporcao_moldura = $this->novaLargura / $this->novaAltura;
		$proporcao_moldura = round($proporcao_moldura, 2);

		$proporcao = $this->largura / $this->altura;
		$proporcao = round($proporcao, 2);


		if ($proporcao == $proporcao_moldura) { // Se a proporção da imagem for IGUAL que 4/3
			$this->LarguraFinal = $this->novaLargura;
			$this->AlturaFinal = $this->novaAltura;
			$this->FlagProporcional = null;
		} elseif ($proporcao < $proporcao_moldura) { // Se a proporção da imagem for MENOR que 4/3
			$this->AlturaFinal = ($this->novaLargura * $this->altura) / $this->largura;
			$this->AlturaFinal = round($this->AlturaFinal, 0);
			$this->LarguraFinal = $this->novaLargura;
			
			$this->FlagProporcional = "P";
		}
		else { // Se a proporção da imagem for MAIOR que 4/3
			$this->LarguraFinal = ($this->novaAltura * $this->largura) / $this->altura;
			$this->LarguraFinal = round($this->LarguraFinal, 0);
			$this->AlturaFinal = $this->novaAltura;
			
			$this->FlagProporcional = "R";
		} 
			



		if ($this->FlagProporcional== "R") { // Se a foto é do tipo RETRATO (Vertical)
			$x = $this->LarguraFinal - $this->novaLargura;
			$x = $x / 2;
			$x = $x * (-1);
			$y = 0;
		} 
		elseif ($this->FlagProporcional == "P") { // Se a foto é do tipo PAISAGEM (Horizontal)
			$y = $this->AlturaFinal - $this->novaAltura;
			$y = $y / 2;
			$y = $y * (-1);
			$x = 0;
		
		} else {
			$y = $this->AlturaFinal - $this->novaAltura;
			$x = $y;
		}


		switch ($this->ImagemTipo) {
			case 1:
				$imgOrig = imagecreatefromgif($this->getImagem());
				$novaImg = imagecreate($this->novaLargura, $this->novaAltura);
				break;
			case 2:
				$imgOrig = imagecreatefromjpeg($this->getImagem());
				$novaImg = imagecreatetruecolor($this->novaLargura, $this->novaAltura);
				break;
			case 3:
				$imgOrig = imagecreatefrompng($this->getImagem());
				$novaImg = imagecreatetruecolor($this->novaLargura, $this->novaAltura);
				break;
			default:
				die("Tipo de imagem informado não é compatível.");
				break;
		}


		# Cria a imagem
		$teste = imagecopyresampled($novaImg, $imgOrig, $x, $y, 0, 0, $this->LarguraFinal, $this->AlturaFinal, $this->largura, $this->altura);

        # Erro?
		if  ($teste) {} else {
            die("Não foi possível redimensionar a imagem.");
        }



	/*	# Marca D'água
        if(!empty($this->MarcadaguaArquivo)) {
                $tmp = getimagesize($this->getMarcadaguaArquivo());
                $this->MarcadaguaLargura  = $tmp[0];
                $this->MarcadaguaAltura   = $tmp[1];
                $this->MarcadaguaTipo     = $tmp[2];
               
                if($this->MarcadaguaAltura > $this->novaAltura ||
                   $this->MarcadaguaLargura  > $this->novaLargura) {
                    die("Marca d'agua é maior que imagem redimensionada.");
                }
           
            $this->verificarMarcadaguaAtributos();

            switch ($this->MarcadaguaTipo) {
                case 1:
                    $MarcaImg = imagecreatefromgif($this->getMarcadaguaArquivo());
                    break;
                case 2:
                    $MarcaImg = imagecreatefromjpeg($this->getMarcadaguaArquivo());
                    break;
                case 3:
                    $MarcaImg = imagecreatefrompng($this->getMarcadaguaArquivo());
                    break;
                default:
                    die("Tipo de imagem da marca d'agua informado não é compatível.");
                    break;
            }
           
            
			# Onde vai ficar a marca d'água
            switch($this->getMarcadaguaPosicao()) {
                case 1:
                    $x = $this->getMarcadaguaDistancia;
                    $y = $this->getMarcadaguaDistancia;
                    break;
                case 2:
                    $x = round(($this->LarguraFinal / 2) - ($this->MarcadaguaLargura / 2));
                    $y = $this->getMarcadaguaDistancia;
                    break;
                case 3:
                    $x = $this->LarguraFinal - $this->MarcadaguaLargura - $this->getMarcadaguaDistancia;
                    $y = $this->getMarcadaguaDistancia;
                    break;
                case 4:
                    $x = round(($this->LarguraFinal / 2) - ($this->MarcadaguaLargura / 2));
                    $y = round(($this->AlturaFinal / 2) - ($this->MarcadaguaAltura / 2));
                    break;
                case 5:
                    $x = $this->getMarcadaguaDistancia;
                    $y = $this->AlturaFinal - $this->MarcadaguaAltura - $this->getMarcadaguaDistancia;
                    break;
                case 6:
                    $x = round(($this->LarguraFinal / 2) - ($this->MarcadaguaLargura / 2));
                    $y = $this->AlturaFinal - $this->MarcadaguaAltura - $this->getMarcadaguaDistancia;
                    break;
                case 7:
                    $x = $this->LarguraFinal - $this->MarcadaguaLargura - $this->getMarcadaguaDistancia;
                    $y = $this->AlturaFinal - $this->MarcadaguaAltura - $this->getMarcadaguaDistancia;
                    break;
                default:
                    $x = $this->getMarcadaguaDistancia;
                    $y = $this->getMarcadaguaDistancia;
            }
           
            # Coloca a Marca D'Água na imagem
			if ($this->MarcadaguaTipo==3)
				$this->imageComposeAlpha( $novaImg, $MarcaImg, $x, $y);
			else
				imagecopymerge($novaImg, $MarcaImg, $x, $y, 0, 0, $this->MarcadaguaLargura, $this->MarcadaguaAltura, $this->getMarcadaguaOpacidade());
        }
       */


       # Pronto! Gravando a imagem
		switch ($this->ImagemTipo) {
			case 1:
				imagegif($novaImg, $this->getImagem());
				break;
			case 2:
				imagejpeg($novaImg, $this->getImagem(), 90);
				break;
			case 3:
				imagepng($novaImg, $this->getImagem());
				break;
			default:
				die("Tipo de imagem informado não é compatível.");
				break;
		}
       
        return true;
    }






	function imageComposeAlpha( &$src, &$ovr, $ovr_x, $ovr_y, $ovr_w = false, $ovr_h = false) {
		if( $ovr_w && $ovr_h )
			$ovr = $this->imageResizeAlpha( $ovr, $ovr_w, $ovr_h );

		imagecopy($src, $ovr, $ovr_x, $ovr_y, 0, 0, imagesx($ovr), imagesy($ovr) ); /* Noew compose the 2 images */
	}


	function imageResizeAlpha(&$src, $w, $h) { /*  Resize a PNG file with transparency to given dimensions and still retain the alpha channel information | Author:  Alex Le - http://www.alexle.net */
			
			$temp = imagecreatetruecolor($w, $h); /* create a new image with the new width and height */

			$background = imagecolorallocate($temp, 0, 0, 0); /* making the new image transparent */
			imagecolortransparent($temp, $background); // make the new temp image all transparent
			imagealphablending($temp, false); // turn off the alpha blending to keep the alpha channel

			#imagecopyresized($temp, $src, 0, 0, 0, 0, $w, $h, imagesx($src), imagesy($src)); # Resize the PNG file | use imagecopyresized to gain some performance but loose some quality
			imagecopyresampled($temp, $src, 0, 0, 0, 0, $w, $h, imagesx($src), imagesy($src)); /* use imagecopyresampled if you concern more about the quality */
			return $temp;
	}


}







?>