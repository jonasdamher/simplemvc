<?php

session_start();

require_once 'conf/Globals.php';
require_once 'libs/Utils.php';
require_once 'libs/autoload.php';

require_once 'conf/Database.php';
require_once 'core/BaseModel.php';
require_once 'core/BaseController.php';

require_once 'libs/Router.php';

$router = new Router();

?>