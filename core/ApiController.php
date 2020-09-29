<?php

declare(strict_types=1);

class ApiController extends BaseController
{

	protected ?JsonRequest $json = null;

	public function __construct()
	{
		parent::__construct();
		$this->json = new JsonRequest;
	}
}
