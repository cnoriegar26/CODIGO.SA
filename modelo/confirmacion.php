<?php
	session_start();
	include('conexion.php');
	
	$conexion=new conexion;
	$ApiKey = "4Vj8eK4rloUd272L48hsrarnUA";
	$merchant_id = $_REQUEST['merchant_id'];
	$referenceCode = $_REQUEST['reference_sale'];
	$reference_pol=$_REQUEST['reference_pol'];
	$reference_code_pol=$_REQUEST['reference_code_pol'];
	
?>