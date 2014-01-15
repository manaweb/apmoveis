<? 
	include('../includes/BancoDeDados.php');
	include('../includes/Funcoes.php');
	include('../includes/Validacoes.php');
	include('../includes/Config.php');
	include('includes/Admin.php');


#print_r($_POST); exit;
	if ($_POST['logar']==1) { 
	
		$usuario = db_lista(db_consulta("SELECT id_usuario,nome,login,email,DATE_FORMAT(data_login,'%d/%m/%Y às %H:%i:%s') as data_login,flag_status FROM adm_usuarios WHERE login LIKE '".$_POST['login']."' AND senha LIKE '".md5($_POST['senha'])."' LIMIT 1;"));
		if ($usuario['id_usuario']>0) {
			if ($usuario['flag_status']==1 || $usuario['id_usuario']==1) {
				$_SESSION['Admin'] = $usuario;
				db_executa('adm_usuarios',array('data_login'=>'now()'),'update','id_usuario='.$usuario['id_usuario']);
				header('Location: ./sys/',true);
			} else {
				echo "<script language=javascript>alert('Usuário bloqueado.');window.location='_login.php';</script>"; 
				exit;
			}
		} else {
			echo "<script language=javascript>alert('Login ou senha invalidos.');window.location='_login.php';</script>"; 
			exit;
		}
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Acesso Restrito</title>
<link href="screen2.css" rel="stylesheet" type="text/css" />
<!--<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js?ver=1.3.2'></script>
<script type="text/javascript">
        $(document).ready(function() {
		
            $(document).mouseup(function() {
				$("#loginform").mouseup(function() {
					return false
				});
				
				$("a.close").click(function(e){
					e.preventDefault();
					$("#loginform").hide();
                    $(".lock").fadeIn();
				});
				
                if ($("#loginform").is(":hidden"))
                {
                    $(".lock").fadeOut();
                } else {
                    $(".lock").fadeIn();
                }				
				$("#loginform").toggle();
            });
			

			// botao exemplo
			$("input#cancel_submit").click(function(e) {
					$("#loginform").hide();
                    $(".lock").fadeIn();
			});			
			
			
        });
</script>-->
</head>
<body>
<div id="cont">
 
  <div id="loginform" class="box form">
    <h2>Acesso Restrito <a href="" class="close">Fechar</a></h2>
    <div class="formcont">
      <fieldset id="signin_menu">
      <span class="message">Entre com seu login e senha para acessar o painel</span>
      <form action="_login.php" method="post" name="frmlogin" id="signin">
	  <input type="hidden" name="logar" value="1" />
        <label for="username">Login</label>
        <input id="username" name="login" value="" title="login" class="required" tabindex="4" type="text">
        </p>
        <p>
          <label for="password">Senha</label>
          <input id="password" name="senha" value="" title="senha" class="required" tabindex="5" type="password">
        </p>
        <p class="clear"></p>
        <a href="#" class="forgot" id="resend_password_link">Esqueceu a senha?</a>
        <p class="remember">
          <input id="signin_submit" value="Entrar" tabindex="6" type="submit">
          <input id="cancel_submit" value="Cancelar" tabindex="7" type="button">
        </p>
      </form>
      </fieldset>
    </div>
    <div class="formfooter"></div>
  </div>
</div>
 
<div id="bg">
 
</div>
 
</body>
</html>
