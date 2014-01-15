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

  <div class=" container">
   
    <div class="row">
         <h1 class="produtos text-muted center-block">Produtos</h1>

      <?=utf8_encode(htmlentities(strip_tags($dados['texto'])));?>

     </div><!-- /.row -->
      
   </div><!-- container-->

    <div class="cleafix"></div>

<div class="container">
    <!-- START THE FEATURETTES -->

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-8">
        <h2 class="featurette-heading">
          <span class="text-muted">Siga nos no</span> <b>facebook</b>
        </h2>
        <div id="likebox-wrapper">
         <div class="fb-like-box" data-href="https://www.facebook.com/lojaapmoveis" data-height="100%" data-colorscheme="light" data-show-faces="false" data-header="false" data-stream="true" data-show-border="true"></div>
        </div>
      </div>

      <div class="cleafix"></div>

      <div class="col-md-4">
        <h2 class="featurette-heading">
          <span class="text-muted">Nossa Loja</span>
        </h2>
        <div>

          <div class='col-md-12'>
            <div class="carousel slide media-carousel" id="media">
              <div class="carousel-inner">
                <?php
                    $isFirst = true;
                    $query = mysql_query("SELECT * FROM tbnossaloja");
                    $rows = mysql_num_rows($query);
                    for ($i = 0;$dadosLoja = mysql_fetch_assoc($query);$i++) {

                      if ($i == 0)
                        echo '<div class="item active"><div class="row nossaloja">';

                      echo '<div class="col-lg-6 col-md-6 col-sm-4 col-xs-6 pull-right">
                      <img class="img-responsive" src="painel/arquivos/nossaloja/_miniaturas/'.$dadosLoja['arquivo'].'" data-large-src="painel/arquivos/nossaloja/'.$dadosLoja['arquivo'].'"  alt="..."/>
                    </div>';

                      if (!(($i+1)%4) && $i != $rows-1) {
                        echo '</div></div><div class="item"><div class="row">';
                      }else if ($i == $rows-1) {
                        echo '</div></div>';
                      }
                    }
                ?>
            </div>
              <a data-slide="prev" href="#media" class="left carousel-control control-mini">‹</a>
              <a data-slide="next" href="#media" class="right carousel-control control-mini">›</a>
            </div>
          </div>
        </div>

        <div class="">
          <img class="img-responsive center-block" src="./img/contato.png" alt="..."/>
        </div>
      </div>
    </div>
</div>

  <div class="cleafix"></div>

  <?php include "footer.php";?>

  <!-- Lightbox HTML5  ================================================== -->
  <script>
      jQuery(function ($) {
          /*$('#media .lightbox').click(function() {
            $('#lightbox-img').attr('src',$(this).attr('data-large-src'));
          });*/

          $("img").h5lightbox();
          $('.lightbox img').click(function() {
            var src = $(this).attr('src').replace('_miniaturas/','');
            $('#lightbox-img > img').attr('src',src);
        });
      });
      </script>

      <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=170974698005";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
  </body>
</html>