<?php

# Banco de Dados
db_conectar();


# Pagina��o
if (isset($_GET["pg"]) && is_numeric($_GET["pg"])) $PGATUAL = $_GET["pg"]; else $PGATUAL = 1; 

?>