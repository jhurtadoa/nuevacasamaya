<header>
			<a href="/"><img id="imgLogo" title="Nueva Casa Maya" src="{{ asset('img/logo.png') }}"/></a>
			<div id="titulopagina">
				<h1>NUEVA CASA MAYA</h1>
				<h2></h2>
			</div>
	</header>
	
	<nav id="minav" class="navbar navbar-default" role="navigation">
	    <div class="navbar-header">
		    <button type="button" class="navbar-toggle" data-toggle="collapse"
		            data-target=".navbar-ex1-collapse">
		      <span class="sr-only">Desplegar navegación</span>
		      <span class="icon-bar"></span>
		      <span class="icon-bar"></span>
		      <span class="icon-bar"></span>
		    </button>
	    	<a class="navbar-brand glyphicon glyphicon-user" href="#"><i> Yasmin Moya</i></a>
		</div>
		
	  	<div class="collapse navbar-collapse navbar-ex1-collapse">
	    	<ul id="menulist" class="nav navbar-nav navbar-right">
		        <li role="presentation" class="dropdown">
				    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
				      Clientes <span class="caret"></span>
				    </a>
				    <ul class="dropdown-menu">
				    	<li><a href="{{url('clientes/nuevo')}}">Nuevo</a></li>
				    	<li role="separator" class="divider"></li>
				    	<li><a href="{{url('clientes')}}">Listar</a></li>
				    	<li role="separator" class="divider"></li>
				    	<li><a href="{{url('clientes/eliminados')}}">Eliminados</a></li>
				    </ul>
				</li>

				<li role="presentation" class="dropdown">
				    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
				      Inmuebles <span class="caret"></span>
				    </a>
				    <ul class="dropdown-menu">
				    	<li><a href="{{url('inmuebles/nuevo')}}">Nuevo</a></li>
				    	<li role="separator" class="divider"></li>
				    	<li><a href="{{url('inmuebles')}}">Listar</a></li>
				    	<li role="separator" class="divider"></li>
				    	<li><a href="{{url('inmuebles/reportes')}}">Reporte General</a></li>
				    </ul>
				</li>



	    	</ul>
	 	</div>
	</nav>