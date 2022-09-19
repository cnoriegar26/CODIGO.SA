<?php

	include('conexion.php');
	include('contruct.php');
	
	class producto extends conexion{
		
		function insertar_producto ($nombre, $descripcion, $precio, $cantidad, $fecha_venc, $nit_prov, $tipo, $imagen){
			
			$construct=new construc;
			
			$nombre_imge=$imagen['name'];
			$tipo_imge=$imagen['type'];
			$ruta_temp=$imagen['tmp_name'];
			$tamaño=$imagen['size'];
			$dimensiones = getimagesize($ruta_temp);
			$width = $dimensiones[0];
    		$height = $dimensiones[1];
			$carpeta="../img/productos/";
			
			if ($tipo_imge != 'image/jpg' && $tipo_imge != 'image/jpeg' && $tipo_imge != 'image/png' && $tipo_imge != 'image/gif')
			{
				$construct->alertas('!Error, el archivo no es una imagen!','false');
			}
			else if ($tamaño > 2048*2048)
			{
				$construct->alertas('!Error, el tamaño máximo permitido es un 2MB!','false');
			}
			else if ($width > 2048 || $height > 2048)
			{
				$construct->alertas('!Error la anchura y la altura maxima permitida es 2048px!','false');
			}
			else if($width < 60 || $height < 60)
			{
				$construct->alertas('!Error la anchura y la altura mínima permitida es 60px!','false');
			}
			else
			{
		
					
					$sql="INSERT INTO `producto`(`nombre_prod`, `descripcion_prod`, `precio_prod`, `codigo_tipo`,`imagen_prod`, `estado_prod`) VALUES ('$nombre','$descripcion','$precio','$tipo','".$carpeta.$nombre.$precio.".jpg"."','1')";
					$respuesta=$this->consulta($sql);
					if ($respuesta){
						$sql="select * from producto order by codigo_prod desc limit 1;";
						$res=$this->consulta($sql);
						while($leer=mysqli_fetch_array($res)){
							$codigo=$leer["codigo_prod"];
						}
						$sql="INSERT INTO `productos_proveedores`( `codigo_prod`, `nit_prov`) VALUES ('$codigo','$nit_prov')";
						$respuesta=$this->consulta($sql);

						if($respuesta){
							
							$sql="INSERT INTO `stock`(`codigo_prod`, `nit_prov`, `cantidad_stoc`, `fecha_venc_stoc`) VALUES ('$codigo','$nit_prov','$cantidad','$fecha_venc')";
							$respuesta=$this->consulta($sql);

							if ($respuesta){
								$construct->alertas('¡Este producto ha sido guardado con exito!','true');	
								$opera=true;
							}else{
								$construct->alertas('¡Error con la base de datos porfavor comuniquese con el administrador!','false');
							}
							
						}else{
							$construct->alertas('¡Error con la base de datos porfavor comuniquese con el administrador!','false');
						}
					}else{
						$construct->alertas('¡Error con la base de datos porfavor comuniquese con el administrador!','false');
					}
				
				if ($opera){
					 $src = $carpeta.$nombre.$precio.".jpg";
					move_uploaded_file($ruta_temp, $src);
				}
			}
		}
		function cargar_proveedores(){
			$sql="SELECT `nit_prov`, `nombre_prov`,estado_prov FROM `proveedores` WHERE 1";
			$resultado=$this->consulta($sql);
			while($leer = mysqli_fetch_array($resultado)){
				if($leer['estado_prov']==1){
				?>
					<option value="<?php echo($leer['nit_prov']);?>"><?php echo($leer['nombre_prov']);?></option>
				<?php
				}
			}
		}
		
		function cargar_tipo(){
			
			$sql="SELECT `codigo_tipo`, `nombre_tipo` FROM `tipo` WHERE 1";
			$resultado=$this->consulta($sql);
			while($leer = mysqli_fetch_array($resultado)){
				?>
					<option value="<?php echo($leer['codigo_tipo']);?>"><?php echo($leer['nombre_tipo']);?></option>
				<?php
			}
			
		}
		
		
		function consultar_productos2($busqueda, $pagina){
		
			
			$tablas='producto p, tipo t';
			$columnasFiltro = array('p.codigo_prod', 'p.nombre_prod');
			$condicion = ' t.codigo_tipo = p.codigo_tipo ';

			if ( $busqueda != "" )
			{
				$condicion .= "and (";
				for ( $i=0 ; $i<count($columnasFiltro) ; $i++ )
				{
					$condicion .= $columnasFiltro[$i]." LIKE '%".$busqueda."%' OR ";
				}
				$condicion = substr_replace( $condicion, "", -3 );
				$condicion .= ')';
			}
			//$condicion.=" order by nombre asc";


			$sql = "SELECT * FROM $tablas where $condicion ";

			$cantidad = $this->cantFilas($sql);
			$tamanioPaginas = 5;
			$inicio = 0;		

			if (!$pagina) {
			   $inicio = 0;
			   $pagina = 1;
			}else {
			   $inicio = ($pagina - 1) * $tamanioPaginas;
			}

			$totalPaginas = ceil($cantidad / $tamanioPaginas);

			$sql .= ' LIMIT '.$inicio.','. $tamanioPaginas;
			$resultado = $this->consulta($sql);
			?>

				<table class="table">
						  <thead>
							<tr>
							  <th style="width: 13%" scope="col">Código</th>
							  <th style="width: 15%" scope="col">Nombre</th>
							  <th style="width: 25%" scope="col">Descripción</th>
							  <th style="width: 13%" scope="col">Precio</th>
							  <th style="width: 15%" scope="col">Tipo</th>
							  <th style="width: 10%; text-align: center" scope="col">Editar</th>
							  <th style="width: 10%; text-align: center" scope="col" align="center">Activar</th>
							</tr>
						  </thead>
						  <tbody>
						<?php 
						while ($row=$this->fetch_array($resultado)){
							$Codigo=$row['codigo_prod'];
							$Nombre=$row['nombre_prod'];													
							$Descripcion=$row['descripcion_prod'];
							$Precio=$row['precio_prod'];
							$Tipo=$row['nombre_tipo'];
							$Estado=$row['estado_prod'];
							if ($Estado==0){
								echo('<tr class="table-danger">');
							}else{
								echo('<tr>');
							}
						?>
								<td><?php echo $Codigo ?></td>
								<td><?php echo $Nombre ?></td>
								<td><?php echo $Descripcion ?></td>
								<td><?php echo $Precio ?></td>
								<td><?php echo $Tipo ?></td>
								<td align="center">
									<buttom title="Editar producto" class="btn boton" onclick="traer_prod(<?php echo($Codigo)?>)"><span class="fa fa-edit"></span></buttom>
						  		</td>
								<td align="center">
						  			<?php 
									if($Estado==0)echo '<buttom title="Inactivo" class="btn boton" onclick="estado('.$Codigo.')"><span class="fa fa-times"></span></buttom>';
									else echo '<buttom title="Activo" class="btn boton" onclick="estado('.$Codigo.')"><span class="fa fa-check"></span></buttom>';
								?>
							  	</td>
							</tr>
						<?php 
						}

						?>
					</tbody>
				</table>
			<nav aria-label="..." align="center" >
				<ul class="pagination pag justify-content-center">
				  <?php if ($totalPaginas > 1) { 
					if ($pagina != 1){ 
						 
						echo '
						<li class="page-item">
						 <a class="page-link letra_negra" href="#" onclick="cargarTabla('.($pagina-1).')" aria-label="Previous">
							<span aria-hidden="true">&laquo;</span>
							<span class="sr-only">Previous</span>
						 </a>
						</li>
						';
					}else{
						echo '
						<li class="page-item disabled ">
						 <a class="page-link letra_negra" href="#" aria-label="Previous">
							<span aria-hidden="true">&laquo;</span>
							<span class="sr-only">Previous</span>
						 </a>
						</li>
						';
					}
					 
					for ($i=1;$i<=$totalPaginas;$i++) {
						
						 if($pagina == $i) echo'<li class="page-item "><a class="page-link pag_active" href="#" onclick="cargarTabla('.$i.')" >'.$i.'</a></li>';
						 else echo '<li class="page-item "><a class="page-link letra_negra" href="#" onclick="cargarTabla('.$i.')" >'.$i.'</a></li>';
					 }
					
					if ($pagina != $totalPaginas){
						 
						echo '<li class="page-item ">
							<a class="page-link letra_negra" href="#" onclick="cargarTabla('.($pagina+1).')" aria-label="Next">
								<span aria-hidden="true">&raquo;</span>
								<span class="sr-only">Next</span>
							</a>
						</li>';
					 }else{
						echo '<li class="page-item disabled">
							<a class="page-link letra_negra" href="#" aria-label="Next">
								<span aria-hidden="true">&raquo;</span>
								<span class="sr-only">Next</span>
							</a>
						</li>';
					}
				}?> 
				</ul>
			</nav>



			<?php

		}
		
		function consultar_productos_galeria( $pagina){
		
			
			$tablas='producto p, tipo t';
			$condicion = ' t.codigo_tipo = p.codigo_tipo and estado_prod = 1 ';

			


			$sql = "SELECT * FROM $tablas where $condicion ";

			$cantidad = $this->cantFilas($sql);
			$tamanioPaginas = 4;
			$inicio = 0;		

			if (!$pagina) {
			   $inicio = 0;
			   $pagina = 1;
			}else {
			   $inicio = ($pagina - 1) * $tamanioPaginas;
			}

			$totalPaginas = ceil($cantidad / $tamanioPaginas);

			$sql .= ' LIMIT '.$inicio.','. $tamanioPaginas;
			
			//echo $sql;
			
			$resultado = $this->consulta($sql);
			?>
				
				<?php if ($totalPaginas > 1) { 
					if ($pagina != 1){ 
						 
						echo '
						<div class="col-md-1 ver_anterior"><button onclick="cargarTabla('.($pagina-1).')">ver anterior<!--<span class="fa fa-caret-left"></span>--></button></div>
						';
					}else{
						
					}
					 
					
					
					if ($pagina != $totalPaginas){
						 
						echo '<div class="col-md-1 ver_mas"><button onclick="cargarTabla('.($pagina+1).')">ver siguiente<!--<span class="fa fa-caret-right"></span>--></button></div>';
					 }else{
						
					}
				}?> 
				
				
				
				<div class="container" style="height: 100%; padding: 0; " >
					<div class="row" style="height: 100%; margin: 0; padding-top: 3% ">
				
				
						<?php 
						$c=1;
						while ($row=$this->fetch_array($resultado)){
							$Codigo=$row['codigo_prod'];
							$Nombre=$row['nombre_prod'];													
							$Descripcion=$row['descripcion_prod'];
							$Precio=$row['precio_prod'];
							$Tipo=$row['nombre_tipo'];
							$Estado=$row['estado_prod'];
							$url=$row['imagen_prod'];
							if ($Estado==0){
								echo('<tr class="table-danger">');
							}else{
								echo('<tr>');
							}
							
							if($c % 2 == 0){
								?>
								<div class="col-md-3">
									<h1 class="h1_1"><?php echo $Nombre?></h1>
									<a href="catalogo.php?menu=catalogo&producto=<?php echo $Nombre ?>"><img class="img" src="<?php echo $url?>" ></a>
								</div>
								<?php
									
							}else{
						?>
							<div class="col-md-3">
								<h1 class="h1_2"><?php echo $Nombre?></h1>
								<a href="catalogo.php?menu=catalogo&producto=<?php echo $Nombre ?>"><img class="img2" src="<?php echo $url?>" ></a>
							</div>	
						<?php }
							$c++;
						}
							
						?>
					</div>	
				</div>
			



			<?php

		}
		
		function estado_prod($id){
			$sql="SELECT `estado_prod` FROM `producto` WHERE `codigo_prod`=$id";
			$result=$this->consulta($sql);
			$estado;
			while($leer=mysqli_fetch_array($result)){
				$estado=$leer['estado_prod'];
			}
			if ($estado==1){
				$sql="UPDATE `producto` SET `estado_prod`='0' WHERE `codigo_prod`=$id";
			}else{
				$sql="UPDATE `producto` SET `estado_prod`= '1' WHERE `codigo_prod` = $id ";
			}
			$result=$this->consulta($sql);
		}	
	
		function traer_producto($codigo){
			$sql="SELECT p.nit_prov, p.nombre_prov, i.codigo_prod,i.nombre_prod,i.descripcion_prod,i.precio_prod, i.imagen_prod, i.estado_prod,t.codigo_tipo, t.nombre_tipo, st.cantidad_stoc, st.fecha_venc_stoc, st.codigo_stoc, i.imagen_prod FROM proveedores p, producto i, productos_proveedores s,tipo t, stock st WHERE s.codigo_prod='$codigo' and p.nit_prov= s.nit_prov and i.codigo_prod= s.codigo_prod and t.codigo_tipo=i.codigo_tipo and st.codigo_prod=i.codigo_prod";
			
			$respuesta=$this->consulta($sql);
			
			while($leer=mysqli_fetch_array($respuesta)){
				$json= array('nit_prov'=>$leer['nit_prov'], 'nombre_prov'=>$leer['nombre_prov'], 'codigo_tipo'=>$leer['codigo_tipo'], 'nombre_tipo'=>$leer['nombre_tipo'], 'codigo_prod'=>$leer['codigo_prod'], 'nombre_prod'=>$leer['nombre_prod'], 'descripcion_prod'=>$leer['descripcion_prod'], 'precio_prod'=>$leer['precio_prod'],'imagen_prod'=>$leer['imagen_prod'],'estado_prod'=>$leer['estado_prod'],'cantidad_stoc'=>$leer['cantidad_stoc'],'fecha_venc_stoc'=>$leer['fecha_venc_stoc'],'imagen'=>$leer['imagen_prod'],'codigo_stoc'=>$leer['codigo_stoc']);
			}
			echo(json_encode($json));
		}
		
		
		function actualizar_preducto($codigo, $nombre, $descripcion, $precio, $nit_prov, $tipo,$imagen){

			$sql2="UPDATE `productos_proveedores` SET `codigo_prod`='$codigo',`nit_prov`='$nit_prov' WHERE `codigo_prod`= '$codigo'";
			//$sql3="UPDATE `stock` SET `codigo_prod`='$codigo',`nit_prov`='$nit_prov',`cantidad_stoc`='$cantidad',`fecha_venc_stoc`='$fecha_venc' WHERE `codigo_prod`= '$codigo'";
			
			if ($imagen['name']==''){
				
				$sql1="UPDATE `producto` SET `nombre_prod`='$nombre',`descripcion_prod`='$descripcion',`precio_prod`='$precio',`codigo_tipo`='$tipo'WHERE `codigo_prod`='$codigo'";
				$json=$this->consulta_actualizar($sql1,$sql2);
				
			}else{
				
				
				$nombre_imge=$imagen['name'];
				$tipo_imge=$imagen['type'];
				$ruta_temp=$imagen['tmp_name'];
				$tamaño=$imagen['size'];
				$dimensiones = getimagesize($ruta_temp);
				$width = $dimensiones[0];
				$height = $dimensiones[1];
				$carpeta="../img/productos/";

				if ($tipo_imge != 'image/jpg' && $tipo_imge != 'image/jpeg' && $tipo_imge != 'image/png' && $tipo_imge != 'image/gif')
				{
					$json = array ('alerta'=>'<div class="alert alert-danger alert-dismissible fade show"role="alert">!Error, el archivo no es una imagen!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>	 </button></div>','typo'=>'error');
				}
				else if ($tamaño > 2048*2048)
				{
				  
					$json = array ('alerta'=>'<div class="alert alert-danger alert-dismissible fade show"role="alert">!Error, el tamaño máximo permitido es un 2MB!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>	 </button></div>','typo'=>'error');
				}
				else if ($width > 2048 || $height > 2048)
				{
					
					$json = array ('alerta'=>'<div class="alert alert-danger alert-dismissible fade show"role="alert">!Error la anchura y la altura maxima permitida es 2048px!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>	 </button></div>','typo'=>'error');
				}
				else if($width < 60 || $height < 60)
				{
					
					$json = array ('alerta'=>'<div class="alert alert-danger alert-dismissible fade show"role="alert">!Error la anchura y la altura mínima permitida es 60px!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>	 </button></div>','typo'=>'error');
				}
				else
				{		
					$sql1="UPDATE `producto` SET `nombre_prod`='$nombre',`descripcion_prod`='$descripcion',`precio_prod`=$precio,`codigo_tipo`='$tipo',`imagen_prod`= '../".$carpeta.$codigo.".jpg"."',`estado_prod`='$estado' WHERE `codigo_prod`= '$codigo'";
					$json=$this->consulta_actualizar($sql1,$sql2,$sql3);
					
					if ($json['typo']=='exito'){
						$src = $carpeta.$codigo.".jpg";
						move_uploaded_file($ruta_temp, $src);
						
						}


				}
			}
			
			echo(json_encode($json));
		}
		function consulta_actualizar($sql1,$sql2){
			
					$respuesta=$this->consulta($sql1);
					if ($respuesta){
						$respuesta=$this->consulta($sql2);

						if($respuesta){
							
							
								$json = array ('alerta'=>'<div class="alert alert-success alert-dismissible fade show"role="alert">¡Este producto ha sido actualizado con exito!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>	 </button></div>','typo'=>'exito');	
						
								
						}else{
							$json = array ('alerta'=>'<div class="alert alert-danger alert-dismissible fade show"role="alert">¡Error con la base de datos porfavor comuniquese con el administrador!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>	 </button></div>','typo'=>'error');	
						}
					}else{
						$json = array ('alerta'=>'<div class="alert alert-danger alert-dismissible fade show"role="alert">¡Error con la base de datos porfavor comuniquese con el administrador!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>	 </button></div>','typo'=>'error');	
					}
			return($json);
			
		}
		
}
?>