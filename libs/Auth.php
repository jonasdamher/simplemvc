<?php

declare(strict_types=1);

/**
 * Para autenticar y comprobar usuarios que han iniciado sesión.
 * Para verificar que tienen acceso a una página en concreto.
 */
class Auth
{
	public function role(string $role = null)
	{
		switch ($role) {
			case 'ROLE_ADMIN':

				if (!isset($_SESSION['userId']) || $_SESSION['userIdRol'] != 1 || $_SESSION['userRolIdentity'] != 'ROLE_ADMIN') {
					Utils::redirection('error/401');
				}

				break;
			default:
				if (isset($_SESSION['userId'])) {
					Utils::redirection('users/profile');
				}
				break;
		}
	}
}
