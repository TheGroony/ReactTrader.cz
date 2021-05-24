<?php

namespace App\Orm;

use App\Orm\Repository\DepositsRepository;
use App\Orm\Repository\StocksRepository;
use App\Orm\Repository\TradesRepository;
use App\Orm\Repository\UsersRepository;
use Nextras\Orm\Model\Model;

/**
 * Class Orm
 * @package App\Orm
 * @property UsersRepository		$users
 * @property DepositsRepository 	$deposits
 * @property TradesRepository 		$trades
 * @property StocksRepository		$stocks
 */

class Orm extends Model {

}
