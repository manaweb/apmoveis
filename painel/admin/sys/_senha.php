<? 
	include('../includes/Config.php');



	if (!empty($_POST['senha_antiga'])) {
		list($usuario) = db_dados("SELECT id_usuario FROM adm_usuarios WHERE id_usuario LIKE '".$_SESSION['Admin']['id_usuario']."' AND senha LIKE '".md5($_POST['senha_antiga'])."' LIMIT 1;");
		if ($usuario==$_SESSION['Admin']['id_usuario']) {
		
			if (strlen($_POST['senha_nova'])>3) {
			
				if ($_POST['senha_nova']==$_POST['senha_nova2']) {
	
					db_executa("adm_usuarios",array('senha'=>md5($_POST['senha_nova'])),'update','id_usuario='.$_SESSION['Admin']['id_usuario']);
					header('Location: index.php?msg='.urlencode('Senha alterada com sucesso!'),true); exit; 
	
				} else { header('Location: _senha.php?erro='.urlencode('Senha não confirmada'),true); exit; }
	
			} else { header('Location: _senha.php?erro='.urlencode('Nova senha muito curta'),true); exit; }

		} else { header('Location: _senha.php?erro='.urlencode('Senha não confere'),true); exit; }

	}


	define('ID_MODULO',0,true);
	include('../includes/Topo.php');
	
?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Alterar a sua senha</h2>
                    </div>
<div id="conteudo">
 


<div class="alterarsenha">

 
 
  <form action="_senha.php" method="post" name="frm1" enctype="multipart/form-data">
  <table>
    <tr>
    	<th><label for="senha_antiga">Senha Antiga:</label></th>
        <td><input type="password" name="senha_antiga" id="senha_antiga" value="" onfocus="this.className='ativo';" onblur="this.className='';" /></td>
    <tr>
    <tr>
    	<th><label for="senha_nova">Nova Senha:</label></th>
        <td><input type="password" name="senha_nova" id="senha_nova" value="" onfocus="this.className='ativo';" onblur="this.className='';" /></td>
    </tr>
    <tr>
    	<th><label for="senha_nova2">Confirme:</label></th>
        <td><input type="password" name="senha_nova2" id="senha_nova2" value="" onfocus="this.className='ativo';" onblur="this.className='';" /></td>
    </tr>
	<tr><th></th><td class="botoes"><input type="submit" value="salvar" style="height:35px!important;" height="35px" id="btn" /></td></tr>
  </table>
  </form>

 
</div>

<br />
<br />

</div>
<?
	include('../includes/Rodape.php');
?>