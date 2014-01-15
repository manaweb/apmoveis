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
  <br>

  <div class="container">

    <div class="row clearfix">
      <div class="col-md-6 column">
        <h2>Contato</h2>
        <p>
          Preencha o formulário ou entre em contato com nosso departamento comercial. Para outras informações sobre os nossos serviços, basta entrar em contato com a área desejada.
        </p>

        <form action="#" method="post" class="form" role="form">
          <label for="">Nome</label>
          <input class="form-control" name="nome" id="nome" placeholder="Nome" type="text" required autofocus />
          <br>
          <label for="">Email</label>
          <input class="form-control" name="email" id="email" placeholder="Seu Email" type="email" required />
          <br>
          <label for="">Telefone</label>
          <input class="form-control" name="telefone" id="telefone" placeholder="Telefone,celular,etc..." type="text" required />
          <br>
          <label for="">Assunto</label>
          <input class="form-control" name="assunto" id="assunto" placeholder="Assunto" type="text" required />
          <br>
          <label for="">Mensagem</label>
          <textarea class="form-control" rows="3" name="mensagem" id="mensagem" placeholder="Mensagem" required></textarea>
          <br>
          <div id="carregando" class="alert"><img src="img/loader.gif" /></div>
          <input type="submit" id="btn-enviar" class="btn btn-primary btn-lg pull-right" value="Enviar" />
        </form>
      </div>

      <div class="col-md-6 column">
        <h3>Onde Estamos</h3>
        <div class="media well">
          <h4>Atendimento</h4>
          <address> <strong>Ap Móveis Ltda.</strong>
            <br />
            Rua São Sebastião, 503 - Centro,
            <br />
            Jaboticabal - SP, 14870-720
            <br /> <abbr title="Phone">Telefone:</abbr>
            +55 (016) 3202-7022
          </address>

          <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
          <style>
                html, body, #map-canvas {
                  height: 100%;
                  margin: 0px;
                  padding: 0px
                }
              </style>
          <script type="text/javascript">
              window.onload = function() {
                  initialize();
              }
           
              function initialize() {
                  var myLatlng = new google.maps.LatLng(-21.253679,-48.321358);
                  
                  var myOptions = {
                      zoom: 15,
                      center: myLatlng,
                      mapTypeId: google.maps.MapTypeId.ROADMAP        }
                   
                  var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

                   
                  var contentString = "É uma empresa focada na inovação de móveis para escritório, nossa meta é oferecer o que há de melhor para cada segmento, com design moderno que faz toda a diferença em uma empresa que deseja se adequar aos padrões exigidos pelo mercado atual.";
                   
                  var infowindow = new google.maps.InfoWindow({
                      content: contentString
                  });
                   
                  var marker = new google.maps.Marker({
                      position: myLatlng,
                      icon: './img/marcador.png',
                      map: map,
                      title: "AP Móveis"
                  });


                  google.maps.event.addListener(marker, 'click', function() {
                      infowindow.open(map,marker);
                  });

                  var styles = [
                   { "featureType": "poi", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "saturation": 28 }, { "hue": "#00ff99" } ] },{ "featureType": "landscape", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "hue": "#0000ff" }, { "lightness": 25 } ] },{ "featureType": "road.highway", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "hue": "#0099ff" }, { "saturation": 54 }, { "gamma": 0.7 }, { "lightness": -16 } ] },{ "featureType": "road.arterial", "elementType": "labels.text.fill", "stylers": [ { "visibility": "on" }, { "hue": "#ff0000" }, { "color": "#298db9" } ] },{ "featureType": "road.local", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#1b7dcf" }, { "hue": "#00ccff" }, { "saturation": 51 }, { "lightness": 48 } ] },{ "featureType": "road.highway.controlled_access", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "saturation": -3 }, { "color": "#e80080" }, { "lightness": 59 } ] },{ } ] ;
                map.setOptions({styles: styles});
              }
          </script>
          <!-- Arquivo de inicialização do mapa -->
          <div id="map_canvas" style="width:820px;height:380px;" class="img-responsive" type="submit"></div>
        </div>
      </div>
    </div>
  </div>

  <br>

  <div class="clearfix"></div>
  <?php include "footer.php";?>

  <!-- Lightbox HTML5  ================================================== -->
  <script>
    jQuery(function ($) {
        $("img").h5lightbox();


		$("form").submit(function(){
			$("#btn-enviar").attr('disabled','disabled');
			$("#carregando").show();
			$.ajax({
				url: "enviar-contato.php?nome="+$("#nome").val()+"&email="+$("#email").val()+"&telefone="+$("#telefone").val()+"&assunto="+$("#assunto").val()+"&mensagem="+$("#mensagem").val(),
				success: function(html) {
					$("#carregando").replaceWith("<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button> <strong>Atenção</strong><p>sua mensagem foi enviada com sucesso!</p></div>");
					$("#btn-enviar").removeAttr('disabled');
					$("input[type=text], input[type=email], textarea").val("");

				}
			});
			return false;
		});

		$("input[type=text], input[type=email]").focus(function(){
			$(".alert").replaceWith('<div id="carregando" class="alert"><img src="img/loader.gif" /></div>');
		})
    });
  </script>
</body>
</html>