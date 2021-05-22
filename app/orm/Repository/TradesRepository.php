<?php


namespace App\Orm\Repository;


use App\Orm\Entity\Trade;
use Nextras\Orm\Repository\Repository;

class TradesRepository extends Repository
{
	public static function getEntityClassNames():array
	{
		return [Trade::class];
	}
}