<?php

	include("conexion.php");
	include('contruct.php');

	class carrito extends conexion{
		
		function agregar_car($cantidad,$valor,$codigo_stoc){
			$fecha=date('y-m-d-h-i-s');
			$sql="SELECT * FROM `facturas` WHERE `documento_pers`= '".$_SESSION['documento']."' and `numero_fact`=0 and `estado_fact`=1";
			$res=$this->cantFilas($sql);
			if ($res>0){
				$codigo_fact=0;
				$res=$this->consulta($sql);
				while($row=mysqli_fetch_array($res)){
					$codigo_fact=$row['codigo_fact'];
				}
				$sql="SELECT * FROM `detalle_factura` WHERE `codigo_stoc`='$codigo_stoc' and codigo_fact='$codigo_fact'";
				$cant=$this->cantFilas($sql);
				if($cant>0){
					$sql="UPDATE `detalle_factura` SET`cantidad_deta`= cantidad_deta+'$cantidad',`precio_deta`= precio_deta+'$valor' WHERE `codigo_stoc`= '$codigo_stoc' and codigo_fact='$codigo_fact'";
					
				}else{
					$sql="INSERT INTO `detalle_factura`(`cantidad_deta`, `precio_deta`, `codigo_fact`, `codigo_stoc`) VALUES ('$cantidad',$valor,$codigo_fact,$codigo_stoc)";
				}
				
				$res=$this->consulta($sql);
				if($res){
					$sql="UPDATE `facturas` SET `total_fact`= total_fact+'".$valor."' WHERE `documento_pers`= '".$_SESSION['documento']."' and `estado_fact`='1' and `numero_fact`='0'";
					$res=$this->consulta($sql);
					if ($res){
						echo('true');
					}else{
						echo('false');
					}
					
				}else{
					echo('false');
				}
				
			}else{
				$sql="INSERT INTO `facturas`(`total_fact`, `estado_fact`, `fecha_hora_fact`, `documento_pers`, `codigo_usua`,`numero_fact`) VALUES ('$valor','1',$fecha,'".$_SESSION['documento']."','".$_SESSION['usuario']."','0')";
				$res=$this->consulta($sql);
				
				if($res){
					$sql="SELECT * FROM `facturas` WHERE `documento_pers`= '".$_SESSION['documento']."' and `numero_fact`=0 and `estado_fact`=1";
					$res=$this->consulta($sql);
					while($row=mysqli_fetch_array($res)){
					$codigo_fact=$row['codigo_fact'];
					}
					
					$sql="INSERT INTO `detalle_factura`(`cantidad_deta`, `precio_deta`, `codigo_fact`, `codigo_stoc`) VALUES ('$cantidad',$valor,$codigo_fact,$codigo_stoc)";
					$res=$this->consulta($sql);
					if ($res){
						echo('true');
					}else{
						echo('false');	
					}
					
					
				}else{
					echo('false');
				}
			}
			 mysqli_close($this->_db);
		}
		
		function traer_carrito(){
			
			$sql="SELECT * FROM facturas f, persona p WHERE f.documento_pers= '".$_SESSION['documento']."' and f.numero_fact=0 and f.estado_fact=1 and p.documento_pers = f.documento_pers";
			$res=$this->cantFilas($sql);
			if ($res>0){
				$res=$this->consulta($sql);
				$codigo_fact=0;
				while($row=mysqli_fetch_array($res)){
					$codigo_fact=$row['codigo_fact'];
					?>
					<div class="col-md-4" style="margin-bottom: 50px;">
						<div class="row">
							<div class="col-md-12 titulo_registro">Datos del envió</div>
							<div class="col-md-12" style="padding: 0; padding-top: 20px">
								<input class="datos_envio" type="text" disabled value="<?php echo $row['nombre_pers']; ?>"><br>
								<input class="datos_envio" type="text" disabled value="<?php echo $row['direccion_pers']; ?>"><br>
								<input class="datos_envio" type="text" disabled value="<?php echo $row['telefono_pers']; ?>">
								<a href="perfil.php" class="boton_editar" style="text-decoration: none; margin-top: 15px;"><span class="fa fa-edit"></span> Editar</a>
							
							</div>
						</div>
					</div>
					
					<?php
				}
				$sql="SELECT * FROM detalle_factura d, producto p, stock st WHERE d.codigo_fact ='$codigo_fact' and st.codigo_stoc=d.codigo_stoc and p.codigo_prod=st.codigo_prod";
				$res=$this->consulta($sql);
				
				?>
				
				<table class="table tabla_cart">
						  <thead>
							<tr>
							  <th style="width: 13%" scope="col"></th>
							  <th style="width: 10%" scope="col">Producto</th>
							  <th style="width: 37%" scope="col">Descripción</th>
							  <th style="width: 10%" scope="col">Precio</th>
							  <th style="width: 10%" scope="col">Cantidad</th>
							  <th style="width: 10%; text-align: center" scope="col">Precio total</th>
							  <th style="width: 10%; text-align: center" scope="col" align="center">Eliminar</th>
							</tr>
						  </thead>
						  <tbody>
				
				<?php
				
				while($row=mysqli_fetch_array($res)){
					
					?>
						
						<tr>
							  <td style="text-align: center"><img src="<?php echo($row['imagen_prod'])?>" height="50px" width="50pxs"></td>
							  <td><?php echo($row['nombre_prod']);?></td>
							  <td align="justify"><?php echo($row['descripcion_prod']);?></td>
							  <td><?php echo($row['precio_prod']);?></td>
							  <td><input class="input_number" type="number" id="p_c<?php echo($row['codigo_deta'])?>" value="<?php echo($row['cantidad_deta']); ?>" max="<?php echo($row['cantidad_stoc']); ?>" min="1" oninput="agregar(<?php echo($row['codigo_deta'])?>)"></td>
								<td align="center" >
									<?php echo($row['precio_deta']);?>
						  		</td>
							  	
							  	<td align="center" >
							  		<buttom title="Eliminar" class="btn boton boton_eliminar" onclick="eliminar(<?php echo($row['codigo_deta'])?>)"><span class="fa fa-trash-alt"></span></buttom>
							  	</td>
							</tr>
						
					<?php
					
				}
				?>
				</tbody></table>
				<?php
			}
			 mysqli_close($this->_db);
		}
		
		function traer_pedido($codigo){
			
			$sql="SELECT * FROM facturas f, persona p WHERE f.codigo_fact = '".$codigo."' and p.documento_pers = f.documento_pers ";
			$res=$this->cantFilas($sql);
			if ($res>0){
				$res=$this->consulta($sql);
				$codigo_fact=0;
				while($row=mysqli_fetch_array($res)){
					$codigo_fact=$row['codigo_fact'];
					
					?>
					<div class="col-md-4" style="margin-bottom: 50px;">
						<div class="row">
							<div class="col-md-12 titulo_registro"style="padding: 0;">Datos del envió</div>
							<div class="col-md-12" style="padding: 0; padding-top: 20px">
								<p class="datos_envio"><?php echo $row['nombre_pers']; ?></p>
								<p class="datos_envio"><?php echo $row['direccion_pers']; ?></p>
								<p class="datos_envio"><?php echo $row['telefono_pers']; ?></p>

							
							</div>
						</div>
					</div>
					
					<?php
					
				}
				$sql="SELECT * FROM detalle_factura d, producto p, stock st WHERE d.codigo_fact ='$codigo_fact' and st.codigo_stoc=d.codigo_stoc and p.codigo_prod=st.codigo_prod";
				$res=$this->consulta($sql);
				
				?>
				
				<table class="table tabla_cart">
						  <thead>
							<tr>
							  <th style="width: 13%" scope="col"></th>
							  <th style="width: 20%" scope="col">Producto</th>
							  <th style="width: 37%" scope="col">Descripción</th>
							  <th style="width: 10%" scope="col">Precio</th>
							  <th style="width: 10%" scope="col">Cantidad</th>
							  <th style="width: 10%; text-align: center" scope="col">Precio total</th>
							  
							</tr>
						  </thead>
						  <tbody>
				
				<?php
				
				while($row=mysqli_fetch_array($res)){
					
					?>
						
						<tr>
							  <td style="text-align: center"><img src="../<?php echo($row['imagen_prod'])?>" height="50px" width="50pxs"></td>
							  <td><?php echo($row['nombre_prod']);?></td>
							  <td align="justify"><?php echo($row['descripcion_prod']);?></td>
							  <td><?php echo($row['precio_prod']);?></td>
							  <td><?php echo($row['cantidad_deta']); ?></td>
								<td align="center" >
									<?php echo($row['precio_deta']);?>
						  		</td>
							</tr>
						
					<?php
					
				}
				?>
				</tbody></table>
				<?php
			}
			 mysqli_close($this->_db);
		}
		
		function traer_compra($codigo){
			
			$sql="SELECT * FROM facturas f, persona p WHERE f.codigo_fact = '".$codigo."' and p.documento_pers = f.documento_pers ";
			$res=$this->cantFilas($sql);
			if ($res>0){
				$res=$this->consulta($sql);
				$codigo_fact=0;
				while($row=mysqli_fetch_array($res)){
					$codigo_fact=$row['codigo_fact'];
				}
				$sql="SELECT * FROM detalle_factura d, producto p, stock st WHERE d.codigo_fact ='$codigo_fact' and st.codigo_stoc=d.codigo_stoc and p.codigo_prod=st.codigo_prod";
				$res=$this->consulta($sql);
				
				?>
				
				<table class="table tabla_cart">
						  <thead>
							<tr>
							  <th style="width: 13%" scope="col"></th>
							  <th style="width: 10%" scope="col">Producto</th>
							  <th style="width: 47%" scope="col">Descripción</th>
							  <th style="width: 10%" scope="col">Precio</th>
							  <th style="width: 10%" scope="col">Cantidad</th>
							  <th style="width: 10%; text-align: center" scope="col">Precio total</th>
							  
							</tr>
						  </thead>
						  <tbody>
				
				<?php
				
				while($row=mysqli_fetch_array($res)){
					
					?>
						
						<tr>
							  <td style="text-align: center"><img src="<?php echo($row['imagen_prod'])?>" height="50px" width="50pxs"></td>
							  <td><?php echo($row['nombre_prod']);?></td>
							  <td align="justify"><?php echo($row['descripcion_prod']);?></td>
							  <td><?php echo($row['precio_prod']);?></td>
							  <td><?php echo($row['cantidad_deta']); ?></td>
								<td align="center" >
									<?php echo($row['precio_deta']);?>
						  		</td>
							</tr>
						
					<?php
					
				}
				?>
				</tbody></table>
				<?php
			}
			 mysqli_close($this->_db);
		}
		
		function traer_addom(){
			$sql="SELECT * FROM `facturas` WHERE `documento_pers`= '".$_SESSION['documento']."' and `numero_fact`=0 and `estado_fact`=1";
			$res=$this->cantFilas($sql);
			if ($res>0){
				$res=$this->consulta($sql);
				$codigo_fact=0;
				while($row=mysqli_fetch_array($res)){
					$codigo_fact=$row['codigo_fact'];
				}
				$sql="SELECT * FROM `detalle_factura` WHERE `codigo_fact`='$codigo_fact'";
				$res=$this->cantFilas($sql);
				if ($res>0){
					echo($res);
				}
			}
			 mysqli_close($this->_db);
		}
		
		function traer_total(){
			$sql="SELECT `total_fact`, codigo_fact FROM `facturas` WHERE `numero_fact`= '0' and estado_fact='1' and `documento_pers`='".$_SESSION['documento']."'";
			$res2=$this->cantFilas($sql);
			if($res2>0){
					$res=$this->consulta($sql);
					while($leer=mysqli_fetch_array($res)){
						$json=array('tipo'=>'true','total'=>$leer['total_fact']+10000,'codigo'=>$leer['codigo_fact']);
					}
			}else{
				$json=array('tipo'=>'false','total'=>'0');
			}
		
			echo(json_encode($json));
		 mysqli_close($this->_db);
		}
		
		function traer_total_compra($codigo){
			$sql="SELECT `total_fact`, codigo_fact, estado_fact FROM `facturas` WHERE codigo_fact='".$codigo."'";
			$res2=$this->cantFilas($sql);
			if($res2>0){
					$res=$this->consulta($sql);
					while($leer=mysqli_fetch_array($res)){
						$json=array('tipo'=>'true','total'=>$leer['total_fact']+10000,'codigo'=>$leer['codigo_fact']);
					}
			}else{
				$json=array('tipo'=>'false');
			}
		
			echo(json_encode($json));
		 mysqli_close($this->_db);
		}
		
		function traer_total_pedido($codigo){
			$sql="SELECT `total_fact`, codigo_fact, estado_fact FROM `facturas` WHERE codigo_fact='".$codigo."'";
			$res2=$this->cantFilas($sql);
			if($res2>0){
					$res=$this->consulta($sql);
					while($leer=mysqli_fetch_array($res)){
						if($leer['estado_fact']==3){
							$json=array('tipo'=>'true','total'=>$leer['total_fact']+10000,'codigo'=>$leer['codigo_fact'],'boton'=>'<button title="Precione este boton si el producto fue enviado" class="btn boton_titulo" onClick="enviar('.$codigo.')">Pedido enviado</button>');
						}else{
							$json=array('tipo'=>'true','total'=>$leer['total_fact']+10000,'codigo'=>$leer['codigo_fact'],'boton'=>'false');
						}
						
						
					}
			}else{
				$json=array('tipo'=>'false');
			}
		
			echo(json_encode($json));
		 	mysqli_close($this->_db);
		}
		
		function eliminar_carrito($codigo){
		
				$sql="CALL eliminar_car($codigo)";
				$res=$this->consulta($sql);
				if ($res){
					echo('true');
				}else{
					echo ('false');
				}
		}
		function agregar_car2($codigo,$cantidad){
			$sql="call agregar_cant('$cantidad','$codigo')";
			$res=$this->consulta($sql);
			if($res){
				echo('true');
			}else{
				echo('false');
			}	
		}
		function confirm_inve(){
			$mensaje='';
			$tipo='false';
			$sql="SELECT * FROM `facturas` WHERE `documento_pers`= '".$_SESSION['documento']."' and `numero_fact`=0 and `estado_fact`=1";
			$res=$this->cantFilas($sql);
			if ($res>0){
				$res=$this->consulta($sql);
				$codigo_fact=0;
				while($row=mysqli_fetch_array($res)){
					$codigo_fact=$row['codigo_fact'];
				}
				$sql="SELECT * FROM detalle_factura df, producto p, stock st  WHERE df.codigo_fact='$codigo_fact' and st.codigo_stoc=df.codigo_stoc and p.codigo_prod=st.codigo_prod";
				$result=$this->consulta($sql);
				$result2=$this->cantFilas($sql);
				if($result2>0){
					while($leer=mysqli_fetch_array($result)){
						
						$sql="SELECT * FROM `stock` WHERE `codigo_stoc`='".$leer['codigo_stoc']."' and `cantidad_stoc`>='".$leer['cantidad_deta']."'";
						$res=$this->cantFilas($sql);
						if($res>0){
								
						}else{
							$mensaje=$mensaje.$leer['nombre_prod']." producto agotado <br>";
							$tipo='true';
						}
						
					}
					
				}
				
			}
			$json=array('tipo'=>$tipo,'mensaje'=>$mensaje);
			echo(json_encode($json));
		}
		
	}
?>