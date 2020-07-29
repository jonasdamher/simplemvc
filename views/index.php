<?php
if (empty(Head::getTitle())) {
	Head::title(View::controller());
}

include 'includes/head.php';

?>
<main>
	<?php include View::controller() . '/' . View::action() . '.php'; ?>
</main>

<?php
include 'includes/footer.php';
?>