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
  <script type="text/javascript" src="./dist/js/jquery.elevateZoom-3.0.8.min.js"></script>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" media="all" type="text/css" href="./dist/css/bootstrap.css">
  <link rel="stylesheet" media="all" type="text/css" href="./dist/fonts/gothic-font.css">
  <link rel="stylesheet" media="all" type="text/css" href="./dist/css/jquery.h5-lightbox.css">
  <link rel="stylesheet" media="all" type="text/css" href="./dist/css/menu.css">
  <link rel="stylesheet" media="all" type="text/css" href="./dist/css/apmoveis.css">
  <link rel="stylesheet" type="text/css" href="zoom/css/zoom.css">
  

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
  	$id = (int)$_GET['id'];
  	$result = mysql_query("select * from tbprodutos where id = $id");
  	$dadosProduto = mysql_fetch_assoc($result);
  ?>
<br>
<div class="cleafix"></div>
<br>
<div class="container">
<div class="row">

  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 pull-left">

    <div class="foto-ver-produtos">


        <div id="zoom">
          <img class="img-responsive" src="painel/arquivos/produtos/<?=$dadosProduto['foto1']?>" data-large-src="painel/arquivos/produtos/<?=$dadosProduto['foto1']?>"/>
           <span class="label label-primary center-block"><span class="glyphicon glyphicon-search"></span> <b>Clique na imagem para ampliar</b></span>
        </div>
    
       
        <div id="zoomhover">
          <img src="painel/arquivos/produtos/<?=$dadosProduto['foto1']?>" style="display: none;">
        </div>
    
    <div class="foto-miniatura">
      	<br>
        <?php
        	for ($i = 1;$i <= 5;$i++)
        		if (!empty($dadosProduto["foto$i"]))
        			echo '<a href="javascript:void(0);"><img src="painel/arquivos/produtos/_miniaturas/'.$dadosProduto["foto$i"].'" alt="" style="margin-right:5px;width: 80px;height: 80px;"></a>';
        ?>
      </div>
  </div>
      
    </div>

  <!--FIM-col-5-->

  <div class="cleafix"></div>

  <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 pull-right">
    <!--col-7-->
	<form action="carrinho.php?type=add" method="post">
    <h1><?=utf8_encode($dadosProduto['nome']); ?></h1>

    <div class="col-lg-7 col-md-8 col-sm-12 col-xs-12">
      <!-- Text input-->
      <div class="form-group">
        <label class="col-lg-9 col-md-9 col-sm-9 col-xs-7 control-label" for="">
          <h4>
            <b>Escolha a quantidade</b>
          </h4>
        </label>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
           <input id="qtd" name="qtd" placeholder="1..." class="form-control input-lg" type="text" maxlength="2" required /></div>
      		<input type="hidden" value="<?=((int)$_GET['id'])?>" id="idProduto" name="id"/>
      </div>
    </div>

    <div class="col-lg-5 col-md-4 col-sm-10 col-xs-10">
      <img src="./img/formas-pagamento.png"></div>

    <div class="col-lg-11 col-md-12 col-sm-12 col-xs-12">
      <input type="submit" id="solicitarOrcamento" class="btn btn-primary btn-lg pull-right" value="Solicitar orçamento" />
    </div>
	</form>
  </div>

  </div>
  <!--FIM-col-7-->




<div class="row">

    <div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-heading">
        <h3>
          <b>Descrição do Produto</b>
        </h3>
      </div>
      <div class="panel-body">
        <?=utf8_encode($dadosProduto['descricao']); ?>
      </div>
    </div>

    <div class="panel panel-default hidden-xs">
      <!-- Default panel contents -->
      <div class="panel-heading">
        <h3>
          <b>Quem Viu, Viu Também</b>
        </h3>
      </div>
    <div class="panel-body">
      <div class="container">
        <div class='row'>
          <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div class="carousel slide media-carousel quemviumedia" id="media">
              <div class="carousel-inner">
                <div class="item active">
                  
            					<?php
            			      		$sql = "select * from tbprodutos where id <> ".(int)$_GET['id']." and id_subcategoria = ".$dadosProduto['id_subcategoria'];
            			      		$result2 = mysql_query($sql);
            			      		$i = 0;
            						while($produtoRelacionado = mysql_fetch_assoc($result2)){
            							if($i < 4){
            						?>
                                <div class="loja-produto-box center-block img-thumbnail col-custom col-lg-2 col-md-3 col-sm-3 ">
                                  <img class="center-block img-responsive" src="painel/arquivos/produtos/_miniaturas/<?php echo $produtoRelacionado['foto1']?>" alt="">
                                  <p>
                                    <b><?=utf8_encode($produtoRelacionado['nome'])?></b>
                                  </p>
                                  <a href="ver_produtos.php?id=<?=$produtoRelacionado['id']?>"><img class="img-responsive center-block orca" src="./img/btn-orca.png" alt=""></a>
                                </div><!-- /.col-->

                                  <?php
            						 	  $i++;
            							}else{
            							  echo '</div></div><div class="item"><div class="row">';	
            							}
            						} 
            			      	?>

              <a data-slide="prev" href="#media" class="left carousel-control quemviu">‹</a>
              <a data-slide="next" href="#media" class="right carousel-control quemviu">›</a>
            
          </div>
        </div>
      </div>
      </div>
    </div>
    </div>
  </div>
  </div><!--row-->

</div><!--container-->

</div>
<div class="clearfix"></div>

<?php include "footer.php";?>
<script type="text/javascript" src="zoom/js/jquery.zoom.js"></script>

 
<!-- Lightbox HTML5  ================================================== -->
<script>
	$(function() {
		$("img").h5lightbox();
		$('.foto-miniatura a img').click(function() {
			var src = $(this).attr('src').replace('_miniaturas/','');
			$('.lightbox').attr('href',src);
			$('.lightbox > img').attr('src',src);
			$('#lightbox-img > img').attr('src',src);
      $('#zoomhover').css('background-image','url('+src+')');
      $('#zoomhover > img').attr('src',src);
		});
	})       
</script>

      
</body>
</html>