<?php include 'views/includes/navbar.php'; ?>
<div class="container">
	<div class="row">
		<h1 class="h1">Articles</h1>
	</div>
	<div class="row">
		<?php
		if($articles['success']){
		foreach ($articles['result'] as $article) { ?>
			<article class="card bg-light shadow-md">
				<div class="card-body">
					<p><?= $article['name'] ?></p>
				</div>
			</article>
		<?php } 
		}else { ?>
			<p><?= $this->getResponseModel() ?></p>
		<?php } ?>
	</div>
</div>