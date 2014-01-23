<!-- FOOTER -->
<div id="footer">
  <?php include_once("analyticstracking.php") ?>
  <div class="container footer">
      <div class="row">
        <div class="col-xs-2 col-sm-6 col-md-6 col-lg-4 pull-right">
          <ul class="list-inline pull-right">
            <li>
              <a href="index.php"><p>Home</a>
            </li>
            <li>
              <a href="produtos.php"><p>Produtos</p></a>
            </li>
            <li>
              <a href="promocoes.php"><p>Promoções</p></a>
            </li>
            <li>
              <a href="contato.php"><p>Contato</p></a>
            </li>
          </ul>
          <br>
          <br>
          <ul class="list-unstyled pull-right">
            <li>
              <a class="letrasize logo-social pull-right" href="#">
                <img class="img-responsive" src="./img/facebook-logo.png" alt="facebook">
              </a>
              <a class="letrasize logo-social pull-right" href="#">
                <img class="img-responsive" src="./img/twitter-logo.png" alt="twitter">
              </a>
            </li>
            <br>
            <br>
            <br>
            <li>  
              <a class="pull-right" href="http://www.w3.org/html/logo/">
                <img  class="img-responsive" src="http://www.w3.org/html/logo/badge/html5-badge-v-css3.png" alt="HTML5 Powered with CSS3 / Styling" title="HTML5 Powered with CSS3 / Styling">
              </a>
            </li>
            <li> 
              <a class="letrasize pull-right" href="http://www.manaweb.com.br/" target="_blank">
                <img class="img-responsive" src="./img/mana-logo.png" alt="ManáWeb + Buscapé">
              </a>
            </li>
          </ul>
        </div>

        <div class="col-xs-10 col-sm-6 col-md-6 col-lg-8 pull-left ">
          <h2>entre em contato</h2>
          <h2>ou faça-nos uma visita</h2>
          <ul class="list-inline">
            <li>
              <img src="./img/map-icon.png" alt="place"></li>
            <li>
              <a class="letrasize" href="#">
                <h4>Rua São Sebastião, 503 - CEP 14870-720 Centro - Jaboticabal - SP</h4>
              </a>
            </li>
          </ul>
          <ul class="list-inline">
            <li>
              <img src="./img/phone-icon.png" alt="telefone"/>
            </li>
            <li>
              <a class="letrasize" href="#">
                <h4>+55 (16) 3202-7022</h4>
              </a>
            </li>
          </ul>
          <ul class="list-inline">
            <li>
              <img src="./img/mail-icon.png" alt="mail"/>
            </li>
            <li>
              <a class="letrasize" href="#">
                <h4>comercial@lojaapmoveis.com.br</h4>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div> <!--/.container FOOTER-->
</div> <!--Fim-FOOTER-->

<script>
  $(function() {
    $("#btn-search2").click(function(){
            window.location = "produtos.php?search="+$("#search-input").val();
      });
  });
</script>