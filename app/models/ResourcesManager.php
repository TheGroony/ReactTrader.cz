<?php


namespace App\Models;


use App\Orm\Orm;

class ResourcesManager // model pro práci s dostupnými instrumenty
{

	/** @var Orm */
	protected $orm;

	public function __construct(Orm $orm) {
		$this->orm = $orm;
	}

	// vrátí všechny dostupné akcie z db
	public function fetchAllStocks() {
		return $this->orm->stocks->findAll()->fetchPairs("id", null);
	}
}