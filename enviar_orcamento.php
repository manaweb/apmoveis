<?php
	if(!isset($_GET['id']) || !isset($_COOKIE)){
		header("Location:cart.php");
	}
	if (isset($_COOKIE['produto_']))
		unset($_COOKIE['produto_']);

	$cookies = array();
	$i = 0;
	foreach($_COOKIE as $key => $value){
		if('produto_' == substr($key, 0, 8)){
			$cookies[$i] = $key;
			$i++;
		}
	}
	if($i == 0){
		header("Location: produtos.php");	
	}

	

?>
<!DOCTYPE html>

<html class="no-js" lang="pt-br">

<head>

  <title>AP Móveis</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="AP Móveis">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link rel="shortcut icon" href="./assets/ico/favicon.png">

  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script type="text/javascript" src="./dist/js/jquery-1.10.2.min.js"></script>
  <script type="text/javascript" src="./dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="./dist/js/jquery.h5-lightbox.min.js"></script>
   <script type="text/javascript" src="./dist/js/jquery.maskedinput.min.js"></script>
  <script type="text/javascript" src="./dist/js/jquery.blockUI.js"></script>
  <script type="text/javascript" src="./dist/js/CEP.js"></script>
  <script type="text/javascript" src="./assets/js/holder.js"></script>
  <script type="text/javascript" src="./assets/js/respond.min.js"></script>
  <script type="text/javascript" src="./assets/js/selectivizr-min.js"></script>
  <script type="text/javascript" src="./assets/js/iefix.js"></script>
  <script type="text/javascript" src="./assets/js/modernizr.js"></script>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" media="all" type="text/css" href="./dist/css/bootstrap.css">
  <link rel="stylesheet" media="all" type="text/css" href="./dist/fonts/gothic-font.css">
  <link rel="stylesheet" media="all" type="text/css" href="./dist/css/jquery.h5-lightbox.css">
  <link rel="stylesheet" media="all" type="text/css" href="./dist/css/menu.css">
  <link rel="stylesheet" media="all" type="text/css" href="./dist/css/apmoveis.css">

  <!-- H4CKs  ================================================== -->

  <!--[if lte IE 6]>
  <link  href="./assets/css/ie6.1.1.css" rel="stylesheet" media="screen, projection">
  <script src="./assets/js/html5shiv.js"></script>
  <link rel="stylesheet" type="text/css" media="screen, projection" href="http://universal-ie6-css.googlecode.com/files/ie6.0.3.css" />
  <![endif]-->

  <!--[if lt IE 7]>
  <script src="./assets/js/html5shiv.js"></script>
  <link href="./assets/css/bootstrap-ie7.css" rel="stylesheet">
  <![endif]-->

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 8]>
  <script src="./assets/js/html5shiv.js"></script>
  <link href="./assets/css/bootstrap-ie7.css" rel="stylesheet">
  <![endif]-->

  <!--[if lt IE 9]>
  <script src="./assets/js/html5shiv.js"></script>
  <script src="./assets/js/respond.min.js"></script>
  <![endif]-->

  <!-- Le HTML5 shim [html5shiv], for IE6-8 support of HTML elements -->
  <!--[if (gte IE 6)&(lte IE 8)]>
  <script type="text/javascript" src="./assets/js/selectivizr.js"></script>
  <noscript>
    <link rel="stylesheet" href="[fallback css]" />
  </noscript>
  <p class=chromeframe>
    Seu navegador está <em>utrapassado!</em>
    <a href="http://browsehappy.com/">Atualize-se para um navegador diferente</a>
    ou
    <a href="http://www.google.com/chromeframe/?redirect=true">Instale o Google Chrome Frame</a>
    para  ter uma experiência <b>completa</b>
    deste site.
  </p>
  <![endif]-->

  <!-- FIM HelpersH4CKs assets  =============================================== -->

</head>

