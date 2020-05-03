<div class="container">
	<div class="row">
		<h1 class="h1">Article</h1>
	</div>
	<div class="row">
		<div class="card bg-light shadow-md">
			<div class="card-body">
				<form class="form" action="<?= URL_BASE ?>articles/create" method="post">
					<div class="form-input">
						<label class="label" for="name">name</label>
						<input type="text" name="name" id="name" class="input" required />
					</div>
					<div class="form-input">
						<label class="label" for="price">price</label>
						<input type="text" name="price" id="price" class="input" value="00.00" pattern="[0-9]{2,}+[.]+[0-9]{2,}" />
					</div>
					<button type="submit" class="btn btn-orange shadow-sm">Create</button>
				</form>
			</div>
		</div>
	</div>
</div>