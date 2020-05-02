<?php
include 'partials/head.php';

if (empty($_SESSION)) {
	include 'partials/navbar.php';
} else {
	include 'partials/navbarAdmin.php';
}
?>
<main>
	<?php include $this->currentView['section'] . '/' . $this->currentView['view'] . '.php'; ?>
</main>

<?php include 'partials/footer.php'; ?>