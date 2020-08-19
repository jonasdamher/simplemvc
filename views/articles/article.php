<?php include 'views/includes/navbar.php'; ?>
<section class="container">
	<div class="row j-center">
		<h1 class="h1"><?= $article['title'] ?></h1>
	</div>
	<section class="row j-center">
		<div class="card card-form bg-light shadow-md">
			<div class="card-body">
				<p><?= $article['description'] ?></p>
				<?= $article['main'] ?>
				<p class="p"><?= $article['createAt'] ?></p>
				<p class="p"><?= $article['categoryName'] ?></p>
				<p class="p"><?= $article['user'] ?></p>
				<p class="p">tags</p>
				<!-- tags -->
				<?php if ($tags['success']) { ?>
					<?php foreach ($tags['result'] as $tag) { ?>
						<p><?= $tag['name'] ?></p>
					<?php } ?>
				<?php } ?>
				<!-- end tags -->
			</div>
		</div>
	</section>
</section>