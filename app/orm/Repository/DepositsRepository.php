<?php

namespace App\Orm\Repository;

use App\Orm\Entity\Deposit;
use Nextras\Orm\Repository\Repository;

class DepositsRepository extends Repository
{

	public static function getEntityClassNames(): array
	{
		return [Deposit::class];
	}

}