<? 
	define('ID_MODULO',31,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	include('../includes/tinyMCE_advanced.php');

	$Config = array(
		'arquivo'=>'user',
		'tabela'=>'user',
		'nome'=>'nome',
		'id'=>'id',
		'urlfixo'=>'', 
		'pasta'=>'materias',
	);


if ($_GET['ID']>0) $dados = db_dados("SELECT user.*,
z_simnao_categoria.*, DATE_FORMAT(data,'%d/%m/%Y') as data1, DATE_FORMAT(nascimento,'%d/%m/%Y') as nascimento1, DATE_FORMAT(datafe,'%d/%m/%Y') as datafe1, DATE_FORMAT(databatismo,'%d/%m/%Y') as databatismo1, DATE_FORMAT(dataentrou,'%d/%m/%Y') as dataentrou1 FROM user INNER JOIN
z_simnao_categoria ON (z_simnao_categoria.id_categoria = user.conjugecrente) WHERE ".$Config['id']."=".(int)$_GET['ID']." LIMIT 1;");

if ($_GET['ID']>0) $dizimista1 = db_dados("SELECT user.*,
z_simnao_categoria.*, DATE_FORMAT(data,'%d/%m/%Y') as data1 FROM user INNER JOIN
z_simnao_categoria ON (z_simnao_categoria.id_categoria = user.dizimista) WHERE ".$Config['id']."=".(int)$_GET['ID']." LIMIT 1;");

if ($_GET['ID']>0) $cargo1 = db_dados("SELECT user.*,
z_cargos_categoria.*, DATE_FORMAT(data,'%d/%m/%Y') as data1 FROM user INNER JOIN
z_cargos_categoria ON (z_cargos_categoria.id_categoria = user.posicaoeclisiastica) WHERE ".$Config['id']."=".(int)$_GET['ID']." LIMIT 1;");

if ($_GET['ID']>0) $estadocivil1 = db_dados("SELECT user.*,
 z_estadocivil_categoria.*, DATE_FORMAT(data,'%d/%m/%Y') as data1 FROM user INNER JOIN
 z_estadocivil_categoria ON ( z_estadocivil_categoria.id_categoria = user.estadocivil) WHERE ".$Config['id']."=".(int)$_GET['ID']." LIMIT 1;");

if ($_GET['ID']>0) $grau1 = db_dados("SELECT user.*,
z_grau_categoria.*, DATE_FORMAT(data,'%d/%m/%Y') as data1 FROM user INNER JOIN
z_grau_categoria ON (z_grau_categoria.id_categoria = user.grau) WHERE ".$Config['id']."=".(int)$_GET['ID']." LIMIT 1;");

if ($_GET['ID']>0) $ministerio1 = db_dados("SELECT user.*,
z_ministerios_categoria.*, DATE_FORMAT(data,'%d/%m/%Y') as data1 FROM user INNER JOIN
z_ministerios_categoria ON (z_ministerios_categoria.id_categoria = user.ministerio) WHERE ".$Config['id']."=".(int)$_GET['ID']." LIMIT 1;");

if ($_GET['ID']>0) $gostariarabalhar1 = db_dados("SELECT user.*,
z_ministerios_categoria.*, DATE_FORMAT(data,'%d/%m/%Y') as data1 FROM user INNER JOIN
z_ministerios_categoria ON (z_ministerios_categoria.id_categoria = user.gostariatrabalhar) WHERE ".$Config['id']."=".(int)$_GET['ID']." LIMIT 1;");



?>



<?
include('../includes/Mensagem.php');
$ondeestou = 'Visualizar Perfil';
?>
                	<div class="conthead">
                        <h2>Visualizar perfil de <?=$dados['nome'];?></h2>
                    </div>
<div id="conteudo">



<?
// -------------------------------------------------------------------------------
// Membro DADOS
// -------------------------------------------------------------------------------
?>
 
<table>

<a  id="btnalt" href="user_dados.php?ID=<?=$dados['id'];?>"><img src="../img/bteditar.png" align="absmiddle" /> Editar dados de <?=$dados['nome'];?> <?=$dados['sobrenome'];?></a>
<br />
<br />
<br />
<a  id="btnalt" href="user_imprimir.php?ID=<?=$dados['id'];?>" target="_blank"><img src="../img/imprimir.png" align="absmiddle" /> Imprimir ficha de <?=$dados['nome'];?> <?=$dados['sobrenome'];?></a>
<br />
<br />

<tr style="position:absolute; top:60px; right:20px; width:200px;"><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#fff; border:1px solid #ccc;"><img src="../../arquivos/user/<?=$dados['imagem'];?>" width="200px"></th><td style="text-shadow: 1px 1px 1px #fff ; color:#000!important; font-size:14px!important;"><b></b></td></tr>

<!-- dados pessoais -->
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#ccc; border-top:5px solid #fff;"><p style="text-shadow: 1px 1px 1px #fff ; color:#222; font-size:20px;">Dados Pessoais</p></th></tr>

<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Data do cadastro:</th><td style="text-shadow: 1px 1px 1px #fff ; color:#000!important; font-size:14px!important;"><b><?=$dados['data1'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Nome:</th><td style="text-shadow: 1px 1px 1px #fff ; background:#f4f4f4; border-top:6px solid #fff;  border-bottom:4px solid #fff; color:#000!important; font-size:14px!important;"><b><?=$dados['nome'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Sobrenome:</th><td style="text-shadow: 1px 1px 1px #fff ; color:#000!important; font-size:14px!important;"><b><?=$dados['sobrenome'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Nome do Pai:</th><td style="text-shadow: 1px 1px 1px #fff ; background:#f4f4f4; border-top:6px solid #fff;  border-bottom:4px solid #fff; color:#000!important; font-size:14px!important;"><b><?=$dados['pai'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Nome da M&atilde;e:</th><td style="text-shadow: 1px 1px 1px #fff ; color:#000!important; font-size:14px!important;"><b><?=$dados['mae'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Naturalidade:</th><td style="text-shadow: 1px 1px 1px #fff ; background:#f4f4f4; border-top:6px solid #fff;  border-bottom:4px solid #fff; color:#000!important; font-size:14px!important;"><b><?=$dados['naturalde'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Nacionalidade:</th><td style="text-shadow: 1px 1px 1px #fff ; color:#000!important; font-size:14px!important;"><b><?=$dados['nacional'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Data de Nascimento:</th><td style="text-shadow: 1px 1px 1px #fff ; background:#f4f4f4; border-top:6px solid #fff;  border-bottom:4px solid #fff; color:#000!important; font-size:14px!important;"><b><?=$dados['nascimento1'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Estado Civil:</th><td style="text-shadow: 1px 1px 1px #fff ; color:#000!important; font-size:14px!important;"><b><?=$estadocivil1['categoria'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Nome do Conjuge:</th><td style="text-shadow: 1px 1px 1px #fff ; background:#f4f4f4; border-top:6px solid #fff;  border-bottom:4px solid #fff; color:#000!important; font-size:14px!important;"><b><?=$dados['conjuge'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Conjuge &eacute; crente?:</th><td style="text-shadow: 1px 1px 1px #fff ; color:#000!important; font-size:14px!important;"><b><?=$dados['categoria'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Conjuge &eacute; de qual igreja?:</th><td style="text-shadow: 1px 1px 1px #fff ; background:#f4f4f4; border-top:6px solid #fff;  border-bottom:4px solid #fff; color:#000!important; font-size:14px!important;"><b><?=$dados['igrejaconjuge'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Filhos:</th><td style="text-shadow: 1px 1px 1px #fff ; color:#000!important; font-size:14px!important;"><b><?=$dados['filhos'];?></b></td></tr>

<!-- dados profissionais -->
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#ccc; border-top:5px solid #fff;"><p style="text-shadow: 1px 1px 1px #fff ; color:#222; font-size:20px;">Informa&ccedil;&otilde;es Profissionais</p></th></tr>

<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Profiss&atilde;o:</th><td style="text-shadow: 1px 1px 1px #fff ; color:#000!important; font-size:14px!important;"><b><?=$dados['profissao'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Empresa que trabalha:</th><td style="text-shadow: 1px 1px 1px #fff ; background:#f4f4f4; border-top:6px solid #fff;  border-bottom:4px solid #fff; color:#000!important; font-size:14px!important;"><b><?=$dados['empresa'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Telefone Comercial:</th><td style="text-shadow: 1px 1px 1px #fff ; color:#000!important; font-size:14px!important;"><b><?=$dados['telcomercial'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Endere&ccedil;o da empresa:</th><td style="text-shadow: 1px 1px 1px #fff ; background:#f4f4f4; border-top:6px solid #fff;  border-bottom:4px solid #fff; color:#000!important; font-size:14px!important;"><b><?=$dados['enderecoempresa'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">RG:</th><td style="text-shadow: 1px 1px 1px #fff ; color:#000!important; font-size:14px!important;"><b><?=$dados['identidade'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">CPF:</th><td style="text-shadow: 1px 1px 1px #fff ; background:#f4f4f4; border-top:6px solid #fff;  border-bottom:4px solid #fff; color:#000!important; font-size:14px!important;"><b><?=$dados['cpf'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Grau de Instru&ccedil;&atilde;o:</th><td style="text-shadow: 1px 1px 1px #fff ; color:#000!important; font-size:14px!important;"><b><?=$grau1['categoria'];?></b></td></tr>

<!-- Informações de Contato -->
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#ccc; border-top:5px solid #fff;"><p style="text-shadow: 1px 1px 1px #fff ; color:#222; font-size:20px;">Informa&ccedil;&otilde;es de contato</p></th></tr>

<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Endere&ccedil;o:</th><td style="text-shadow: 1px 1px 1px #fff ; color:#000!important; font-size:14px!important;"><b><?=$dados['endereco'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">CEP:</th><td style="text-shadow: 1px 1px 1px #fff ; background:#f4f4f4; border-top:6px solid #fff;  border-bottom:4px solid #fff; color:#000!important; font-size:14px!important;"><b><?=$dados['cep'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Bairro:</th><td style="text-shadow: 1px 1px 1px #fff ; color:#000!important; font-size:14px!important;"><b><?=$dados['bairro'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Cidade:</th><td style="text-shadow: 1px 1px 1px #fff ; background:#f4f4f4; border-top:6px solid #fff;  border-bottom:4px solid #fff; color:#000!important; font-size:14px!important;"><b><?=$dados['cidade'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Estado:</th><td style="text-shadow: 1px 1px 1px #fff ; color:#000!important; font-size:14px!important;"><b><?=$dados['estado'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Telefone:</th><td style="text-shadow: 1px 1px 1px #fff ; background:#f4f4f4; border-top:6px solid #fff;  border-bottom:4px solid #fff; color:#000!important; font-size:14px!important;"><b><?=$dados['telefone'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Celular:</th><td style="text-shadow: 1px 1px 1px #fff ; color:#000!important; font-size:14px!important;"><b><?=$dados['celular'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">E-mail:</th><td style="text-shadow: 1px 1px 1px #fff ; background:#f4f4f4; border-top:6px solid #fff;  border-bottom:4px solid #fff; color:#000!important; font-size:14px!important;"><b><?=$dados['email'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Twitter:</th><td style="text-shadow: 1px 1px 1px #fff ; color:#000!important; font-size:14px!important;"><b><?=$dados['twitter'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Facebook:</th><td style="text-shadow: 1px 1px 1px #fff ; background:#f4f4f4; border-top:6px solid #fff;  border-bottom:4px solid #fff; color:#000!important; font-size:14px!important;"><b><?=$dados['facebook'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Orkut:</th><td style="text-shadow: 1px 1px 1px #fff ; color:#000!important; font-size:14px!important;"><b><?=$dados['orkut'];?></b></td></tr>

<!-- Informações Religiosas -->
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#ccc; border-top:5px solid #fff;"><p style="text-shadow: 1px 1px 1px #fff ; color:#222; font-size:20px;">Informa&ccedil;&otilde;es Religiosas</p></th></tr>

<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Data de Profiss&atilde;o de F&eacute;:</th><td style="text-shadow: 1px 1px 1px #fff ; background:#f4f4f4; border-top:6px solid #fff;  border-bottom:4px solid #fff; color:#000!important; font-size:14px!important;"><b><?=$dados['datafe1'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Data do Batismo:</th><td style="text-shadow: 1px 1px 1px #fff ; color:#000!important; font-size:14px!important;"><b><?=$dados['databatismo1'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Igreja em que foi batizado:</th><td style="text-shadow: 1px 1px 1px #fff ; background:#f4f4f4; border-top:6px solid #fff;  border-bottom:4px solid #fff; color:#000!important; font-size:14px!important;"><b><?=$dados['igrejabatismo'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Cidade da Igreja:</th><td style="text-shadow: 1px 1px 1px #fff ; color:#000!important; font-size:14px!important;"><b><?=$dados['cidadeigreja'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Estado da Igreja:</th><td style="text-shadow: 1px 1px 1px #fff ; background:#f4f4f4; border-top:6px solid #fff;  border-bottom:4px solid #fff; color:#000!important; font-size:14px!important;"><b><?=$dados['estadoigreja'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Pastor que batizou:</th><td style="text-shadow: 1px 1px 1px #fff ; color:#000!important; font-size:14px!important;"><b><?=$dados['pastorbatismo'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Data que chegou na igreja:</th><td style="text-shadow: 1px 1px 1px #fff ; background:#f4f4f4; border-top:6px solid #fff;  border-bottom:4px solid #fff; color:#000!important; font-size:14px!important;"><b><?=$dados['dataentrou1'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Modo como entrou na igreja:</th><td style="text-shadow: 1px 1px 1px #fff ; color:#000!important; font-size:14px!important;"><b><?=$dados['modocomoentrou'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">M&uacute;sica Preferida:</th><td style="text-shadow: 1px 1px 1px #fff ; background:#f4f4f4; border-top:6px solid #fff;  border-bottom:4px solid #fff; color:#000!important; font-size:14px!important;"><b><?=$dados['musicapreferida'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Texto B&iacute;blico preferido:</th><td style="text-shadow: 1px 1px 1px #fff ; color:#000!important; font-size:14px!important;"><b><?=$dados['bibliapreferida'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">&Eacute; dizimista?:</th><td style="text-shadow: 1px 1px 1px #fff ; background:#f4f4f4; border-top:6px solid #fff;  border-bottom:4px solid #fff; color:#000!important; font-size:14px!important;"><b><?=$dizimista1['categoria'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Faz parte de qual minist&eacute;rio?:</th><td style="text-shadow: 1px 1px 1px #fff ; color:#000!important; font-size:14px!important;"><b><?=$ministerio1['categoria'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Qual &eacute; o seu talento?</th><td style="text-shadow: 1px 1px 1px #fff ; background:#f4f4f4; border-top:6px solid #fff;  border-bottom:4px solid #fff; color:#000!important; font-size:14px!important;"><b><?=$dados['talentos'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Qual o seu cargo na igreja?</th><td style="text-shadow: 1px 1px 1px #fff ; color:#000!important; font-size:14px!important;"><b><?=$cargo1['categoria'];?></b></td></tr>
<tr><th style="text-shadow: 1px 1px 1px #fff ; padding:0; width:200px; background:#EAEAEA; border-top:5px solid #fff;">Onde gostaria de trabalhar na igreja?</th><td style="text-shadow: 1px 1px 1px #fff ; background:#f4f4f4; border-top:6px solid #fff;  border-bottom:4px solid #fff; color:#000!important; font-size:14px!important;"><b><?=$gostariarabalhar1['categoria'];?></b></td></tr>
 
</table>

 


</div>

<?
	include('../includes/Rodape.php');
?>