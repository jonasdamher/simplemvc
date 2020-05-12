<div class="container">
	<div class="row j-center">
		<h1 class="h1">Article</h1>
	</div>
	<div class="row j-center">
		<div class="card card-form bg-light shadow-md">
			<div class="card-body">
				<form class="form" action="<?= URL_BASE ?>articles/create" method="post">
					<div class="form-input">
						<label class="label" for="title">Title</label>
						<input type="text" name="title" id="title" class="input" required />
					</div>
					<div class="form-input">
						<label class="label" for="description">Description</label>
						<input type="text" name="description" id="description" class="input" />
					</div>
					<div class="form-input">
						<textarea name="editor" id="editor" rows="10" col="80">
						</textarea>
					</div>
					<div class="form-input">
						<label class="label" for="idCategory">Category</label>
						<select name="idCategory" id="idCategory" class="input">
							<option value="0">-Select category-</option>
							<?php
							if ($categories['success']) {
								foreach ($categories['result'] as $category) { ?>
									<option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
							<?php }
							} ?>
						</select>
					</div>

					<button type="submit" class="btn btn-orange shadow-sm">Create</button>
				</form>
			</div>
		</div>
	</div>
	<div class="row j-center">
		<p class="text-danger p"><?= $this->getResponseModel() ?></p>
	</div>
</div>
<script>
	CKEDITOR.replace('editor');
</script>