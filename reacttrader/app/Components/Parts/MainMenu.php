<?php

namespace App\Components\Parts;

use App\Components\Forms\ILogoutFormFactory;
use App\Components\Forms\LogoutForm;
use App\Models\AccountManager;
use App\Models\TradeManager;
use Nette;
use Nette\Application\UI\Form;
use Nette\Security\User;

class MainMenu extends Nette\Application\UI\Control // komponenta na hlavní menu uvnitř aplikace
{

	/** @var ILogoutFormFactory */
	public $logoutFormFactory;

	/** @var AccountManager */
	protected $accountManager;

	/** @var TradeManager */
	protected $tradeManager;


	/** @var User */
	protected $user;
	protected $customTemplate = "MainMenu";
	protected $templateDir = "/../templates/Parts/%s.latte";

	// Předání všech potřebných záležitostí
	public function __construct(User $user, ILogoutFormFactory $logoutFormFactory, AccountManager $accountManager, TradeManager $tradeManager)
	{
		$this->user = $user;
		$this->logoutFormFactory = $logoutFormFactory;
		$this->accountManager = $accountManager;
		$this->tradeManager = $tradeManager;
	}

	// render šablony
	public function render()
	{
		$template = $this->template;
		$template->setFile(__DIR__ . sprintf($this->templateDir, $this->customTemplate));

		// předání potřebných proměnných do šablony
		$template->account = $this->accountManager->getCurrentUser();
		$template->liquidity = $this->tradeManager->getCurrentLiquidity();
		$template->monthlyChange = $this->tradeManager->getMonthlyChange();
		$template->annualChange = $this->tradeManager->getAnnualChange();
		$template->monthlyChangeTrades = $this->tradeManager->getMonthlyChange(false);
		$template->annualChangeTrades = $this->tradeManager->getAnnualChange(false);

		$template->render();
	}

	public function createComponentLogoutForm(): LogoutForm
	{ // logout form komponenta do šablony
		return $this->logoutFormFactory->create();
	}


}