  <!-- Consulta CEP  -->

$(document).ready(function() {

    $('.maskCep').mask('99.999-999');

    $('#btnBuscarCep').click(function() {
        $.blockUI({
            message: '<h3> Consultando <img src="./img/busca.gif" />  <img src="img/ajax-loader.gif" /></h3>'
        });
        $('#panelFooter').text('');

        //Pega o conteudo do campo CEP e remove caracteres especiais
        var cep = $('#txtNumCep').val().replace(/[^\d]/g, "");

        $.ajax({
            url: "http://cep.correiocontrol.com.br/" + cep + ".json",
            type: "GET",
            dataType: "json",
            success: function(json) {
                $('#txtLogradouro').val(json.logradouro);
                $('#txtBairro').val(json.bairro);
                $('#txtCidade').val(json.localidade);
                $('#txtEstado').val(json.uf);

            },
            error: function() {
                $('#panelFooter').text('CEP não localizado!');
                 $('#txtLogradouro').val('');
                $('#txtBairro').val('');
                $('#txtCidade').val('');
                $('#txtEstado').val('');
            },
            complete: function() {
                $.unblockUI();
            }
        });

    })

    $('#btnLimparForm').click(function() {
        $('#txtNumCep').val("");
        $('#txtLogradouro').val("");
        $('#txtBairro').val("");
        $('#txtCidade').val("");
        $('#txtEstado').val("");
    })

    $('#btnGravarForm').click(function() {
        var cep = $('#txtNumCep').val();
        var logradouro = $('#txtLogradouro').val();
        var numLogradouro = $('#txtNumLogradouro').val();
        var bairro = $('#txtBairro').val();
        var cidade = $('#txtCidade').val();
        var estado = $('#txtEstado').val();

        alert(cep + "|" + logradouro + "|" + numLogradouro + "|" 
                  + bairro + "|" + cidade + "|" + estado);
    })

});
