<?php

declare(strict_types=1);
/**
 * Modelo de usuario
 */
class UsersModel extends BaseModel
{

	private $id;
	private $name;
	private $email;
	private $password;

	public function __construct()
	{
		$table = 'users';
		parent::__construct($table);
	}

	// Gets y sets

	public function setId($id)
	{
		$this->id = (int) $id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setEmail($email)
	{
		$this->email = $this->postData($email)->type('email')->strict()->require()->sanitize()->validate();
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setPassword($password)
	{
		$this->password = $this->postData($password)->type('string')->strict()->require()->sanitize()->validate();
	}

	public function getPassword()
	{
		return $this->password;
	}

	// Fin gets y sets

	/**
	 * Buscar usuario por ID.
	 */
	public function get(): array
	{
		return $this->findById($this->getId());
	}

	/**
	 * Crear cuenta de usuario.
	 */
	public function signup(): array
	{
		try {

			$consult = Database::connect()->prepare("INSERT INTO $this->table (name, email, password) VALUES (:name, :email, :password)");

			$consult->bindValue(':name', $this->getName(), PDO::PARAM_STR);
			$consult->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
			$consult->bindValue(':password', $this->criptoPassword(), PDO::PARAM_STR);

			$consult->execute();

			$result = ['lastId' => Database::connect()->lastInsertId()];

			$this->success($result);
		} catch (PDOException $e) {

			$this->fail($e->getMessage());
		} finally {

			$consult = null;
			Database::disconnect();
			return $this->response();
		}
	}

	/**
	 * Iniciar sesión con una cuenta de usuario.
	 */
	public function login(): array
	{
		try {

			$consult = Database::connect()->prepare("SELECT 
			user.id, user.name, user.email, user.password, user.idRol, 
			usr_rol.rol, usr_rol.indentity 
			FROM $this->table as user 
			INNER JOIN usr_rol ON user.idRol = usr_rol.id 
			WHERE email = :email and user.disabled=:disabledUser");

			$consult->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
			$consult->bindValue(':disabledUser', 0, PDO::PARAM_INT);

			$consult->execute();

			if ($consult->rowCount() == 0) {
				throw new Exception('password or email does not match.');
			}

			$result = $consult->fetch(PDO::FETCH_ASSOC);

			if (!password_verify($this->getPassword(), $result['password'])) {
				throw new Exception('password or email does not match.');
			}

			$this->sessionInit($result);
			$this->updateDateLastSession($result);
		} catch (Exception $e) {

			$this->fail($e->getMessage());
		} catch (PDOException $e) {

			$this->fail($e->getMessage());
		} finally {

			$consult = null;
			Database::disconnect();
			return $this->response();
		}
	}

	private function updateDateLastSession($user)
	{
		try {
			$consult = Database::connect()->prepare("UPDATE $this->table SET lastSession=:currentDate where id=:id");

			$consult->bindValue(':currentDate', Utils::currentDate(), PDO::PARAM_STR);
			$consult->bindValue(':id', $user['id'], PDO::PARAM_INT);
			$consult->execute();
		} catch (PDOException $e) {

			$this->fail($e->getMessage());
		} finally {

			$consult = null;
			Database::disconnect();
		}
	}

	/**
	 * Salir de sesión activa de usuario
	 */
	public function logout()
	{
		session_unset();
		session_destroy();
		session_regenerate_id(true);

		Utils::redirection('home');
	}

	/**
	 * Variables de sesión de usuario, $_SESSION
	 */
	private function sessionInit($userData)
	{
		$token = bin2hex(random_bytes(256));
		$_SESSION['_token'] = $token;
		$_SESSION['userId'] = $userData['id'];
		$_SESSION['userName'] = $userData['name'];
		$_SESSION['userRolName'] = $userData['rol'];
		$_SESSION['userIdRol'] = $userData['idRol'];
		$_SESSION['userRolIdentity'] = $userData['indentity'];

		Utils::redirection('users/profile');
	}

	/**
	 * Encriptar contraseña de usuario
	 */
	private function criptoPassword(): string
	{
		return password_hash($this->getPassword(), PASSWORD_DEFAULT);
	}
}
