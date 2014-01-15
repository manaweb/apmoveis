<? 
	/*include('../includes/BancoDeDados.php');
	include('../includes/Funcoes.php');
	include('../includes/Validacoes.php');
	include('../includes/Config.php');
	include('includes/Admin.php');*/


	$_SESSION['Admin']='';
	@session_unregister('Admin');
	echo "<script language=javascript>alert('Saiu com sucesso!');window.location='_login.php';</script>"; 

?>