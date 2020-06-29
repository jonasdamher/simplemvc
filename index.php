<?php

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
require_once 'libs/Head.php';

// Clases principales de la webapp
require_once 'core/Database.php';
require_once 'core/BaseModel.php';
require_once 'core/BaseController.php';

// Router
require_once 'libs/Router.php';
