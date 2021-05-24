<?php

namespace App\Orm\Entity;

use Nextras\Dbal\Utils\DateTimeImmutable;
use Nextras\Orm\Entity\Entity;

/**
 * Class Stock
 * @package App\Orm\Entity
 * @property int						$id		{primary}
 * @property string 					$ticker
 * @property string						$nazev
 * @property string						$img
 */

class Stock extends Entity {

}