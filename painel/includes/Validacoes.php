<?

// ------------------------------------------------------------------------------
// * validaCPF: Verifica se é um CPF válido
// ------------------------------------------------------------------------------
function validaCPF($cpf) {
    $tam_cpf = strlen($cpf); 
	$cpf_limpo = "";
    for ($i=0; $i<$tam_cpf; $i++) { 
      $carac = substr($cpf, $i, 1); 
      if (ord($carac)>=48 && ord($carac)<=57) // verifica se o codigo asc refere-se a 0-9 
        $cpf_limpo .= $carac; 
    } 
    if (strlen($cpf_limpo)!=11) 
      return false; 

    // achar o primeiro digito verificador 
    $soma = 0; 
    for ($i=0; $i<9; $i++) 
      $soma += (int)substr($cpf_limpo, $i, 1) * (10-$i); 

    if ($soma == 0) 
      return false; 

    $primeiro_digito = 11 - $soma % 11; 

    if ($primeiro_digito > 9) 
      $primeiro_digito = 0; 

    if (substr($cpf_limpo, 9, 1) != $primeiro_digito) 
      return false; 

    // acha o segundo digito verificador 
    $soma = 0; 
    for ($i=0; $i<10; $i++) 
      $soma += (int)substr($cpf_limpo, $i, 1) * (11-$i); 

    $segundo_digito = 11 - $soma % 11; 

    if ($segundo_digito > 9) 
      $segundo_digito = 0; 

    if (substr($cpf_limpo, 10, 1) != $segundo_digito) 
      return false; 

    return true; 
  } 



// ------------------------------------------------------------------------------
// * validaCNPJ: Verifica se é um CNPJ válido
// ------------------------------------------------------------------------------
function validaCNPJ($cnpj)
{
    $pontos = array(',','-','.','','/');
    
    $cnpj = str_replace($pontos,'',$cnpj);
    $cnpj = trim($cnpj);
    if(empty($cnpj) || strlen($cnpj) != 14) return FALSE;
    else {
        if(check_fake($cnpj,14)) return FALSE;
        else {
            $rev_cnpj = strrev(substr($cnpj, 0, 12));
            for ($i = 0; $i <= 11; $i++) {
                $i == 0 ? $multiplier = 2 : $multiplier;
                $i == 8 ? $multiplier = 2 : $multiplier;
                $multiply = ($rev_cnpj[$i] * $multiplier);
                $sum = $sum + $multiply;
                $multiplier++;

            }
            $rest = $sum % 11;
            if ($rest == 0 || $rest == 1)  $dv1 = 0;
            else $dv1 = 11 - $rest;
            
            $sub_cnpj = substr($cnpj, 0, 12);
            $rev_cnpj = strrev($sub_cnpj.$dv1);
            unset($sum);
            for ($i = 0; $i <= 12; $i++) {
                $i == 0 ? $multiplier = 2 : $multiplier;
                $i == 8 ? $multiplier = 2 : $multiplier;
                $multiply = ($rev_cnpj[$i] * $multiplier);
                $sum = $sum + $multiply;
                $multiplier++;

            }
            $rest = $sum % 11;
            if ($rest == 0 || $rest == 1)  $dv2 = 0;
            else $dv2 = 11 - $rest;

            if ($dv1 == $cnpj[12] && $dv2 == $cnpj[13]) return true; //$cnpj;
            else return false;
        }
    }
}



// ------------------------------------------------------------------------------
// * validaData: Checa se uma data está formatada corretamente: dd/mm/yyyy
// ------------------------------------------------------------------------------
function validaData($data) {
	if (strpos($data,'/')) $arrData = explode("/", $data);
	else if (strpos($data,'-')) $arrData = explode("-", $data);
	else if (strpos($data,'.')) $arrData = explode(".", $data);

	if (checkdate($arrData[1], $arrData[0], $arrData[2])) return true; else return false;

}


// ------------------------------------------------------------------------------
// * validaEmail: Verifica se um e-mail é válido
// ------------------------------------------------------------------------------
function validaEmail($email) {
	if(!ereg("^([0-9,a-z,A-Z]+)([.,_,-]([0-9,a-z,A-Z]+))*[@]([0-9,a-z,A-Z]+)([.,_,-]([0-9,a-z,A-Z]+))*[.]([a-z,A-Z]){2,3}([0-9,a-z,A-Z])?$", $email)) { 
		return false;
	} else {
		return true;
	}
}


// ------------------------------------------------------------------------------
// * validaTipoArquivo: verifica se um arquivo é de um determinado tipo	
// ------------------------------------------------------------------------------
function validaTipoArquivo($nomearquivo, $tipo) {
	//$nomearquivo = "arquivo.png";
	$extensao = explode(".", $nomearquivo);
	$extensao = strtolower($extensao[(count($extensao) - 1)]);

	$lista[1] = array("jpg","jpeg", "gif", "png", "bmp", "JPG", "JPEG", "GIF", "PNG", "BMP");
	$lista[2] = array("mp3", "wma");
	$lista[3] = array("doc", "pdf", "ppt", "pps", "xls", "csv");

	if (in_array($extensao, $lista[$tipo])) return true;
	  else return false;
	return true;
}










?>