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
		include 'cabecalho.php';
	?>

  <br>

  <!-- Grid loja-orçamentos Produtos -->
  <div class="container">

    <div class="row">
      <!-- row -->
      <h1 class="produtos text-muted pull-left">Produtos</h1>
    </div>

    <!-- Menu Lateral -->
    <div class="row">
      <!-- row -->
      <div id="menu-lateral" class="col-lg-3 col-md-3 hidden-sm hidden-xs">
        <h3>
          <b>Ache o produto que deseja aqui.</b>
        </h3>
        <br>
        <div class="input-group">
          <!-- /input-group -->
          <input type="text" name="pesquisa" id="txtSearch" class="form-control" Placeholder="Pesquisar" value="<?php echo isset($pesquisa) ? $pesquisa : ""; ?>" />
          <span class="input-group-btn">
            <button class="btn btn-primary" id="btn-search" type="button">
              <span class="glyphicon glyphicon-search"></span>
            </button>
          </span>
        </div>
        <!-- /input-group -->
        <ul class="bullet menu-bar lg-visible md-visible sm-visible xs-hidden">
          <h3>
            <b>Nossos Produtos</b>
          </h3>
          <?php
			$ul = '';
			$final = '';
			$q = mysql_query("SELECT * FROM tbprodutos_categorias");
			while ($dados = mysql_fetch_assoc($q)) {
				$final = '';
				$id = $dados['id_categoria'];
				$qq = mysql_query("SELECT * FROM tbprodutos_subcategorias WHERE categoria = '$id'");
				while ($dados2 = mysql_fetch_assoc($qq))
					$final .= '<hr class="separador-menu"><li><a href="promocoes.php?id='.$dados2['id_subcategoria'].'">'.utf8_encode($dados2['subcategoria']).'</a></li>';
				$ul .= '<ul class="bullet"><li><a href="javascript:void(0);">'.utf8_encode($dados['categoria']).'</a><ul class="bullet">'.$final.'</ul></li></ul>';
				
			}
			echo $ul;
			?>
        </ul>
      </div>
      <!-- Menu Lateral -->

      <div id="divProdutos" class="pull-right col-lg-9 col-md-9 col-sm-11 col-xs-11">
        <?php
        	echo "<div id='999999999999999999999999999999999999999999999999999999999999999999999' style='display: none;' class='loja-produto-box img-thumbnail col-lg-3 col-md-3 col-sm-3 col-xs-10 produtinho'>
	          <img class='img-responsive' src='painel/arquivos/produtos/_miniaturas/' alt=''>
	          <p>
	            <b></b>
	          </p>
	          <a><img class='img-responsive orca' src='./img/btn-orca.png' alt=''></a>
			</div>";
        ?>
        <!-- /.col-lg-3 -->
        <!--<a href="#">
          <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
              <button type="button" id="btn-verMais" class="btn btn-primary btn-lg btn-block">Veja Mais</button>
          </div>
        </a>-->
      </div>
    </div>
  </div>
  </div>
  
  <!-- fim - container -->

  <br>

  <!-- fim - row -->
  <br>

  <!--container-->
  <div class="clearfix"></div>


  <?php include "footer.php";?>

  <!-- Lightbox HTML5  ================================================== -->
  <script>
      jQuery(function ($) {
      	  carregaProdutos();
          $("img").h5lightbox();

          $("#btn-search").click(function(){
          	window.location = "produtos.php?search="+$("#txtSearch").val();
          });

          $("#btn-verMais").click(function(){
          	carregaProdutos();	
          })

          function carregaProdutos(){
          	var catid = '';
          	var id = '';
          	var pesquisa = '';
          	<?php
          	$catid = $_GET['catid'];
      			$id = $_GET['id'];
      			$pesquisa = $_GET['search'];
      			if(isset($catid)) $catid = "catid=$catid";
      			if(isset($id)) $id = "id=$id";
      			if(isset($pesquisa)) $pesquisa = "pesquisa=$pesquisa";
          	?>
          	catid = '<?=$catid?>';
          	id = '<?=$id?>';
          	pesquisa = '<?=$pesquisa?>';
    			$.ajax({
    				url: "retornoProdutos.php?lastId="+ $(".produtinho:last").attr('id')+'&' + catid + id + pesquisa+'&promocoes=1',
    				type: 'GET',
    				dataType: 'html',
    				beforeSend: function() {
    					$("#btn-verMais").replaceWith('<div id="carregando" class="btn btn-primary btn-lg btn-block"><img src="img/loader.gif" class="img-responsive" /></div>');	
    				},
    				success: function(html) {
    					if(html){		
    						$("#divProdutos").prepend(html);
    						$('#carregando').replaceWith('<!--<a href="javascript:void(0);" id="btn-verMais"><div class="col-lg-10 col-md-10 col-sm-10 col-xs-10"><button type="button" class="btn btn-primary btn-lg btn-block">Veja Mais</button></div></a>-->');
    					}else{
    						$('#carregando').replaceWith('<!--<a href="javascript:void(0);" id="btn-verMais"><div class="col-lg-10 col-md-10 col-sm-10 col-xs-10"><button disabled="disabled" type="button" class="btn btn-primary btn-lg btn-block">Você já visualizou todos os produtos</button></div></a>-->');
    					}
    				}
    			});
			     return false;
          }
      });
      </script>
</body>
</html>