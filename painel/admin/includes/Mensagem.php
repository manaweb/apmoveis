<?

	if (!empty($_GET['msg'])) {
		echo '<div class="notification okok png_bg"><a href="#" class="close">Fechar</a>';
		$msgs = explode('|',$_GET['msg']);
		foreach ($msgs as $msg) {
			if (strlen($msg)>0) echo '<div style="color:#66CC66!important;">'.utf8_encode($msg).'</div>';
		}
		echo '</div>';
	}


	if (!empty($_GET['erro'])) {
		echo '<div class="notification errado png_bg"><a href="#" class="close">Fechar</a>';
		$erros = explode('|',$_GET['erro']);
		foreach ($erros as $erro) {
			if (strlen($erro)>0) echo '<div style="color:#CC6666!important;">'.utf8_encode($erro).'</div>';
		}
		echo '</div>';
	}


	if (!empty($_GET['info'])) {
		echo '<div class="notification information png_bg"><a href="#" class="close">Fechar</a>';
		$infos = explode('|',$_GET['info']);
		foreach ($infos as $info) {
			if (strlen($info)>0) echo '<div style="color:green#4E70D6!important;">'.utf8_encode($info).'</div>';
		}
		echo '</div>';
	}



?>