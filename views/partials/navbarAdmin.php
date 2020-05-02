<header>
	<nav class="navbar shadow-sm">
		<div class="navbar-body">
			<div class="navbar-content">
				<a href="<?= URL_BASE ?>users/profile">
					<img class="logo" src="<?= URL_BASE ?>public/img/logo-simplymvcphp.png" title="logo simplymvcphp" alt="logo simplymvcphp" />
				</a>
				<ul class="navbar-menu">
					<li class="<?= Utils::menuActive('users') ?>"><a href="<?= URL_BASE ?>users/profile">Profile</a></li>
					<li class="<?= Utils::menuActive('articles') ?>"><a href="<?= URL_BASE ?>articles/create">Create article</a></li>
					<li class="<?= Utils::menuActive('mycv') ?>"><a href="<?= URL_BASE ?>mycv">MyCV</a></li>
				</ul>
			</div>
			<a class="btn text-shadow-sm" href="<?= URL_BASE ?>/users/logout">Logout</a>
		</div>
	</nav>
</header>