<section class="navbar-content">
	<a href="<?= URL_BASE ?>home">
		<img class="logo" src="<?= URL_BASE ?>public/img/logo-simplymvcphp.png" title="logo" alt="logo" />
	</a>
	<ul class="navbar-menu">
		<li class="<?= Utils::menuActive('home') ?>"><a href="<?= URL_BASE ?>home"><span><i class="fas fa-home"></i></span>Home</a></li>
		<li class="<?= Utils::menuActive('articles') ?>"><a href="<?= URL_BASE ?>articles"><span><i class="fas fa-tags"></i></span>Articles</a></li>
	</ul>
</section>
<section class="navbar-content">
	<ul class="navbar-menu m-0">
		<li class="m-0">
			<button type="button" class="btn btn-square" title="Search"><i class="fas fa-search fa-lg"></i></button>
			<input type="search" id="search" class="input" placeholder="Search..." />
		</li>
	</ul>
</section>