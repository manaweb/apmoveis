<? 
	session_start();
	include ('../includes/BancoDeDados.php'); 
	include ('../includes/Funcoes.php'); 
	include ('../includes/Config.php'); 

	#sleep(1);
	#echo $_SESSION['contatoConfirmacao'];

	$img = new CriarImagem();
	$_SESSION['contatoConfirmacao'] = $img->output();

?>