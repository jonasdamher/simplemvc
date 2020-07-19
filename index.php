<?php
/**
 * 
 * 
 * @package simplymvc
 * @version 1.0
 * @license https://github.com/jonasdamher/simplifyimage/blob/master/LICENSE MIT License
 * 
 * @author Jonás Damián Hernández [jonasdamher]
 */

error_reporting(E_ALL);

session_start();

// Variables globales
require_once 'conf/Globals.php';

// Autocargar todas las clases
require_once 'libs/autoload.php';

// Clases de ayuda
require_once 'libs/Utils.php';
require_once 'libs/Auth.php';
require_once 'libs/JsonRequest.php';
require_once 'libs/View.php';

// Clases principales de la webapp
require_once 'core/Database.php';
require_once 'core/BaseModel.php';
require_once 'core/BaseController.php';

// Router
require_once 'libs/Router.php';
