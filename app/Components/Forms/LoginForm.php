<?php

namespace App\Components\Forms;

use Nette;
use Nette\Application\UI\Form;
use Nette\Security\User;

class LoginForm extends BasicForm // Komponenta formuláře na přihlášení
{
	/** @var User */
	protected $user;
	protected $customTemplate = "LoginForm";

	public function __construct(User $user) // Předání uživatele
	{
		$this->user = $user;
	}

	public function render()
	{ // render šablony formuláře
		$template = $this->template;
		$template->setFile(__DIR__ . sprintf($this->templateDir, $this->customTemplate));
		$template->render();
	}

	public function createComponentForm()
	{
		$form = new Form;
		$form->setHtmlAttribute("class", "login-form loginForm");
		$form->addText("email", "E-mail")->setRequired()
			->setHtmlAttribute("class", "inputEmail inputClass")
			->setRequired();
		$form->addPassword("heslo", "Heslo")->setRequired()
			->setHtmlAttribute("class", "inputHeslo inputClass")
			->setRequired();
		$form->addSubmit("send", "Přihlásit se");

		$form->onSuccess[] = [$this, "processForm"];
		return $form;
	}

	/**
	 * @param Form $form
	 * @param \stdClass $values
	 * $
	 * @return void
	 */
	public function processForm(Form $form, \stdClass $values)
	{ // Pokus o přihlášení a redirect na nástěnku
		try {
			$this->user->setExpiration("1 day");
			$this->user->login($values->email, $values->heslo);

			$this->presenter->redirect("Dashboard:default");

		} catch (Nette\Security\AuthenticationException $exception) {
			$this->onError($exception);
		}
	}


}