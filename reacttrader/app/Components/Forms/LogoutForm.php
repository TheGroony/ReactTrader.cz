<?php

namespace App\Components\Forms;

use Nette;
use Nette\Application\UI\Form;
use Nette\Security\User;

class LogoutForm extends BasicForm
{
	/** @var User */
	protected $user;
	protected $customTemplate = "LogoutForm";

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function render() {
		$template = $this->template;
		$template->setFile(__DIR__.sprintf($this->templateDir,$this->customTemplate));
		$template->render();
	}

	public function createComponentForm() {
		$form = new Form;
		$form->addSubmit("send", "Odhlásit se");
		$form->onSuccess[] = [$this, "processForm"];
		return $form;
	}

	/**
	 * @param Form $form
	 * @param \stdClass $values
	 * $
	 * @return void
	 */
	public function processForm() {
		try {
			$this->user->logout();
			$this->presenter->redirect("Login:default");
		} catch(Nette\Security\AuthenticationException $exception) {
			$this->onError($exception);
		}
	}


}