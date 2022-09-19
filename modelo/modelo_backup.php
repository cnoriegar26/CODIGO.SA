<?php
	include("conexion.php");
	include('function_backup.php');



	class backup extends conexion{
		
		function crear_backup(){
			
			
			$fecha=date("Y-m-d-h-i");
			$fecha2=date("Y-m-d h:i:s");
			$url=("../../back/backups/db-backup-".$fecha.".sql");
			$result=$this->registrar_backup($fecha2,$url);
			
			if ($result){
				
				$json=array('accion'=>'1','respuesta'=>$url);
				
				
			}else{
				$json=array('accion'=>'2','respuesta'=>'<div class="alert alert-danger alert-dismissible fade show"role="alert">!hubo un problema al insertar los datos!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>	 </button></div>');
			}
			
			echo(json_encode($json));
			
		}
		function registrar_backup($fecha,$url){
			
				$sql="INSERT INTO `backup`(`fechahora_back`, `codigo_usua`, `url_back`) VALUES ('$fecha','1','$url')";
				$respuesta=$this->consulta($sql);
				return($respuesta);
				
		}
		function consultar_backup($fecha){
			$sql="SELECT * FROM backup b, usuarios u, persona p WHERE b.fechahora_back LIKE '%$fecha%' and u.codigo_usua=b.codigo_usua and p.documento_pers=u.documento_pers ORDER BY b.fechahora_back DESC";
			$respuesta=$this->consulta($sql);
			?>
		<table class="table ">
						  <thead>
							<tr>
							  <th style="width: 30%" scope="col">Fecha </th>
							  <th style="width: 37%" scope="col">Usuario</th>
							  <th style="width: 33%" scope="col">Descargar</th>
							</tr>
						  </thead>
					<tbody>
			<?php
				while ($leer=mysqli_fetch_array($respuesta)){
					
					?>
					<tr>
					<td><?php echo $leer['fechahora_back'] ?></td>
					<td><?php echo $leer['nombre_pers'] ?></td>	
					<td><a title="Descargar" class="btn boton" href="<?php echo($leer['url_back']) ?>" ><span class="fas fa-download"></span></a></td>
					</tr>
					<?php
					
				}
				?>
				</tbody>
				</table>
				<?php
				
		}
		
		
	}

?>