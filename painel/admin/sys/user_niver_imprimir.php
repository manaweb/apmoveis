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


?>



 
<div id="conteudo">



<?
// -------------------------------------------------------------------------------
// Membro DADOS
// -------------------------------------------------------------------------------
?>
 
 
<?

if ($_GET['niver']>0) $sql = "
	
	SELECT *, DATE_FORMAT(nascimento,'%d/%m/%Y') as data1, DATE_FORMAT(nascimento,'%d') as nascimento1 FROM user WHERE DATE_FORMAT(nascimento,'%m') BETWEEN ".(int)$_GET['niver']." AND ".(int)$_GET['niver']." ORDER BY nascimento1 ASC
	
	";
	else {echo 'Nenhum relatório foi criado.'; exit;}
?>

 
<?
 

	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título		2=>Fonte			3=>Url
		array('texto',		'Nome',			'nome',		''),
		array('texto',		'Telefone',		'telefone',			''),
		array('texto',		'Celular',		'celular',			''),
		array('resumo',		'E-mail',		'email',			''),
		array('texto',		'Anivers&aacute;rio',	'data1',			''),
		array('foto',		'Foto',			'imagem',			''),
	);





	# Processando os dados
	$Lista = new Consulta($sql,999999,$PGATUAL);
	while ($linha = db_lista($Lista->consulta)) {
	$linha['categoria']=utf8_encode($linha['categoria']);
	$dados[] = $linha;
	}


	# Listando
	echo adminLista($campos,$dados,array(),$Config,false);












?>

</div>