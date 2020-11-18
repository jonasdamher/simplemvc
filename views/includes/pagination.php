<div class="row">
	<div class="col-12 d-flex j-end pb-1">
		<section class="pagination">
			<div class="pagination-body">
				<nav role="navigation" aria-label="Pagination Navigation">
					<ul>
						<?php foreach ($pagination['pagination'] as $page) { ?>
							<li>
								<a class="<?= $page['active'] ? 'active' : '' ?><?= $page['disabled'] ? ' disabled' : '' ?>" <?= $page['active'] ? 'aria-current="true"' : '' ?> aria-label="<?= $page['active'] ? 'Current page, Page ' . $page['page'] : 'Go to page ' . $page['page'] ?>" title="<?= $page['active'] ? 'Current page, page ' . $page['page'] : 'Go to page ' . $page['page'] ?>" <?= (!empty($page['rel']) ? 'rel="' . $page['rel'] . '"' : '') ?> href="<?= URL_BASE . 'articles?page=' . $page['page'] . '&limit=' . $limit ?>">
									<?= $page['page'] ?>
								</a>
							</li>
						<?php } ?>
					</ul>
				</nav>
			</div>
		</section>
	</div>
	<div class="col-12 d-flex j-end">
		<p>Page <?= $pagination['current'] ?> of <?= $pagination['pages'] ?></p>
	</div>
</div>