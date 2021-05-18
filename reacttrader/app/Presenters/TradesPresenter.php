<?php


namespace App\Presenters;


use App\Components\Forms\AccountDepositForm;
use App\Components\Forms\DoneTradeForm;
use App\Components\Forms\IAccountDepositFormFactory;
use App\Components\Forms\IDoneTradeFormFactory;
use App\Models\ResourcesManager;
use App\Models\TradeManager;

class TradesPresenter extends BasePresenter
{
	/**
	 * @var IDoneTradeFormFactory
	 * @inject
	 */
	public $doneTradeFormFactory;

	/**
	 * @var IAccountDepositFormFactory
	 * @inject
	 */
	public $accountDepositFormFactory;

	/**
	 * @var ResourcesManager
	 * @inject
	 */
	public $resourcesManager;

	/**
	 * @var TradeManager
	 * @inject
	 */
	public $tradeManager;

	public function renderDefault() {
		$this->template->trades = $this->tradeManager->getAllTrades();
		$this->template->stocks = $this->resourcesManager->fetchAllStocks();
		bdump($this->resourcesManager->fetchAllStocks());
	}

	public function createComponentDoneTradeForm(): DoneTradeForm {
		return $this->doneTradeFormFactory->create();
	}

	public function createComponentAccountDepositForm(): AccountDepositForm {
		return $this->accountDepositFormFactory->create();
	}
}