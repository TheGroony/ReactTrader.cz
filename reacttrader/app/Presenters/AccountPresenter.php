<?php


namespace App\Presenters;


use App\Models\TradeManager;

class AccountPresenter extends BasePresenter
{

	public function renderDefault() {
		$this->template->currentLiquidity = $this->tradeManager->getCurrentLiquidity();
		$this->template->deposits = $this->tradeManager->getAllDeposits();
		$this->template->monthlyChange = $this->tradeManager->getMonthlyChange();
		$this->template->annualChange = $this->tradeManager->getAnnualChange();
	}
}