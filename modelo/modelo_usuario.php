<?php

	include("conexion.php");
	include('contruct.php');

	class persona extends conexion{
		
		function sesion($documento, $contrasena){
			$sql="SELECT * FROM persona p, usuarios u  WHERE p.documento_pers = u.documento_pers and u.documento_pers = '$documento' and u.contrasena_usua = '$contrasena'";
			
			$result=$this->consulta($sql);
			$rowscont=$this->cantFilas($sql);
			$construct=new construc;
			if ($rowscont<1){
				$construct->alertas('Usuario o contraseña incorrectos','false');
				
			}else{
				
				while($leer=mysqli_fetch_array($result)){
					//1 trabajador, 2 cliente, 0 administrador
				if( ($leer['estado_usua']==1)){
					$_SESSION['usuario']=$leer['codigo_usua'];
					$_SESSION['rol']=$leer['rol_usua'];
					$_SESSION['nombre']=$leer['nombre_pers'];
					$_SESSION['documento']=$leer['documento_pers'];
					$construct->alertas('inicio con exito','true');
				}else{
					$construct->alertas('Este usuario no pocee una cuenta en esta pagina o esta inactivo','false');
				}
			}
			}		
		}
	
		function insertar_usuario($documento,$nombre,$telefono,$correo,$direccion,$contrasena,$rol){
			$construct=new construc;
			
			$sql="SELECT * FROM persona WHERE documento_pers= '$documento'";
			$count=$this->cantFilas($sql);
			if ($count>0){
				$sql="SELECT * FROM `usuarios` WHERE `documento_pers`='$documento'";
				$cant=$this->cantFilas($sql);
				if($cant>0){
					$construct->alertas('¡Este usuario ya existe!','false');
				}else{
					$sql="INSERT INTO `usuarios`(`contrasena_usua`, `rol_usua`, `documento_pers`, `estado_usua`) VALUES ('$contrasena','$rol','$documento','1')";
					$result=$this->consulta($sql);
					if($result){
						$sql="UPDATE `persona` SET `nombre_pers`='$nombre',`direccion_pers`='$direccion',`telefono_pers`='$telefono',`email_pers`='$correo' WHERE `documento_pers`='$documento'";
						$result=$this->consulta($sql);
						if($result){
							$construct->alertas('¡Este usuario ha sido guardado con exito!','true');
						}else{
							$construct->alertas('¡Error con la base de datos porfavor comuniquese con el administrador!','false');
						}
						
					}else{
						$construct->alertas('¡Error con la base de datos porfavor comuniquese con el administrador!','false');
					}
				}
				
			}else{
				
				$sql="INSERT INTO persona(documento_pers, nombre_pers, direccion_pers, telefono_pers, email_pers) VALUES ('$documento','$nombre','$direccion','$telefono','$correo')";
				$result=$this->consulta($sql);
				if ($result){
					$sql="INSERT INTO usuarios(contrasena_usua, rol_usua, documento_pers, estado_usua) VALUES ('$contrasena','$rol','$documento',1)";
					$result=$this->consulta($sql);
					if ($result){
						$construct->alertas('¡Este usuario ha sido guardado con exito!','true');
					}else{
						$construct->alertas('¡Error con la base de datos porfavor comuniquese con el administrador!','false');
					}
				}else{
					
					$construct->alertas('¡Error con la base de datos porfavor comuniquese con el administrador!','false');
				}
				
			}
		}
		
	
		function consultar_usuario($busqueda, $pagina){
		
			$tablas='persona p, usuarios u';
			$columnasFiltro = array('p.documento_pers', 'p.nombre_pers');
			$condicion = 'u.documento_pers = p.documento_pers and (u.rol_usua = 0 or u.rol_usua = 1)';

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

				<table class="table" style="padding-top: 15px">
					<thead>
						<tr>
						  <th style="width: 13%" scope="col">Documento</th>
							  <th style="width: 20%" scope="col">Nombre</th>
							  <th style="width: 13%" scope="col">Dirección</th>
							  <th style="width: 13%" scope="col">Teléfono</th>
							  <th style="width: 25%" scope="col">Correo</th>
							  <th style="width: 10%" scope="col">Rol</th>
							  <th style="width: 5%" scope="col">Editar</th>
							  <th style="width: 5%" scope="col">Activar</th>

						</tr>
					</thead>
					<tbody>
						<?php 
						while ($row=$this->fetch_array($resultado)){
							$Documento=$row['documento_pers'];
							$Nombre=$row['nombre_pers'];
							$Direccion=$row['direccion_pers'];
							$Correo=$row['email_pers'];
							$Telefono=$row['telefono_pers'];
							$Estado=$row['estado_usua'];							
							$Rol=$row['rol_usua'];
							if ($Estado==0){
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
								<td>
								<?php 
									if($Rol==0)echo 'Admin';
									else echo 'Empleado';
								?>
								</td>
								<td align="center">
									<buttom title="Editar Usuario" class="btn boton" onclick="traer_usua(<?php echo($Documento)?>)"><span class="fa fa-edit"></span></buttom>
						  		</td>
								<td align="center">
						  			<?php 
									if($Estado==0)echo '<buttom title="Inactivo" class="btn boton" onclick="estado('.$Documento.')"><span class="fa fa-times"></span></buttom>';
									else echo '<buttom title="Activo" class="btn boton" onclick="estado('.$Documento.')"><span class="fa fa-check"></span></buttom>';
								?>
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
		
		function actualizar_usuario($documento,$nombre,$telefono,$correo,$direccion,$contrasena,$rol){
			$conexion=new conexion;
			$sql="UPDATE `persona` SET `nombre_pers`='$nombre',`direccion_pers`='$direccion',`telefono_pers`='$telefono',`email_pers`='$correo' WHERE `documento_pers`='$documento'";
			$contruct= new construc;
			$result=$conexion->consulta($sql);
			if ($result){
				$sql="UPDATE `usuarios` SET `contrasena_usua`='$contrasena',`rol_usua`='$rol' WHERE `documento_pers`='$documento'";
				$result=$conexion->consulta($sql);
				if($result){
					
					$contruct->alertas('¡Este usuario ha sido actualizado con exito!','true');
					
				}else{
					
					$contruct->alertas('¡Error con la base de datos porfavor comuniquese con el administrador!','false');
									
				}
			}else{
				
				$contruct->alertas('¡Error con la base de datos porfavor comuniquese con el administrador!','false');
				
			}
			
		}
		
		function traer_usua($documento){
			$sql="SELECT * FROM persona p,usuarios u WHERE p.documento_pers='$documento' and u.documento_pers = p.documento_pers";
			$respuesta=$this->consulta($sql);
			while($leer = mysqli_fetch_array($respuesta)){
				$json=array('documento'=>$leer['documento_pers'],'nombre'=>$leer['nombre_pers'],'direccion'=>$leer['direccion_pers'],'telefono'=>$leer['telefono_pers'],'correo'=>$leer['email_pers'],'estado'=>$leer['estado_usua'],'contrasena'=>$leer['contrasena_usua'],'rol'=>$leer['rol_usua']);
			}
			
			echo (json_encode($json));
		}
		
		function estado_usua($id){
			$sql="SELECT `estado_usua` FROM `usuarios` WHERE `documento_pers`=$id";
			$result=$this->consulta($sql);
			$estado;
			while($leer=mysqli_fetch_array($result)){
				$estado=$leer['estado_usua'];
			}
			if ($estado==1){
				$sql="UPDATE `usuarios` SET `estado_usua`='0' WHERE `documento_pers`=$id";
			}else{
				$sql="UPDATE `usuarios` SET `estado_usua`= '1' WHERE `documento_pers` = $id ";
			}
			$result=$this->consulta($sql);
		}
			
	}

?>
		