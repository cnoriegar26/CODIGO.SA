<?php
	include('conexion.php');
	include('contruct.php');


	class proveedor extends conexion{
		
		function insertar_proveedor($nit,$nombre,$telefono,$correo,$direccion,$descripcion){
			
			$construct=new construc;
			$sql="SELECT * FROM `proveedores` WHERE `nit_prov`='$nit'";
			$count=$this->cantFilas($sql);
			if ($count>0){
				$construct->alertas('!Este proveedor ya existe en nuestra base de datos!','false');
			}else{
				
				$sql="INSERT INTO `proveedores`(`nit_prov`, `nombre_prov`, `telefono_prov`, `correo_prov`, `descripcion_prov`, `direccion_prov`,`estado_prov`) value ('$nit','$nombre','$telefono','$correo','$descripcion','$direccion','1')";
				$result=$this->consulta($sql);
				if ($result){
						$construct->alertas('¡Este proveedor ha sido guardado con exito!','true');
				}else{
					$construct->alertas('¡Error con la base de datos porfavor comuniquese con el administrador!','false');	
				}
				
			}
		}
		
		function consultar_proveedores($busqueda, $pagina){
		
			$tablas='proveedores p';
			$columnasFiltro = array('p.nit_prov', 'p.nombre_prov');
			$condicion = '1 ';

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
						  	<th scope="col" style="width: 10%">Documento</th>
							<th scope="col" style="width: 20%">Nombre</th>
							<th style="width: 15%" scope="col">Dirección</th>
							<th scope="col" style="width: 10%">Teléfono</th>
							<th style="width: 15%" scope="col">Correo</th>
							<th style="width: 20%" scope="col">Descripción</th>
							<th style="width: 5%" scope="col">Editar</th>
							<th style="width: 5%" scope="col">Activar</th>

						</tr>
					</thead>
					<tbody>
						<?php 
						while ($row=$this->fetch_array($resultado)){
							$Documento=$row['nit_prov'];
							$Nombre=$row['nombre_prov'];
							$Direccion=$row['direccion_prov'];
							$Correo=$row['correo_prov'];
							$Telefono=$row['telefono_prov'];							
							$Descripcion=$row['descripcion_prov'];
							$estado=$row['estado_prov'];
							if ($estado==0){
								echo('<tr class="table-danger">');
							}else{
								echo('<tr>');
							}
						?>
								<td><?php echo $Documento ?></td>
								<td><?php echo $Nombre ?></td>								
								<td><?php echo $Direccion ?></td>
								<td><?php echo $Telefono ?></td>
								<td><?php echo $Correo ?></td>
								<td><?php echo $Descripcion ?></td>
								<td>
									<buttom title="Editar Proveedor" class="btn boton" onclick="traer_prov(<?php echo($Documento);?>)"><span class="fa fa-edit"></span></buttom>
								</td>
								<td align="center">
						  			<?php 
									if($estado==0)echo '<buttom title="Inactivo" class="btn boton" onclick="estado('.$Documento.')"><span class="fa fa-times"></span></buttom>';
									else echo '<buttom title="Activo" class="btn boton" onclick="estado('.$Documento.')"><span class="fa fa-check"></span></buttom>';
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
		
		
		function actualizar_proveedor($nit,$nombre,$telefono,$correo,$direccion,$descripcion){
			$construct=new construc;
			$sql="UPDATE `proveedores` SET `nombre_prov`='$nombre',`telefono_prov`='$telefono',`correo_prov`='$correo',`descripcion_prov`='$descripcion',`direccion_prov`='$direccion' WHERE `nit_prov`='$nit'";
			$result=$this->consulta($sql);
			
			if ($result){
				
					$construct->alertas('¡El proveedor ha sido actualizado con exito!','true');			
				
			}else{
				$construct->alertas('¡Error con la base de datos porfavor comuniquese con el administrador!','false');				
			}			
		}
		
		function traer_proveedor($nit){
			$sql=("SELECT * FROM `proveedores` WHERE `nit_prov`='$nit'");
			$respuesta=$this->consulta($sql);
			while($leer = mysqli_fetch_array($respuesta)){
				$json=array('nit'=>$leer['nit_prov'],'nombre'=>$leer['nombre_prov'],'direccion'=>$leer['direccion_prov'],'telefono'=>$leer['telefono_prov'],'correo'=>$leer['correo_prov'],'descripcion'=>$leer['descripcion_prov']);
			}
			
			echo (json_encode($json));
		}
		
			function estado_prov($id){
			$sql="SELECT `estado_prov` FROM `proveedores` WHERE `nit_prov`=$id";
			$result=$this->consulta($sql);
			$estado;
			while($leer=mysqli_fetch_array($result)){
				$estado=$leer['estado_prov'];
			}
			if ($estado==1){
				$sql="UPDATE `proveedores` SET `estado_prov`='0' WHERE `nit_prov`=$id";
			}else{
				$sql="UPDATE `proveedores` SET `estado_prov`= '1' WHERE `nit_prov` = $id ";
			}
			$result=$this->consulta($sql);
		}
		
	}
?>