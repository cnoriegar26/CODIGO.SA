<?php

	include ('../vendor/autoload.php');
	class construc {
		function alertas($mensaje, $tipo){
			
			if ($tipo == 'true'){
				
				$alerta='<div class="alert alert-success alert-dismissible fade show" role="alert">
						  '.$mensaje.'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>';
			}else{
				$alerta='<div class="alert alert-danger alert-dismissible fade show" role="alert">
						  '.$mensaje.'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>';
			}
			$json=array('tipo'=>$tipo,"alerta"=>$alerta);
			echo(json_encode($json));
		}
		
		function crear_pdf($html,$url,$footer,$head){
			
			$htmlf='<div >';
			$htmlf=$htmlf.$html;
			$htmlf=$htmlf.'</div>';
			
			$mpdf = new \Mpdf\Mpdf([
					'mode' => 'utf-8',
					'format' => [295, 380], 
					'orientation' => 'p',
					'setAutoTopMargin' => 'pad'
			]);
			
			//$css=file_get_contents('../css/bootstrap.css');


			//$mpdf->WriteHTML($css);

			//$mpdf->WriteHTML($css,1);
			$mpdf->SetHeader($head);
			$mpdf->SetFooter($footer);
			$mpdf->WriteHTML($htmlf);
			$mpdf->Output($url,'f');
		}
	
	function armado_html($colimnas,$data,$sql_array){
			$tamaño_row=100/count($colimnas);
		$tabla='<table border="1" style="width: 1024px;"><tr>';
			foreach ($colimnas as $valor){
				$tabla=$tabla.'<th style="width:'.$tamaño_row.'%">'.$valor.'</th>';
			}
			$tabla=$tabla.'</tr>';
			while($leer=mysqli_fetch_array($sql_array)){
				$tabla=$tabla.'<tr>';
				
				foreach($data as $dato){
					$tabla=$tabla.'<td>'.$leer[$dato].'</td>';
				}
				$tabla=$tabla.'</tr>';
			}
		$tabla=$tabla.'</table>';
		$url='../temp_pdf/consult3.pdf';
		$this->crear_pdf($tabla,$url,'false','false');
		echo('../'.$url);
		
		}
		}
?>