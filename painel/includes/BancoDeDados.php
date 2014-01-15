<?php

  function db_conectar($servidor = DB_SERVIDOR, $usuario = DB_USUARIO, $senha = DB_SENHA, $banco = DB_BANCO) {
    global $db_link;

    $db_link = mysql_connect($servidor, $usuario, $senha);
    if ($db_link) mysql_select_db($banco);

    return $db_link;
  }



  function db_desconectar() {
    global $db_link;
    return mysql_close($db_link);
  }



  function db_erro($consulta, $erronum, $erro) { 
    die('<table cellpadding=30 cellspacing=0 style="border:1px solid #dddddd;"><tr><td><font color=red><b>Erro!</b></font><BR><BR><b># '.$erronum.'</b> - '.$erro.'<BR><BR>'.$consulta.'</td></tr></table>');
  }




  function db_consulta($consulta) {
    global $db_link;
    $result = mysql_query($consulta, $db_link) or db_erro($consulta, mysql_errno(), mysql_error());
    return $result;
  }


  function db_executa($tabela, $dados, $acao = 'insert', $parametros = '') {
	reset($dados);
    if (strtolower($acao) == 'insert') {
      $consulta = 'insert into ' . $tabela . ' (';
      while (list($coluna, ) = each($dados)) $consulta .= $coluna . ', ';
      $consulta = substr($consulta, 0, -2) . ') values (';

	  reset($dados);
      while (list(, $valor) = each($dados)) {
        switch ((string)$valor) {
          case 'now()':
            $consulta .= 'now(), ';
            break;
          case 'null':
            $consulta .= 'null, ';
            break;
          default:
            $consulta .= '\'' . db_entrada($valor) . '\', ';
            break;
        }
      }
      $consulta = substr($consulta, 0, -2) . ')';

    } elseif (strtolower($acao) == 'update') {
      $consulta = 'update ' . $tabela . ' set ';

	  reset($dados);
      while (list($coluna, $valor) = each($dados)) {
        switch ((string)$valor) {
          case 'now()':
            $consulta .= $coluna . ' = now(), ';
            break;
          case 'null':
            $consulta .= $coluna .= ' = null, ';
            break;
          default:
            $consulta .= $coluna . ' = \'' . db_entrada($valor) . '\', ';
            break;
        }
      }
      $consulta = substr($consulta, 0, -2) . ' where ' . $parametros;
    }
    return db_consulta($consulta);
  }



  function db_lista($db_consulta) {
    return mysql_fetch_array($db_consulta);
  }



  function db_linhas($db_consulta) {
    return mysql_num_rows($db_consulta);
  }



  function db_insert_id() {
    return mysql_insert_id();
  }



  function db_free_result($db_consulta) {
    return mysql_free_result($db_consulta);
  }



  function db_saida($string) {
    return htmlspecialchars($string);
  }



  function db_entrada($string) {
    return addslashes($string);
  }


  function db_dados($string) {
  	return db_lista(db_consulta($string));
  }




?>