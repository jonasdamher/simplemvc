<header>
	<nav class="navbar">
		<section class="navbar-body">
			<?php
			/**
			 * Incluye una barra de navegación distinta si estás iniciado sesión o no
			 */
			include 'navbar/' . (empty($_SESSION) ? 'default' : 'admin') . '.php';
			?>
		</section>
	</nav>
</header>