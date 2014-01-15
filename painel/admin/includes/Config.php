<?php
	@session_start();
	@ob_start();
	error_reporting(0);

	include('../../../php/config/config.php');
	include('../../includes/BancoDeDados.php');
	include('../../includes/Funcoes.php');
	include('../../includes/Validacoes.php');
	include('../../includes/Imagens.php');
	include('../../includes/Config.php');
	include('../../includes/Email.php');
	include('../includes/Admin.php');
	include('../includes/Privado.php');

	db_conectar();

	# Tirar o time limit
	if (function_exists("set_time_limit")==1 and get_cfg_var("safe_mode")==0) @set_time_limit(0);


?>