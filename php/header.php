		<?php

		$header = new Headers;
		$formatName = @$header->_getHeader('formatName');

		if (!file_exists($formatName)) {
			$hContent = @$header->_getHeader('title');
			if (!isset($hContent))
				$header->_setHeader('title','101FM Jaboticabal - Jornal');
			
			$header->_setHeader('description','Jornal 101FM de Jaboticabal. Confira as principais notícias de Jaboticabal referentes à Política, Editoriais, Resumos Semanais, Videos...');
			$header->_setHeader('keywords','101FM, Jaboticabal, Jornal, 101FM Jaboticabal - Jornal, Vereador, Editoriais, Videos, Especial, Resumo da Semana');
			$header->_setHeader('author','Maná WEB');
			
				
			$headers = '
				<meta charset="UTF-8">
				<meta name="description" content="'.$header->_getHeader('description').'">
				<meta name="keywords" content="'.$header->_getHeader('keywords').'">
				<meta name="author" content="'.$header->_getHeader('author').'">
				<meta name="robots" content="all">
				<title>'.$header->_getHeader('title').'</title>
				<link rel="stylesheet" href="'.CSS_DIRECTORY.'cores.css" media="all">
				<link rel="stylesheet" href="'.CSS_DIRECTORY.'fonts.css" media="all">
				<link rel="stylesheet" href="'.CSS_DIRECTORY.'101fm.css" media="screen,print">
				<link rel="stylesheet" href="'.CSS_DIRECTORY.'noticias.css" media="screen,print">
				<link rel="stylesheet" href="'.CSS_DIRECTORY.'container.css" media="screen,print">';

			@file_put_contents($formatName, $headers);
			echo $headers;
		}else echo file_get_contents($formatName);