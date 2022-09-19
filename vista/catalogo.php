<html >
<head>
<?php include("head.php"); ?>
<link rel="stylesheet" href="../css/general_index.css">
</head>
<body>


<section>
	<?php include("barra.php"); ?>
</section>
<section>
	<?php include("navegador_3.php");?>
</section>

<section>
	<div class="container contenedor">
    <div class="row">
    	<div id="header" align="center" class="col-md-12" style="margin-top: 10px">
			<nav> <!-- Aqui estamos iniciando la nueva etiqueta nav -->
			  <ul>
			  	<li>
			  	<div class="alert alert-secondary" role="alert">
 					<a class="nav-link icono" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
						FILTRAR POR TIPO DE PRODUCTO <span class="fas fa-arrow-down"></span>
					  </a>
					</div>
			  		
			  	</li>
			  </ul>
			  	<div class="collapse" id="collapseExample">
				  <div class="card card-body">
					<ul class="nav" id="menu_cat">
				
					</ul>
				  </div>
				</div>
				
			</nav><!-- Aqui estamos cerrando la nueva etiqueta nav -->
		</div>
		
		<div class="col-md-12 productos" >
		<div class="row" id="catalogo" style="margin-top: 10px">
			
		</div>
		</div>
    </div>
	</div>
</section>

<div class="modal fade contenedor modal" id="exampleModal2" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title nombre_del_producto" id="exampleModalLabel"><div id="titulo">Hierba buena</div></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12" align="center" >
        <input type="hidden" id="codigo" name="codigo">
        <input type="hidden" id="valor_prod" name="valor_prod">
        
				<div class="col-md-12">
					<img class="img_seleccionada" id="imagen_prod" src="../img/productos/producto1.jpg" width="350px" height="300px">
				</div>
				<div class="col-md-12" style="padding: 0">
					<p class="descripcion_producto" id="descripcion">
						Traida de la selva del amazonas (descripcion del producto)
					</p>
				</div>
				<div class="col-md-12" style="padding: 0">
					<p class="valor" id="valor">Valor: 86,000.00</p>
				</div>
				<div class="col-md-12" style="padding: 0">
					<p class="cantidad">
						Cantidad <input type="number" min="1" id="cantidad_carrito" name="cantidad_carrito" value="1">
					</p>
				</div>
				<div class="col-md-12" style="padding: 0; margin-bottom: 20px">
					<?php 
					if (isset($_SESSION['rol'])){
						if($_SESSION['rol']==0 || $_SESSION['rol']==1){
						?>						
							<button type="button" class="boton_iniciar"  id="agregar_car">Añadir al carrito</button>  
						<?php
						}else{
						?>
							<button type="button" class="boton_iniciar" onClick="agregar_carrito()" id="agregar_car">Añadir al carrito</button> 						
							 
						<?php
						}
					}else{
						
					}
				  ?>
					
				</div>
			</div>
      </div>
      
    </div>
  </div>
</div>

<section>
	<?php include("footer.php"); ?>
</section>

</body>

<?php include("pie.php"); ?> 
<script>
	
	$(document).ready(function (){
		
		cargar_menu();
		cargar_catalogo(1);
		
	});
	
	function cargar_menu(){
			
			$.ajax({
				 url:'../controlador/controlador_catalogo.php?operador=cargar_menu',
				 beforeSend: function(objeto){
			  	},
				success:function(data){
					
					$("#menu_cat").html(data).fadeIn('slow');
					$("#menu_cat").append('<li class="titulo" ><a class="titulo_nombre" href="catalogo.php?menu=catalogo&tipo=0">Todos</a></li></li>');
				}
			});
	}
	function cargar_catalogo(page){
			
			var busqueda= $("#busqueda").val();
			
		
			var tipo=(<?php if (isset($_GET['tipo'])){echo($_GET['tipo']);}else{echo(0);} ?>);
			$.ajax({
				 url:'../controlador/controlador_catalogo.php?pagina='+page+'&busqueda='+busqueda+'&operador=cargar_catalogo'+'&tipo='+tipo,
				 beforeSend: function(objeto){
			  	},
				success:function(data){
					
					$("#catalogo").html(data).fadeIn('slow');
					
				}
			})
		}
	function traer_producto(id){
		$.ajax({
			url:'../controlador/controlador_producto.php',
			dataType: "json",
			type:"POST",
			data:{operador:'traer_prod',codigo:id},
			success:function(respuesta){
				$("#exampleModal2").modal('show');
				
				$("#codigo").val(respuesta['codigo_stoc']);
				$("#descripcion").html(respuesta['nombre_prod']+' '+respuesta['descripcion_prod']);
				$("#valor").html('valor:'+' $'+respuesta['precio_prod']);
				$("#imagen_prod").attr('src',respuesta['imagen']);
				$("#titulo").html(respuesta['nombre_prod']);
				$("#cantidad_carrito").attr('max',respuesta['cantidad_stoc']);
				$("#valor_prod").val(respuesta['precio_prod']);
				
				
			},
			error:function(rsultado){
				alert(rsultado.status);
			}
			
		});
	}
	function agregar_carrito(){
		
		<?php if(isset($_SESSION['documento'])){
			?>
				var valor= $('#valor_prod').val()*1;
				var cantidad=$('#cantidad_carrito').val()*1;
				var total=valor*cantidad;
				$.ajax({
					url:'../controlador/controlador_carrito.php',
					data:{operador:'agregar_carrito',cantidad:cantidad,valor:total,codigo:$("#codigo").val()},
					type:'POST',
					success:function(respuesta){
						if(respuesta!='false'){
							cargar_addom();
							$("#exampleModal2").modal('hide');
						}
					},
					error: function(respuesta){
						alert(respuesta.status);
					}


				});
		<?php
		}
		else{
			?>
			$("#exampleModal").modal('show');
			$("#exampleModal2").modal('hide');
		<?php
		} ?>;
		
	}

	$('#exampleModal2').on('hidden.bs.modal', function (e) {
  		$("#cantidad_carrito").val(1);
	});
	
	
	</script>

</html>