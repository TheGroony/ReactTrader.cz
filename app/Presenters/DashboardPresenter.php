<?php


namespace App\Presenters;


class DashboardPresenter extends BasePresenter // presenter stránky (nástěnka)
{
	// hodí do šablony požadované proměnné
	public function renderDefault() {
		$this->template->currentLiquidity = $this->tradeManager->getCurrentLiquidity();
		$this->template->monthlyChange = $this->tradeManager->getMonthlyChange();
		$this->template->annualChange = $this->tradeManager->getAnnualChange();
		$this->template->monthlyChangeTrades = $this->tradeManager->getMonthlyChange(false);
		$this->template->annualChangeTrades = $this->tradeManager->getAnnualChange(false);
		$this->template->lastTrade = $this->tradeManager->getLastTrade();
		$this->template->bestMonthlyTrade = $this->tradeManager->getBestMonthlyTrade();
	}
}