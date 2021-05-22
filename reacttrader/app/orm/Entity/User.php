<?php

namespace App\Orm\Entity;

use Nextras\Orm\Entity\Entity;

/**
 * Class User
 * @package App\Orm\Entity
 * @property int	$id		{primary}
 * @property string	$email
 * @property string $name
 * @property string $password
 * @property string $role
 */

class User extends Entity {
	const ROLE_WAITING = "waiting";
	const ROLE_VERIFIED = "verified";

	// role pro přístup do aplikace
	const ROLES = [
		self::ROLE_WAITING => "Registrace čekající na vyřízení",
		self::ROLE_VERIFIED => "Ověřený uživatel",
	];
}