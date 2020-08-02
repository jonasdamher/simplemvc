<?php

declare(strict_types=1);

class Validator extends responseHandler
{

	private $data = null;

	private ?string $type = null;
	private bool $strict = false;
	private bool $require = false;
	private bool $sanitize = false;

	public function postData(string $postParameter)
	{
		$this->data = trim($_POST[$postParameter]) ?? null;
		return $this;
	}

	public function getData(string $getParameter)
	{
		$this->data = trim($_GET[$getParameter]) ?? null;
		return $this;
	}

	public function data($data)
	{
		$this->data = trim($data) ?? null;
		return $this;
	}

	public function require()
	{
		$this->require = true;
		return $this;
	}

	public function strict()
	{
		$this->strict = true;
		return $this;
	}

	public function sanitize()
	{
		$this->sanitize = true;
		return $this;
	}

	public function type(string $type)
	{
		$this->type = $type;
		return $this;
	}

	private function useRequire($data)
	{
		if ($data == null || empty($data) || (is_array($data) && count($data) == 0)) {
			$this->fail('Data is required, is empty.');
		}
	}

	private function useSanitize($data)
	{
		switch ($this->type) {
			case 'string';
				$data = filter_var($data, FILTER_SANITIZE_STRING);
				break;
			case 'int';
				$data = filter_var($data, FILTER_SANITIZE_NUMBER_INT);
				break;
			case 'float';
				$data = filter_var($data, FILTER_SANITIZE_NUMBER_FLOAT);
				break;
			case 'email';
				$data = filter_var($data, FILTER_SANITIZE_EMAIL);
				break;
			case 'url';
				$data = filter_var($data, FILTER_SANITIZE_URL);
				break;
		}
		return $data;
	}

	public function validate()
	{
		$data = (($this->sanitize) ? $this->useSanitize($this->data) : $this->data);

		switch ($this->type) {
			case 'string';
				$data = ((empty($data)) ? ($this->strict ? '' : null) : $data);
				break;
			case 'int';
				$data = (!filter_var($data, FILTER_VALIDATE_INT)) ? (($this->strict ? 0 : null)) : $data;
				break;
			case 'float';
				$data = (!filter_var($data, FILTER_VALIDATE_FLOAT)) ? (($this->strict ? 0 : null)) :  $data;
				break;
			case 'email';
				$data = (!filter_var($data, FILTER_VALIDATE_EMAIL)) ? (($this->strict ? '' : null)) : $data;
				break;
			case 'url';
				$data = (!filter_var($data, FILTER_VALIDATE_URL)) ? (($this->strict ? '' : null)) : $data;
				break;
		}

		if ($this->require) {
			$this->useRequire($data);
		}

		return $data;
	}

	/**
	 * Devuelve un array asociativo para saber si la validación fue con exito.
	 * 
	 * @return array Devuelve las claves asociativas:
	 * - success (bool)
	 * - message (string)
	 */
	public function isValidForm()
	{
		return $this->response();
	}
}
