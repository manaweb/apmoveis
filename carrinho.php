<?php
	include "orcamento/cart/produto.class.php";
	include "orcamento/cart/carrinho.class.php";
	$Cart = new Carrinho;
	
	if (isset($_COOKIE['produto_'])){
		unset($_COOKIE['produto_']);
		setcookie('produto_', '');
	}
	
	if (isset($_POST)){
		$Produto = new Produto($_POST);
		$Cart->AddCart($Produto);
	}
	if(isset($_GET['type']) && $_GET['type'] == 'add'){
		header("Location: carrinho.php");
	}else if(isset($_GET['type']) && $_GET['type'] == 'remove'){
		$id = $_GET['id'];
		setcookie("produto_$id",NULL);
		header("Location: carrinho.php");
	}
	$cookies = array();
	$i = 0;
	foreach($_COOKIE as $key => $value){
		if('produto_' == substr($key, 0, 8)){
			$cookies[$i] = $key;
			$i++;
		}
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
  <?php
    include "cabecalho.php";
  ?>
  <br>
  <div class="container">
    <div class="row">
      <!-- row -->
      <h1 class="produtos text-muted pull-left">Carrinho</h1>
    </div>

    <div class="panel panel-default">

      <div class="panel-heading">Produto</div>


	  <?php
		if(sizeof($cookies) == 0){
				echo "<p>Nada</p>";
		}else{
			for($i = 0; $i < sizeof($cookies); $i++){
				$meuArray = unserialize($_COOKIE[$cookies[$i]]);
				$sqlCarrinho = "select * from tbprodutos WHERE id = ".$meuArray['id'];
				$resultado = mysql_query($sqlCarrinho);
				if(mysql_num_rows($resultado) > 0){
					$dadosCarrinho = mysql_fetch_array($resultado);
			?>
      <div 	class="panel-body row">
        <div class="panel-body col-md-8">
          <div class="media">
            <a class="thumbnail pull-left" href="ver_produtos.php?id=<?=$dadosCarrinho['id']?>">
              <img class="media-object img-responsive" src="painel/arquivos/produtos/_miniaturas/<?php echo $dadosCarrinho['foto1']?>"></a>
            <div class="media-body">
              <h4 class="media-heading">
              	<input type="hidden" value="<?=$meuArray['id']?>" class="idProduto" />
                <a href="ver_produtos.php?id=<?=$dadosCarrinho['id']?>"><?=utf8_encode($dadosCarrinho['nome'])?></a>
              </h4>
              <!--<h5 class="media-heading">
                por
                <a href="#">Marca/Fabricante</a>
              </h5>-->
              <strong><?=utf8_encode($dadosCarrinho['descricao'])?></strong>
             </div>
          </div>
        </div>
        <div class="panel-body col-md-4">
          <div class="input-group">
            <span class="input-group-addon">Qtd.</span>

            <input type="text" class="form-control qtdCart" placeholder="<?=$meuArray['qtd']?>" value="<?=$meuArray['qtd']?>" />

            <span class="input-group-btn">
              <button type="button" class="btn btn-warning">
                <span class="glyphicon glyphicon-repeat"></span>
                Atualizar
              </button>
            </span>
          </div>
          <!-- /input-group -->
          <hr>
          <button type="button" onclick="remover(<?=$meuArray['id']?>)" class="btn btn-danger pull-right">
            <span class="glyphicon glyphicon-remove"></span>
            Remover
          </button>
        </div>
        <!-- /.col-lg-6 --> </div>
      <!-- /row -->
	<?php 	  }else{
				setcookie("produto_".$meuArray['id'],NULL);
			  }
			}
		  }?>



      <hr>

      <div class="panel-body pull-right">
      	<a href="produtos.php">
	        <button class="btn btn-primary">
	          <span class="glyphicon glyphicon-shopping-cart"></span>
	          Continue Comprando
	        </button>
	    </a>

        <button type="button" onclick="finalizar()" class="btn btn-success">
          Finalizar Compra
          <span class="glyphicon glyphicon-play"></span>
        </button>

      </div>
    </div>
  </div>
</div>
  <br>

  <div class="cleafix"></div>


  <div class="clearfix"></div>
  <?php include "footer.php";?>

  <!-- Lightbox HTML5  ================================================== -->
  <script>
      jQuery(function ($) {
          $("img").h5lightbox();
      });
      
      function remover(id){
      	if(!confirm('Tem certeza que deseja remover este item do carrinho?'))
      		return false;
      	window.location = "carrinho.php?type=remove&id="+id;
      }
      
      function finalizar(){
		var produtos = new Array();
		var quantidades = new Array();
		for(i = 0; i < $(".idProduto").size();i++){
			produtos[i] = $(".idProduto").eq(i).val();
			quantidades[i] = $(".qtdCart").eq(i).val();
		}
		window.location = "informe_email.php?id="+produtos+"&qtd="+quantidades;
      }
      </script>
</body>
</html>