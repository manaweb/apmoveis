<?php 
	if(!isset($_GET['id']) || !isset($_COOKIE) || !isset($_GET['qtd'])){
		header("Location:carrinho.php");
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

  <div class="container"> <!--container - conteudo-->
    <div class="row"><!-- /.row -->
      <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
        <!-- /.col-lg-8 -->
        <h2>Para finalizar a compra, informe seu e-mail. <small><b>Rápido ! Fácil ! Seguro !</b>
          </small>
        </h2>
		<form method="post" action="cadastro_orcamento.php">
	        <div class="input-group col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
	          <input type="hidden" name="id" value="<?=(isset($_GET['id']) ? $_GET['id'] : "")?>" />
			  <input type="hidden" name="qtd" value="<?=(isset($_GET['qtd']) ? $_GET['qtd'] : "")?>" />
	          <input  id="" name="email"  placeholder="email@mail.com" type="email" class="form-control" autofocus required>
	          <span class="input-group-btn">
	            <input type="submit" id="" name="" class="btn btn-primary" value="Enviar" />
	          </span>
	        </div>
	        <!-- /input-group -->
        </form>

        <br>
        <div class="col-lg-8 col-lg-offset-2 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 alert alert-success letrasize">
          <!--sucess-alert-->

          <h4>Usamos seu e-mail de forma 100% segura para:</h4>
          <h5>
            <span class="glyphicon glyphicon-ok">
              <b class="text-muted cg">Identifica seu perfil</b>
            </span>
          </h5>
          <h5>
            <span class="glyphicon glyphicon-ok">
              <b class="text-muted cg">Notificar sobre o andamento do seu pedido</b>
            </span>
          </h5>
          <h5>
            <span class="glyphicon glyphicon-ok">
              <b class="text-muted cg">Gerenciar seu histórico de compras</b>
            </span>
          </h5>
          <h5>
            <span class="glyphicon glyphicon-ok">
              <b class="text-muted cg">Acelerar o preenchimento de suas informações</b>
            </span>
          </h5>
        </div><!--sucess-alert-->
        <br>
      </div><!-- /.col-lg-8 --> 
      <div class="col-lg-3 col-lg-offset-9 col-md-3 col-md-offset-9 col-sm-8 col-sm-offset-4 col-xs-8 col-xs-offset-4">
        <button type="button" class="btn btn-primary">
            <span class="glyphicon glyphicon-shopping-cart"></span> Voltar para o Carrinho
        </button>
      </div>
    </div><!-- /.row --> 
  </div> <!-- /.container -->
</div>
  <div class="cleafix"></div>


  <div class="clearfix"></div>
<?php include "footer.php"; ?>

  <!-- Lightbox HTML5  ================================================== -->
  <script>
      jQuery(function ($) {
          $("img").h5lightbox();
      });
      </script>
</body>
</html>