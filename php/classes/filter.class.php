<?php

class Filters {
	
	public function _paraRetirarAcentos($var) {
		$var = preg_replace('/([á|à|ã|ä|â])|(&atilde;)|(&agrave;)|(&atilde;)|(&auml;)|(&aacute;)|(&acirc;)/','a',$var);
		$var = preg_replace('/([é|è|ë|ê])|(&eacute;)|(&egrave;)|(&euml;)|(&ecirc;)/','e',$var);
		$var = preg_replace('/([í|ì|ï|î])|(&igrave;)|(&iacute;)|(&iuml;)|(&icirc;)/','i',$var);
		$var = preg_replace('/([ó|ò|õ|ö|ô])|(&ograve;)|(&otilde;)|(&ouml;)|(&oacute;)|(&ocirc;)/','o',$var);
		$var = preg_replace('/([ú|ù|ü|û])|(&ugrave;)|(&uacute;)|(&uuml;)|(&ucirc;)/','u',$var);
		$var = preg_replace('/([ç])|(&ccedil;)/','c',$var);
		return $var;
	}
	
	public function _paraEliminar($alvo,$listaCaracteres='@,(,),$,!,+,[,],@,*') {
		$this->originalVar = $alvo;
		$lista = explode(',',$listaCaracteres);
		$montarEx = '([';
		foreach($lista as $chars)
			$montarEx .= "\\$chars|";
		$montarEx = rtrim($montarEx,'|');
		$montarEx .= '|\,|\.|"|:])';
		return preg_replace($montarEx,'',$alvo);
	}
	
	public function _paraURL($url) {
		$url = preg_replace('/([ |\/])/','-',$url);
		return $this->_paraEliminar($this->_paraRetirarAcentos(strtolower($url)));
	}
	
	public function _retornarOriginal() {
		return $this->originalVar;
	}
}