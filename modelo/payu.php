<?php
include("conexion.php");

	class payu extends conexion{
		
		function trer_valores(){
			$sql="SELECT f.total_fact, f.codigo_fact, p.email_pers FROM facturas f,persona p WHERE f.numero_fact= '0' and f.documento_pers='".$_SESSION['documento']."' and p.documento_pers=f.documento_pers";
			$res2=$this->cantFilas($sql);
			if($res2>0){
					$res=$this->consulta($sql);
					while($leer=mysqli_fetch_array($res)){
						$json=array('tipo'=>'true','total'=>$leer['total_fact']+10000,'codigo'=>$leer['codigo_fact'], 'mail'=>$leer['email_pers']);
					}
			}else{
				$json=array('tipo'=>'false');
			}
			
		 mysqli_close($this->_db);
			return($json);
		}
		
	}
?>