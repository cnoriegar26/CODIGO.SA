<html >
<head>
<?php include("head.php"); ?>
</head>
<body>
<section>
	<?php include("navegador1.php"); ?>
</section>
<section class="container-fluid" style="height: 100%">
<div class="row">
	<?php include("navegador2.php"); ?>
		
<div class="col-md-11 cuerpo ">
		<!--emcabezado del cuerpo-->
		
	<div class="col-md-12" style="padding-top: 5px">
		
		<!--encabezado tab-panel-->
		<div class="row">
		<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="margin-top: 5px">
			<li class="nav-item">
				<a class=" nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Registro</a>
		  	</li>	
		</ul>
		
		</div>
		
		<div class="row">
		<div class="col-md-12 tab-content contenido_cuerpo" id="pills-tabContent">
	  		
	  		<!--registrar factura-->
	  		<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
		  	
		  	<div class="row titulo_tab_control">
				<div class="col-md-12" >
					Registrar factura
				</div>
			</div>
			
			<div class="row" style="padding-top: 15px">
				
				<div class="col-md-1"></div>
				<div class="col-md-10" align="right"><h6 id="factura_n">Factura N° 0001</h6></div>
				<div class="col-md-1"></div>
				
				<div class="col-md-1"></div>				
				<div class="col-md-10" style=" padding: 10px; border: 1px solid rgba(177,170,170,0.3)">
					<div class="row">
					<input type="hidden" id="documenton_cliente" value="">
						<div class="col-md-3" align="center" id="nombre_clien">victor julio ossa puello</div>
						<div class="col-md-2" align="center" id="documento_clien">1065895559</div>
						<div class="col-md-2" align="center" id="direccion_clien">carrera N 9-04</div>
						<div class="col-md-2" align="center" id="telefono_clien">3155331460</div>
						<div class="col-md-3" align="center" id="correo_clien">victorjulio-1993-@hotmail.com</div>
					</div>
				</div>
				<div class="col-md-1"></div>
				
				<div class="col-md-1"></div>
	
				<div class="col-md-10 cuadro_prod_fact" >
					<div class="row">
						<div class="col-md-4" align="right">
						<h6 style=" padding-top: 8px">Búsqueda</h6>
						</div>

						<div class="col-md-5">
							<div class="input-group mb-3">
								<input type="text" class="form-control buscador" placeholder="Código o nombre del producto" aria-label="Recipient's username" aria-describedby="basic-addon2" id="busqueda" oninput="consultar_stock(1)">
								<div class="input-group-append">
								<button class="input-group-text buscador"><span class="fa fa-search"></span></button>
							  </div>
							</div>
						</div>
					</div>
					<div id="alerta_m"></div>
					<div class="row">
						<div class="col-md-12">
					<div class="table-responsive table-hover" style="max-height:250px" id="prod">
						<table class="table">
						  <thead>
							<tr>
							  <th style="width: 25%" scope="col">Código</th>
							  <th style="width: 25%" scope="col">Nombre</th>
							  <th style="width: 25%; text-align: center" scope="col">Cantidad</th>
							  <th style="width: 25%; text-align: center" scope="col">Agregar</th>
							</tr>
						  </thead>
						  <tbody>
							<tr>
							  <th scope="row">004</th>
							  <td>hierba buena </td>
							  <td align="center">
							  	<input type="number" value="1" min="1" max="76"  id="cantidad" name="cantidad">
							  </td>
							  <td align="center">
							  		<buttom title="Agregar a la factura" class="btn boton_titulo" >Agregar</buttom>
							  </td>
							</tr>
														
						  </tbody>
						</table>
					</div>
						</div>
					</div>
				</div>
				<div class="col-md-1"></div>
				
				<div class="col-md-12" >
				<div id="alertas"></div>
					<div class="table-responsive table-hover" >
						<table class="table" style="padding: 0">
						  <thead>
							<tr>
							  <th style="width: 10%" scope="col">Cantidad</th>
							  <th style="width: 40%" scope="col">Detalle</th>
							  <th style="width: 25%; text-align: center" scope="col">Valor unitario</th>
							  <th style="width: 25%; text-align: center" scope="col">Valor total</th>
							  <th style="width: 25%; text-align: center" scope="col">Eliminar</th>
							</tr>
						  </thead>
						  <tbody id="table_facture">
							
							</tbody>
							<tr>
							  <td></td>
							  <td></td>
							  <th style="text-align: center" >Subtotal</th>
							  <td align="center" id="sub_total">0</td>
							  <td></td>
							</tr>
							<tr>
							  <td></td>
							  <td></td>
							  <th style="text-align: center">I.V.A</th>
							  <td align="center" id="iva">0</td>
							  <td></td>
							</tr>
							<tr>
							  <td></td>
							  <td></td>
							  <th style="text-align: center">Total</th>
							  <td align="center" id="total">0</td>
							  <td></td>
							</tr>
							
						  
						</table>					
					</div>
					
					<div class="row" style="padding-bottom: 20px">
							<div class="col-md-12" align="right">
							<button type="submit" class="btn boton_form" id="terminar_fact" onClick="crear_factura()"><span class="fa fa-save fa-2x"></span><br>terminar</button>
							</div>
					</div>
					
				</div>
				
				</div>

			</div>			
		  	
		 	</div>
		 
		  	</div>
		</div>	
		
	</div>
		
</div>

</section>
</body>

