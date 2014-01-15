<? 
	include ('../includes/BancoDeDados.php'); 
	include ('../includes/Funcoes.php'); 
	include ('../includes/Config.php'); 
	include ('../includes/Validacoes.php'); 

# Configurações
$dadosconfig = db_dados( "SELECT * FROM tbconfiguracoes WHERE id_config=1");

	// Post -> $var
	foreach ($_POST as $campo => $valor) $$campo = $valor;
	

	// Testes
	$erro=false;
	if (strlen($nome) < 4) $erro=true;
	if (!($id_departamentos>0)) $erro=true;
	if (ValidaEmail($email)==false) $erro=true;
	if (strlen($mensagem) < 4) $erro=true;

	

	// Se houver erro, SAI
	if ($erro==true) { header('Location: '.utf8_decode($dadosconfig['url']).'/departamentos_ver/'.(int)$id_departamentos.'/erro.html',true); exit; } 


	$mensagem = str_replace("\n","<br>",htmlentities(substr($mensagem,0,5000)));

	//DADOS
	$dados = array('id_departamentos'=>$id_departamentos, 'nome'=>htmlentities($nome), 'email'=>$email, 'mensagem'=>$mensagem, 'ip'=>$_SERVER['REMOTE_ADDR'], 'flag_status'=>'0', 'datahora'=>'now()');

	db_executa('tbdepartamentos_comentarios', $dados);
	$_SESSION['contatoConfirmacao']='';

	// Retorna
	header('Location: '.utf8_decode($dadosconfig['url']).'/departamentos_ver/'.(int)$id_departamentos.'/sucesso.html',true);

?>