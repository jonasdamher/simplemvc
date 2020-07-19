<?php if ($this->getResponseModel()) { ?>
	<div class="snackbar shadow-sm">
		<div class="snackbar-body">
			<p><?= $this->getResponseModel() ?></p><button type="button" class="btn text-danger ml-2 btn-snackbar-close" title="close">X</button>
		</div>
	</div>
<?php } ?>