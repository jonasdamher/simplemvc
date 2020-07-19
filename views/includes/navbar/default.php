<header>
	<nav class="navbar">
		<div class="navbar-body">
			<div class="navbar-content">
				<a href="<?= URL_BASE ?>home">
					<img class="logo" src="<?= URL_BASE ?>public/img/logo-simplymvcphp.png" title="logo simplymvcphp" alt="logo simplymvcphp" />
				</a>
				<ul class="navbar-menu">
					<li class="<?= Utils::menuActive('home') ?>"><a href="<?= URL_BASE ?>home"><span><i class="fas fa-home"></i></span>Home</a></li>
					<li class="<?= Utils::menuActive('articles') ?>"><a href="<?= URL_BASE ?>articles"><span><i class="fas fa-tags"></i></span>Articles</a></li>
					<li class="<?= Utils::menuActive('articles') ?>"><button type="button" class="btn"><i class="fas fa-search fa-lg"></i></button></li>
				</ul>
			</div>
		</div>
	</nav>
</header>