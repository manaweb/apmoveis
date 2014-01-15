<?php

# Banco de Dados
db_conectar();


# Paginaчуo
if (isset($_GET["pg"]) && is_numeric($_GET["pg"])) $PGATUAL = $_GET["pg"]; else $PGATUAL = 1; 

?>