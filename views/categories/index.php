<div class="container">
	<div class="row">
		<h1 class="h1">Categories</h1>
	</div>
	<div class="row">
		<div class="card bg-light shadow-md">
			<div class="card-body">
				<form class="form" action="<?= URL_BASE ?>categories" method="post">
					<div class="form-input">
						<label class="label" for="name">name</label>
						<input type="text" name="name" id="name" class="input" required />
					</div>
					<button type="submit" class="btn btn-orange shadow-sm">Create</button>
				</form>
			</div>
		</div>
	</div>
	<div class="row">
		<p class="text-danger p"><?= $this->getResponseModel() ?></p>
	</div>
	<div class="row">
		<?php if ($categories['success']) { ?>
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th colspan="2">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($categories['result'] as $category) { ?>
							<tr data-id="<?= $category['id'] ?>">
								<th><?= $category['id'] ?></th>
								<td><?= $category['name'] ?></td>
								<td><button type="button" class="btn">Update</button></td>
								<td><button type="button" class="btn text-danger btn-modal-delete">Delete</button></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		<?php } else { ?>
			<p class="p"><?= $categories['message'] ?></p>
		<?php } ?>
	</div>
</div>

<div id="modal-delete" class="modal">
	<div class="modal-content">
		<div class="modal-card bg-light">
			<div class="modal-header">
				<p class="text-bold">Delete category</p>
				<button type="button" class="btn text-secondary text-bold btn-close-modal" title="Close modal">X</button>
			</div>
			<div class="modal-body">
				<form class="form">
					<p class="p">Delete category</p>
					<button type="button" class="btn btn-orange shadow-sm">Delete</button>
				</form>
			</div>
		</div>
	</div>
</div>