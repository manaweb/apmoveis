<?php
	if(isset($_GET['id'])){
		include("php/config/config.php");
		include("painel/includes/BancoDeDados.php");
		include 'orcamento/checkout/actioncheckout.class.php';
		$conexao = db_conectar(); 
		define ("DOMINIO", "http://www.lojaapmoveis.com.br");
		if (isset($_COOKIE['produto_']))
			unset($_COOKIE['produto_']);

		$cookies = array();
		$i = 0;
		foreach($_COOKIE as $key => $value){
			if('produto_' == substr($key, 0, 8)){
				$cookies[$i] = $key;
				$i++;
			}
		}
		$email = $_GET['email'];
		$cookies = array();
		$i = 0;
		foreach($_COOKIE as $key => $value){
			if('produto_' == substr($key, 0, 8)){
				$cookies[$i] = $key;
				$i++;
			}
		}
		date_default_timezone_set('America/Sao_Paulo');
		//criando e inserindo um novo orçamento
		mysql_query("insert into tborcamento (id_cliente, data) values (".$_GET['id'].", '".date('Y-m-d H:i:s')."')");
		$newOrcamento = mysql_fetch_array(mysql_query("select * from tborcamento order by id desc limit 1"));
		//fim da criacao do novo orcamento, variavel $newOrcamento sera usada para criacao dos itens
		
		//pegando os dados dos cliente para mostrar no email
		$cliente = mysql_fetch_array(mysql_query("select * from tbclientes where id = ".$_GET['id']));
		
		$headers = "";
		$msg = "";
		
		$header .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n";
		$headers .= "From: AP Móveis <contato@lojaapmoveis.com.br>\r\n";

		$msg = "
		<html><head>
		<meta charset='UTF-8'>
		<style>
			table *{
				color: #000;
			}
			table{
				width: 100%;
			}
			th{
				font-weight: bold;
				background: #F0F0F0;
			}
			th, td{
				padding: 10px;
				text-align: center;
			}
		</style>
	</head>
	<body style='font-family: Century Gothic !important;width: 1100px;margin: auto;'>
		<div style='width: 1000px;margin: auto;padding: 50px;'><!--tudo-->
			<table>
				<tr>
					<td>
						<p style='/* font-size: 14px; */'>".$cliente['primeironome']." ".$cliente['ultimonome']."</p>
						<p>".$cliente['email']."</p>
						<p>".$cliente['telefone']."</p>
					</td>
					
					<td>
						<img src='http://www.lojaapmoveis.com.br/img/logo.png' alt='AP Móveis'>
					</td>
					
					<td>
						<p>Data: ".date('d-m-Y H:i:s')."</p>
						<p>Orçamento nº: ".$newOrcamento['id']."</p>
					</td>
				</tr>
			</table>
			
			<div style='clear: both;margin-bottom: 80px;'><!--pedido-->
				<h3 style='text-align: center;padding-top: 40px;font-size: 35px;'>Orçamento</h3>
				<table border='1' style='margin-bottom: 10px;border-collapse: collapse;border-color: #d0d0d0;'>
					<thead>
						<tr>
							<th>Produto</th>
							<th>C&oacute;digo</th>
							<th>Quantidade</th>
						</tr>
					</thead>
					<tbody>";
		for($i = 0; $i < sizeof($cookies); $i++){
			$meuArray = unserialize($_COOKIE[$cookies[$i]]);
			$sqlCarrinho = "select * from tbprodutos WHERE id = ".$meuArray['id'];
			$resultado = mysql_query($sqlCarrinho);
			$dadosCarrinho = mysql_fetch_array($resultado);
			
			//inicio criacao itemOrcamento
			
			mysql_query("insert into tbitensorcamento 
						(id_orcamento, id_produto, variacao, quantidade) 
						values 
						(".$newOrcamento['id'].", ".$dadosCarrinho['id'].", '".utf8_decode($meuArray['variacao'])."', ".$meuArray['qtd'].");");
						
			//fim criacao itemOrcamento
			
			$msg.="	
						<tr>
							<td>
								<a href='".DOMINIO."/ver_produtos.php?id=".$dadosCarrinho['id']."'>
									<span style='border: none;text-align: center;width: 100%;display: inline-block;'>".utf8_encode($dadosCarrinho['nome'])."</span>
								</a>
							</td>
							<td>".$meuArray['id']."</td>
							<td style='font-weight: bold;'>".$meuArray['qtd']."</td>
						</tr>";
						
			setcookie("produto_".$meuArray['id'], "");
		}	
		$msg.="		</tbody>
				</table>
			</div><!--/pedido-->
					
			<div style='margin-top: 100px; 0; width: 1000px;'><!--dadosEmpresa-->
				<h3 style='font-size: 20px;color: #046095;font-family: Trebuchet MS !important;'>Entre em contato ou faça-nos uma visita</h3>
				<p style='font-size: 17px;'>Rua São Sebastião, 503<br>
					Centro<br>
					Jaboticabal</p>
				<p style='font-size: 17px;'>(16) 3202-7022</p>
				<p style='font-size: 17px;'>contato@lojaapmoveis.com.br</p>
				
				<div style='float: right;  margin-top: -65px;'><!--Logo Mana-->
					<a href='http://www.manaweb.com.br' target='_blank'><img src='http://lojaapmoveis.com.br/img/mana-logo.png' alt='Maná Web'></a>
				</div><!--/Logo Mana-->
			</div><!--/dadosEmpresa-->
		</div><!--/tudo-->
	</body>
</html>
				";
				
		$opts = array(
			
			'assunto' => 'Orçamentos',
			'remetente' => 'contato@lojaapmoveis.com.br',
			'nomeRemetente' => utf8_decode('AP Móveis'),
			'destino' => array('Cliente' => $email, 'AP Móveis' => 'contato@lojaapmoveis.com.br'),
			'corpo' => $msg
		
		);
		$Act = new ActionCheckout;
		echo $Act->sendConfirm($opts);

		/*if (mail($email, utf8_decode("Orçamento realizado no site RF Casa e Cia"),$msg,$headers)) {

			echo "True";
		} else {
			echo "False";
		}*/
	}
?>

