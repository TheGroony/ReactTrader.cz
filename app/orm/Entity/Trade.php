<?php


namespace App\Orm\Entity;


use Nextras\Dbal\Utils\DateTimeImmutable;
use Nextras\Orm\Entity\Entity;

/**
 * Class Trade
 * @package App\Orm\Entity
 * @property int 					$id {primary}
 * @property int 					$user_id
 * @property string 				$ticker
 * @property DateTimeImmutable 		$from
 * @property DateTimeImmutable 		$till
 * @property string 				$direction
 * @property string 				$strategy
 * @property int 					$maxProfit
 * @property int 					$maxLoss
 * @property int 					$openingIv
 * @property int 					$closingIv
 * @property int 					$profitLoss
 * @property string 				$imageName
 * @property int 					$liquidityBefore
 */
class Trade extends Entity
{

}