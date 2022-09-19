<?php 
		$menu = '';
		if(isset($_REQUEST['menu'])){
			$menu = $_REQUEST['menu'];
		}
	?>

<nav class=" navbar navbar-expand-lg navbar-light bg-light" style="background: rgba(32,41,63,1.00)!important; color: white;">
  <a class="navbar-brand titulo" href="../index.php?menu=index">Palacio Hindú</a>
  <button class="navbar-toggler boton_desplegable1"type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" style="padding-top: 5px;" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto " >
     <?php if($_SESSION['rol']==0){?>
      <li class="nav-item letra_blanca <?php if($menu == 'panel_control')echo 'active_1'; ?>">
        <a class="nav-link" style="color: white!important" href="panel_control.php?menu=panel_control">Panel de control</a>
      </li>
      <li class="nav-item">
        <a class="nav-link letra_blanca <?php if($menu == 'configuracion')echo 'active_1'; ?> " href="configuracion.php?menu=configuracion" style="color: white!important">Configuración</a>
      </li>
      <?php }?>
    </ul>
    <div class="btn-group">
  
    <div class="form-inline dropdown" style="padding-right: 60px; padding-left: 5px" >
    	<?php echo($_SESSION['nombre'])?> <span style="padding-left: 5px"  class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><span class="fa fa-user-circle"></span><!--<img src="" class="logo_circle" >--></span>
    	
    	<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
			<a class="dropdown-item letra_cerrar" href="perfil.php" >Perfil</a>
			<a class="dropdown-item letra_cerrar" href="cerrar_sesion.php" >Cerrar</a>
		</div>
    </div>
  </div>
</nav>