<header>
		<div class="navegador" style="margin-top: 20px; margin-bottom: 20px; padding-top: 0.5%">
			<nav class="menu navbar navbar-expand-lg">
			<div class="container" style="padding: 0;">
			<div class="col-md-12" style="padding: 0">	
		  	<ul class="navbar-nav justify-content-center" >
				  <li class="nav-item active <?php if($menu == 'index')echo 'menu_activo'; ?>">
					<a class="nav-link" href="index.php?menu=index"><img src="../img/iconos/img_inicio.png" width="30px" height="30px;">INICIO <span class="sr-only">(current)</span></a>
				  </li>
				  <li class="nav-item <?php if($menu == 'catalogo')echo 'menu_activo'; ?>">
					<a class="nav-link" href="catalogo.php?menu=catalogo">CATALOGO</a>
				  </li>
				  <li class="nav-item <?php if($menu == 'informacion')echo 'menu_activo'; ?>">
					<a class="nav-link " href="informacion.php?menu=informacion">INFORMACIÓN</a>
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
				  
				  
			</ul></div>
			</div>
			</nav>
		</div>
</header>