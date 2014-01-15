<?php

class Headers {
	private $metas;

	public function __construct() {
		$this->metas = array();
	}

	public function _setHeader($metaName,$value) {
		$_SESSION[$metaName] = $value;
		$this->metas[$metaName] = $_SESSION[$metaName];
		
	}
	public function _getHeader($metaName) {
		return $_SESSION[$metaName];
	}
	public function __destruct() {
		
	}
}
