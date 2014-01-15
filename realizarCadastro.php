<?php
	include("php/config/config.php");
	include("painel/includes/BancoDeDados.php");
	$conexao = db_conectar();

	if (isset($_GET['email'])) {
		$email = $_GET['email'];
		$primeiroNome = utf8_decode($_POST['firstname']);
		$ultimoNome = utf8_decode($_POST['lastname']);
		$celular = $_POST['celular'];
		$telefone = $_POST['telefone'];
		$cep = $_POST['txtNumCep'];
		$logradouro = utf8_decode($_POST['txtLogradouro']);
		$numero = $_POST['txtNumLogradouro'];
		$bairro = utf8_decode($_POST['txtBairro']);
		$cidade = utf8_decode($_POST['txtCidade']);
		$estado = utf8_decode($_POST['txtEstado']);
		mysql_query("UPDATE tbclientes SET primeironome = '$primeiroNome', ultimonome = '$ultimoNome', celular = '$celular', telefone = '$telefone', cep = '$cep', logradouro = '$logradouro', numero = '$numero', bairro = '$bairro', cidade = '$cidade', estado = '$estado' WHERE email = '$email'");
		$sql = "select id from tbclientes where email = '$email'";
		$dados = mysql_fetch_assoc(mysql_query($sql));
		header("Location: enviar_orcamento.php?id=".$dados['id']);
	}
	else
		$email = $_POST['email'];

	$primeiroNome = $_POST['firstname'];
	$ultimoNome = $_POST['lastname'];
	$celular = $_POST['celular'];
	$telefone = $_POST['telefone'];
	$cep = $_POST['txtNumCep'];
	$logradouro = $_POST['txtLogradouro'];
	$numero = $_POST['txtNumLogradouro'];
	$bairro = $_POST['txtBairro'];
	$cidade = $_POST['txtCidade'];
	$estado = $_POST['txtEstado'];

	$sqlCadastro = "select * from tbclientes where email = '".$email."'";
	$result = mysql_query($sqlCadastro);
	$numRows = mysql_num_rows($result);
	if($numRows == 0){
		$sql = "insert into tbclientes (email, primeironome, ultimonome, celular, telefone, cep, logradouro, numero, bairro, cidade, estado) 
				values 
				('$email', '".utf8_decode($primeiroNome)."', '".utf8_decode($ultimoNome)."', '".utf8_decode($celular)."', 
				'".utf8_decode($telefone)."', '$cep', '".utf8_decode($logradouro)."', '$numero', '".utf8_decode($bairro)."','".utf8_decode($cidade)."','$estado')";
		mysql_query($sql);
	}
	$sql = "select id from tbclientes where email = '$email'";
	$dados = mysql_fetch_assoc(mysql_query($sql));
	header("Location: enviar_orcamento.php?id=".$dados['id']);
?>