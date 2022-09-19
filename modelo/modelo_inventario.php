<?php
	
	
	include('conexion.php');
	include('contruct.php');
	
	class inventario extends conexion{
		
		function cargar_productio($busqueda){
			$sql="SELECT codigo_prod, nombre_prod FROM producto WHERE codigo_prod like '%$busqueda%' or nombre_prod like '%$busqueda%'";
			$resultado=$this->consulta($sql);
			while($leer = mysqli_fetch_array($resultado)){
				?>
					<option value="<?php echo($leer['codigo_prod']);?>"><?php echo($leer['codigo_prod']."--".$leer['nombre_prod']);?></option>
				<?php
			}
		}
		function cargar_proveedor($busqueda){
			$sql="SELECT `nit_prov`, `nombre_prov` FROM `proveedores` WHERE nit_prov like '%$busqueda%' or nombre_prov like '%$busqueda%'";
			$resultado=$this->consulta($sql);
			while($leer = mysqli_fetch_array($resultado)){
				?>
					<option value="<?php echo($leer['nit_prov']);?>"><?php echo($leer['nombre_prov']);?></option>
				<?php
			}
		}
	
	function insertar_stock($codigo_prod,$nit_prov,$fecha_venc,$cantidad){
		$sql="INSERT INTO `stock`( `codigo_prod`, `nit_prov`, `cantidad_stoc`, `fecha_venc_stoc`) VALUES ('$codigo_prod','$nit_prov','$cantidad','$fecha_venc')";
		$respuesta=$this->consulta($sql);
		$construct= new construc;	
		if ($respuesta){
				$construct->alertas('¡Este producto ha sido agregado al stock con exito!','true');				
			}else{
				$construct->alertas('¡Error con la base de datos porfavor comuniquese con el administrador!','false');					
			}
		}
		
	function consultar_productos($busqueda, $pagina){
		
			$campos = ' p.codigo_prod, p.nombre_prod, p.descripcion_prod, p.precio_prod, s.cantidad_stoc, s.fecha_venc_stoc, s.codigo_stoc, pr.nombre_prov, t.nombre_tipo, p.estado_prod ';
			$tablas='producto p, proveedores pr, stock s, tipo t';
			$columnasFiltro = array('p.codigo_prod', 'p.nombre_prod');
			$condicion = 'p.codigo_prod = s.codigo_prod and s.nit_prov = pr.nit_prov and t.codigo_tipo = p.codigo_tipo ';

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
			$tamanioPaginas = 20;
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
							  <th style="width: 15%" scope="col">Código</th>
							  <th style="width: 20%" scope="col">Nombre</th>
							  <th style="width: 15%" scope="col">Proveedor</th>
							  <th style="width: 20%" scope="col">Fecha venc.</th>
							  <th style="width: 10%" scope="col">Precio</th>
							  <th style="width: 10%; text-align: center" scope="col">Cantidad</th>
							  <th style="width: 10%; text-align: center" scope="col">Actualizar</th>
							</tr>
						  </thead>
					<tbody>
						<?php 
						while ($row=$this->fetch_array($resultado)){
							$Codigo=$row['codigo_prod'];
							$Nombre=$row['nombre_prod'];													
							$Descripcion=$row['descripcion_prod'];
							$Precio=$row['precio_prod'];
							$Cantidad=$row['cantidad_stoc'];
							$Fecha=$row['fecha_venc_stoc'];
							$Proveedor=$row['nombre_prov'];
							$Tipo=$row['nombre_tipo'];
							$Estado=$row['estado_prod'];
							if ($row['cantidad_stoc'] < 10){
								?>
								<tr class="table-danger">	
								<?php
							}else{
								if ($row['cantidad_stoc'] < 20){
										?>								
									<tr class="table-warning">
									<?php
								}else{
									?>								
								<tr>
								<?php
								}
								
							}
						?>
						
								<td><?php echo $Codigo ?></td>
								<td><?php echo $Nombre ?></td>
								<td><?php echo $Proveedor ?></td>
								<td><?php echo $Fecha ?></td>	
								<td><?php echo $Precio ?></td>
								<td><?php echo $Cantidad ?></td>
								<td >
							  		<buttom title="actualizar producto" class="btn boton_guardar" onClick="consultar_actu_stoc(<?php echo($row['codigo_stoc']) ?>)"><span class="fa fa-edit"></span></buttom>
							  
							  	</td>
							
							</tr>
						<?php 
						}

						?>
					</tbody>
				</table>
			<nav aria-label="..." align="center">
				<ul class="pagination pag justify-content-center">
				  <?php if ($totalPaginas > 1) { 
					if ($pagina != 1){ 
						 
						echo '
						<li class="page-item">
						 <a class="page-link letra_negra" href="#" onclick="cargar_tabla('.($pagina-1).')" aria-label="Previous">
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
						
						 if($pagina == $i) echo'<li class="page-item "><a class="page-link pag_active" href="#" onclick="cargar_tabla('.$i.')" >'.$i.'</a></li>';
						 else echo '<li class="page-item "><a class="page-link letra_negra" href="#" onclick="cargar_tabla('.$i.')" >'.$i.'</a></li>';
					 }
					
					if ($pagina != $totalPaginas){
						 
						echo '<li class="page-item ">
							<a class="page-link letra_negra" href="#" onclick="cargar_tabla('.($pagina+1).')" aria-label="Next">
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
		function traer_stock($codigo_stoc){
			$sql="SELECT s.codigo_stoc, s.codigo_prod, s.nit_prov, s.cantidad_stoc, s.fecha_venc_stoc, p.nombre_prod FROM stock s, producto p WHERE s.codigo_stoc='$codigo_stoc' and p.codigo_prod=s.codigo_prod" ;
			
			$respuesta=$this->consulta($sql);
			
			while($leer=mysqli_fetch_array($respuesta)){
				$json= array('codigo_stoc'=>$leer['codigo_stoc'],'cantidad_stoc'=>$leer['cantidad_stoc'],'fecha_venc_stoc'=>$leer['fecha_venc_stoc'],'nit_proveedor'=>$leer['nit_prov'],'nombre_prod'=>$leer['nombre_prod']);
			}
			echo(json_encode($json));
			
		}
		function actualizar_stoc($codigo_stoc,$fecha_venc,$cantidad){
			$construct= new construc;
			$sql="UPDATE `stock` SET `cantidad_stoc`='$cantidad',`fecha_venc_stoc`='$fecha_venc' WHERE `codigo_stoc`='$codigo_stoc'";
			$result=$this->consulta($sql);
			if ($result){
				$construct->alertas('¡Este producto ha sido actualizado con exito!','true');							
			}else{
				$construct->alertas('¡Error con la base de datos porfavor comuniquese con el administrador!','false');
			}
		}
		function busqueda($busqueda){
			
			$campos = ' p.codigo_prod, p.nombre_prod, p.descripcion_prod, p.precio_prod, s.cantidad_stoc, s.fecha_venc_stoc, s.codigo_stoc, pr.nombre_prov, t.nombre_tipo, p.estado_prod ';
			$tablas='producto p, proveedores pr, stock s, tipo t';
			$columnasFiltro = array('p.codigo_prod', 'p.nombre_prod');
			$condicion = 'p.codigo_prod = s.codigo_prod and s.nit_prov = pr.nit_prov and t.codigo_tipo = p.codigo_tipo ';

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
			$result=$this->consulta($sql);
			$construc=new construc;
			$col=array('codigo','nombre','proveedor','fecha venc','precio','cantidad');
			$datan=array('codigo_prod','nombre_prod','nombre_prov','fecha_venc_stoc','precio_prod','cantidad_stoc');
			$construc->armado_html($col,$datan,$result);	
		}
		
}
?>