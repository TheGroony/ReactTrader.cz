<?php

namespace App\Models;

use App\Orm\Entity\Deposit;
use App\Orm\Entity\Trade;
use Nette\Security\User;
use App\Orm\Orm;
use Nette;
use Nextras\Dbal\Utils\DateTimeImmutable;
use Nextras\Orm\Collection\ICollection;

class TradeManager
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

	/**
	 * přidá k aktuálnímu účtu vklad nebo výběr peněz
	 * @param string $description
	 * @param string $date
	 * @param int $amount
	 * @return \Nextras\Orm\Entity\IEntity|Deposit
	 */
	public function addDeposit(string $description, string $date, int $amount)
	{


		$deposit = new Deposit();

		$deposit->user_id = $this->user->id;
		$deposit->description = $description;
		$deposit->date = DateTimeImmutable::createFromFormat("Y-m-d", $date);
		$deposit->amount = $amount;


		return $this->orm->persistAndFlush($deposit);
	}

	public function getCurrentLiquidity()
	{
		$liquidity = 0;

		$deposits = $this->orm->deposits->findBy(["user_id" => $this->user->id])->fetchPairs("id", "amount");
		$trades = $this->orm->trades->findBy(["user_id" => $this->user->id])->fetchPairs("id", "profitLoss");

		if ($deposits != null) {
			foreach ($deposits as $deposit) {
				$liquidity += $deposit;
			}
		}
		if ($trades != null) {
			foreach ($trades as $trade) {
				$liquidity += $trade;
			}
		}

		return $liquidity;
	}

	public function getAllDeposits()
	{
		return $this->orm->deposits->findBy(["user_id" => $this->user->id])->orderBy("date", ICollection::DESC)->fetchPairs("id", null);
	}

	public function addDoneTrade($values)
	{

		$image = "";
		switch ($values->ticker) {
			case "AAPL":
				$image = "apple";
				break;
			case "FB":
				$image = "facebook";
				break;
			case "NFLX":
				$image = "netflix";
				break;
			case "TWTR":
				$image = "twitter";
				break;
			case "AMZN":
				$image = "amazon";
				break;
			case "TSLA":
				$image = "tesla";
				break;
			case "NIO":
				$image = "nio";
				break;
			default:
				$image = "custom";
				break;

		}
		$image = $image . ".png";

		$trade = new Trade();

		$trade->user_id = $this->user->id;
		$trade->ticker = strtoupper($values->ticker);
		$trade->from = DateTimeImmutable::createFromFormat("Y-m-d", $values->from);
		$trade->till = DateTimeImmutable::createFromFormat("Y-m-d", $values->to);
		$trade->direction = $values->isShort ? "short" : "long";
		$trade->strategy = $values->strategy;
		$trade->maxProfit = $values->maxProfit;
		$trade->maxLoss = $values->maxLoss;
		$trade->openingIv = $values->openingIv;
		$trade->closingIv = $values->closingIv;
		$trade->profitLoss = $values->realisedPl;

		$trade->imageName = $image;
		$trade->liquidityBefore = $this->getCurrentLiquidity();

		return $this->orm->persistAndFlush($trade);
	}

	public function getAllTrades()
	{
		return $this->orm->trades->findBy(["user_id" => $this->user->id])->orderBy("from", ICollection::DESC)->fetchPairs("id", null);
	}

	public function getLastTrade()
	{
		return $this->orm->trades->findBy(["user_id" => $this->user->id])->orderBy("till", ICollection::DESC)->limitBy(1)->fetchPairs("id", null);
	}

	public function getBestMonthlyTrade()
	{
		return $this->orm->trades->findBy(
			[
				"user_id" => $this->user->id,
				"till>=" => date("Y-m-1"),
				"till<=" => date("Y-m-t")
			]
		)->orderBy("profitLoss", ICollection::DESC)
			->limitBy(1)->fetchPairs("id", null);
	}


	/**
	 * Vrátí sumu změny účtu z období aktuálního měsíce
	 * @param bool $withDeposits
	 * @return int|mixed
	 */
	public function getMonthlyChange(bool $withDeposits = true)
	{
		$monthly = 0;
		$trades = $this->orm->trades->findBy(
			[
				"user_id" => $this->user->id,
				"till>=" => date("Y-m-1"),
				"till<=" => date("Y-m-t")

			]
		)->fetchPairs("id", "profitLoss");
		if ($trades != null) {
			foreach ($trades as $trade) {
				$monthly += $trade;
			}
		}

		if ($withDeposits) {
			$deposits = $this->orm->deposits->findBy(
				[
					"user_id" => $this->user->id,
					"date>=" => date("Y-m-1"),
					"date<=" => date("Y-m-t")
				]
			)->fetchPairs("id", "amount");

			if ($deposits != null) {
				foreach ($deposits as $deposit) {
					$monthly += $deposit;
				}
			}
		}

		return $monthly;
	}

	/**
	 * Vrací sumu změny účtu z období aktuálního roku
	 * @param bool $withDeposits
	 * @return int|mixed
	 */
	public function getAnnualChange(bool $withDeposits = true)
	{
		$annual = 0;
		$trades = $this->orm->trades->findBy(
			[
				"user_id" => $this->user->id,
				"till>=" => date("Y-01-1"),
				"till<=" => date("Y-12-31")

			]
		)->fetchPairs("id", "profitLoss");
		if ($trades != null) {
			foreach ($trades as $trade) {
				$annual += $trade;
			}
		}

		if ($withDeposits) {
			$deposits = $this->orm->deposits->findBy(
				[
					"user_id" => $this->user->id,
					"date>=" => date("Y-01-1"),
					"date<=" => date("Y-12-31")
				]
			)->fetchPairs("id", "amount");

			if ($deposits != null) {
				foreach ($deposits as $deposit) {
					$annual += $deposit;
				}
			}
		}

		return $annual;
	}
}