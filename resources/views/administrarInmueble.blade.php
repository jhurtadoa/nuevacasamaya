@extends('layouts.master')
@section('autocomplete')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<style>
		.custom-combobox {
			position: relative;
			display: inline-block;
		}
		.custom-combobox-toggle {
			position: absolute;
			top: 0;
			bottom: 0;
			margin-left: -1px;
			padding: 0;
		}
		.custom-combobox-input {
			margin: 0;
			padding: 5px 10px;
		}
		</style>
	<script>
	(function( $ ) {
		$.widget( "custom.combobox", {
			_create: function() {
				this.wrapper = $( "<span>" )
					.addClass( "custom-combobox" )
					.insertAfter( this.element );

				this.element.hide();
				this._createAutocomplete();
				this._createShowAllButton();
			},

			_createAutocomplete: function() {
				var selected = this.element.children( ":selected" ),
					value = selected.val() ? selected.text() : "";

				this.input = $( "<input>" )
					.appendTo( this.wrapper )
					.val( value )
					.attr( "title", "" )
					.addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
					.autocomplete({
						delay: 0,
						minLength: 0,
						source: $.proxy( this, "_source" )
					})
					.tooltip({
						tooltipClass: "ui-state-highlight"
					});

				this._on( this.input, {
					autocompleteselect: function( event, ui ) {
						ui.item.option.selected = true;
						this._trigger( "select", event, {
							item: ui.item.option
						});
					},

					autocompletechange: "_removeIfInvalid"
				});
			},

			_createShowAllButton: function() {
				var input = this.input,
					wasOpen = false;

				$( "<a>" )
					.attr( "tabIndex", -1 )
					.attr( "title", "Show All Items" )
					.tooltip()
					.appendTo( this.wrapper )
					.button({
						icons: {
							primary: "ui-icon-triangle-1-s"
						},
						text: false
					})
					.removeClass( "ui-corner-all" )
					.addClass( "custom-combobox-toggle ui-corner-right" )
					.mousedown(function() {
						wasOpen = input.autocomplete( "widget" ).is( ":visible" );
					})
					.click(function() {
						input.focus();

						// Close if already visible
						if ( wasOpen ) {
							return;
						}

						// Pass empty string as value to search for, displaying all results
						input.autocomplete( "search", "" );
					});
			},

			_source: function( request, response ) {
				var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
				response( this.element.children( "option" ).map(function() {
					var text = $( this ).text();
					if ( this.value && ( !request.term || matcher.test(text) ) )
						return {
							label: text,
							value: text,
							option: this
						};
				}) );
			},

			_removeIfInvalid: function( event, ui ) {

				// Selected an item, nothing to do
				if ( ui.item ) {
					return;
				}

				// Search for a match (case-insensitive)
				var value = this.input.val(),
					valueLowerCase = value.toLowerCase(),
					valid = false;
				this.element.children( "option" ).each(function() {
					if ( $( this ).text().toLowerCase() === valueLowerCase ) {
						this.selected = valid = true;
						return false;
					}
				});

				// Found a match, nothing to do
				if ( valid ) {
					return;
				}

				// Remove invalid value
				this.input
					.val( "" )
					.attr( "title", value + " didn't match any item" )
					.tooltip( "open" );
				this.element.val( "" );
				this._delay(function() {
					this.input.tooltip( "close" ).attr( "title", "" );
				}, 2500 );
				this.input.autocomplete( "instance" ).term = "";
			},

			_destroy: function() {
				this.wrapper.remove();
				this.element.show();
			}
		});
	})( jQuery );

	$(function() {
		$( "#combobox" ).combobox();
		$( "#toggle" ).click(function() {
			$( "#combobox" ).toggle();
		});
	});
	</script>
@endsection

