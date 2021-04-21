<?php


namespace App\Presenters;


use App\Components\Parts\IMainMenuFactory;
use App\Components\Parts\MainMenu;
use Nette\Application\UI\Presenter;
use Nette\Security\User;

class BasePresenter extends Presenter
{
	/** @var IMainMenuFactory @inject */
	public $mainMenuFactory;

	/** @var User */
	protected $user;

	public function __construct(User $user)
	{
		parent::__construct();
		$this->user = $user;
	}

	public function startup()
	{
		parent::startup();

		if(!$this->user->isLoggedIn() && !$this->isLinkCurrent("Login:default")) {
			if(!$this->isLinkCurrent("Homepage:default")) {
				$this->redirect("Login:default");
			}
		}

		if($this->user->isLoggedIn() && $this->isLinkCurrent("Login:default")) {
			$this->redirect("Dashboard:default");
		}
	}

	public function createComponentMainMenu(): MainMenu {
		return $this->mainMenuFactory->create();
	}
}