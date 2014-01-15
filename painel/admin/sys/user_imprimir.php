<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cadastro de Membros</title>

<!-- ANTIGOS -->
     <script type="text/javascript" src="../js/admin.js"></script>
    <script type="text/javascript" src="../../js/ajax.js"></script>
    <script type="text/javascript" src="../../js/scripts.js"></script>
	<link href="../css/admin.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="../css/imprimir.css" rel="stylesheet" type="text/css" media="print"/>
	
			<!-- CSS -->
		<link rel="stylesheet" href="../resources/css/style.css" type="text/css" media="screen" />
		<!-- NAO APAGAR-->
		<link rel="stylesheet" href="../resources/css/invalid.css" type="text/css" media="screen" />	
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">
if( jQuery ) {
  jQuery(
    function() {
      if ( typeof( window.print ) != 'undefined' ) {
        window.print();
      }   
    }
  );
// Versão convencional
} else {
  window.onload = function()
  {
    if ( typeof( window.print ) != 'undefined' ) {
      //window.print();
    }
  } 
}
</script>
		
<!-- css calendádio -->
<link href="../styles/fullcalendar.css" rel="stylesheet" type="text/css" />
<!-- ligthbox css -->
<link href="../styles/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css" />
<!-- WYSIWYG Editor de texto -->
<link href="../styles/wysiwyg.css" rel="stylesheet" type="text/css" />
<!-- CSS CONTROLES E DEMAIS OPÇÕES -->
<link href="../styles/main.css" rel="stylesheet" type="text/css" />
<!-- CSS GERAL -->
<link href="../themes/blue/styles.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<? 
	define('ID_MODULO',31,true);
	include('../includes/Config.php');
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



 
<div id="conteudo">



<?
// -------------------------------------------------------------------------------
// Membro DADOS
// -------------------------------------------------------------------------------
?>
 
<table>

 

<tr style="position:absolute; top:60px; right:20px; width:200px;"><th style="  ; padding:0; width:200px; background:#fff; border:1px solid #ccc;"><img src="../../arquivos/user/<?=$dados['imagem'];?>" width="200px"></th><td style="   "><b></b></td></tr>

<!-- dados pessoais -->
<tr><th style="   "><p style="  ; color:#222; font-size:20px;">Dados Pessoais</p></th></tr>

<tr><th style="   ">Data do cadastro:</th><td style="   "><b><?=$dados['data1'];?></b></td></tr>
<tr><th style="   ">Nome:</th><td style="   "><b><?=$dados['nome'];?></b></td></tr>
<tr><th style="   ">Sobrenome:</th><td style="   "><b><?=$dados['sobrenome'];?></b></td></tr>
<tr><th style="   ">Nome do Pai:</th><td style="   "><b><?=$dados['pai'];?></b></td></tr>
<tr><th style="   ">Nome da M&atilde;e:</th><td style="   "><b><?=$dados['mae'];?></b></td></tr>
<tr><th style="   ">Naturalidade:</th><td style="   "><b><?=$dados['naturalde'];?></b></td></tr>
<tr><th style="   ">Nacionalidade:</th><td style="   "><b><?=$dados['nacional'];?></b></td></tr>
<tr><th style="   ">Data de Nascimento:</th><td style="   "><b><?=$dados['nascimento1'];?></b></td></tr>
<tr><th style="   ">Estado Civil:</th><td style="   "><b><?=$estadocivil1['categoria'];?></b></td></tr>
<tr><th style="   ">Nome do Conjuge:</th><td style="   "><b><?=$dados['conjuge'];?></b></td></tr>
<tr><th style="   ">Conjuge &eacute; crente?:</th><td style="   "><b><?=$dados['categoria'];?></b></td></tr>
<tr><th style="   ">Conjuge &eacute; de qual igreja?:</th><td style="   "><b><?=$dados['igrejaconjuge'];?></b></td></tr>
<tr><th style="   ">Filhos:</th><td style="   "><b><?=$dados['filhos'];?></b></td></tr>

<!-- dados profissionais -->
<tr><th style="   "><p style="  ; color:#222; font-size:20px;">Informa&ccedil;&otilde;es Profissionais</p></th></tr>

