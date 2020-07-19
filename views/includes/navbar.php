<?php

/**
 * Incluye una barra de navegación distinta si estás iniciado sesión o no
 */
include 'navbar/' . (empty($_SESSION) ? 'default' : 'admin') . '.php';
