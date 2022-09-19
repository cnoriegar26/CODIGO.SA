<?php

include('modelo_factura.php');
$factura = new factura();

$ApiKey = 'JmBG2ig8XUdRDvra410j0411V6';

/*$merchant_id = $_REQUEST['merchantId'];

$referenceCode = $_REQUEST['referenceCode'];
$TX_VALUE = $_REQUEST['TX_VALUE'];
$New_value = number_format($TX_VALUE, 1, '.', '');
$currency = $_REQUEST['currency'];
$transactionState = $_REQUEST['transactionState'];
$firma_cadena = "$ApiKey~$merchant_id~$referenceCode~$New_value~$currency~$transactionState";
$firmacreada = md5($firma_cadena);
$firma = $_REQUEST['signature'];
$reference_pol = $_REQUEST['reference_pol'];
$cus = $_REQUEST['cus'];
$extra1 = $_REQUEST['description'];
$id = $_REQUEST['extra1'];
$pseBank = $_REQUEST['pseBank'];
$lapPaymentMethod = $_REQUEST['lapPaymentMethod'];
$transactionId = $_REQUEST['transactionId'];*/

$merchant_id = $_REQUEST['merchant_id'];
$referenceCode = $_REQUEST['reference_sale'];
$TX_VALUE = $_REQUEST['value'];
$New_value = number_format($TX_VALUE, 1, '.', '');
$currency = $_REQUEST['currency'];
$transactionState = $_REQUEST['state_pol'];
$firma_cadena = "$ApiKey~$merchant_id~$referenceCode~$New_value~$currency~$transactionState";
$firmacreada = md5($firma_cadena);
$firma = $_REQUEST['sign'];
$reference_pol = $_REQUEST['reference_pol'];
$id = $_REQUEST['extra1'];
$fecha = $_REQUEST['extra2'];



if ($transactionState == 4 ) {
	$estadoTx = "Transacción aprobada";
	$factura->actualizar_estado($id, 3, $fecha);
}

else if ($transactionState == 6 ) {
	$estadoTx = "Transacción rechazada";
	$factura->actualizar_estado($id, 4, $fecha);
}

else if ($transactionState == 104 ) {
	$estadoTx = "Error";
	$factura->actualizar_estado($id, 5, $fecha);
}

else if ($transactionState == 7 ) {
	$estadoTx = "Transacción pendiente";
	$factura->actualizar_estado($id, 2, $fecha);
}

else {
	//$estadoTx=$_REQUEST['mensaje'];
	$factura->actualizar_estado($id, 5, $fecha);
}


?>