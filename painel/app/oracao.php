<? 
	include ('../includes/BancoDeDados.php'); 
	include ('../includes/Funcoes.php'); 
	include ('../includes/Config.php'); 
	include ('../includes/Validacoes.php'); 


	// Post -> $var
	foreach ($_POST as $campo => $valor) $$campo = $valor; 


	// Testes
	$erro=false;
	if (strlen($nome) < 4) $erro=true;
	if (strlen($pedido) < 4) $erro=true;
	if ((strtolower($codigo) != strtolower($_SESSION['contatoConfirmacao']))||(strlen($_SESSION['contatoConfirmacao'])!=4)) $erro.="Código de Confirmação";
	$_SESSION['contatoConfirmacao']='';

	// Se houver erro, SAI
	if ($erro==true) { header('Location: ../site/index.php?p=pedidosdeoracao&ok=0',true); exit; } 

	//DADOS
	$dados = array('id_oracao'=>'', 'nome'=>htmlentities($nome), 'pedido'=>htmlentities($pedido), 'data'=>'now()');

	db_executa('tboracao', $dados);
	$_SESSION['contatoConfirmacao']='';

	// Retorna
	header('Location: ../site/index.php?p=pedidosdeoracao&ok=1',true);

?>