<?
	ob_start();

	include('../../includes/BancoDeDados.php');
	include('../../includes/Funcoes.php');
	include('../../includes/Validacoes.php');
	include('../../includes/Imagens.php');
	include('../../includes/Config.php');
	include('../../includes/Email.php');
	include('../includes/Admin.php');
	


	# Tirar o time limit
	if (function_exists("set_time_limit")==1 and get_cfg_var("safe_mode")==0) @set_time_limit(0);


?>