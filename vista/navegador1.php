<?php 
		$menu = '';
		if(isset($_REQUEST['menu'])){
			$menu = $_REQUEST['menu'];
		}
?>
<div class="col-md-12" style="padding: 0; position: fixed; top:0; z-index: 100">
	<div class="col-md-12 navegador1">
	
<nav class="navbar navbar-expand-lg ">
  			<a class="navbar-brand nombre" href="index.php?menu=index">PALACIO HINDÚ</a>
  			<button class="navbar-toggler boton_navegador" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="fa fa-bars"></span>
			</button>
			
			<div class="collapse navbar-collapse " id="navbarSupportedContent">
				<ul class="navbar-nav ">
				  <li class="nav-item active <?php if($menu == 'index')echo 'menu_activo'; ?>">
					<a class="nav-link" href="index.php?menu=index"><img src="../img/iconos/img_inicio.png" width="30px" height="30px;">INICIO <span class="sr-only">(current)</span></a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link <?php if($menu == 'catalogo')echo 'menu_activo'; ?>" href="catalogo.php?menu=catalogo">CATALOGO</a>
				  </li>
				  <li class="nav-item <?php if($menu == 'informacion')echo 'menu_activo'; ?>">
					<a class="nav-link" href="informacion.php?menu=informacion">INFORMACIÓN</a>
				  </li>
				  <li class="nav-item <?php if($menu == 'contacto')echo 'menu_activo'; ?>">
					<a class="nav-link" href="contacto.php?menu=contacto">CONTACTO</a>
				  </li>
				   <?php 
					if (isset($_SESSION['rol'])){
						if($_SESSION['rol']==0 || $_SESSION['rol']==1){
						?>						
							  <li class="nav-item <?php if($menu == 'admin')echo 'menu_activo'; ?>">
								<a class="nav-link" href="admin/index.php">ADMIN</a>
							  </li>
						<?php
						}
					}else{
						
					}
				  ?>
				  
				  <?php 
					if (isset($_SESSION['rol'])){
						if($_SESSION['rol']==2){
						?>						
							  <li class="nav-item <?php if($menu == 'mis_compras')echo 'menu_activo'; ?>">
								<a class="nav-link" href="mis_compras.php?menu=mis_compras">MIS COMPRAS</a>
							  </li>
						<?php
						}
					}else{
						
					}
				  ?>
				  
				</ul>
			</div>
</nav>

</div>
</div>

