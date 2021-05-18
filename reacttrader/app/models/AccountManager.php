<?php

namespace App\Models;

use App\Orm\Entity\Deposit;
use Nette\Security\User;
use App\Orm\Orm;
use Nette;
use Nextras\Dbal\Utils\DateTimeImmutable;

class AccountManager
{
	/** @var Orm */
	protected $orm;

	/** @var User */
	protected $user;

	public function __construct(Orm $orm, User $user)
	{
		$this->orm = $orm;
		$this->user = $user;
	}


	public function getCurrentUser() {
		return $this->orm->users->getById($this->user->id);
	}
}