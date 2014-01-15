<? 
	define('ID_MODULO',0,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');


?>
<meta http-equiv="refresh" content="120; url=index.php" />
 <style>
 	#comentPendent{
 		background: #C00;
		font-family: 'Arial';
		font-size: 25px;
		color: #FFF;
		padding: 0px 6px;
		position: relative;
		top: 4px;
 	}
 	
 </style>
 

<?
 
	include('../includes/Mensagem.php');
?>








<!-- INÃ�CIO DO GRÃ�FICO -->          
        		<div class="container med left" id="graphs">
                	<div class="conthead">
                		<h2>Gr&aacute;fico de visitas</h2>
                    </div>
<!-- MENUS DOS GRAFICOS -->                    
                	<div class="contentbox">
                    	<ul class="tablinks tabfade">
                        	<li class="nomar"><a href="#graphs-1">Barras</a></li>
                            <li><a href="#graphs-4">Area</a></li>
                        </ul>
<!-- FIM MENU GRAFICOS -->                       
<!-- INICIANDO TABELAS DE GRAFICOS -->
                    	<div class="tabcontent" id="graphs-1">
                            <table style="display: none; height: 250px" class="bar" width="52%">
                                <caption>Visitas ao site nos &uacute;ltimos 3 dias</caption>
                                <thead>
                                    <tr>
                                        <td></td>
										<?
										$hoje = time(); 
										$ontem = $hoje - (24*3600); 
										$anteontem = $hoje - (48*3600);
										?>
										<th scope="col"> <span  style="color:green; font-weight:bold; text-decoration:underline;"><?echo date('d/m/Y', $hoje); ?> - Hoje</span></th>
										<th scope="col"> <?echo date('d/m/Y', $ontem); ?></th>
										<th scope="col"> <?echo date('d/m/Y', $anteontem);?></th>
										
                                        
										
										
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">Visitas</th>
										<?
											$i=0;
											$SQL = "SELECT * FROM visitantes ORDER BY id DESC";
											$Lista = new Consulta($SQL,3,$PGATUAL);
											while ($linha = db_lista($Lista->consulta)) { $i++;
										?>

                                        <td><?=$linha['contador'];?></td>
										
<?
	}
?>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                   
                    
                   		<div class="tabcontent" id="graphs-4">
                            <table style="display: none; height: 250px" class="area" width="52%">
                               <caption>Visitas ao site nos Ãºltimos 3 dias</caption>
                                <thead>
                                    <tr>
                                        <td></td>
<?
$hoje = time(); 
$ontem = $hoje - (24*3600); 
$anteontem = $hoje - (48*3600);
?>
										<th scope="col"> <span  style="color:green; font-weight:bold; text-decoration:underline;"><?echo date('d/m/Y', $hoje); ?> - Hoje</span></th>
										<th scope="col"> <?echo date('d/m/Y', $ontem); ?></th>
										<th scope="col"> <?echo date('d/m/Y', $anteontem);?></th>
										
										
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">Visitas</th>
<?
	$i=0;
	$SQL = "SELECT * FROM visitantes ORDER BY id DESC";
	$Lista = new Consulta($SQL,3,$PGATUAL);
	while ($linha = db_lista($Lista->consulta)) { $i++;
?>	

                                        <td><?=$linha['contador'];?></td>
										
<?
	}
?>
                                    </tr>
                                </tbody>
                            </table>
                   		</div>
<!-- FIM DO GRÃ�FICO -->  
                      
                    </div>
                </div>
                
<!-- INÃ�CIO DAS ESTATÃ�STICAS -->               
                <div class="container sml right">
                	<div class="conthead">
                		<h2>Op&ccedil;&otilde;es</h2>
                    </div>
                	<div class="contentbox">
                    	<ul class="summarystats">
							<?php if(usuarioPermissao($_SESSION['Admin']['id_usuario'],'86')){?>
								<li>
								<? $sql = "SELECT * FROM tborcamento where flag_status = 0";
								$query = mysql_query($sql) or die(mysql_error());
								$total = mysql_num_rows($query); ?>
	                            	<p class="statcount"><img src="../img/coment.png" /></p> <p><span id='comentPendent'><?echo $total;?></span> Pedidos de Or&ccedil;amento</p>    <p class="statview"><a href="orcamento.php" title="view">ver</a></p>
	                            </li>
							<?}?>
                        	
							
							<? if ($_SESSION['Admin']['id_usuario']==1) { ?>
							<li>
                            	<p class="statcount"><img src="../img/administradores.png" /></p> <p>Administradores do site</p>    <p class="statview"><a href="_usuarios.php" title="view">ver</a></p>
                            </li>
                            <? } ?>
                            <li>
                            	<p class="statcount"><img src="../img/alterarSenha.png" /></p> <p>Alterar a sua senha</p>    <p class="statview"><a href="_senha.php" title="view">ver</a></p>
                            </li>
							<li>
                            	<p class="statcount"><img src="../img/sair.png" /></p> <p><a href="../_logoff.php">Sair</a></p>
                            </li>
                    
					</ul>

                        
                    </div>
                </div>
<!-- FIM DAS ESTATÃ�STICAS -->    
               
                <!-- LIMPAR --> <div style="clear: both"></div>
              
			  
			  
			  
			  

 
<? include('../includes/Rodape.php'); ?>