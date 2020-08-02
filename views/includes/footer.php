<footer class="footer">
	<section class="footer-body">
		<?php include 'views/includes/footer/' . Footer::get() . '.php'; ?>
	</section>
</footer>
<!-- SCRIPTS JS -->
<script src="<?= URL_BASE ?>/public/js/dom.js" defer></script>
<script src="<?= URL_BASE ?>/public/js/main.js" defer></script>
<script src="<?= URL_BASE ?>/public/js/all.min.js" defer></script>
<?php
$totalLinksJs = count(Footer::getLinksJs());
if ($totalLinksJs > 0) {
	foreach (Footer::getLinksJs() as $linkJs) { ?>
		<script src="<?= URL_BASE ?>public/js/<?= $linkJs ?>.js" defer></script>
<?php }
} ?>
</body>

</html>