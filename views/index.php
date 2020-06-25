<?php
include 'partials/head.php';

/**
 * Incluye una barra de navegación distinta si estás iniciado sesión o no
 */
include 'partials/' . (empty($_SESSION) ? 'navbar' : 'navbarAdmin') . '.php';

?>
<main>
<?php

include $this->currentView['section'] . '/' . $this->currentView['view'] . '.php';

?>
</main>

<?php

include 'partials/footer.php';

?>