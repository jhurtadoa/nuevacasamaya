$(document).on('ready',function(){
    $('#bnAgregarPago').on('click', agregarElemento);
    $('table').tablesorter();
    $('#bn-registrar-cliente').on('click', function(){
        var id_inmueble = $('#id-inmueble-admin').val();
        window.location.pathname = 'clientes/nuevo/' + id_inmueble;
    });
    
    
});

    var contador = 0;
    var tipos = new Array();
    var montos = new Array();
    var fechas = new Array();
    var detalles = new Array();

    function agregarElemento()
    {
        var tipoPago = $('#tipoPago').val();
        var montoPago = $('#montoPago').val();
        var fechaPago = $('#fechaPago').val();
        var detallesPago = $('#detallesPago').val();

        if($.trim(tipoPago) == 0){
            alert("Debe Seleccionar un tipo de pago.");
            $("#tipoPago").focus();
            return false;
        }

        if(isNaN($.trim(montoPago))  ||  $.trim(montoPago) < 0   ||  $.trim(montoPago) == ""){
            alert("Debe ingresar un monto valido.");
            $("#montoPago").focus();
            return false;
        }

        tipos.push(tipoPago);
        montos.push(montoPago);
        fechas.push(fechaPago);
        detalles.push(detallesPago);

        agregarPago(tipoPago, montoPago, fechaPago, detallesPago);
    }

    function agregarPago(tipoP, montoP, fechaP, detallesP){
        var anadidos = $("#anadidos");
        var text = anadidos.html();
        if(contador == 0)
        { 
            anadidos.html("<label>Rublos añadidos</label><br><div class='grupoPago'><input type='text' name='tipoPanadido' value='"+tipoP+"' disabled><input type='text' name='montoPanadido' value='"+montoP+"' disabled><input type='text' name='fechaPanadido' value='"+fechaP+"' disabled><input type='text' name='detallesPanadido' value='"+detallesP+"' disabled></div>");
            contador++
        }else{
            anadidos.html( text + "<div class='grupoPago'><input type='text' name='tipoPanadido' value='"+tipoP+"' disabled><input type='text' name='montoPanadido' value='"+montoP+"' disabled><input type='text' name='fechaPanadido' value='"+fechaP+"' disabled><input type='text' name='detallesPanadido' value='"+detallesP+"' disabled></div>");
        }
        copiarListas();
    }

    function copiarListas(){
        var listaTipo = tipos.toString();
        var listaMontos = montos.toString();
        var listaFechas = fechas.toString();
        var listaDetalles = detalles.toString();
        $("#listaTipos").val(listaTipo);
        $("#listaMontos").val(listaMontos);
        $("#listaFechas").val(listaFechas);
        $("#listaDetalles").val(listaDetalles);
        
    }


/*function formCrearCliente(url){
    var contenedor = $("#modal-cliente");
    var html = "<div><h2>Crear cliente</h2><form action='hola' method='post'><input type='text' name='namec' class='form-control' pattern='[A-Za-z]'><input type='text' name='last_namec' class='form-control' pattern='[A-Za-z]'><input type='text' name='document' pattern='[0-9]' class='form-control'><input type='text' name='phone' class='form-control' pattern='[0-9]{10}'><input type='email' name='email' class='form-control'><input type='submit' class='btn btn-default' value='Crear'><input type='hidden' name='_token' value="{{ csrf_token() }}"></form></div>";
    contenedor.html(html);

}
*/


/*
$(window).scroll(function(){
	var altura = 83;
	if($(window).scrollTop() > altura) 
	{
		$('#minav').addClass('mi-navbar-fix');
	}
	else
		if( $('#minav').hasClass('mi-navbar-fix'))
		{
			$('#minav').removeClass('mi-navbar-fix');
		}
		   
});






function ajax(url, contenedor, esHtml, tipoenvio){

	$.ajax({
        url: url,
        async:true,
        beforeSend: function(objeto){
            var x;
			x=$("#"+contenedor).html("<img  src='"+hostnombre+"img/loader.gif' />")
        },
        complete: function(objeto, exito){
        
        },
        dataType: "html",
        error: function(objeto, quepaso, otroobj){
            alert("Error: "+quepaso);
        },
        global: true,
        ifModified: false,
        processData:true,
        success: function(datos){
			if(esHtml){
				$("#"+contenedor).html(datos);
			}else{
				$("#"+contenedor).val(datos);
			}

        },
        timeout: 3000,
        type: tipoenvio
	});
	

}
*/
