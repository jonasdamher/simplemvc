<?php include 'views/includes/navbar.php'; ?>
<div class="container">
	<div class="row j-center">
		<div class="card card-form bg-light shadow-md">
			<div class="card-body">
				<div class="d-flex j-between pb-1 mb-1 border-bottom">
					<h1>Categories</h1>
					<button type="button" class="btn btn-primary btn-modal-new shadow-sm">New category</button>
				</div>
				<?php if ($categories['success']) { ?>
					<div class="table-responsive">
						<table id="table-categories" class="table">
							<thead>
								<tr>
									<th>Name</th>
									<th>Created</th>
									<th>Last update</th>
									<th colspan="2">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($categories['result'] as $category) { ?>
									<tr data-id="<?= $category['id'] ?>">
										<td><?= $category['name'] ?></td>
										<td><?= $category['createAt'] ?></td>
										<td><?= is_null($category['updateAt']) ? 'None' :  $category['updateAt']  ?></td>
										<td><button type="button" class="btn btn-light">Update</button></td>
										<td><button type="button" class="btn btn-light text-danger btn-modal-remove">Remove</button></td>
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
	</div>
</div>
<!-- MODAL NEW -->
<div id="modal-new" class="modal">
	<div class="modal-content">
		<div class="modal-card bg-light">
			<div class="modal-header border-bottom">
				<p class="text-bold">New category</p>
				<button type="button" class="btn text-secondary text-bold btn-close-modal btn-square" title="Close modal"><i class="fas fa-times"></i></button>
			</div>
			<div class="modal-body">
				<form class="form" action="<?= URL_BASE ?>categories" method="post">
					<div class="form-input">
						<label class="label" for="name">name</label>
						<input type="text" name="name" id="name" class="input" required />
					</div>
					<button type="submit" class="btn btn-primary shadow-sm">Create</button>
				</form>
			</div>
		</div>
		<p id="error-request-new" class="d-none"><?= $this->getResponseModel() ?></p>
	</div>
</div>
<!-- MODAL REMOVE -->
<div id="modal-remove" class="modal">
	<div class="modal-content">
		<div class="modal-card bg-light">
			<div class="modal-header">
				<p class="text-bold">Remove category</p>
				<button type="button" class="btn text-secondary text-bold btn-close-modal btn-square" title="Close modal"><i class="fas fa-times"></i></button>
			</div>
			<div class="modal-body">
				<form class="form">
					<div class="mb-1">
						<p class="p">Category: <span id="text-category-remove"></span></p>
					</div>
					<div class="d-flex j-between">
						<button type="button" class="btn btn-light shadow-sm btn-close-modal">Discard</button>
						<button type="button" id="btn-remove-category" class="btn btn-primary shadow-sm">Remove</button>
					</div>
				</form>
			</div>
		</div>
		<p id="request-success-remove" class="d-none request-success"></p>
		<p id="error-request-remove" class="d-none"></p>
	</div>
</div>