@section('contenido')

	<div id="camposCliente">
		<h2>Datos del Cliente</h2>
		<input type="text" class="form-control" value="{{$inmueble->rent->client->name.' '.$inmueble->rent->client->last_name}}" >
		<a href="#" class="button" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>

		<!-- Modal Cliente -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  	<div class="modal-dialog" role="document">
			    <div class="modal-content">
			      	<div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					    <h4 class="modal-title" id="myModalLabel">Datos del cliente</h4>
					</div>
			      	<div class="modal-body" id="modal-cliente">
						<div>
							<h2>Datos cliente</h2>
				      		<form action="{{ url('clientes/'.$inmueble->rent->client->id)}}" method="post">
					        	<input type="text" name="name" class="form-control" value="{{$inmueble->rent->client->name}}">
					        	<input type="text" name="last_name" class="form-control" value="{{$inmueble->rent->client->last_name}}">
					        	<input type="text" name="document" class="form-control" value="{{$inmueble->rent->client->document}}">
					        	<input type="text" name="phone" class="form-control" value="{{$inmueble->rent->client->phone}}" >
					        	<input type="email" name="email" class="form-control" value="{{$inmueble->rent->client->email}}">
					        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
					        	<input type="hidden" name="immovable_id" value="{{ $inmueble->id }}">
					        	<input type="submit" class="btn btn-default" value="Actualizar">
					        </form>
						</div>

						<div>
							<h2>Nuevo cliente</h2>
							<form action="{{ route('asignarcliente', ['id_inmueble' => $inmueble->id]) }}" method="post">
								<p>Recuerde que si cambia de cliente, se tomará como un nuevo contrato de arriendo.</p>
								
								<div class="ui-widget">
									<label for="combobox">Listado clientes registrados</label>
									<select id="combobox" name="id_cliente">
										<option value="">Selecciona uno ..</option>
										
										@foreach($clientes as $cliente)
										<option value="{{ $cliente->id }}">{{ $cliente->name.' '.$cliente->last_name }}</option>
										@endforeach
										
									</select>
									<input type="submit" class="btn btn-default" value="Asignar">
								</div>
								<input type="hidden" id="id-inmueble-admin"value="{{ $inmueble->id }}">
								<input type="hidden" name="rent_id" value="{{ $inmueble->rent->id }}">
								<input type="button" class="btn btn-default" id="bn-registrar-cliente" value="Registrar cliente nuevo">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
							</form>
						</div>

			      	
			      	</div>
			      	<hr>
			      	<div>
			      		
			      	</div>
					<div class="modal-footer">
					    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				    </div>
			    </div>
			</div>
		</div>

	</div>

	<div id="camposArriendo">
		<h2>Información de Arriendo</h2>
		
		<form action="{{url('inmuebles/arriendo')}}" method="post">
			
			<div id="form-group">
				<label for="fechainicio">Fecha Inicio Arriendo</label>
				<input type="date" class="form-control" id="fechainicio" min="2014-06-20" name="start_date" value="{{ $inmueble->rent->start_date }}" readonly/>
			</div>

			<div id="form-group">
				<label for="fechafin">Fecha Fin Arriendo</label>
				<input type="date" class="form-control" id="fechafin" min="2014-06-20" name="end_date"  value="{{ $inmueble->rent->end_date }}" readonly/>
			</div>

			<div id="form-group">
				<label for="valorarriendo">Valor Arriendo</label>
				<input type="text" name="rent_cost" class="form-control" id="valorarriendo"  value="{{ $inmueble->rent->rent_cost }}" readonly/>
			</div>
			<input type="hidden" name="immovable_id" value="{{ $inmueble->id }}">
			<input type="hidden" name="client_id" value="{{ $inmueble->rent->client->id }}">
			<input type="hidden" name="rent_id" value="{{ $inmueble->rent->id }}">

			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<input type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal-arriendo" name="cambiar_terminos" value="Cambiar terminos">
		
		</form>
		
		<form action="{{url('inmuebles/finarriendo')}}" method="post">
			<input type="hidden" name="immovable_id" value="{{ $inmueble->id }}">
			<input type="hidden" name="rent_id" value="{{ $inmueble->rent->id }}">
			<input type="submit" class="btn btn-default" name="fin_contrato" value="Finalizar contrato">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
		</form>
			
		<!-- Modal Arriendo-->
		<div class="modal fade" id="myModal-arriendo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  	<div class="modal-dialog" role="document">
			    <div class="modal-content">
			      	<div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					    <h4 class="modal-title" id="myModalLabel">Datos del cliente</h4>
					</div>
			      	<div class="modal-body" id="modal-arriendo">
						<h2>Editar Información de Arriendo</h2>
						<form action="{{url('inmuebles/updatearriendo')}}" method="post">
							<div id="form-group">
								<label for="fechainicio">Fecha Inicio Arriendo</label>
								<input type="date" class="form-control" id="fechainicio" min="2014-06-20" name="start_date" value="{{ $inmueble->rent->start_date }}"/>
							</div>

							<div id="form-group">
								<label for="fechafin">Fecha Fin Arriendo</label>
								<input type="date" class="form-control" id="fechafin" min="2014-06-20" name="end_date" value="{{ $inmueble->rent->end_date }}"/>
							</div>

							<div id="form-group">
								<label for="valorarriendo">Valor Arriendo</label>
								<input type="text" class="form-control" id="valorarriendo" name="rent_cost" value="{{ $inmueble->rent->rent_cost }}"/>
							</div>
							<input type="hidden" name="immovable_id" value="{{ $inmueble->id }}">
							<input type="hidden" name="client_id" value="{{ $inmueble->rent->client->id }}">
							<input type="hidden" name="rent_id" value="{{ $inmueble->rent->id }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">

							<input type="submit" class="btn btn-default" value="Aceptar">

						</form>
			      		
			      	</div>
					<div class="modal-footer">
					    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				    </div>
			    </div>
			</div>
		</div>

	</div>

	<div id="camposContable">
		<form method="POST" name="formulario" action="{{ route('agregartransacciones', ['id_rent' => $inmueble->rent->id]) }}">
				<h2>Información Contable</h2>

				<div id="form-group">
					<label for="tipoPago">Tipo de transacción</label>
					<select name="tipoPago" id="tipoPago" class="form-control">
						<option value="Vacio">Seleccione uno</option>
						<option value="Mensualidad">Mensualidad</option>
						<option value="Luz">Luz</option>
						<option value="Agua">Agua</option>
						<option value="Gas">Gas</option>
						<option value="GastoExtra">Gasto extra</option>
					</select>
				</div>

				<div id="form-group">
					<label for="montoPago">Monto Pagado</label>
					<input type="number" class="form-control" id="montoPago" name="montoPago" min="0"/>
				</div>

				<div id="form-group">
					<label for="fechaPago">Fecha de Pago</label>
					<input type="date" class="form-control" id="fechaPago" min="2014-06-20" name="fechaPago"/>
				</div>

				<div id="form-group">
					<label for="detallesPago">Detalles del Pago</label>
					<input type="text" class="form-control" id="detallesPago" name="detallesPago"/>
				</div>

				<input type="button" class="btn btn-default btn-sm" id="bnAgregarPago" value="Agregar"/>

				
				<div id="anadidos">
				</div>

				<input type="hidden" name="listaTipos" id="listaTipos">
				<input type="hidden" name="listaMontos" id="listaMontos">
				<input type="hidden" name="listaFechas" id="listaFechas">
				<input type="hidden" name="listaDetalles" id="listaDetalles">
			</div>

			<input type="hidden" name="rent_id" value="{{ $inmueble->rent->id }}">
			<input type="hidden" name="immovable_id" value="{{ $inmueble->id }}">
			<input type="button" class="btn btn-default" onClick="formulario.submit()" value="Registrar Transacciones">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

		</form>
@endsection