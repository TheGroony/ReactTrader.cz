<?php

namespace App\Orm\Repository;

use App\Orm\Entity\User;
use Nextras\Orm\Repository\Repository;

class UsersRepository extends Repository
{
	/**
	 * Returns possible entity class names for current repository.
	 * @return string[]
	 */
	public static function getEntityClassNames(): array
	{
		return [User::class];
	}
}