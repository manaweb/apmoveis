<? 
	include('../includes/Config.php');

	define('ID_MODULO',0,true);
	include('../includes/Topo.php');
	
?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Perguntas Frequentes</h2>
                    </div>
<div id="conteudo">
 
<ul id="faq">
<?
	$i=0;
	$consulta = db_consulta("SELECT * FROM adm_faq ORDER BY pergunta ASC");
	while ($linha = db_lista($consulta)) { $i++;
?>	
	<li>
       	<a href="#" onclick="faqResposta(<?=$i;?>);">&rsaquo; <?=utf8_encode($linha['pergunta']);?></a>
        <div id="resposta<?=$i;?>"><?=utf8_encode($linha['resposta']);?></div>
	</li>
	
<?
	}
	if ($i==0) echo '<li>Nenhuma pergunta cadastrada.</li>';


?>
</ul>
<script language="javascript">
function faqResposta(i) {
  for (var j=1;j<=<?=$i;?>;j++) {
	document.getElementById('resposta'+j).style.display='none';
	if (j==i) document.getElementById('resposta'+j).style.display='block';
  }
}
</script>

<br />
<br />

<br><br>

</div>
<?
	include('../includes/Rodape.php');
?>