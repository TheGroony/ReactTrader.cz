<?php

namespace App\Orm\Repository;

use App\Orm\Entity\Stock;
use Nextras\Orm\Repository\Repository;

class StocksRepository extends Repository
{

	public static function getEntityClassNames(): array
	{
		return [Stock::class];
	}

}