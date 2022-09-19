<?php
	include("conexion.php");
	include('contruct.php');

	class catalogo extends conexion{
		
		function cargar_menu(){
			$sql='SELECT * FROM `tipo` WHERE 1';
			$result=$this->consulta($sql);
			while($leer=mysqli_fetch_array($result)){
				
				?>
				
					<li class="titulo" ><a class="titulo_nombre "  href="catalogo.php?menu=catalogo&tipo=<?php echo($leer['codigo_tipo']); ?>"><?php echo($leer['nombre_tipo'])?></a>
					
					</li>
				
				<?php
				
			}
		}
		
		
		function cargar_categorias(){
			$sql='SELECT * FROM `tipo` WHERE 1 LIMIT 6';
			$result=$this->consulta($sql);
			$bandera = true;
			while($leer=mysqli_fetch_array($result)){
				
							
					if($bandera){
					?>	
						<a type="buttom" href="catalogo.php?menu=catalogo&tipo=<?php echo $leer['codigo_tipo']?>" class="btn" > <img src="../img/iconos/rama1.png" height="60px" width="60px"><br><?php echo($leer['nombre_tipo'])?></a>
					<?php	
						$bandera = false;
					}else{
						?>
						<a type="buttom" href="catalogo.php?menu=catalogo&tipo=<?php echo $leer['codigo_tipo']?>" class="btn" > <img src="../img/iconos/rama2.png" height="60px" width="60px"><br><?php echo($leer['nombre_tipo'])?></a>
						<?php
						$bandera = true;
					}		
				
				
			}
		}
		
		function cargar_catalogo($busqueda, $pagina, $tipo){
			
			$tablas='producto p, tipo t';
			$columnasFiltro = array('p.codigo_prod', 'p.nombre_prod');
			if ($tipo==0){
				$condicion = ' t.codigo_tipo = p.codigo_tipo ';
			}else{
				$condicion = " t.codigo_tipo = p.codigo_tipo and p.codigo_tipo= $tipo ";
			}
			

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
			$tamanioPaginas = 36;
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
					<div class="row">
					
						<?php 
						while ($row=$this->fetch_array($resultado)){
							$Codigo=$row['codigo_prod'];
							$Nombre=$row['nombre_prod'];													
							$Descripcion=$row['descripcion_prod'];
							$Precio=$row['precio_prod'];
							$Tipo=$row['nombre_tipo'];
							$Estado=$row['estado_prod'];
							$url=$row['imagen_prod'];
							if ($Estado==0){
								
							}else{
								?>
									<div class="col-md-2" style="min-width: 180px">
										<img onclick="traer_producto(<?php echo($Codigo) ?>)" src="<?php echo($url); ?>" width="100%" height="150px"><br>
										<?php echo($Nombre); ?>
									</div>
							<?php 
							}
						
						}

						?>
						
						</div>
						<div class="col-md-12">
			<nav aria-label="..." align="center" class="" >
				<ul class="pagination pag justify-content-center">
				  <?php if ($totalPaginas > 1) { 
					if ($pagina != 1){ 
						 
						echo '
						<li class="page-item">
						 <a class="page-link letra_negra" href="#" onclick="cargar_catalogo('.($pagina-1).')" aria-label="Previous">
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
						
						 if($pagina == $i) echo'<li class="page-item "><a class="page-link pag_active" href="#" onclick="cargar_catalogo('.$i.')" >'.$i.'</a></li>';
						 else echo '<li class="page-item "><a class="page-link letra_negra" href="#" onclick="cargar_catalogo('.$i.')" >'.$i.'</a></li>';
					 }
					
					if ($pagina != $totalPaginas){
						 
						echo '<li class="page-item ">
							<a class="page-link letra_negra" href="#" onclick="cargar_catalogo('.($pagina+1).')" aria-label="Next">
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
			</div>


			<?php

			
		}
		
	}


?>