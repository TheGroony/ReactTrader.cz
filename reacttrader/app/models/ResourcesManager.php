<?php


namespace App\Models;


use Nette\Database\Explorer;

class ResourcesManager
{
	private $database;

	public function __construct(Explorer $database) {
		$this->database = $database;
	}

	public function fetchAllStocks() {
		return $this->database->table("stocks");
	}
}