<? 

	if (!empty($_SESSION['Admin']['login'])) {

		if (! usuarioPermissao($_SESSION['Admin']['id_usuario'],ID_MODULO)) { include('../sys/_restrito.php'); exit; }
	
	} else { header('Location: _login.php',true); echo "<script language=javascript>window.location='_login.php';</script>"; exit; }

?>