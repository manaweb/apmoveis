<?php
include dirname(__FILE__)."/../phpmailer/class.phpmailer.php";
class ActionCheckout {

	public $checkOpts;

	/*
		Envia um e-mail de confirmação
		$checkOpts = array(
			'assunto' => 'Orçamentos',
			'remetente' => 'suporte@manaweb.com.br',
			'nomeRemetente' => 'Suporte Maná WEB',
			'destino' => array('White Weslie' => 'wesleyfetish@gmail.com','Dark Weslie' => 'wesley.santos@cudoce.com'),
			'corpo' => 'HTML'
		)
	*/
	public function sendConfirm($checkOpts) {
		try {
			$mail = new PHPMailer(true);
			$mail->isSMTP();
			$mail->SMTPDebug  = 2;                   
			$mail->SMTPAuth   = true;
			$mail->Host       = "localhost";      
			$mail->Port       = 587;                   
			$mail->Username   = "rf@rfcasaecia.com.br";  
			$mail->Password   = "rfcasa001";            
			$mail->From = $checkOpts['remetente'];
			$mail->Sender = $checkOpts['remetente'];
			$mail->FromName = $checkOpts['nomeRemetente'];

			foreach($checkOpts['destino'] as $name => $mails)
				$mail->AddAddress($mails,utf8_decode($name));

			$mail->IsHTML(true);
			$mail->Subject = utf8_decode($checkOpts['assunto']);
			$mail->Body = utf8_decode($checkOpts['corpo']);
			$mail->Send();
		}catch(phpmailerException $e) {
			echo $e->errorMessage();
		}catch(Exception $e) {
			echo $e->getMessage();
		}
	}

	protected function sendBCash($cartPost) {
		/*$data = NULL;
		if (is_object($cartPost)) {

			foreach($cart->cart as $cart) {
				

			}
		}else $data = $cartPost;

		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,'https://www.bcash.com.br/checkout/pay/');
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
		$response = ob_get_contents();
		echo $response;
		ob_end_clean();*/
	}
}