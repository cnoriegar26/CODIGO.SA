<html >
<head>
<?php include("head.php"); ?>
<link rel="stylesheet" href="../css/general_index.css">
</head>
<body>


<section>
	<?php include("barra.php"); ?>
</section>
<section>
	<?php include("navegador_3.php");?>
</section>

<?php

include('../modelo/modelo_factura.php');
$factura = new factura();

$ApiKey = 'JmBG2ig8XUdRDvra410j0411V6';

$merchant_id = $_REQUEST['merchantId'];
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
$pseBank = $_REQUEST['pseBank'];
$lapPaymentMethod = $_REQUEST['lapPaymentMethod'];
$transactionId = $_REQUEST['transactionId'];
$extra = $_REQUEST['extra1'];
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


<section>

	<div class="container contenedor contenedor_cart">
		<div class="row " >
				<div class=" confirmar_compra col-md-6 offset-md-3" style="padding: 40px;margin-top: 60px">
				<div style="text-align: center"><h1 class="titulo_confirmar">RESUMEN TRANSACCIÓN</h1></div>
				<?php
					
					if (strtoupper($firma) == strtoupper($firmacreada)) {
							?>
							
							<table class="tabla_respuesta">
							<tr>
							<td>Estado de la transaccion</td>
							<td><?php echo $estadoTx; ?></td>
							</tr>
							<tr>
							<tr>
							<td >ID de la transaccion</td>
							<td><?php echo $transactionId; ?></td>
							</tr>
							<tr>
							<td>Referencia de la venta</td>
							<td><?php echo $reference_pol; ?></td>
							</tr>
							<tr>
							<td>Referencia de la transaccion</td>
							<td><?php echo $referenceCode; ?></td>
							</tr>
							<tr>
							<?php
							if($pseBank != null) {
							?>
								<tr>
								<td>cus </td>
								<td><?php echo $cus; ?> </td>
								</tr>
								<tr>
								<td>Banco </td>
								<td><?php echo $pseBank; ?> </td>
								</tr>
							<?php
							}
							?>
							<tr>
							<td>Valor total</td>
							<td>$<?php echo number_format($TX_VALUE); ?></td>
							</tr>
							<tr>
							<td>Moneda</td>
							<td><?php echo $currency; ?></td>
							</tr>
							<tr>
							<td>Descripción</td>
							<td><?php echo ($extra1); ?></td>
							</tr>
							<tr>
							<td>Entidad:</td>
							<td><?php echo ($lapPaymentMethod); ?></td>
							</tr>
							</table>
						<?php
						}
						else
						{
							echo $merchant_id."dfsf";
						?>

							<h1>Error validando firma digital.</h1>
						<?php
						}
						?>
				</div>
		</div>		
				
		</div>
		
    </div>
	</div>
</section>
</body>
<?php include('pie.php')?>

</html>