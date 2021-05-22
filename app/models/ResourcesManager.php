<?php


namespace App\Models;


use Nette\Database\Explorer;

class ResourcesManager // model pro práci s dostupnými instrumenty
{
	private $database;

	public function __construct(Explorer $database) {
		$this->database = $database;
	}

	// vrátí všechny dostupné akcie z db
	public function fetchAllStocks() {
		return $this->database->table("stocks");
	}
}