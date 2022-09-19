<?php
	include("conexion.php");
	include('contruct.php');

	class compra extends conexion{
		
		function insertar_compra ($codigo, $proveedor, $valor, $fecha, $imagen){
			
			$construct=new construc;
			
			$nombre_imge=$imagen['name'];
			$tipo_imge=$imagen['type'];
			$ruta_temp=$imagen['tmp_name'];
			$tamaño=$imagen['size'];
			$dimensiones = getimagesize($ruta_temp);
			$width = $dimensiones[0];
    		$height = $dimensiones[1];
			$carpeta="../img/factura_comp/";
			
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
		
				$sql="SELECT * FROM `compras` WHERE `codigo_comp`='$codigo'";
				$respuesta=$this->cantFilas($sql);
				$opera=false;
				if($respuesta>0){
					$construct->alertas('!Esta factura ya existe en nuestra base de datos!','false');
				}else{
					$sql="INSERT INTO `compras`(`codigo_comp`, `nit_prov`,`valor_comp`,`fecha_comp`, `url_comp`,`codigo_usua`) VALUES ('$codigo','$proveedor','$valor','$fecha','../".$carpeta.$codigo.".jpg"."','1')";
					$respuesta=$this->consulta($sql);
					if ($respuesta){
						$construct->alertas('¡la compra ha sido guardado con exito!','true');	
						$opera=true;
					}else{
						$construct->alertas('¡Error con la base de datos porfavor comuniquese con el administrador!','false');
					}
				}
				if ($opera){
					 $src = $carpeta.$codigo.".jpg";
					move_uploaded_file($ruta_temp, $src);
				}
			}
		}
		
		function consultar_compra($busqueda, $pagina){
		
			
			$tablas='compras c, proveedores p';
			$columnasFiltro = array('c.codigo_comp','c.fecha_comp');
			$condicion = ' p.nit_prov = c.nit_prov ';

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
							  <th style="width: 20%" scope="col">Código factura</th>
							  <th style="width: 20%" scope="col">Proveedor</th>
							  <th style="width: 20%" scope="col">Valor</th>
							  <th style="width: 20%" scope="col">Fecha</th>
							  <th style="width: 20%" scope="col">Factura</th>
							</tr>
						  </thead>
						  <tbody>
						<?php 
						while ($row=$this->fetch_array($resultado)){
							$Codigo=$row['codigo_comp'];
							$proveedor=$row['nombre_prov'];													
							$valor=$row['valor_comp'];
							$fecha=$row['fecha_comp'];
							$url=$row['url_comp'];
						?>
							<tr>
								<td><?php echo $Codigo ?></td>
								<td><?php echo $proveedor ?></td>
								<td><?php echo $valor ?></td>
								<td><?php echo $fecha ?></td>
								 <td>
							  	<a id="example8" href="<?php echo $url ?>"><img alt="example8" height="30px" width="30px" src="<?php echo $url ?>" /></a>
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
		
		function busqueda($busqueda){
			
			$tablas='compras c, proveedores p';
			$columnasFiltro = array('c.codigo_comp','c.fecha_comp');
			$condicion = ' p.nit_prov = c.nit_prov ';

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
			$col=array('codigo_factura','proveedor','valor','fecha',);
			$datan=array('codigo_comp','nombre_prov','valor_comp','fecha_comp');
			$construc->armado_html($col,$datan,$result);	
		}
		function generar_pdf($html){
			$construct=new construc;
			$construct->crear_pdf($html);
		}
		
	}
?>