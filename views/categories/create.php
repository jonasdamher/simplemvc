<div class="container">
	<div class="row j-center">
		<h1 class="h1">Category</h1>
	</div>
	<div class="row f-column items-center">
		<div class="card bg-light shadow-md">
			<div class="card-body">
				<form class="form" action="<?= URL_BASE ?>categories/create" method="post">
					<div class="form-input">
						<label class="label" for="name">name</label>
						<input type="text" name="name" id="name" class="input" required />
					</div>
					<button type="submit" class="btn btn-orange shadow-sm">Create</button>
				</form>
			</div>
		</div>
		<p class="text-danger p"><?= $this->getResponseModel() ?></p>
	</div>
</div>