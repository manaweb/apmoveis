<?php
include ('../php/config/config.php'); 
include ('includes/BancoDeDados.php'); 
include ('includes/Funcoes.php'); 
include ('includes/Config.php'); 
db_conectar();
db_consulta("UPDATE tbcontador SET acessos=acessos+1 WHERE id_pagina=1");

header('Location: /painel/admin/index.php',true); 

?>