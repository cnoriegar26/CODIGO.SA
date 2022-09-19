<?php

	include('../modelo/modelo_catalogo.php');
	$catalogo = new catalogo;
	
	if (isset($_REQUEST['operador'])){
		
		$operador=$_REQUEST['operador'];
		
		switch ($operador){

			case 'cargar_menu':
				$catalogo->cargar_menu();
				break;
				
			case 'cargar_catalogo':
				$catalogo->cargar_catalogo($_REQUEST['busqueda'],$_REQUEST['pagina'],$_REQUEST['tipo']);				
				break;
				
			case 'cargar_categorias':
				$catalogo->cargar_categorias();				
				break;
		}
		
	}else{
		
	}
	

?>