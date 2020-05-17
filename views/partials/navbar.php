<header>
	<nav class="navbar">
		<div class="navbar-body">
			<div class="navbar-content">
				<a href="<?= URL_BASE ?>home">
					<img class="logo" src="<?= URL_BASE ?>public/img/logo-simplymvcphp.png" title="logo simplymvcphp" alt="logo simplymvcphp" />
				</a>
				<ul class="navbar-menu">
					<li class="<?= Utils::menuActive('home') ?>"><a href="<?= URL_BASE ?>home">Home</a></li>
					<li class="<?= Utils::menuActive('articles') ?>"><a href="<?= URL_BASE ?>articles">Articles</a></li>
					<li class="<?= Utils::menuActive('mycv') ?>"><a href="<?= URL_BASE ?>mycv">MyCV</a></li>
				</ul>
			</div>
			<a class="btn btn-orange shadow-sm" href="<?= URL_BASE ?>login">Login</a>
		</div>
	</nav>
</header>