<div class="navegador2 col-md-1" style="height: auto!important" >
	
	<div class="d-sm-block d-md-none navbar-light" align="right" style="margin-top: 5px; margin-bottom: 5px; padding-right: 15px ">	
		<button class="navbar-toggler boton_desplegable2"type="button" data-toggle="collapse" href="#desplegable" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    	<span class="navbar-toggler-icon"></span>
  		</button>
  	</div>
  	
  	<?php 
		if (isset($_SESSION['rol'])){
			if($_SESSION['rol']==0 || $_SESSION['rol']==1){
			
			}else{
				header("location: ../index.php?menu=index");
			}
		}else{
			header("location: ../index.php?menu=index");
		}
	  ?>
	
	<div class="collapse show" id="desplegable" align="center" >
		<ul class="margen nav flex-column" >
			
			<li class="menu2  nav-item" >
				<a class="  nav-link "  href="../index.php?menu=index"style="padding: 25px">HOME</a>
			</li>
			<?php if($_SESSION['rol']==0){?>
			<li class="menu2 nav-item" >
				<a class="nav-link <?php if($menu == 'usuario')echo 'active_2'; ?>" href="usuario.php?menu=usuario"><span class="fa fa-users fa-2x"></span><br> Usuario</a>
			</li>
			<?php }?>
				<?php if($_SESSION['rol']==0){?>
			<li class="menu2 nav-item" >
				<a class="nav-link <?php if($menu == 'compra')echo 'active_2'; ?>" href="compra.php?menu=compra"><span class="far fa-money-bill-alt fa-2x"></span><br> Compras</a>
			</li>
			<?php }?>
			<li class="menu2 nav-item" >
				<a class=" nav-link <?php if($menu == 'factura')echo 'active_2'; ?>" href="factura.php?menu=factura" ><span class="fa fa-th-list fa-2x"></span><br> Factura</a>
			</li>
			
			<li class="menu2 nav-item" >
				<a class=" nav-link <?php if($menu == 'pedidos')echo 'active_2'; ?>" href="pedidos.php?menu=pedidos" ><span class="fas fa-shopping-cart fa-2x"></span><br> Pedidos <span class="badge badge-warning" id="numero">0</span></a>
			</li>
			
			<?php if($_SESSION['rol']==0){?>
			<li class="menu2 nav-item">
				<a class=" nav-link <?php if($menu == 'producto')echo 'active_2'; ?>" href="producto.php?menu=producto"><span class="fab fa-product-hunt fa-2x"  ></span><br> Productos</a>
			</li>
			<?php }?>
			<?php if($_SESSION['rol']==0){?>
			<li class="menu2 nav-item">
				<a class=" nav-link <?php if($menu == 'inventario')echo 'active_2'; ?>" href="inventario.php?menu=inventario"><span class="fa fa-clipboard fa-2x"></span><br> Inventario</a>
			</li>
			<?php }?>
			<?php if($_SESSION['rol']==0){?>
			<li class="menu2 nav-item">
				<a class=" nav-link <?php if($menu == 'proveedor')echo 'active_2'; ?>" href="proveedor.php?menu=proveedor"><span class="fa fa-handshake fa-2x" ></span><br> Proveedores</a>
			</li>
			<?php }?>
			<li class="menu2 nav-item">
				<a class=" nav-link <?php if($menu == cliente)echo 'active_2'; ?>" href="cliente.php?menu=cliente"><span class="fa fa-user-circle fa-2x"></span><br> Clientes</a>
			</li>
			<?php if($_SESSION['rol']==0){?>
			<li class="menu2 nav-item">
				<a class=" nav-link <?php if($menu == 'reporte')echo 'active_2'; ?>" href="reporte.php?menu=reporte"><span class="fa fa-chart-pie fa-2x"  ></span><br> Reportes</a>
			</li>
			<?php }?>
			<?php if($_SESSION['rol']==0){?>
			<li class="menu2 nav-item">
				<a class=" nav-link <?php if($menu == 'backup')echo 'active_2'; ?>" href="backup.php?menu=backup"><span class="fa fa-cloud-download-alt fa-2x" ></span><br> Copia de seguridad</a>
			</li>
			<?php }?>
		</ul>
	</div>
</div>


