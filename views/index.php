<?php
include 'includes/head.php';

include 'includes/navbar.php';

?>
<main>
	<?php include View::controller() . '/' . View::action() . '.php'; ?>
</main>

<?php

include 'includes/footer.php';

?>