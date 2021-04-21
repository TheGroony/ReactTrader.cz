<?php

namespace App\Components\Parts;

use App\Components\Forms\ILogoutFormFactory;
use App\Components\Forms\LogoutForm;
use Nette;
use Nette\Application\UI\Form;
use Nette\Security\User;

class MainMenu extends Nette\Application\UI\Control
{
	/** @var ILogoutFormFactory */
	public $logoutFormFactory;


	/** @var User */
	protected $user;
	protected $customTemplate = "MainMenu";
	protected $templateDir = "/../templates/Parts/%s.latte";

	public function __construct(User $user, ILogoutFormFactory $logoutFormFactory)
	{
		$this->user = $user;
		$this->logoutFormFactory = $logoutFormFactory;
	}

	public function render() {
		$template = $this->template;
		$template->setFile(__DIR__.sprintf($this->templateDir,$this->customTemplate));
		$template->render();
	}

	public function createComponentLogoutForm(): LogoutForm {
		return $this->logoutFormFactory->create();
	}


}