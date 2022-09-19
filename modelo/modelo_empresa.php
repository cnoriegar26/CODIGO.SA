<?php

	include('conexion.php');
	include('contruct.php');

	class empresa extends conexion{
		
		function registrar_empresa($nit,$nombre,$direccion,$telefono,$correo,$mision,$vision){
			$cnst=new construc;
			$sql="INSERT INTO `empresa`(`nit_empr`, `nombre_empr`, `direccion_empr`, `telefono_empr`, `correo_empr`, mision, vision) VALUES ('$nit','$nombre','$direccion','$telefono','$correo','$mision','$vision')";
			$result=$this->consulta($sql);
			if($result){
				$cnst->alertas('datos de la empresa guardados con exito','true');
			}else{
				$cnst->alertas('hubo un problema al registrar los datos comuniquese con su administrador','false');
			}
		}
		
		function actualizar_empresa($nit,$nombre,$direccion,$telefono,$correo,$mision,$vision){
			$cnst=new construc;
			$sql="UPDATE `empresa` SET `nombre_empr`='$nombre',`direccion_empr`='$direccion',`telefono_empr`='$telefono',`correo_empr`='$correo',`mision`='$mision',`vision`='$vision'  WHERE nit_empr='$nit'";
			$result=$this->consulta($sql);
			if($result){
				$cnst->alertas('datos de la empresa actualizados con exito','true');
			}else{
				$cnst->alertas('hubo un problema al actualizar los datos comuniquese con su administrador','false');
			}
		}
		
		function traer_empresa(){
			$sql='SELECT * FROM `empresa` WHERE 1';
			$res2=$this->cantFilas($sql);
			if ($res2>0){
				$res=$this->consulta($sql);
				while($leer=mysqli_fetch_array($res)){
					$json=array('tipo'=>'true','nit'=>$leer['nit_empr'],'nombre'=>$leer['nombre_empr'],'telefono'=>$leer['telefono_empr'],'direccion'=>$leer['direccion_empr'],'correo'=>$leer['correo_empr'],'mision'=>$leer['mision'],'vision'=>$leer['vision']);
				}
			}else{
				$json=array('tipo'=>'false','mj'=>'porfavor registre una empresa');
			}
			echo(json_encode($json));
		}
	}

?>