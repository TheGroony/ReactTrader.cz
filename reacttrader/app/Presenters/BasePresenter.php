<?php


namespace App\Presenters;


use App\Components\Parts\IMainMenuFactory;
use App\Components\Parts\MainMenu;
use App\Models\AccountManager;
use App\Models\TradeManager;
use App\Orm\Orm;
use Nette\Application\UI\Presenter;
use Nette\Security\User;

class BasePresenter extends Presenter
{
	/** @var IMainMenuFactory @inject */
	public $mainMenuFactory;

	/** @var User @inject */
	public $user;

	/** @var Orm @inject */
	public $orm;

	/** @var AccountManager @inject */
	public $accountManager;

	/** @var TradeManager @inject */
	public $tradeManager;

	public function __construct()
	{
		parent::__construct();
	}

	public function beforeRender()
	{
		$this->template->account = $this->accountManager->getCurrentUser();
	}

	public function startup()
	{
		parent::startup();

		if (!$this->user->isLoggedIn() && !$this->isLinkCurrent("Login:default")) {
			if (!$this->isLinkCurrent("Homepage:default")) {
				$this->redirect("Login:default");
			}
		}

		if ($this->user->isLoggedIn() && $this->isLinkCurrent("Login:default")) {
			$this->redirect("Dashboard:default");
		}
	}

	public function createComponentMainMenu(): MainMenu
	{
		return $this->mainMenuFactory->create();
	}
}