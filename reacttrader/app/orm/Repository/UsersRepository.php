<?php

namespace App\Orm\Repository;

use App\Orm\Entity\User;
use Nextras\Orm\Repository\Repository;

class UsersRepository extends Repository
{

	public static function getEntityClassNames(): array
	{
		return [User::class];
	}
}