<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Man&aacute; WEB - Painel de Administra&ccedil;&atilde;o</title>

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
		
	 	<script type="text/javascript" src="../resources/scripts/jquery-1.3.2.min.js"></script>	
		<script>
		$(document).ready(function(){
		$(".close").click(
			function () {
				$(this).parent().fadeTo(400, 0, function () { // esse script � o respons�vel em fechar a notifica��o de alerta, erro, etc
					$(this).slideUp(400);
				});
					return false;
				}
			);
		});
		</script>
		
<!-- css calend�dio -->
<link href="../styles/fullcalendar.css" rel="stylesheet" type="text/css" />
<!-- ligthbox css -->
<link href="../styles/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css" />
<!-- WYSIWYG Editor de texto -->
<link href="../styles/wysiwyg.css" rel="stylesheet" type="text/css" />
<!-- CSS CONTROLES E DEMAIS OP��ES -->
<link href="../styles/main.css" rel="stylesheet" type="text/css" />
<!-- CSS GERAL -->
<link href="../themes/blue/styles.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<!-- LOGO E PESQUISA -->
	<div id="header">
    	<a href="index.php"><img src="../images/logo.png" alt="AdminCP" class="logo" /></a>
    </div>
 <!-- FIM DA LOGO E PESQUISA -->   
    
<!-- IN�CIO DA ESQUERDA COM MENUS ETC -->
        <div id="left">


<!-- TOLBOX QUE DESCE - MENU -->
        	<div id="openCloseIdentifier"></div>
            <div id="slider">
                <ul id="sliderContent">
					
					<? if ($_SESSION['Admin']['id_usuario']==1) { ?>
					<li class="alt"><a href="_usuarios.php" title="">Administradores</a></li>
					<? } ?>
					
                    <li><a href="_senha.php" title="">Alterar senha</a></li>
                    <!--<li class="alt"><a href="_faq.php" title="">Perguntas Frequentes</a></li>-->
                    <li><a href="../_logoff.php" title="">Sair</a></li>
					
					<? if ($_SESSION['Admin']['id_usuario']>=2) { ?>
					<li class="alt"><a href="#" title=""></a></li>
					<li class="alt"><a href="#" title=""></a></li>
					<li class="alt"><a href="#" title=""></a></li>
					<? } ?>
					
					<? if ($_SESSION['Admin']['id_usuario']==1) { ?>
                    <!--<li><a href="configuracoes_dados.php?ID=1" title="">Configura&ccedil;&otilde;es do site</a></li>-->
                    <li class="alt"><a href="#" title=""></a></li>
                    <li class="alt"><a href="#" title=""></a></li>
					<?	} ?>

                </ul>
                <div id="openCloseWrap">
                    <div id="toolbox">
            			<a href="#" title="Toolbox Dropdown" class="toolboxdrop">Op&ccedil;&otilde;es <img src="../images/icon_expand_grey.png" alt="Expand" /></a>
            		</div>
                </div>
            </div>
<!-- FIM FIM TOLBOX QUE DESCE - MENU  -->
    	
<!-- LOGADO -->
            <div id="userbox">
                <p><span><br>A&ccedil;&otilde;es</span></p>
                <ul>
					<? if ($_SESSION['Admin']['id_usuario']==1) { ?>
                	<li><a href="_usuarios.php" title="Administradores"><img src="../img/user.png" alt="Administradores" /></a></li>
                    
                    <? } ?>
					<? if ($_SESSION['Admin']['id_usuario']>=2) { ?>
					<li><a href="_senha.php" title="Alterar Senha"><img src="../img/senha.png" alt="Alterar Senha" /></a></li>
					<li><a href="#" title="Suporte"><img src="../img/suporte.png" alt="Suporte" /></a></li>
					<? } ?>
					<li><a href="../_logoff.php" title="Sair"><img src="../images/icons/icon_unlock.png" alt="Sair" /></a></li>
                </ul>
            </div>
<!-- FIM LOGADO -->  

<!-- IN�CIO DO MENU NAVEGA��O -->         
            <ul id="nav">
			
			
			<li><ul class="navigation">
			<li class="heading selected">Menu</li>
			</ul></li> 
			
			
<li>

		<?php
			function ListaMenu($dentro_id) {
			$i=0;
			$consulta = db_consulta("SELECT * FROM adm_menu WHERE dentro_id=".(int)$dentro_id." order by id_menu asc;");
			if (db_linhas($consulta)>0) {
			while ($linha = db_lista($consulta)) { $i++;
				if ($i>1) $saida;
				if (empty($linha['icone'])) $linha['icone']='';

				if (!($linha['dentro_id']>0)) {
					$saida .= "<a ";
					if (ID_MODULO==$linha['id_menu']) { $saida .= ' class="expanded heading" '; }else{ $saida .= ' class="collapsed heading" ';}
					if (! usuarioPermissao($_SESSION['Admin']['id_usuario'],$linha['id_menu'])) $saida .= ' style="display:none;" ';
					$saida .= ">".utf8_encode($linha['titulo']);
					
					if (! usuarioPermissao($_SESSION['Admin']['id_usuario'],$linha['id_menu'])) {$saida .= "</a>";}else{
					$saida .= "</a><ul class='navigation'>";}
					
				} else $saida .= "<li><a href='".$linha['destino']."'>".utf8_encode($linha['titulo'])."</a></li>";

				
				if ((!usuarioPermissao($_SESSION['Admin']['id_usuario'],$linha['id_menu']))&&($linha['id_dentro']==0)) {} else {
					if (db_linhas(db_consulta("SELECT id_menu FROM adm_menu WHERE dentro_id=".(int)$linha['id_menu']))>0) {
						$saida .= ListaMenu($linha['id_menu']);
						 
					}
				}
				$saida .= '';
				
			}	$saida .= "</ul>";
			}	else $saida .= '';
			
			return $saida;
		}
		
		echo ListaMenu(0);
		
		?>
 

</li>  	
 
            </ul>
        </div>      
<!-- FIM DA NAVEGA��O DOS MENUS --> 

<!-- FIM DA ESQURDA COOM MENUS -->   



<!-- IN�CIO DA DIREITA -->     
        <div id="right">

<!-- LOGADO STATUS-->  
            <div id="breadcrumb">
                <ul>	
        			<li><p><a href="#">Ol&aacute; <?=$_SESSION['Admin']['nome'];?></a></li>
                </ul>
            </div>
<!-- FIM LOGADO -->  



<!-- BOT�ES TOPO ADMIN -->  
            <ul id="topbtns">
            	
            <!--    <li>
                	<a href="#"><img src="../images/icons/icon_lrg_calendar.png" alt="Calendar" /><br />Calendar</a>
                </li>
                <li>
                	<a href="#"><img src="../images/icons/icon_lrg_create.png" alt="Create" /><br />Create</a>
                </li>
                <li>
                	<a href="#"><img src="../images/icons/icon_lrg_user.png" alt="Users" /><br />Users</a>
                </li> -->
                <li style="opacity: 0.5">
                	<a><img src="../images/icons/icon_lrg_media.png" alt="Pagar fatura" /><br />Fatura</a>
                </li>
                <li style="opacity: 0.5">
                	<a><img src="../images/icons/icon_lrg_comment.png" alt="Comment" /><br />Novidades</a>
                </li>
                <li style="opacity: 0.5">
                	<a><img src="../images/icons/icon_lrg_support.png" alt="Suporte t�cnico" /><br />Perguntas</a>
                </li>
            </ul>
<!-- FIM DOS BOT�ES -->  





 <!-- Main content start -->      
            <div id="content">