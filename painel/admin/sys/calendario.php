<? 
	define('ID_MODULO',28,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'calendario',
		'tabela'=>'calendario',
		'titulo'=>'titulo',
		'id'=>'id_evento',
		'urlfixo'=>'', 
		'pasta'=>'calendario',
	);

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Compromissos</h2>
                    </div>
<div id="conteudo">
<a  id="btnalt" href="calendario_dados.php"><img src="../img/add.png" align="absmiddle" /> Adicionar Novo Compromisso</a>
<br />
<br />

<? $SQLs = mysql_query("SELECT * FROM calendario");
        $array = array();
        $i = 0;
        while ($row = mysql_fetch_array($SQLs)) {
            $array[$i]=array("id"=>$row["id_evento"],"title"=>"(".$row['titulo'].") ".$row['descricao'],"start"=>$row["data"],"allDay"=>true,"description"=>$row["descricao"],"url"=>"calendario_dados.php?ID=".$row["id_evento"],"editable"=>false,"textColor"=>"black","color"=>"black");
            $i++;
        }
 ?>
 
<script>
$(document).ready(function() {
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		var calendar = $('#calendar').fullCalendar({
			header: {
				left: 'title',
				right: 'prev,next'
			},
			selectable: false,
			selectHelper: false,
			select: function(start, end, allDay) {
				var title = prompt('Event Title:');
				if (title) {
					calendar.fullCalendar('renderEvent',
						{
							title: title,
							description: description,
						},
						false // habilitar e desablitar inserir
					);
				}
				calendar.fullCalendar('unselect');
			},
			editable: false,
			
			events: <? echo json_encode($array); ?>
		});
		
	});
</script>


<div class="contentbox">
<!-- gera calendário -->
<div id="calendar"></div>
</div>
					
    
<br />
<br />

</div>
			
<div class="conthead">
<h2>Lista de Compromissos</h2>
</div>
<div id="conteudo">
<?



	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título		2=>Fonte			3=>Url
		
		array('texto',		'TÍTULO',		'titulo',			''),
		array('texto',		'DATA',		'data1',		''),
	);


	# Consulta SQL
	$SQL = "SELECT *, DATE_FORMAT(data,'%d/%m/%Y') as data1 FROM calendario ORDER BY data DESC";



	# Processando os dados
	$Lista = new Consulta($SQL,20,$PGATUAL);
	while ($linha = db_lista($Lista->consulta)) {
		$dados[] = $linha;
	}


	# Listando
	echo adminLista($campos,$dados,array('excluir','editar'),$Config,true);



	# Paginação
	echo '<div class="paginacao">'.$Lista->geraPaginacao().'</div>';









?>
</div>
<? include('../includes/Rodape.php'); ?>