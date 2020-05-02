<div class="container">
	<div class="row">
		<h1 class="h1">Articles</h1>
	</div>
	<div class="row">
	<?php foreach($articles['result'] as $article){?>	
	<p><?= $article['name']?></p>
	<?php } ?>

	</div>
</div>