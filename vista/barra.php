<?php 
		$menu = '';
		if(isset($_REQUEST['menu'])){
			$menu = $_REQUEST['menu'];
		}
?>

<div class="container barra">
	<div class="row">
		<div class="col-md-4" >
			<a class="icono" href="https://www.facebook.com/epalacio.hindu" title="Visitanos en Facebook" target="_blank"><span class="fab fa-facebook-f"></span></a>
			<a class="icono" href="#" style="text-decoration: none; cursor: none;"><span class="fab fa-whatsapp"></span> +57 3215605690</a>
		</div>
		<div class="col-md-4 " align="center"><h1 class="nombre1"><?php if($menu != 'index') echo 'PALACIO HINDÚ';?></h1></div>
		<div class="col-md-4" align="right" >
			<?php 
			if (isset($_SESSION['documento'])){
				?>
				<a class="boton_barra" href="perfil.php"><?php echo($_SESSION['nombre'])?></a>
				<a class="boton_barra" href="cerrar_sesion.php">Cerrar sesión</a>
				<?php 
					if (isset($_SESSION['rol'])){
						if($_SESSION['rol']==0 || $_SESSION['rol']==1){
						?>						
							  
						<?php
						}else{
						?>
							<a href="cart.php"><img src="../img/iconos/carrito.png"><span class="badge badge-danger badge-pill" id="addom"></span></a> 						
							 
						<?php
						}
					}else{
						
					}
				  ?>
				
				<?php
			}else{
				?>
				<a class="boton_barra <?php if($menu == 'registrarse')echo 'boton_barra_activo'; ?>"  href="registrarse.php?menu=registrarse">Registrarse</a>
				<a class="boton_barra" data-toggle="modal" data-target="#exampleModal">Iniciar sesión</a>
				<?php
			}
			?>
			
			
			
			
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade contenedor modal" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Iniciar Sesión</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div id="alerta_sesion"></div>
       <form action="../controlador/controlador_usuarios.php" id="sesion_usua" method="post">
       <input type="hidden" id="operador" name="operador" value="sesion">
        <div class="col-md-12" >
				
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4"  align="right">
								<label >Usuario</label></div>
							<div class="col-md-8" style="padding: 0">
								<input type="text" class="input_text" id="usuario" name="usuario">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4"  align="right">
								<label >Contraseña</label></div>
							<div class="col-md-8" style="padding: 0">
								<input type="password" class="input_text" id="pass" name="pass">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-12" style="padding: 0">
								<button type="submit" class="boton_iniciar" id="iniciar">Iniciar sesión</button>
							</div>
						</div>
					</div>
					
					<div class="col-md-12" align="center" style="padding: 0; padding-top: 30px; ">
						<img src="../img/iconos/imagen_sesion.png">
						<p>En el palacio Hindú, encuentras todo lo que necesitas para estar bien y mejorar tu vida. Tenemos grandes recursos para satisfacer sus necesidades.</p>
					</div>
						
				
			</div>
     </form>
      </div>
      
    </div>
  </div>
</div>