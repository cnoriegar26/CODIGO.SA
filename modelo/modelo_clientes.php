<?php
	include("conexion.php");
	include('contruct.php');

	class cliente extends conexion{
		
	
		function insertar_cliente($documento,$nombre,$telefono,$correo,$direccion){
			$construct=new construc;
			
			$sql="SELECT * FROM persona WHERE documento_pers= '$documento'";
			$count=$this->cantFilas($sql);
			if ($count>0){
				$construct->alertas('!Este cliente ya existe en nuestra base de datos!','false');
			}else{
				
				$sql="INSERT INTO persona(documento_pers, nombre_pers, direccion_pers, telefono_pers, email_pers) VALUES ('$documento','$nombre','$direccion','$telefono','$correo')";
				$result=$this->consulta($sql);
				
				if ($result){
					$construct->alertas('¡Este cliente ha sido guardado con exito!','true');
					
				}else{
					
					$construct->alertas('¡Error con la base de datos porfavor comuniquese con el administrador!','false');
				}
				
			}
		}
		
		function consultar_cliente($busqueda, $pagina){
			$tablas='persona';
			//$columnasFiltro = array('documento_pers', 'nombre_pers');
			$condicion = " ((documento_pers like '%".$busqueda."%' or nombre_pers like '%".$busqueda."%') and (not documento_pers in (SELECT documento_pers from usuarios))) or (documento_pers like '%".$busqueda."%' or nombre_pers like '%".$busqueda."%') and (documento_pers in (SELECT documento_pers from usuarios WHERE rol_usua='2')) ";

			/*if ( $busqueda != "" )
			{
				$condicion .= "and (";
				for ( $i=0 ; $i<count($columnasFiltro) ; $i++ )
				{
					$condicion .= $columnasFiltro[$i]." LIKE '%".$busqueda."%' OR ";
				}
				$condicion = substr_replace( $condicion, "", -3 );
				$condicion .= ')';
			}*/
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
							  <th style="width: 13%" scope="col">Documento</th>
							  <th style="width: 25%" scope="col">Nombre</th>
							  <th style="width: 15%" scope="col">Dirección</th>
							  <th style="width: 15%" scope="col">Teléfono</th>
							  <th style="width: 25%" scope="col">Correo</th>
							  <th style="width: 10%" scope="col">Editar</th>
							</tr>
						  </thead>
					<tbody>
						<?php 
						while ($row=$this->fetch_array($resultado)){
							$Documento=$row['documento_pers'];
							$Nombre=$row['nombre_pers'];
							$Direccion=$row['direccion_pers'];
							$Telefono=$row['telefono_pers'];
							$Correo=$row['email_pers'];
							
							
						?>
							<tr>
								<td ><?php echo $Documento ?></td>
								<td ><?php echo $Nombre ?></td>					
								<td ><?php echo $Direccion ?></td>
								<td ><?php echo $Telefono ?></td>
								<td ><?php echo $Correo ?></td>
								
								<td align="center">
									<buttom title="Editar Usuario" class="btn boton" onclick="traer_clie(<?php echo($Documento)?>)"><span class="fa fa-edit"></span></buttom>
						  		</td>
							</tr>
						<?php 
						
						}

						?>
					</tbody>
				</table>
			<nav aria-label="..." align="center" style="margin-left: 33%">
				<ul class="pagination ">
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
						
						 if($pagina == $i) echo'<li class="page-item "><a class="page-link color_pag" href="#" onclick="cargarTabla('.$i.')" >'.$i.'</a></li>';
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
		function actualizar_cliente($documento,$nombre,$telefono,$correo,$direccion){
			$construct=new construc;
			
			$sql="UPDATE `persona` SET `nombre_pers`='$nombre',`direccion_pers`='$direccion',`telefono_pers`='$telefono',`email_pers`='$correo' WHERE `documento_pers`='$documento'";
			$result=$this->consulta($sql);
			
			if ($result){
					$construct->alertas('¡El cliente ha sido actualizado con exito!','true');
			}else{
				$construct->alertas('¡Error con la base de datos porfavor comuniquese con el administrador!','false');
			}			
		}
		function traer_cliente($documento){
			$sql="SELECT * FROM persona WHERE documento_pers='$documento'";
			$respuesta=$this->consulta($sql);
			while($leer = mysqli_fetch_array($respuesta)){
				$json=array('documento'=>$leer['documento_pers'],'nombre'=>$leer['nombre_pers'],'direccion'=>$leer['direccion_pers'],'telefono'=>$leer['telefono_pers'],'correo'=>$leer['email_pers']);
			}
			
			echo (json_encode($json));
		}
		function busqueda($busqueda){
			
			$tablas='persona';
			$columnasFiltro = array('documento_pers', 'nombre_pers');
			$condicion = ' not documento_pers in (SELECT documento_pers from usuarios) ';

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
			$col=array('documento','nombre','direccion','telefono','correo');
			$datan=array('documento_pers','nombre_pers','direccion_pers','telefono_pers','email_pers');
			$construc->armado_html($col,$datan,$result);	
		}
	}
?>