// -----------------------------------------------------------------------------------------------------------
// * consultaSelTodos: No "consultar", seleciona todos os checkbox
// -----------------------------------------------------------------------------------------------------------
function consultaSelTodos(selecionado) {
	for (var i=1;i<=200;i++) {
		if (document.getElementById('check'+i)) {
			document.getElementById('check'+i).checked=selecionado;
		}
	}
}



/**
 * Opens calendar window.
 *
 * @param   string      calendar.php parameters
 * @param   string      form name
 * @param   string      field name
 * @param   string      edit type - date/timestamp
 */
function abrirCalendario(params, form, field, type) {
	window.open("../includes/calendario.php?" + params, "calendar", "width=300,height=230,status=yes");
	dateField = eval("document." + form + "." + field);
	dateType = type;
}







function open_newwin( mypage, myname, w ,h , settings )
{
	// usage:
	// newwin = open_newwin( "index.phtml", "emailAll", 200, 100, "scrollbars=no,menubar=no,resizable=0,location=no" ) ;
	// <script language="JavaScript" src="<? echo $BASE_URL ?>/js/newwin.js"></script>

	LeftPosition = (screen.width) ? (screen.width-w)/2 : 0 ;
	TopPosition = (screen.height) ? (screen.height-h)/2 : 0 ;
	new_settings = 'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+','+settings ;
	win = window.open( mypage, myname, new_settings ) ;
	return win ;
}

