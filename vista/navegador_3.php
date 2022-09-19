<header>
<div class="col-md-12" style="padding: 0; margin :0">
<div class="menu col-md-12 navegador3">
<div class="container" style="padding: 0">
<nav class=" navbar navbar-expand-lg" style="padding-left: 0">
  			<a class="navbar-brand nombre2"  href="index.php?menu=index">PALACIO HINDÚ</a>
  			<button class="navbar-toggler boton_navegador" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="fa fa-bars"></span>
			</button>
			
			<div class="collapse navbar-collapse " id="navbarSupportedContent">
			<div class="col-md-8" style="padding: 0">
				<ul class="navbar-nav <?php if($menu == 'index')echo 'menu_activo'; ?>">
				  <li class="nav-item active">
					<a class="nav-link" href="index.php?menu=index"><img src="../img/iconos/img_inicio.png" width="30px" height="30px;">INICIO <span class="sr-only">(current)</span></a>
				  </li>
				  <li class="nav-item <?php if($menu == 'catalogo')echo 'menu_activo'; ?>">
					<a class="nav-link" href="catalogo.php?menu=catalogo">CATALOGO</a>
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
			<?php if($menu == 'catalogo') 
	?>
			<div class="col-md-4" style="padding: 0" >
				<input type="text" class="busqueda" placeholder="Búsqueda del producto" value="<?php if (isset($_GET['producto'])){echo($_GET['producto']);} ?>" id="busqueda" oninput="cargar_catalogo(1)">
			</div>
			<?php
			?>
			
			<?php if($menu == 'mis_compras') echo ' 
			<div class="col-md-4" style="padding: 0" >
				<input type="text" class="busqueda" placeholder="Búsqueda por fecha" id="busqueda" oninput="cargarTabla(1)">
			</div>'
			?>
			</div>
</nav>
</div>
</div>
</div>
</header>