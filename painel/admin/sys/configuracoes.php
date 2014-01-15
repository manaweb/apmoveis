<? 
	define('ID_MODULO',999,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'configuracoes',
		'tabela'=>'tbconfiguracoes',
		'titulo'=>'nomesite',
		'id'=>'id_config',
		'urlfixo'=>'', 
		'pasta'=>'configuracoes',
	);

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Configurações</h2>
                    </div>
<div id="conteudo">
<a  id="btnalt" href="configuracoes_dados.php?ID=1"><img src="../img/config.png" align="absmiddle" /> Editar Configurações</a>
<br />
<br />
<?



$dados2 = db_lista(db_consulta("SELECT * FROM tbconfiguracoes WHERE id_config=1 LIMIT 1;"));

?>

<br />
<br />
<p style="font-size:14px;">
<img src="../../arquivos/configuracoes/<?=$dados2['imagem'];?>" /><br /><br />
Nome da Empresa: <b><?=$dados2['nomesite'];?><br /> </b>
Slogan da Empresa: <b><?=$dados2['slogansite'];?><br /> </b>
Email da Empresa: <b><?=$dados2['emailsite'];?><br /> </b>
Twitter (Opcional): <b><?=$dados2['twitter'];?><br /> </b>
Facebook (Opcional): <b><?=$dados2['facebook'];?><br /> </b>
Canal no Youtube (Opcinonal): <b><?=$dados2['youtube'];?><br /> </b>
Produto 1: <b><?=$dados2['telefone1'];?><br />  </b>
produto 2: <b><?=$dados2['telefone2'];?><br />  </b>
Banner topo: <b><?=$dados2['telefone3'];?><br />  </b>
Banner lateral:<b><?=$dados2['produtoservico'];?><br /> </b>
Rodapé: <b><?=$dados2['endereco'];?> </b>
</p>
 


</div>
<? include('../includes/Rodape.php'); ?>
