<?php
if ($articles['success']) {
	foreach ($articles['result'] as $article) { ?>
		<article class="card bg-light shadow-md mw-card">
			<div class="card-body">
				<p class="card-text-lead"><a href="<?= URL_BASE . 'articles/' . $article['urlName'] ?>"><?= $article['title'] ?></a></p>
				<p><?= $article['description'] ?></p>
				<p><?= $article['user'] ?></p>
				<a href="categories/get/<?= $article['idCategory'] ?>"><?= $article['categoryName'] ?></a>
				<p><?= $article['createAt'] ?></p>
			</div>
		</article>
	<?php }
} else { ?>
	<p><?= $this->getResponseModel() ?></p>
<?php } ?>