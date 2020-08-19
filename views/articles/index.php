<?php include 'views/includes/navbar.php'; ?>
<section class="container">
	<div class="row">
		<h1 class="h1">Articles</h1>
	</div>
	<section class="row">
		<?php
		if($articles['success']){
		foreach ($articles['result'] as $article) { ?>
			<article class="card bg-light shadow-md">
				<div class="card-body">
					<p class="card-text-lead"><a href="<?= URL_BASE.'articles/get/'.$article['urlName'] ?>"><?= $article['title'] ?></a></p>
					<p><?= $article['description'] ?></p>
				</div>
			</article>
		<?php } 
		}else { ?>
			<p><?= $this->getResponseModel() ?></p>
		<?php } ?>
	</section>
</section>