<tr><th style="   ">Profiss&atilde;o:</th><td style="   "><b><?=$dados['profissao'];?></b></td></tr>
<tr><th style="   ">Empresa que trabalha:</th><td style="   "><b><?=$dados['empresa'];?></b></td></tr>
<tr><th style="   ">Telefone Comercial:</th><td style="   "><b><?=$dados['telcomercial'];?></b></td></tr>
<tr><th style="   ">Endere&ccedil;o da empresa:</th><td style="   "><b><?=$dados['enderecoempresa'];?></b></td></tr>
<tr><th style="   ">RG:</th><td style="   "><b><?=$dados['identidade'];?></b></td></tr>
<tr><th style="   ">CPF:</th><td style="   "><b><?=$dados['cpf'];?></b></td></tr>
<tr><th style="   ">Grau de Instru&ccedil;&atilde;o:</th><td style="   "><b><?=$grau1['categoria'];?></b></td></tr>

<!-- Informações de Contato -->
<tr><th style="   "><p style="  ; color:#222; font-size:20px;">Informa&ccedil;&otilde;es de contato</p></th></tr>

<tr><th style="   ">Endere&ccedil;o:</th><td style="   "><b><?=$dados['endereco'];?></b></td></tr>
<tr><th style="   ">CEP:</th><td style="   "><b><?=$dados['cep'];?></b></td></tr>
<tr><th style="   ">Bairro:</th><td style="   "><b><?=$dados['bairro'];?></b></td></tr>
<tr><th style="   ">Cidade:</th><td style="   "><b><?=$dados['cidade'];?></b></td></tr>
<tr><th style="   ">Estado:</th><td style="   "><b><?=$dados['estado'];?></b></td></tr>
<tr><th style="   ">Telefone:</th><td style="   "><b><?=$dados['telefone'];?></b></td></tr>
<tr><th style="   ">Celular:</th><td style="   "><b><?=$dados['celular'];?></b></td></tr>
<tr><th style="   ">E-mail:</th><td style="   "><b><?=$dados['email'];?></b></td></tr>
<tr><th style="   ">Twitter:</th><td style="   "><b><?=$dados['twitter'];?></b></td></tr>
<tr><th style="   ">Facebook:</th><td style="   "><b><?=$dados['facebook'];?></b></td></tr>
<tr><th style="   ">Orkut:</th><td style="   "><b><?=$dados['orkut'];?></b></td></tr>

<!-- Informações Religiosas -->
<tr><th style="   "><p style="  ; color:#222; font-size:20px;">Informa&ccedil;&otilde;es Religiosas</p></th></tr>

<tr><th style="   ">Data de Profiss&atilde;o de F&eacute;:</th><td style="   "><b><?=$dados['datafe1'];?></b></td></tr>
<tr><th style="   ">Data do Batismo:</th><td style="   "><b><?=$dados['databatismo1'];?></b></td></tr>
<tr><th style="   ">Igreja em que foi batizado:</th><td style="   "><b><?=$dados['igrejabatismo'];?></b></td></tr>
<tr><th style="   ">Cidade da Igreja:</th><td style="   "><b><?=$dados['cidadeigreja'];?></b></td></tr>
<tr><th style="   ">Estado da Igreja:</th><td style="   "><b><?=$dados['estadoigreja'];?></b></td></tr>
<tr><th style="   ">Pastor que batizou:</th><td style="   "><b><?=$dados['pastorbatismo'];?></b></td></tr>
<tr><th style="   ">Data que chegou na igreja:</th><td style="   "><b><?=$dados['dataentrou1'];?></b></td></tr>
<tr><th style="   ">Modo como entrou na igreja:</th><td style="   "><b><?=$dados['modocomoentrou'];?></b></td></tr>
<tr><th style="   ">M&uacute;sica Preferida:</th><td style="   "><b><?=$dados['musicapreferida'];?></b></td></tr>
<tr><th style="   ">Texto B&iacute;blico preferido:</th><td style="   "><b><?=$dados['bibliapreferida'];?></b></td></tr>
<tr><th style="   ">&Eacute; dizimista?:</th><td style="   "><b><?=$dizimista1['categoria'];?></b></td></tr>
<tr><th style="   ">Faz parte de qual minist&eacute;rio?:</th><td style="   "><b><?=$ministerio1['categoria'];?></b></td></tr>
<tr><th style="   ">Qual &eacute; o seu talento?</th><td style="   "><b><?=$dados['talentos'];?></b></td></tr>
<tr><th style="   ">Qual o seu cargo na igreja?</th><td style="   "><b><?=$cargo1['categoria'];?></b></td></tr>
<tr><th style="   ">Onde gostaria de trabalhar na igreja?</th><td style="   "><b><?=$gostariarabalhar1['categoria'];?></b></td></tr>
 
</table>
 


</div>