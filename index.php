<?php
/**
 * Blog montado en PHP con arquitectura MVC.
 * 
 * @package simplemvc
 * @version 1.0
 * @license https://github.com/jonasdamher/simplemvc/blob/dev/LICENSE MIT License
 * 
 * @author Jonás Damián Hernández [jonasdamher]
 */

error_reporting(E_ALL);

session_start();

// Variables globales
require_once 'conf/Globals.php';

// Autocargar todas las clases
require_once 'libs/autoload.php';

// Clases ayudantes
require_once 'helpers/Utils.php';
require_once 'helpers/View.php';
require_once 'libs/Auth.php';
require_once 'libs/JsonRequest.php';

// Clases principales de la webapp
require_once 'core/Database.php';

require_once 'libs/responseHandler.php';
require_once 'libs/Validator.php';
require_once 'core/BaseModel.php';
require_once 'core/BaseController.php';

// Router
require_once 'libs/Router.php';
