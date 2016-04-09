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
        listarTransacciones();
    }

    function listarTransacciones(){
        var listaAnadidos = $('#anadidos');
        listaAnadidos.html("");
        var contador = 0;
        var tamListas = tipos.length;
        for(var i = 0; i < tamListas; i++){

            if(contador == 0)
            { 
                listaAnadidos.html("<label>Rublos añadidos</label><br>");
                contador++
            }

            if(contador >= 0)
            {
                listaAnadidos.html(listaAnadidos.html() + "<div class='grupoPago'><input type='text' name='tipoPanadido' value='"+tipos[i]+"' disabled><input type='text' name='montoPanadido' value='"+montos[i]+"' disabled><input type='text' name='fechaPanadido' value='"+fechas[i]+"' disabled><input type='text' name='detallesPanadido' value='"+detalles[i]+"' disabled><span><a href='javascript:eliminarRublo("+(i)+")'>Eliminar</a></span></div>");
            }
        }
    }

    function eliminarRublo(i){
        tipos.splice(i,1);
        montos.splice(i,1);
        fechas.splice(i,1);
        detalles.splice(i,1);
        listarTransacciones();
    }

