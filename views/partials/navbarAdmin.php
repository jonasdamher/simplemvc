<header>
	<nav class="navbar shadow-sm">
		<div class="navbar-body">
			<div class="navbar-content">
				<a href="<?= URL_BASE ?>users/profile">
					<img class="logo" src="<?= URL_BASE ?>public/img/logo-simplymvcphp.png" title="logo simplymvcphp" alt="logo simplymvcphp" />
				</a>
				<ul class="navbar-menu">
					<li class="<?= Utils::menuActive('users') ?>"><a href="<?= URL_BASE ?>users/profile">Profile</a></li>
					<li class="<?= Utils::menuActive('articles') ?>">
						<a href="<?= URL_BASE ?>articles">Articles</a>
						<button type="button" class="btn btn-dropdown"></button>
						<div class="dropdown shadow-md">
							<ul class="dropdown-body">
								<li><a href="<?= URL_BASE ?>articles/create">Create article</a></li>
								<li><a href="<?= URL_BASE ?>categories">Categories</a></li>
							</ul>
						</div>
					</li>
					<li class="<?= Utils::menuActive('mycv') ?>"><a href="<?= URL_BASE ?>mycv">MyCV</a></li>
				</ul>
			</div>
			<div class="navbar-content">
				<div class="text-light text-shadow-sm"><?= $_SESSION['userName'] ?></div>
				<span class="text-secondary separator-left">|</span>
				<a class="btn text-light text-shadow-sm" href="<?= URL_BASE ?>/users/logout">Logout</a>
			</div>
		</div>
	</nav>
</header>