<?php

declare(strict_types=1);

class Validator extends responseHandler
{

	private $data = null;

	private ?string $type = null;
	private bool $require = false;
	private bool $sanitize = false;

	public function postData(string $postParameter)
	{
		$this->data = $_POST[$postParameter] ?? null;
		return $this;
	}

	public function getData(string $getParameter)
	{
		$this->data = $_GET[$getParameter] ?? null;
		return $this;
	}

	public function require()
	{
		$this->require = true;
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
		if ($data == null || count($data) == 0 || empty($data)) {
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
				$data = $data == '' ? null : $data;
				break;
			case 'int';
				$data = filter_var($data, FILTER_VALIDATE_INT);
				break;
			case 'float';
				$data = filter_var($data, FILTER_VALIDATE_FLOAT);
				break;
			case 'email';
				$data = filter_var($data, FILTER_VALIDATE_EMAIL);
				break;
			case 'url';
				$data = filter_var($data, FILTER_VALIDATE_URL);
				break;
		}

		if ($this->require) {
			$this->useRequire($data);
		}

		return $data;
	}
}
