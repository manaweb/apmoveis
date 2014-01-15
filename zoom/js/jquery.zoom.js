/*
	#zoom -> id referente a div que definirá o tamanho da imagem mínima
	#zoomhover -> id referente a div que irá exibir a imagem aumentada
*/
$(function() {
	$('#zoomhover img').hide(); // Esconde a div responsável por mostrar a imagem aumentada
});
$(window).load(function() {
	var pos = $('#zoom').offset();
	var src = $('#zoom img').attr('src'); // Pega o caminho da imagem que irá ser exibida/aumentada
	
	// Pega o comprimento e a altura da imagem dentro da div #zoom
	var width = $('#zoom img').width();
	var height = $('#zoom img').height();
	
	// Pega o coprimento e a altura da imagem original dentro da div #zoomhover
	var tamanhoW = $('#zoomhover img').width();
	var tamanhoH = $('#zoomhover img').height();
	
	// Evento responsável por retirar #zoomhover caso saia da área de #zoom
	$('#zoom').mouseout(function() {
		$('#zoomhover').removeClass('zoomHover');
	});
	
	$('#zoomhover').css('background-image','url('+src+')');
	// Evento responsável por dar o 'efeito' de zoom
	$('#zoom').mousemove(function(e) {
		var x = e.pageX-pos.left;
		var y = e.pageY-pos.top;
		var porcentoW = (x*100)/width;
		var porcentoH = (y*100)/height;
		var pxFW = Math.round((tamanhoW*porcentoW)/100);
		var pxFH = Math.round((tamanhoH*porcentoH)/100);
		var porcentoFW = Math.round((pxFW*100)/tamanhoW);
		var porcentoFH = Math.round((pxFH*100)/tamanhoH);
		
		$('#zoomhover').addClass('zoomHover');
		$('#zoomhover').css({
			'background-position': porcentoFW+'% '+porcentoFH+'%'
		});
	});
});