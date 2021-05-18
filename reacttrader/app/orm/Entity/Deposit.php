<?php

namespace App\Orm\Entity;

use Nextras\Dbal\Utils\DateTimeImmutable;
use Nextras\Orm\Entity\Entity;

/**
 * Class Deposit
 * @package App\Orm\Entity
 * @property int						$id		{primary}
 * @property int 						$user_id
 * @property string						$description
 * @property DateTimeImmutable			$date
 * @property int						$amount
 */

class Deposit extends Entity {

}