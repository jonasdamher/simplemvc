<?php include 'views/includes/navbar.php'; ?>
<section class="container">
	<div class="row j-center">
		<h1 class="h1">Article</h1>
	</div>
	<section class="row j-center">
		<div class="card card-form bg-light shadow-md">
			<div class="card-body">
				<div class="form">
					<div class="form-input">
						<label class="label" for="title">Title</label>
						<input type="text" name="title" id="title" class="input" required />
					</div>
					<div class="form-input">
						<label class="label" for="description">Description</label>
						<input type="text" name="description" id="description" class="input" />
					</div>
					<div class="form-input">
						<textarea name="editor textarea" id="editor" rows="10" col="80">
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
					<div class="form-input">
						<label class="label" for="tags">Add tags</label>
						<input type="text" name="tags" id="tags" class="input" />
					</div>
					<div id="tags-list" class="d-flex f-wrap w-100"></div>
					<button type="button" id="btn-create-article" class="btn btn-primary shadow-sm">Create</button>
				</div>
			</div>
		</div>
	</section>
	<div class="row j-center">
		<p class="text-danger p"><?= $this->getResponseModel() ?></p>
	</div>
</section>