<?php include("pie.php"); ?>
<script>
	
	$(document).ready(function(){
		$("#terminar_fact").attr('disabled','true');
		traer_cliente(<?php echo($_REQUEST['cliente'])?>);
		consultar_stock(1);
		traer_consecutivo();
	});
	function traer_cliente(id){
		$.ajax({
				dataType:'json',
				 url:'../../controlador/controlador_factura.php?documento='+id+'&operador=traer_clie_fact',
				 beforeSend: function(objeto){
			  	},
				success:function(data){
						
					$("#documento_clien").html(data['documento_pers']);
					$("#nombre_clien").html(data['nombre_pers']);
					$("#direccion_clien").html(data['direccion_pers']);
					$("#telefono_clien").html(data['telefono_pers']);
					$("#correo_clien").html(data['correo_pers']);
					$("#documento_cliente").html(data['documento_pers']);
					activar_terminar_fact();
				},
				error:function(respuesta){
					alert(respuesta.status);
				}
			});
	}
	
	function activar_terminar_fact(){
		var nFilas = $("#table_facture tr").length;
		
		if ($("#documento_cliente").val()!=""){
			if (nFilas>0){
				$("#terminar_fact").removeAttr('disabled');	
				$("#alertas").html("");
			}else{
				alerta("agregue un producto porfavor","f");
			}
			
		}else{
			alerta("agregue un cliente porfavor","f");
		}
	}
	function consultar_stock(page){
		var busqueda= $("#busqueda").val();
			$.ajax({
				 url:'../../controlador/controlador_factura.php?pagina='+page+'&busqueda='+busqueda+'&operador=consultar_prod',
				 beforeSend: function(objeto){
			  	},
				success:function(data){
					$("#prod").html(data).fadeIn('slow');
				}
			});
	}
	var subtotal=0;
	var array1=[];
	var array2=new Array();
	function agregar_a_factura(id){
		var cantidad = $("#cantidad_"+id).val()*1;
		var disponibilidad=$("#disponible_"+id).val()*1;
		if (cantidad > disponibilidad){
			alerta("no se puede agregar mas producto del que tiene en stock","m");
		}else{
				$.ajax({
				dataType:'json',
				 url:'../../controlador/controlador_factura.php?codigo='+id+'&cantidad='+cantidad+'&disponible='+disponibilidad+'&operador=traer_prod_fact',
				 beforeSend: function(objeto){
			  	},
				success:function(data){
				
					$("#table_facture").append(data['html']);
					var valor=data['precio_ptod_tota'];
					subtotal+= valor;
					var iva=subtotal*0.19;
					var total=subtotal-iva;
					$("#sub_total").html(total);
					$("#iva").html(iva);
					$("#total").html(subtotal);
					array1={"cantidad":data['cantidad'],"codigo":data['id'],"precio":data['precio_ptod_tota']};
					array2.push(array1);
					var dismi=disponibilidad-cantidad;
					$("#disponiblet_"+id).html(dismi);
					$("#disponible_"+id).val(dismi);
					$("#disponible_"+id).attr('max',dismi);
					activar_terminar_fact();
					
				},
					Error:function(data){
						alerta(data.status);
					}
			});
				  
			}
	}
	function alerta(msg,type){
		var alerta_fact='<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Alerta!</strong> '+msg+'.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
		if (type=="m"){
			$("#alerta_m").html(alerta_fact)
		}else{
			$("#alertas").html(alerta_fact);
		}
		
	}
	$(document).on('click', '.borrar', function (event) {
		event.preventDefault();
		
		$(this).closest('tr').remove();
		var id=$(this).attr('title');
		jQuery.each(array2,function(ind,element){
			if (element['codigo'] == id){
				
				var restablecer_cent=($("#disponible_"+id).val()*1)+(element['cantidad']*1);
				$("#disponible_"+id).val(restablecer_cent);
				$("#disponiblet_"+id).html(restablecer_cent);
				var sub =(element['precio']*1);
				subtotal=subtotal-sub;
				var iva=subtotal*0.19;
				var tat=subtotal-iva;
				$("#sub_total").html(tat);
				$("#iva").html(iva);
				$("#total").html(subtotal);
				array2.splice(ind,1);
				return false;
			}
		});
	});
	
	function abrirEnPestana(url) {
		var a = document.createElement("a");
		a.target = "_blank";
		a.href = url;
		a.click();
	}
	
	function crear_factura(){
		var date=new Date();
		var dia=date.getDate();
		var mes=date.getMonth()+1;
		var año=date.getFullYear();
		var hoy=año+'-'+mes+'-'+dia;
			$.ajax({
				url:'../../controlador/controlador_factura.php',
				data: {operador:'insertar_fact',productos:array2,cliente:$("#documento_clien").html(),subtotal:subtotal},
				type:'POST',
				success:function(respuesta){
				
				if (respuesta!='false'){
					alerta(respuesta);
					abrirEnPestana(respuesta)
					window.location.href='factura.php';
					
				}else{
					alerta('error al crear la factura comuniquese con su administrador');
				}

				},
				error:function(rsultado){
					alert(rsultado);
				}
			});

			
	}
		function traer_consecutivo(){
		$.ajax({
				 url:'../../controlador/controlador_factura.php?operador=consecutivo',
				 beforeSend: function(objeto){
			  	},
				success:function(data){
					datos=(data*1)+1;
					$("#factura_n").html('Factura N° '+datos).fadeIn('slow');
				},
				error:function(respuesta){
					alert(respuesta.status);
				}
			})
	}
	
	
	</script>

</html>