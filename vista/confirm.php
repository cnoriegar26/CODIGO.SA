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

<section>

	<?php
				include('../modelo/payu.php');
				$paydata=new payu;
				$fecha=date('y-m-d-h-i-s');
				$pay=$paydata->trer_valores();
				$api='JmBG2ig8XUdRDvra410j0411V6';
				$mechanid='728662';
				$acountid='733626';
				
				$referencia='pago#_'.$fecha.'_'.$pay['codigo'];
				$refe=$api."~".$mechanid."~".$referencia."~".$pay['total'].'~COP';
				//echo($refe);
				$signature=md5($api."~".$mechanid."~".$referencia."~".$pay['total'].'~COP');
				
				//$signature=md5('4Vj8eK4rloUd272L48hsrarnUA~508029~'.$referencia.'~50000~COP')	
	?>

	<div class="container contenedor contenedor_cart">
		<div class="row " >
				<div class=" confirmar_compra col-md-6 offset-md-3" style="padding: 40px;margin-top: 60px">
				<div style="text-align: center"><h1 class="titulo_confirmar">Descripción de la compra</h1></div>
				<p class="text_confirmar">
					Codigo de refencia del pago por PAYU: <?php echo($referencia);?>.</p>
				<p class="text_confirmar">Factura de compra palacio hindú numero: <?php echo($pay['codigo']);?>.</p>
				<p class="text_confirmar">Total del valor de los productos es de $<?php echo($pay['total']-10000);?> pesos Colombianos.</p>
				<p class="text_confirmar">Todos sus productos seran enviados en los siguientes 3 dias habiles, el valor del envio es de $10000 pesos colombianos.</p>
				<p class="text_confirmar">El valor total de la compra es de $<?php echo($pay['total']);?> pesos Colombianos.</p>
												
					<form method="post" action="https://gateway.payulatam.com/ppp-web-gateway/">
					  <input name="merchantId" type="hidden"  value="<?php echo($mechanid); ?>"   >
					  <input name="accountId"     type="hidden"  value="<?php echo ($acountid); ?>" >
					  <input name="description"   type="hidden"  value="pago de una compra por internet"  >
					  <input name="referenceCode" type="hidden"  value="<?php echo($referencia); ?>" >
					  <input name="amount"        type="hidden"  value="<?php echo($pay['total']); ?>"   >
					  <input name="tax"           type="hidden"  value="0"  >
					  <input name="taxReturnBase" type="hidden"  value="0" >
					  <input name="currency"      type="hidden"  value="COP" >
					  <input name="signature"     type="hidden"  value="<?php echo($signature); ?>"  >
					  <input name="test"          type="hidden"  value="1" >
					  <input name="buyerEmail"    type="hidden"  value="<?php echo($pay['mail']); ?>" >
					  <input name="responseUrl"    type="hidden"  value="http://www.elpalaciohindu.com/vista/respuesta.php">
					  <input name="confirmationUrl"    type="hidden"  value="http://www.elpalaciohindu.com/modelo/respuesta.php" >
					  <input name="extra1" type="hidden"  value="<?php echo($pay['codigo']); ?>" >
					  <input name="extra2" type="hidden"  value="<?php echo($fecha); ?>" >
					 <button type="submit" class="boton_iniciar">CONFIRMAR COMPRA</button>
					<div style="margin-top: 10px"></div>
					 <button type="button" class="boton_iniciar" onClick="redirect()">REGRESAR AL CARRITO DE COMPRAS</button>
					</form>
					
				</div>
		</div>		
				
		</div>
		
    </div>
	</div>
</section>
</body>
<?php include("pie.php"); ?>
<script>
	function redirect(){
		window.location.href='cart.php'
	}
	
</script>
</html>
