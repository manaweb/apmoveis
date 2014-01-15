<?php
include('../includes/Config.php');

$SQL = mysql_query("SELECT * FROM calendario");
        $array = array();
        $i = 0;
        while ($row = mysql_fetch_array($SQL)) {
            $array[$i]=array("id"=>$row["id_evento"],"title"=>"(".$row['titulo'].") ".$row['descricao'],"start"=>$row["data"],"allDay"=>true,"description"=>$row["descricao"],"url"=>"calendario_dados.php?ID=".$row["id_evento"],"editable"=>false,"textColor"=>"black","color"=>"black");
            $i++;
        }

 echo json_encode($array);

?>
