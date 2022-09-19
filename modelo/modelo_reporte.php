<?php
 include('conexion.php');

	class reporte extends conexion {
		function consultar_ventas_totales($fecha_inic,$fecha_fina){
			$totalventa=0;
			$cantidadlfacturas=0;
			$array1=[];
			$sql="SELECT * FROM `facturas` WHERE `fecha_hora_fact` BETWEEN '$fecha_inic' and '$fecha_fina'";
			$result=$this->consulta($sql);
			$result2=$this->cantFilas($sql);
			if ($result2>0){
				
				for($i=$fecha_inic;$i<=$fecha_fina;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
					
					$sql="SELECT * FROM `facturas` WHERE `fecha_hora_fact`LIKE ('%$i%') and `estado_fact`='0'";
					$result=$this->consulta($sql);
					$result2=$this->cantFilas($sql);
					
					 while($leer = mysqli_fetch_array($result)){
						 
						$totalventa += $leer['total_fact'];
						$cantidadlfacturas ++;		
						
					}
					
					$valores=array('total'=>$totalventa,'cantidad'=>$cantidadlfacturas,'fecha'=>$i);
					if ($result2>0){
						array_push($array1,$valores);	
					}
					$totalventa=0;
					$cantidadlfacturas=0;
					 
				}
				$json=array('typo'=>'true','valores'=>$array1);
				
				
			
			}else{
				$json=array('typo'=>'false','alerta'=>'<div class="alert alert-danger alert-dismissible fade show"role="alert">¡No hay registro de ventas!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>	 </button></div>');
			}
			echo (json_encode($json));
		}
	
		function traer_tipos(){
			$sql="SELECT `codigo_tipo`, `nombre_tipo` FROM `tipo` WHERE 1";
			$result=$this->consulta($sql);
			$tipo_prod=array();
			while ($leer=mysqli_fetch_array($result)){
				
				$arr1=array('id'=>$leer['codigo_tipo'],'nombre'=>$leer['nombre_tipo']);
				
				array_push($tipo_prod, $arr1);
			}
			return($tipo_prod);
		}
		
		function consulta_tipo_prod($fecha_inic,$fecha_fina){
			$total=0;
			$cantidad=0;
			$tipo=$this->traer_tipos();
			$resultado_array=array();
				$sql="SELECT * FROM facturas f, producto p, stock st ,detalle_factura df WHERE (f.fecha_hora_fact BETWEEN '$fecha_inic' and '$fecha_fina') and f.estado_fact='0' and df.codigo_fact=f.codigo_fact and st.codigo_stoc=df.codigo_stoc and p.codigo_prod=st.codigo_prod";
			
			$result2=$this->cantFilas($sql);
			if ($result2>0){
				
					foreach ($tipo as $valor){
						$sql="SELECT * FROM facturas f, producto p, stock st ,detalle_factura df WHERE (f.fecha_hora_fact BETWEEN '$fecha_inic' and '$fecha_fina') and f.estado_fact='0' and df.codigo_fact=f.codigo_fact and st.codigo_stoc=df.codigo_stoc and p.codigo_prod=st.codigo_prod and p.codigo_tipo='".$valor['id']."'";
						
						$cantidad=$this->cantFilas($sql);
						$total=$total + $cantidad;
						array_push($resultado_array,array("cantidad"=>$cantidad, "nombre"=>$valor['nombre']));
					}

				
				foreach ($resultado_array as $valor2){
					$valores=number_format((($valor2['cantidad']*1)/$total)*100, 2, '.', '');
					?>
						<tr>
							  <th ><?php echo($valor2['nombre'])?></th>
							  <td><?php echo($valor2['cantidad'])?></td>
							  <td>
					  				<div class="progress" >
						  				<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo($valores)?>%"><?php echo($valores)?>%</div>
						  			</div>
						  	  </td>
							</tr>
				<?php
					
				}
				
			}else{
				echo('<tr><td colspan="3"><div class="alert alert-danger alert-dismissible fade show"role="alert">¡No hay registro de ventas!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>	 </button></div></td></tr>');
			}
		}
		
	}
?>