<?php
	include("php/config/config.php");
	include("painel/includes/BancoDeDados.php");
	$conexao = db_conectar();
?>
<?php include_once("analyticstracking.php") ?>
<!--cssmenu desktop ==================================================-->
  <div class="visible-lg visible-md hidden-sm hidden-xs">
    <div id='cssmenu' class="pull-right">
      <ul class="porcimacssmenu">
        <li class="box-flag">
          <a href='./index.php'>
            <span>Home</span>
          </a>
        </li>
        <li>
          <a href="sobre.php">
            <span>Quem somos</span>
          </a>
        </li>
        <li class='has-sub'>
          <a href='./produtos.php'>
            <span>Produtos</span>
          </a>
          <ul>
             <?php
            	$query = mysql_query("SELECT * FROM tbprodutos_categorias");
            	while ($category = mysql_fetch_assoc($query)) {
            ?>
	      	<li>
	      		<a href="produtos.php?catid=<?=$category['id_categoria']?>">
	      			<span><?=utf8_encode($category['categoria'])?></span>
	      		</a>
	      	</li>
          <?php } ?>
          </ul>
        </li>
        <li>
          <a href='promocoes.php'>
            <span>Promoções</span>
          </a>
        </li>
        <li class='last'>
          <a href='contato.php'>
            <span>Contato</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
  <!-- FIM - cssmenu desktop ==================================================-->

  <!-- NAVBAR ================================================== -->
  <div class="navbar-wrapper hidden-lg hidden-md visible-sm visible-xs">
    <header class="navbar navbar-inverse navbar-fix-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
           <div class="input-group col-md-11 col-sm-11 col-xs-9" style="padding: 8px;">
                <!-- /input-group -->
                <input type="text" class="form-control" Placeholder="Pesquisar" id="search-input">
                <span class="input-group-btn">
                  <button class="btn btn-default" type="button" id="btn-search2">
                    <span class="glyphicon glyphicon-search"></span>
                  </button>
                </span>
              </div>
              <!-- /input-group -->
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li>
              <a href="index.php">
                <span>Home</span>
              </a>
            </li>
            <li>
              <a href="sobre.php">
                <span>Quem somos</span>
              </a>
            </li>
          <li class="dropdown">
            <a  class"dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);">
              Produtos
              <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <?php
                  $query = mysql_query("SELECT * FROM tbprodutos_categorias");
                  while ($category = mysql_fetch_assoc($query)) {
                ?>
                <li>
                  <a href="produtos.php?catid=<?=$category['id_categoria']?>">
                    <span><?=utf8_encode($category['categoria'])?></span>
                  </a>
                </li>
                <?php } ?>
              </ul>
          </li>
          <li>
            <a href="promocoes.php">
              <span>Promoções</span>
            </a>
          </li>
          <li>
            <a href="contato.php">
              <span>Contato</span>
            </a>
          </li>
          </ul>
        </div>
      </div>
    </header>
  </div>

  <!-- logo AP -->
  <div class="aplogo-lg visible-lg hidden-md hidden-sm hidden-xs" >
    <a href="index.php"><img src="./img/logo.png"  class=""  alt="..."/></a>
  </div>
  <div class="aplogo-md hidden-lg visible-md hidden-sm hidden-xs" >
    <a href="index.php"><img src="./img/logo-mini.png"  class=""  alt="..."/></a>
  </div>
  <div class="aplogo-sm hidden-lg hidden-md visible-sm hidden-xs" >
    <a href="index.php"><img src="./img/logo-micro.png"  class=""  alt="..."/></a>
  </div>
  <div class="aplogo-xs hidden-lg hidden-md hidden-sm visible-xs" >
    <a href="index.php"><img src="./img/logo-icon.png"  class=""  alt="..."/></a>
  </div>
  <!-- logo AP - fim -->

  <!-- Carousel  ================================================== -->

  <!--db conexion bannerr-->
  <!--db conexion bannerr-->

  <div id="myCarousel" class="carousel slide">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <!-- conteudo carousel -->
    <div class="carousel-inner">
     <?php
		$sqlBanner = "select * from tbpublicidade";
		$result = mysql_query($sqlBanner);
		$active = '';
		for($i = 0;$dadosBanner = mysql_fetch_array($result);$i++){
			if ($i == 0)
				$active = 'active';
			else
				$active = '';
			$link = $dadosBanner['destino'] == "" ? "" : "href='".$dadosBanner['destino']."' target='_blank'";
		?>
		<div class="item <?=$active?>">
			<a <?=$link?>>
				<img src="painel/arquivos/banner/<?=$dadosBanner['arquivo']?>" alt="<?=utf8_encode($dadosBanner['titulo'])?>" />
			</a>
		</div>
	<?php } ?>
    </div>

  <!-- /.Controls -->

  
  <div class="clearfix"></div>

  </div>  <!-- /.Carossel -->

  <script type="text/javascript">
    $('#myCarousel').carousel({
      interval: 5000
    });
  </script>