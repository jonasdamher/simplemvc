<section class="navbar-content">
	<a href="<?= URL_BASE ?>home">
		<img class="logo" src="<?= URL_BASE ?>public/images/logo/jonasdamher.png" title="logo" alt="logo" />
	</a>
	<ul class="navbar-menu">
		<li class="<?= Utils::menuActive('home') ?>"><a href="<?= URL_BASE ?>home"><span><i class="fas fa-home"></i></span>Home</a></li>
		<li class="<?= Utils::menuActive('articles') ?>"><a href="<?= URL_BASE ?>articles"><span><i class="fas fa-tags"></i></span>Articles</a></li>
	</ul>
</section>
<section class="navbar-content">
	<form action="<?= URL_BASE ?>articles/search" method="get">
		<ul class="navbar-menu m-0">
			<li class="m-0">
				<label for="search" title="Search">
					<button type="<?= (empty(Utils::getValue('q')) ? 'button' : 'submit') ?>" id="btn-search" class="btn btn-secondary btn-square" title="Search" data-toggle="close">
						<i class="fas fa-search fa-lg"></i>
					</button>
				</label>
				
				<input type="search" id="search" name="q" class="input <?= (empty(Utils::getValue('q')) ? 'd-none' : '') ?>" placeholder="Search..." value="<?= (empty(Utils::getValue('q')) ? '' : Utils::getValue('q')) ?>" />

				<button type="button" id="btn-quit-search" class="btn btn-secondary btn-square <?= (empty(Utils::getValue('q')) ? 'd-none' : '') ?>" title="Search quit">
					<i class="fas fa-times fa-lg"></i>
				</button>

			</li>
		</ul>
	</form>
</section>