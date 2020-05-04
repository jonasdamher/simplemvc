<?php

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

	public function setId($id)
	{
		$this->id = $id;
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
		$this->email = $email;
	}
	public function getEmail()
	{
		return $this->email;
	}

	public function setPassword($password)
	{
		$this->password = $password;
	}
	public function getPassword()
	{
		return $this->password;
	}

	private function sessionInit($userData)
	{
		$_SESSION['userInit'] = $userData['id'];
		$_SESSION['userName'] = $userData['name'];
		$_SESSION['userRol'] = $userData['idRol'];

		Utils::redirection('users/profile');
	}

	private function criptoPassword()
	{
		return password_hash($this->getPassword(), PASSWORD_DEFAULT);
	}

	public function signup()
	{
		try {

			$consult = Database::connect()->prepare("INSERT INTO $this->table (name, email, password) VALUES (:name, :email, :password)");
			$consult->bindValue(':name', $this->getName(), PDO::PARAM_STR);
			$consult->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
			$consult->bindValue(':password', $this->criptoPassword(), PDO::PARAM_STR);
			$consult->execute();

			$result = ['lastId' => Database::connect()->lastInsertId()];

			$result = null;
			Database::disconnect();

			return $this->success($result);
		} catch (PDOException $e) {
			return $this->fail($e->getMessage());
		}
	}

	public function login()
	{
		try {

			$consult = Database::connect()->prepare("SELECT * FROM $this->table WHERE email=:email");
			$consult->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
			$consult->execute();

			Database::disconnect();

			if ($consult->rowCount() == 0) {
				return $this->fail('password or email does not match');
			}

			$result = $consult->fetch(PDO::FETCH_ASSOC);
			$consult = null;

			if (!password_verify($this->getPassword(), $result['password'])) {
				return $this->fail('password or email does not match');
			}

			$this->sessionInit($result);
		} catch (PDOException $e) {
			return $this->fail($e->getMessage());
		}
	}

	public function logout()
	{
		session_unset();
		session_destroy();
		session_regenerate_id(true);

		Utils::redirection('home');
	}

	public function get()
	{
		return $this->findById($this->getId());
	}
}
?>