<body>
  <?php include_once("analyticstracking.php") ?>

  <?php include "cabecalho.php";?>
  <br>

  <div class="container">
    <div class="row">

      <div class="well col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <div class="row">
		  <?php
			$sqlCadastro = "select * from tbclientes where id = ".$_GET['id']."";
			$result = mysql_query($sqlCadastro);
			$dadosCliente = mysql_fetch_assoc($result);
			$tel = "";
			if($dadosCliente['telefone'] != ""){
				$tel = $dadosCliente['telefone'];
			}else if($dadosCliente['celular'] != ""){
				$tel = $dadosCliente['celular'];
			}
		  ?>
          <div class="col-xs-6 col-sm-6 col-md-6">
            <address>
              <p> <strong><?=utf8_encode($dadosCliente['primeironome']." ".$dadosCliente['ultimonome'])?></strong>
                <br>
                <?=utf8_encode($dadosCliente['logradouro'])?>, <?=$dadosCliente['numero']?> - <?=$dadosCliente['bairro']?>
                <br>
                <?=utf8_encode($dadosCliente['cidade'])?>, <?=$dadosCliente['estado']?> - <?=$dadosCliente['cep']?>
                <br> <abbr title="Phone">Telefone:</abbr>
                <?php echo $tel; ?>
                <p></address>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-6 text-right">
              	<?php
              	date_default_timezone_set('America/Sao_Paulo');?>
                <p> <em>Data: <?php echo date('d/m/Y')?></em>
                </p>
                <p>
                  <!--<em>Pedido : </em>-->
                </p>
              </div>
            </div>
            <div class="row">
              <div class="text-center">
                <h1>Orçamento</h1>
              </div>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Produto</th>
                    <th>Qtd.#</th>
                  </tr>
                </thead>
                <tbody>
	        	<?php
	        		$total = 0;
					for($i = 0; $i < sizeof($cookies); $i++){
						$meuArray = unserialize($_COOKIE[$cookies[$i]]);
						$total += $meuArray['qtd']; 
						$sqlCarrinho = "select * from tbprodutos WHERE id = ".$meuArray['id'];
						$resultado = mysql_query($sqlCarrinho);
						$dadosCarrinho = mysql_fetch_array($resultado);
					?>
	              <tr>
	                <td class="col-md-11">
	                  <em><?=utf8_encode($dadosCarrinho['nome'])?></em>
	                </td>
	                <td class="col-md-1" style="text-align: center"><?php echo $meuArray['qtd']; ?></td>
	              </tr>
	              <?php }?>
	              <tr></tr>
	              <tr>
	                <td class="text-right">
	                  <h4> <strong>Total:</strong>
	                  </h4>
	                </td>
	                <td class="text-center text-danger">
	                  <h4>
	                    <strong><?=$total?></strong>
	                  </h4>
	                </td>
	              </tr>
	            </tbody>
              </table>
              <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 col-lg-offset-1">
                <button type="button" class="btn btn-success btn-lg btn-block btn-enviar-orcamento">
                  Enviar Orçamento
                  <span class="glyphicon glyphicon-chevron-right"></span>
                </button>
              </div>
            </div>
          </div>

      <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12  pull-right well well-sm">
        <legend>
          <a href="http://www.jquery2dotnet.com"> <i class="glyphicon glyphicon-globe"></i>
          </a>
          Cadastro
        </legend>
        <div class="row">
          <form action="#" method="post" class="form" role="form">
            <div class=" col-lgl-12 col-md-8 col-sm-6 col-xs-8">
              <label for="">Email</label>
              <input class="form-control" value="<?=$dadosCliente['email']?>" name="email" id="email" placeholder="SeuEmail@email.com.br" type="email" required autofocus disabled="disabled"/>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-11 col-md-6 col-sm-4 col-xs-10">
              <label for="">Nome</label>
              <input class="form-control" value="<?=utf8_encode($dadosCliente['primeironome'])?>" name="firstname" placeholder="Nome" type="text" required disabled="disabled"/>
            </div>
            <div class="col-md-8 col-xs-11">
              <label for="">Sobrenome</label>
              <input class="form-control" value="<?=utf8_encode($dadosCliente['ultimonome'])?>" name="lastname" placeholder="Sobrenome" type="text" required disabled="disabled"/>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-8">
              <label for="">Telefone</label>
              <input class="form-control" name="telefone" value="<?=$dadosCliente['telefone']?>" placeholder="(0XX) 9XXXX-XXXX" type="text" required disabled="disabled"/>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-8">
              <label for="">Celular</label>
              <input class="form-control" value="<?=$dadosCliente['celular']?>" name="celular" placeholder="(0XX) 9XXXX-XXXX" type="text" required disabled="disabled"/>
            </div>
          </div>

          <!-- CEP-->
          <legend>Endereço</legend>
          <div class="row">
            <div class="col-lg-7 col-md-7 col-sm-4 col-xs-8">
              <!-- Appended Input-->
              <label for="txtNumCep">CEP</label>
              <div class="input-group">
                <input class="form-control maskCep" value="<?=$dadosCliente['cep']?>" id="txtNumCep" name="txtNumCep" placeholder="12.345-678" type="text" disabled="disabled">
                <span id="btnBuscarCep" class="btn btn-warning input-group-addon" disabled="disabled">Buscar</span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
              <!-- Text input-->
              <label for="txtLogradouro">Logradouro</label>
              <input class="form-control " id="txtLogradouro" value="<?=utf8_encode($dadosCliente['logradouro'])?>" name="txtLogradouro" placeholder="Rua, Avenida..." type="text" disabled="disabled"></div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-8">
              <label for="txtNumLogradouro">Nº/Complemento</label>
              <input class="form-control " id="txtNumLogradouro" value="<?=utf8_encode($dadosCliente['numero'])?>" name="txtNumLogradouro" placeholder="Nº123 casa 01" type="text" disabled="disabled"></div>

            <!-- Text input-->
            <div class="col-lg-6 col-md-4 col-sm-4 col-xs-8">
              <label for="txtBairro">Bairro</label>
              <input class="form-control " id="txtBairro" name="txtBairro" value="<?=utf8_encode($dadosCliente['bairro'])?>" placeholder="bairro das laranjeiras" type="text" disabled="disabled"></div>
          </div>
          <div class="row">
            <!-- Text input-->
            <div class="col-lg-5 col-md-6 col-sm-6 col-xs-6">
              <label for="txtCidade">Cidade</label>
              <input class="form-control " id="txtCidade" name="txtCidade" value="<?=utf8_encode($dadosCliente['cidade'])?>" placeholder="sao paulo" type="text" disabled="disabled"></div>

            <!-- Text input-->
            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4">
              <label for="txtEstado">Estado</label>
              <input class="form-control " id="txtEstado" name="txtEstado" value="<?=$dadosCliente['estado']?>" placeholder="SP" type="text" disabled="disabled"></div>
          </div>
          <button class="btn btn-lg btn-danger btn-block" id="editarMucho" type="button">Editar Cadastro</button>
        </div>
      </div>
    </form>
    

    <div class="alert alert-success">

        <a href="#" class="close" data-dismiss="alert">&times;</a>

        Seu orçamento foi enviado com <strong>sucesso!</strong>, redirecionando para a página inicial...

    </div>


  </div>


      <br>

      <div class="cleafix"></div>


      <div class="clearfix"></div>
      <?php include "footer.php";?>

      <!-- Lightbox HTML5  ================================================== -->
      <script>
      jQuery(function ($) {
          $('.alert-success').hide();
          $("img").h5lightbox();
          
          $('#editarMucho').click(function() {
            if ($(this).attr('class').indexOf('btn-success') >= 0) {
              $(this).attr('type','submit');
              $('form').attr('action','realizarCadastro.php?email='+$('#email').val()).submit();
            }
            $('.btn-success').attr('disabled','disabled');
          	$('input[type=text],#btnBuscarCep').removeAttr('disabled');
            $(this).removeClass('btn-danger').addClass('btn-success').text('Finalizar Edição');
          });
      $(".btn-enviar-orcamento").click(function(){
				$(this).addClass('disabled').attr('disabled','disabled');
				$.ajax({
					url: "finalizar.php?id=<?=$_GET['id']?>&email=<?=$dadosCliente['email']?>",
					success: function(html) {
						$('.alert-success').fadeIn('slow');
            $('html,body').animate({
              scrollTop: $('#footer').offset().top+'px'
            },500);

						window.setTimeout(function(){
							window.location='index.php'
						}, 5000);
					}
				});
			});
      });
      </script>
</body>
</html>