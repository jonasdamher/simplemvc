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

				if (!$this->verify() || !($_SESSION['userIdRol'] == 1) || !($_SESSION['userRolIdentity'] == 'ROLE_ADMIN')) {
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

	private function checkSession()
	{
		$list = ['userId', 'userName', 'userRolName', 'userIdRol', 'userRolIdentity'];
		$countSession = count($_SESSION);
		$ok = true;

		if ($countSession > 0) {
			foreach ($list as $key) {
				if (!array_key_exists($key, $_SESSION)) {
					$ok = false;
					break;
				}
			}
		} else {
			$ok = false;
		}

		return $ok;
	}

	private function verify()
	{
		$ok = false;
		try {

			if (!$this->checkSession()) {
				throw new Exception(false);
			}

			$consult = Database::connect()->prepare('SELECT 
			user.id 
			FROM users as user 
			INNER JOIN usr_rol ON user.idRol = usr_rol.id 
			WHERE user.id =:userId and user.name = :userName and 
			usr_rol.rol=:userRolName and usr_rol.id=:userIdRol and usr_rol.indentity=:userRolIdentity');

			$consult->bindValue(':userId',	$_SESSION['userId'], PDO::PARAM_INT);
			$consult->bindValue(':userName',	$_SESSION['userName'], PDO::PARAM_STR);
			$consult->bindValue(':userRolName',	$_SESSION['userRolName'], PDO::PARAM_STR);
			$consult->bindValue(':userIdRol',	$_SESSION['userIdRol'], PDO::PARAM_INT);
			$consult->bindValue(':userRolIdentity',	$_SESSION['userRolIdentity'], PDO::PARAM_STR);

			$consult->execute();

			if ($consult->rowCount() == 0) {
				throw new Exception(false);
			}

			$ok = true;
		} catch (PDOException $e) {
			$ok = false;
		} catch (Exception $e) {
			$ok = false;
		} finally {

			return $ok;
		}
	}
}
