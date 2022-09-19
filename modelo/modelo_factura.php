<?php
	include('conexion.php');
	include('contruct.php');

	class factura extends conexion{
	
		
		
		function listclinte($busqueda, $pagina){
			$tablas='persona';
			//$columnasFiltro = array('documento_pers', 'nombre_pers');
			$condicion = "((documento_pers like '%".$busqueda."%' or nombre_pers like '%".$busqueda."%') and (not documento_pers in (SELECT documento_pers from usuarios))) or (documento_pers like '%".$busqueda."%' or nombre_pers like '%".$busqueda."%') and (documento_pers in (SELECT documento_pers from usuarios WHERE rol_usua='2')) ";

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

				<table class="table" style="">
					<thead >
						<tr>
						  <th scope="col" style="width: 17%;">Documento</th>
						  <th scope="col" style="width: 17%;">Nombre</th>
						  <th scope="col" style="width: 17%;">Dirección</th>
						  <th scope="col" style="width: 17%;">Teléfono</th>
						  <th scope="col" style="width: 17%;">Correo</th>
						  <th scope="col" style="width: 10%;">Acción</th>

						</tr>
					</thead>
					<tbody>
						<?php 
						while ($row=mysqli_fetch_array($resultado)){
							$Documento=$row['documento_pers'];
							$Nombre=$row['nombre_pers'];
							$Direccion=$row['direccion_pers'];
							$Correo=$row['email_pers'];
							$Telefono=$row['telefono_pers'];	
						?>
							<tr>
								<td ><?php echo $Documento ?></td>
								<td ><?php echo $Nombre ?></td>					
								<td ><?php echo $Direccion ?></td>
								<td ><?php echo $Telefono ?></td>
								<td ><?php echo $Correo ?></td>
								<td align="center">
									<a type="buttom" class="btn boton_titulo" href="crear_factura.php?cliente=<?php echo $Documento ?>">Facturar</a>
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
						 <a class="page-link letra_negra" href="#" onclick="cargar_tabla_clie('.($pagina-1).')" aria-label="Previous">
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
						
						 if($pagina == $i) echo'<li class="page-item "><a class="page-link color_pag" href="#" onclick="cargar_tabla_clie('.$i.')" >'.$i.'</a></li>';
						 else echo '<li class="page-item "><a class="page-link letra_negra" href="#" onclick="cargar_tabla_clie('.$i.')" >'.$i.'</a></li>';
					 }
					
					if ($pagina != $totalPaginas){
						 
						echo '<li class="page-item ">
							<a class="page-link letra_negra" href="#" onclick="cargar_tabla_clie('.($pagina+1).')" aria-label="Next">
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
	
	function consultar_stock($busqueda, $pagina){
		$campos = ' p.codigo_prod, p.nombre_prod, p.descripcion_prod, p.precio_prod, s.cantidad_stoc, s.codigo_stoc, s.fecha_venc_stoc, pr.nombre_prov, t.nombre_tipo, p.estado_prod ';
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


			$sql = "SELECT * FROM $tablas where $condicion ORDER BY s.fecha_venc_stoc ASC";

			$cantidad = $this->cantFilas($sql);
			$tamanioPaginas = 10;
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

				<table class="table" style="">
					<thead>
						<tr>
						 <!-- <th scope="col ">Codigo</th>-->
						  <th scope="col ">Nombre</th>
						  <!--<th scope="col ">Proveedor</th>-->
						  <th scope="col ">Fecha ven</th>
						  <th scope="col ">Precio</th>
						  <th scope="col ">Cantidad disponible</th>
						  <th scope="col ">Cantidad a vender</th>
						  <th scope="col " style="text-align: center">Acción</th>
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
							$codigo_stock=$row['codigo_stoc'];
							
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
								<?php /*?><td scope="row"><?php echo $Codigo ?></td><?php */?>
								<td scope="row"><?php echo $Nombre ?></td>
								<?php /*?><td scope="row"><?php echo $Proveedor ?></td><?php */?>
								<td scope="row"><?php echo $Fecha ?></td>	
								<td scope="row"><?php echo $Precio ?></td>
								
								<td><div id="disponiblet_<?php echo $codigo_stock ?>"><?php echo $Cantidad ?></div><input type="hidden" id="disponible_<?php echo $codigo_stock ?>" name="disponible_<?php echo $codigo_stock ?>" value="<?php echo $Cantidad ?>"></td>
								
					  			<td >
						  			<input type="number" value="1" min="1" max="<?php echo $Cantidad ?>" class="form-control" id="cantidad_<?php echo $codigo_stock ?>" name="cantidad_<?php echo $codigo_stock ?>">
							  	</td>
							  	<td align="center">
							  		<buttom title="Agregar a la factura" class="btn boton_titulo" id="btn_agregar_producto" onClick="agregar_a_factura(<?php echo $codigo_stock ?>)">Agregar</buttom>
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
						 <a class="page-link letra_negra" href="#" onclick="consultar_stock('.($pagina-1).')" aria-label="Previous">
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
						
						 if($pagina == $i) echo'<li class="page-item "><a class="page-link pag_active" href="#" onclick="consultar_stock('.$i.')" >'.$i.'</a></li>';
						 else echo '<li class="page-item "><a class="page-link letra_negra" href="#" onclick="consultar_stock('.$i.')" >'.$i.'</a></li>';
					 }
					
					if ($pagina != $totalPaginas){
						 
						echo '<li class="page-item ">
							<a class="page-link letra_negra" href="#" onclick="consultar_stock('.($pagina+1).')" aria-label="Next">
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
		
		function descontar($factura){
			$sql=("SELECT * FROM detalle_factura WHERE codigo_fact= '$factura'");
			
			$res=$this->consulta($sql);
			if($res){
				while($leer = mysqli_fetch_array($res)){
					$codigo_st=$leer['codigo_stoc'];
					$cantidad=$leer['cantidad_deta'];
					$sql="UPDATE stock SET stock.cantidad_stoc= stock.cantidad_stoc - $cantidad WHERE stock.codigo_stoc=$codigo_st";
					$result=$this->consulta($sql);
				}	
			}
			
		}
		function devolver($factura){
			$sql=("SELECT * FROM detalle_factura WHERE codigo_fact= '$factura'");
			$res=$this->consulta($sql);
			if($res){
			while($leer=mysqli_fetch_array($res)){
				$codigo_st=$leer['codigo_stoc'];
				$cantidad=$leer['cantidad_deta'];
				$sql="UPDATE stock SET stock.cantidad_stoc= stock.cantidad_stoc + $cantidad WHERE stock.codigo_stoc=$codigo_st";
				$result=$this->consulta($sql);
			}
			}
		}
		
		function actualizar_estado($factura, $estado_pay, $fecha){
			
			$sql="SELECT * FROM `facturas` WHERE `codigo_fact`='$factura'";
			$result=$this->consulta($sql);
			$estado="";
			if($result){
				while($leer=mysqli_fetch_array($result)){
					$estado=$leer['estado_fact'];
				}
				if ($estado_pay==2 && $estado==1){
					
					$this->descontar($factura);
					
					//$sql="UPDATE facturas SET estado_fact = $estado_pay, fecha_hora_fact= '$fecha' WHERE codigo_fact = $factura";
					//$result=$this->consulta($sql);
					
				}
				if ($estado_pay==3 && $estado==2){
					//$sql="UPDATE facturas SET estado_fact = $estado_pay, fecha_hora_fact= '$fecha' WHERE codigo_fact = $factura";
					//$result=$this->consulta($sql);
				}
				if ($estado_pay==4 && $estado==2){
					$this->devolver($factura);
					//$sql="UPDATE facturas SET estado_fact = $estado_pay, fecha_hora_fact= '$fecha' WHERE codigo_fact = $factura";
					//$result=$this->consulta($sql);
				}
				if ($estado_pay==5 && $estado==2){
					$this->devolver($factura);
					//$sql="UPDATE facturas SET estado_fact = $estado_pay, fecha_hora_fact= '$fecha' WHERE codigo_fact = $factura";
					//$result=$this->consulta($sql);
				}
				if ($estado_pay==3 && $estado==1){
					$this->descontar($factura);
					//$sql="UPDATE facturas SET estado_fact = $estado_pay, fecha_hora_fact= '$fecha' WHERE codigo_fact = $factura";
					//$result=$this->consulta($sql);
				}
				$sql="UPDATE facturas SET estado_fact = $estado_pay, fecha_hora_fact= '$fecha' WHERE codigo_fact = $factura";
				$result=$this->consulta($sql);
			}				
		}
		
		function estado_factura($factura){
			
			$productos=array();
			$consecutivo=$this->traer_consecutivo()+1;
			$sql="UPDATE facturas SET estado_fact = '0', numero_fact='$consecutivo', url_fact='../../facturas/$consecutivo.pdf' WHERE codigo_fact = $factura";
			$result=$this->consulta($sql);
			if($result){
				$sql="UPDATE `configuracion` SET `consecutivo_actu_conf`='$consecutivo' WHERE `codigo_conf`='0'";
				$result=$this->consulta($sql);
				$sql="SELECT * FROM `detalle_factura` WHERE `codigo_fact`=$factura";
				$result=$this->consulta($sql);
				$result2=$this->cantFilas($sql);
				if($result2>0){
					while($leer=mysqli_fetch_array($result)){
						array_push($productos,array('precio'=>$leer['precio_deta'],'cantidad'=>$leer['cantidad_deta'],'codigo'=>$leer['codigo_stoc']));
						//$productos=array('precio'=>$leer['precio_deta'],'cantidad'=>$leer['cantidad_deta'],'codigo'=>$leer['codigo_stoc']);
					}
				}
				$sql="SELECT `codigo_fact`, `total_fact`,`documento_pers` FROM `facturas` WHERE `codigo_fact`=$factura";
				$result=$this->consulta($sql);
				$result2=$this->cantFilas($sql);
				if($result2>0){
					while($leer=mysqli_fetch_array($result)){
						$subtotal=$leer['total_fact'];
						$documento_clie=$leer['documento_pers'];
					}
				}
				$this->crear_pdf_fact($productos,$subtotal,$documento_clie);
				
				
			}
						
		}
		
		function traer_producto_fact($id,$cantidad,$disponible){
			
			$sql="SELECT p.descripcion_prod, p.codigo_prod ,p.precio_prod, s.codigo_stoc FROM producto p, stock s WHERE s.codigo_stoc='$id' and p.codigo_prod=s.codigo_prod";
			$result=$this->consulta($sql);
			while($leer=mysqli_fetch_array($result)){
				$precio=$leer['precio_prod']*$cantidad;
				$json=array('precio_unid'=>$leer['precio_prod'],'id'=>$id,'cantidad'=>$cantidad,'precio_ptod_tota'=>$precio,'html'=>'
					<tr>
					<td>'.$cantidad.'</td>
					<td>'.$leer['descripcion_prod'].'</td>
					<td align="center">'.$leer['precio_prod'].'</td>
					<td align="center">'.$leer['precio_prod']*$cantidad.'</td>
					<td align="center"><buttom title="'.$leer['codigo_stoc'].'" class="borrar btn boton" value="Eliminar"><span class="fa fa-times"></span></buttom></td>
				</tr>
				');
				
				}
			echo(json_encode($json));
			
		}
		
		
		function traer_clie_factura($id){
			$sql="SELECT `documento_pers`, `nombre_pers`, `direccion_pers`, `telefono_pers`, `email_pers` FROM `persona` WHERE `documento_pers`='$id'";
			$resultado= $this->consulta($sql);
			while($leer=mysqli_fetch_array($resultado)){
				
				$json=array("documento_pers"=>$leer['documento_pers'], "nombre_pers"=>$leer['nombre_pers'], "direccion_pers"=>$leer['direccion_pers'], "telefono_pers"=>$leer['telefono_pers'], "correo_pers"=>$leer["email_pers"]);
				
			}
			echo(json_encode($json));
		}
	
		
		function traer_consecutivo(){
			
			$sql="SELECT `consecutivo_actu_conf` FROM `configuracion` WHERE `codigo_conf`='0'";

			$respuesta=$this->consulta($sql);
			$consecutivo="";
			while($leer=mysqli_fetch_array($respuesta)){
				$consecutivo=$leer['consecutivo_actu_conf'];
			}
			return($consecutivo);
		}
		
		function insertar_factura($productos,$bub_total,$codigo_clie){
				$tabla="";
				$codigo_fac=0;
				
				$consecutivo=($this->traer_consecutivo())+1;
				
				$fecha=date('y-m-d-h-i-s');

				$sql="INSERT INTO `facturas`(`numero_fact`, `total_fact`, `estado_fact`, `fecha_hora_fact`, `documento_pers`, `codigo_usua`,url_fact) VALUES ('$consecutivo','$bub_total','0','$fecha','$codigo_clie','1','../../facturas/$consecutivo.pdf')";
				$respuesta=$this->consulta($sql);
				if($respuesta){
					$res=$this->consulta("SELECT `codigo_fact` FROM `facturas` WHERE `numero_fact`=$consecutivo");
					while($row=mysqli_fetch_array($res)){
						$codigo_fac=$row['codigo_fact'];
					}
					foreach ($productos as $valor){
						
					$sql="INSERT INTO `detalle_factura`(`cantidad_deta`, `precio_deta`, `codigo_fact`, `codigo_stoc`) VALUES ('".$valor['cantidad']."','".$valor['precio']."','$codigo_fac','".$valor['codigo']."')";
						$respuesta=$this->consulta($sql);
						if($respuesta){
							
								$result=$this->consulta("UPDATE `stock` SET `cantidad_stoc`=cantidad_stoc-'".$valor['cantidad']."' WHERE `codigo_stoc`='".$valor['codigo']."'");
								if ($result){
									$sql="UPDATE `configuracion` SET `consecutivo_actu_conf`='$consecutivo' WHERE `codigo_conf`='0'";
									$respuesta=$this->consulta($sql);
									
								}else{
									echo(false);
								}
						}else{
							echo(false);
							exit();
						}
					}
					$this->crear_pdf_fact($productos,$bub_total,$codigo_clie);
					
				}else{
					echo(false);	
				}
			}
		function consultar_factura($busqueda, $pagina){
			
			$campos = 'f.numero_fact, f.fecha_hora_fact, f.total_fact, f.estado_fact, f.url_fact, p.nombre_pers';
			$tablas='facturas f, usuarios u, persona p';
			$columnasFiltro = array('f.numero_fact','f.documento_pers', 'p.nombre_pers' );
			$condicion = 'u.codigo_usua = f.codigo_usua and p.documento_pers = f.documento_pers and f.estado_fact=0';

			if ( $busqueda != "" )
			{
				$condicion .= " and (";
				for ( $i=0 ; $i<count($columnasFiltro) ; $i++ )
				{
					$condicion .= $columnasFiltro[$i]." LIKE '%".$busqueda."%' or ";
				}
				$condicion = substr_replace( $condicion, "", -3 );
				$condicion .= ')';
			}
			//$condicion.=" order by nombre asc";


			$sql = "SELECT * FROM $tablas where $condicion ".' ORDER BY f.fecha_hora_fact DESC ';

			$cantidad = $this->cantFilas($sql);
			$tamanioPaginas = 15;
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

				<table class="table ">
						  <thead>
							<tr>
							  <th style="width: 10%" scope="col">N° Factura</th>
							  <th style="width: 20%" scope="col">Fecha</th>
							  <th style="width: 20%" scope="col">Cliente</th>
							
							  <th style="width: 17%" scope="col">Total</th>
							  <th style="width: 17%" scope="col">Detalle</th>
							</tr>
						  </thead>
						  <tbody>
						<?php 
						while ($row=$this->fetch_array($resultado)){
							
							$Codigo=$row['codigo_fact'];
							$usuario=$row['nombre_pers'];													
							$total=$row['total_fact'];
							$fecha=$row['fecha_hora_fact'];
							$url=$row['url_fact'];
							
							
							
							
						?>
							<tr>
								<td scope="row"><?php echo $Codigo ?></td>
								<td scope="row"><?php echo $fecha ?></td>
								<td scope="row"><?php echo $usuario?></td>	
								<td scope="row"><?php echo $total ?></td>
						  	<td>
						  		<a href="<?php echo($url); ?>" title="ver detalles" class="btn boton_titulo" target=”_blank”>Ver detalles</a>
							  </td>
							  	
							</tr>
						<?php 
							
						}

						?>
					</tbody>
				</table>
				
			<nav aria-label="...">
				<ul class="pagination justify-content-center pag">
				  <?php if ($totalPaginas > 1) { 
					if ($pagina != 1){ 
						 
						echo '
						<li class="page-item">
						 <a class="page-link letra_negra" href="#" onclick="cargar_factura('.($pagina-1).')" aria-label="Previous">
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
						
						 if($pagina == $i) echo'<li class="page-item "><a class="page-link pag_active" href="#" onclick="cargar_factura('.$i.')" >'.$i.'</a></li>';
						 else echo '<li class="page-item "><a class="page-link letra_negra" href="#" onclick="cargar_factura('.$i.')" >'.$i.'</a></li>';
					 }
					
					if ($pagina != $totalPaginas){
						 
						echo '<li class="page-item ">
							<a class="page-link letra_negra" href="#" onclick="cargar_factura('.($pagina+1).')" aria-label="Next">
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
		
		function consultar_pedidos($busqueda, $pagina){
			
			$campos = 'f.numero_fact, f.fecha_hora_fact, f.total_fact, f.estado_fact, f.url_fact, p.nombre_pers, f.documento_pers';
			$tablas='facturas f, usuarios u, persona p';
			$columnasFiltro = array('f.numero_fact','f.documento_pers', 'p.nombre_pers' );
			$condicion = 'u.codigo_usua = f.codigo_usua and p.documento_pers = u.documento_pers and f.estado_fact>1';

			if ( $busqueda != "" )
			{
				$condicion .= " and (";
				for ( $i=0 ; $i<count($columnasFiltro) ; $i++ )
				{
					$condicion .= $columnasFiltro[$i]." LIKE '%".$busqueda."%' or ";
				}
				$condicion = substr_replace( $condicion, "", -3 );
				$condicion .= ')';
			}
			//$condicion.=" order by nombre asc";


			$sql = "SELECT * FROM $tablas where $condicion ".' ORDER BY f.fecha_hora_fact DESC ';

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

				<table class="table ">
						  <thead>
							<tr>
						  	  <th style="width: 20%" scope="col">Documento</th>
							  <th style="width: 20%" scope="col">Nombre</th>
							  <th style="width: 20%" scope="col">Fecha</th>						
							  <th style="width: 10%" scope="col">Total</th>
							  <th style="width: 20%" scope="col">Estado</th>
							  <th style="width: 10%" scope="col">Detalle</th>
							</tr>
						  </thead>
						  <tbody>
						<?php 
						while ($row=$this->fetch_array($resultado)){
							
							$Codigo=$row['codigo_fact'];
							$usuario=$row['nombre_pers'];													
							$total=$row['total_fact'];
							$fecha=$row['fecha_hora_fact'];
							$estado = $row['estado_fact'];
							$documento = $row['documento_pers'];
							
							
							
						?>
							<tr>
								<td scope="row"><?php echo $documento ?></td>
								<td scope="row"><?php echo $usuario ?></td>
								<td scope="row"><?php echo $fecha ?></td>
								<td scope="row"><?php echo $total ?></td>	
								<td scope="row"><?php 
									if($estado == 2)echo '<span class="estado_compra badge badge-secondary" stile="color:white!important">Pago pendiente</span>';
									else if($estado == 3)echo '<span class="estado_compra badge badge-primary">Pagada</span>';
									else if($estado == 4)echo '<span class="estado_compra badge badge-warning">Rechazada</span>';
									else if($estado == 5)echo '<span class="estado_compra badge badge-danger">Cancelada</span>';
									else if($estado == 6)echo '<span class="estado_compra badge badge-success">Pedido enviado</span>';
								?></td>
						  	<td>
						  		<a href="detalle_pedido.php?codigo=<?php echo $Codigo ?>" title="ver detalles" class="btn boton_titulo">Ver detalles</a>
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
		
		function cantidad_pedidos(){
			
			$campos = 'f.numero_fact, f.fecha_hora_fact, f.total_fact, f.estado_fact, f.url_fact, p.nombre_pers, f.documento_pers';
			$tablas='facturas f, usuarios u, persona p';
			$condicion = 'u.codigo_usua = f.codigo_usua and p.documento_pers = u.documento_pers and f.estado_fact>1';

			


			$sql = "SELECT * FROM $tablas where $condicion";

			$cantidad = $this->cantFilas($sql);
			
			echo $cantidad;
			

			
			
		}
		
		function consultar_compras($busqueda, $pagina){
			
			$campos = 'f.numero_fact, f.fecha_hora_fact, f.total_fact, f.estado_fact, f.url_fact, p.nombre_pers, f.documento_pers';
			$tablas='facturas f, usuarios u, persona p';
			$columnasFiltro = array('f.fecha_hora_fact' );
			$condicion = 'u.codigo_usua = f.codigo_usua and p.documento_pers = u.documento_pers and f.estado_fact != 1 and f.documento_pers = "'.$_SESSION['documento'].'"';

			if ( $busqueda != "" )
			{
				$condicion .= " and (";
				for ( $i=0 ; $i<count($columnasFiltro) ; $i++ )
				{
					$condicion .= $columnasFiltro[$i]." LIKE '%".$busqueda."%' or ";
				}
				$condicion = substr_replace( $condicion, "", -3 );
				$condicion .= ')';
			}
			//$condicion.=" order by nombre asc";


			$sql = "SELECT * FROM $tablas where $condicion ".' ORDER BY f.fecha_hora_fact DESC ';

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
			//echo($sql);
			$resultado = $this->consulta($sql);
			?>

				<table class="table tabla_cart">
						  <thead>
							<tr>
							  <th style="width: 25%; text-align: center" scope="col">Fecha</th>
							  <th style="width: 25%; text-align: center" scope="col">Estado</th>
							  <th style="width: 25%; text-align: center" scope="col">Total</th>
							  <th style="width: 25%; text-align: center" scope="col">Detalles</th>
							</tr>
						  </thead>
						  <tbody>
						<?php 
						while ($row=$this->fetch_array($resultado)){
							
							$Codigo=$row['codigo_fact'];
							$usuario=$row['nombre_pers'];													
							$total=$row['total_fact'];
							$fecha=$row['fecha_hora_fact'];
							$estado = $row['estado_fact'];
							$documento = $row['documento_pers'];
							$url =substr($row['url_fact'], 3);
							
							
						?>
							<tr>
								
								<td scope="row"  align="center"><?php echo $fecha ?></td>								
								<td scope="row"  align="center"><?php 
									if($estado == 2)echo '<span class="badge estado_compra badge-secondary">Pago pendiente</span>';
									else if($estado == 3)echo '<span class="badge estado_compra badge-primary">Pagada</span>';
									else if($estado == 4)echo '<span class="badge estado_compra badge-warning">Rechazada</span>';
									else if($estado == 5)echo '<span class="badge estado_compra badge-danger">Cancelada</span>';
									else if($estado == 6)echo '<span class="badge estado_compra badge-success">Pedido enviado</span>';
									else if($estado == 0)echo '<span  class="estado_compra badge badge-success">Enviada y terminada</span>';
								?></td>
								<td scope="row"  align="center"><?php echo $total ?></td>	
						  		<td  align="center">
						  		<?php
								if($estado == 0){
								?>
						  		
						  		<a href="<?php echo($url); ?>" title="ver detalles" class="btn boton boton_eliminar " target=”_blank” ><span class="fa fa-download"></span></a>
						  		
						  		<?php
								}else{
								?>
					  			<a href="detalle_compra.php?menu=mis_compras&codigo=<?php echo $Codigo ?>"  title="ver detalles" class="btn boton boton_eliminar"><span class="fas fa-th-list"></a>
						  		<?php
								}
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
						
						 if($pagina == $i) echo'<li class="page-item active"><a class="page-link pag_active" href="#" onclick="cargarTabla('.$i.')" >'.$i.'</a></li>';
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
		
		
		function crear_pdf_fact($productos,$subtotal,$codigo_clie){
			$tabla="";
			$iva=$subtotal*0.19;
			$sub2=$subtotal-$iva;
			$total=$subtotal;
			$sql="SELECT * FROM `persona` WHERE `documento_pers`='$codigo_clie'";
			$respuesta=$this->consulta($sql);
			$nombre="";
			$direccion="";
			$telefono="";
			$documento="";
			$fecha=date('y-m-d');
			
			while($leer=mysqli_fetch_array($respuesta)){
				$documento=$leer['documento_pers'];
				$nombre=$leer['nombre_pers'];
				$direccion=$leer['direccion_pers'];
				$telefono=$leer['telefono_pers'];
			}
			foreach($productos as $valor1){
					$precio_unid=$valor1['precio']/$valor1['cantidad'];
					$result=$this->consulta("SELECT p.nombre_prod, p.descripcion_prod FROM producto p, stock s WHERE s.codigo_stoc= '".$valor1['codigo']."' and p.codigo_prod=s.codigo_prod");
					while($leer2=mysqli_fetch_array($result)){
						$nombre_prod=$leer2['nombre_prod'];
						$descripcion_prod=$leer2['descripcion_prod'];
					}
					$tabla=$tabla.'
						<tr>
						  <td align="center" width="15%">'.$valor1['cantidad'].'</td>
						  <td width="55%">'.$nombre_prod.' '.$descripcion_prod.'</td>
						  <td align="center" width="15%">'.$precio_unid.'</td>
						  <td align="center" width="15%">'.$valor1['precio'].'</td>
						</tr>';
				}
			$codigo_fact=$this->traer_consecutivo();
			
			$html='';
			$html=$html.'	
			<hr>
			<table width="1024px" border="0" cellspacing="10px">
			   <tr>
				  <th scope="col" width="15%" style="color: blue" >Cantidad</th>
				  <th scope="col" width="55%" style="color: blue"  align="left">Descripcion</th>
				  <th scope="col" width="15%" style="color: blue">Valor Unitario</th>
				  <th scope="col" width="15%" style="color: blue">Total</th>
				</tr>
			</table>
			<hr>
			<table width="1024px" border="0" cellspacing="10px">'.$tabla.'</table>';
			
			$html=$html.'<hr>
<br>
<table width="1024px">
  <tr>
  	<td align="left" width="15%">&nbsp;</td>
      <td align="left" width="55%">&nbsp;</td>
      <td align="left" width="15%" align="center">&nbsp;Subtotal</td>
      <td align="left" width="15%" align="center">&nbsp;'.$sub2.'</td>
     </tr>
     <tr>
  	<td align="left">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td align="left" align="center">&nbsp;I.V.A</td>
      <td align="left" align="center">&nbsp;'.$iva.'</td>
     </tr>
     <tr>
  	<td align="left">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td align="left" align="center">&nbsp;Total</td>
      <td align="left" align="center">&nbsp;'.$total.'</td>
     </tr>
  </table>
  <hr>
<table width="1024px" border="0">
  <tbody>
    <tr>
      <td width="25%"></td>
		<td width="25%"></td>
      <td width="50%" >
      	<table width="100%" border="0">
		  <tbody>
			<tr>
			  <td width="25%" align="right">Vendedor:</td>
			  <td align="left" width="75%">'.$_SESSION['nombre'].'</td>
			</tr>
		  </tbody>
		</table>
		</td>
    </tr>
    <tr>
      
    </tr>
  </tbody>
</table>';
			
			$head='<table width="1024px" border="0">
  <tbody>
    <tr>
      <td width="25%"><table width="100%" border="0">
		  <tbody>
			<tr>
			  <th scope="col" align="left">El PALACIO HINDÚ</th>
			</tr>
			<tr>
			  <td align="left">NIT. 800073355-4</td>
			</tr>
			<tr>
			  <td align="left">Prop. Teresa Arias</td>
			</tr>
		  </tbody>
		</table>
</td>
      <td width="25%">&nbsp;</td>
      <td width="25%">&nbsp;</td>
      <td width="25%" align="center">Todo para la buena suerte 
					en su hogar o negocio
					sahumerios, riegos,
					perfumes zodicales y
					productos esotericos en general</td>
    </tr>
	  <tr>
	  	<td width="25%"><table width="100%" border="0">
		  <tbody>
			<tr>
			  <td align="left" style="color: blue">Factura de venta # '.$codigo_fact.'</td>
			</tr>
			<tr>
			  <td align="left">Fecha: '.$fecha.'</td>
			</tr>
		  </tbody>
		</table>
	</td>
  	 <td width="25%">&nbsp;</td>
      <td width="25%">&nbsp;</td>
      <td width="25%">&nbsp;</td>
	  </tr>
	    <tr>
	  	<td width="25%"><table width="100%" border="0">
		  <tbody>
			<tr>
			  <td align="left">Nombre: '.$nombre.'</td>
			</tr>
			<tr>
			  <td align="left">Identificación: '.$documento.'</td>
			</tr>
			<tr>
			  <td align="left">Dirección: '.$direccion.'</td>
			</tr>
			<tr>
			  <td align="left">Telefono: '.$telefono.'</td>
			</tr>
		  </tbody>
		</table>
	</td>
  	 <td width="25%">&nbsp;</td>
      <td width="25%">&nbsp;</td>
      <td width="25%">&nbsp;</td>
	  </tr>
  </tbody>
</table>';
			$footer='<table width="1024px" border="0">
  <tbody>
    <tr>
      <td width="25%"></td>
    </tr>
    <tr>
      <td width="50%" >
      	<table width="100%" border="0">
		  <tbody>
			<tr>
			  <td align="center">Carrera 16 N° 3-21 Aguachica-Cesar</td>
			</tr>
			<tr>
			  <td align="center">565 0389 - 321 560 5690</td>
			</tr>
		  </tbody>
		</table>

      </td>
    </tr>
    <tr>
      <td width="25%"></td>
    </tr>
  </tbody>
</table>';
		$construct=new construc;
			$url='../facturas/'.$codigo_fact.'.pdf';
			$url2="../".$url;
			$resp=$construct->crear_pdf($html,$url,$footer,$head);
			if ($resp=1){
				echo($url2);	
			}else{
				echo('false');
			}
			
			
		}

}	

	
?>