<section class="navbar-content">
	<a href="<?= URL_BASE ?>users/profile">
		<img class="logo" src="<?= URL_BASE ?>public/images/logo/launcher-1.webp" title="logo simplymvcphp" alt="logo simplymvcphp" />
	</a>
	<ul class="navbar-menu">
		<li class="<?= Utils::menuActive('users') ?>"><a href="<?= URL_BASE ?>users/profile">Profile</a></li>
		<li class="<?= Utils::menuActive('articles') ?>">
			<div class="d-flex items-center">
				<a href="<?= URL_BASE ?>articles">Articles</a>
				<button type="button" class="btn btn-square btn-dropdown" title="dropdown">
					<i class="fas fa-caret-down"></i>
				</button>
			</div>
			<div class="dropdown shadow-md">
				<ul class="dropdown-body">
					<li><a href="<?= URL_BASE ?>articles/create">Create article</a></li>
					<li><a href="<?= URL_BASE ?>categories">Categories</a></li>
				</ul>
			</div>
		</li>
		<li class="<?= Utils::menuActive('mycv') ?>"><a href="<?= URL_BASE ?>mycv">MyCV</a></li>
	</ul>
</section>
<section class="navbar-content">
	<div class="text-shadow-sm"><?= $_SESSION['userName'] ?></div>
	<span class="text-secondary separator-left">|</span>
	<a class="btn btn-square text-shadow-sm" href="<?= URL_BASE ?>users/logout?token=<?= $_SESSION['_token'] ?>">Logout</a>
</section>