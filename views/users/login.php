<div class="container">
	<div class="row j-center">
		<h1 class="h1">Login</h1>
	</div>
	<div class="row f-column items-center">
		<div class="card bg-light shadow-md">
			<div class="card-body">
				<form class="form" action="<?= URL_BASE ?>login" method="post">
					<div class="form-input">
						<label class="label" for="email">Email</label>
						<input type="email" name="email" id="email" class="input" value="<?= Utils::postValue('email') ?>" required />
					</div>
					<div class="form-input">
						<label class="label" for="password">Password</label>
						<input type="password" name="password" id="password" class="input" value="<?= Utils::postValue('password') ?>" required />
					</div>
					<button type="submit" class="btn btn-orange shadow-sm">Access</button>
				</form>
			</div>
		</div>
		<p class="text-danger p"><?= $this->getResponseModel() ?></p>
	</div>
</div>