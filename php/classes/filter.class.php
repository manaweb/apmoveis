<?php

class Filters {
	
	public function _paraRetirarAcentos($var) {
		$var = preg_replace('/([�|�|�|�|�])|(&atilde;)|(&agrave;)|(&atilde;)|(&auml;)|(&aacute;)|(&acirc;)/','a',$var);
		$var = preg_replace('/([�|�|�|�])|(&eacute;)|(&egrave;)|(&euml;)|(&ecirc;)/','e',$var);
		$var = preg_replace('/([�|�|�|�])|(&igrave;)|(&iacute;)|(&iuml;)|(&icirc;)/','i',$var);
		$var = preg_replace('/([�|�|�|�|�])|(&ograve;)|(&otilde;)|(&ouml;)|(&oacute;)|(&ocirc;)/','o',$var);
		$var = preg_replace('/([�|�|�|�])|(&ugrave;)|(&uacute;)|(&uuml;)|(&ucirc;)/','u',$var);
		$var = preg_replace('/([�])|(&ccedil;)/','c',$var);
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