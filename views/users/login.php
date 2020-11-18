<section class="container">
	<div class="row j-center">
		<h1 class="h1">Login</h1>
	</div>
	<section class="row j-center">
		<div class="card bg-light shadow-md">
			<div class="card-body">
				<form class="form" action="<?= URL_BASE ?>login" method="post">
					<div class="form-input">
						<label class="label" for="email">Email</label>
						<input type="email" name="email" id="email" class="input" value="<?= Utils::postValue('email') ?>" autocomplete="email" required />
					</div>
					<div class="form-input">
						<label class="label" for="password">Password</label>
						<input type="password" name="password" id="password" class="input" value="<?= Utils::postValue('password') ?>" autocomplete="off" required />
					</div>
					<input type="hidden" name="token" value="<?= $token ?>" autocomplete="off" required />
					<button type="submit" class="btn btn-primary shadow-sm">Access</button>
				</form>
			</div>
		</div>
	</section>
	<?php include 'views/includes/snackbar.php'; ?>
</section>