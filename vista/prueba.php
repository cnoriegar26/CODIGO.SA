<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<link rel="stylesheet" href="../css/general_index.css">
</head>

<body>
	<p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p>
	<header>
		<div class="contenedor">
			<div class="logo">
				<img src="http://dummyimage.com/200x100/000/fff&text=LOGO" alt="">
			</div>
			<nav class="menu">
				<ul>
					<li><a href="#">Inicio</a></li>
					<li><a href="#">Blog</a></li>
					<li><a href="#">Proyectos</a></li>
					<li><a href="#">Trabajos</a></li>
					<li><a href="#">Contacto</a></li>
				</ul>
			</nav>
		</div>
	</header>
	<p>lorem adsai</p><br>
	<p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br><p>lorem adsai</p><br>
</body>
<script src="../js/jquery-3.3.1.min.js"></script>
<script type="application/javascript">
$(document).ready(function(){
	var altura = $('.menu').offset().top;
	
	$(window).on('scroll', function(){
		if ( $(window).scrollTop() > altura ){
			$('.menu').addClass('menu-fixed');
		} else {
			$('.menu').removeClass('menu-fixed');
		}
	});
 
});
</script>

</html>