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
	if (!($id_galeria>0)) $erro=true;
	if (ValidaEmail($email)==false) $erro=true;
	if (strlen($mensagem) < 4) $erro=true;
	/* if ((strtolower($codigo) != strtolower($_SESSION['contatoConfirmacao']))||(strlen($_SESSION['contatoConfirmacao'])!=4)) $erro=true;
	$_SESSION['contatoConfirmacao']=''; */

	// Se houver erro, SAI
	if ($erro==true) { header('Location: ../site/index.php?p=galerias_ver&id='.(int)$id_galeria.'&ok=0',true); exit; } 


	$mensagem = str_replace("\n","<br>",htmlentities(substr($mensagem,0,5000)));

	//DADOS
	$dados = array('id_galeria'=>$id_galeria, 'nome'=>htmlentities($nome), 'email'=>$email, 'mensagem'=>$mensagem, 'ip'=>$_SERVER['REMOTE_ADDR'], 'flag_status'=>'0', 'datahora'=>'now()');

	db_executa('tbgalerias_comentarios', $dados);
	$_SESSION['contatoConfirmacao']='';

	// Retorna
	header('Location: ../site/index.php?p=galerias_ver&id='.(int)$id_galeria.'&ok=1',true);

?>