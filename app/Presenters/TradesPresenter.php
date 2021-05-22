<?php


namespace App\Presenters;


use App\Components\Forms\AccountDepositForm;
use App\Components\Forms\DoneTradeForm;
use App\Components\Forms\IAccountDepositFormFactory;
use App\Components\Forms\IDoneTradeFormFactory;
use App\Models\ResourcesManager;
use App\Models\TradeManager;

class TradesPresenter extends BasePresenter // Presenter stránky s obchody
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

	// render šablony a hození potřebných proměnných
	public function renderDefault() {
		$this->template->trades = $this->tradeManager->getAllTrades();
		$this->template->stocks = $this->resourcesManager->fetchAllStocks();
		bdump($this->resourcesManager->fetchAllStocks());
	}

	// komponenta formuláře pro zadání obchodu
	public function createComponentDoneTradeForm(): DoneTradeForm {
		return $this->doneTradeFormFactory->create();
	}

	// komponenta formuláře pro zadání výběru či vkladu (JS swich na frontendu)
	public function createComponentAccountDepositForm(): AccountDepositForm {
		return $this->accountDepositFormFactory->create();
	}
}