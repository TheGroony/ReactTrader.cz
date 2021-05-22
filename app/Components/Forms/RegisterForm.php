<?php

namespace App\Components\Forms;

use App\Models\Security\DatabaseAuthenticator;
use Nette;
use Nette\Application\UI\Form;

class RegisterForm extends BasicForm
{
	/** @var DatabaseAuthenticator */
	public $databaseAuthenticator;

	protected $customTemplate = "RegisterForm";

	public function __construct(DatabaseAuthenticator $databaseAuthenticator) // předání vlastního modelu pro práci s autentifikací
	{
		$this->databaseAuthenticator = $databaseAuthenticator;
	}

	public function render()
	{
		$template = $this->template;
		$template->setFile(__DIR__ . sprintf($this->templateDir, $this->customTemplate));
		$template->render();
	}

	public function createComponentForm() // tvorba formu
	{
		$form = new Form;
		$form->setHtmlAttribute("class", "login-form registerForm");
		$form->addText("jmeno", "Jméno")
			->setHtmlAttribute("class", "inputJmeno inputClass")
			->setRequired();
		$form->addText("email", "E-mail")->setRequired()
			->setHtmlAttribute("class", "inputEmail inputClass")
			->setRequired();
		$form->addPassword("heslo", "Heslo")->setRequired()
			->setHtmlAttribute("class", "inputHeslo inputClass")
			->setRequired();
		$form->addPassword("hesloZnovu", "Validace")
			->setHtmlAttribute("class", "inputHesloZnovu inputClass")
			->addRule($form::EQUAL, "Hesla se neshodují.", $form["heslo"])
			->setRequired();
		$form->addSubmit("send", "Zaregistrovat se");

		$form->onSuccess[] = [$this, "processForm"];
		return $form;
	}

	/**
	 * @param Form $form
	 * @param \stdClass $values
	 * $
	 * @return void
	 */
	public function processForm(Form $form, \stdClass $values) // process odeslaného formu
	{
		try {
			$user = $this->databaseAuthenticator->registerUser($values->email, $values->jmeno, $values->heslo); // registrace nového uživatele na základě dat z formuláře
			$this->onSuccess($user);
		} catch (Nette\Security\AuthenticationException $exception) {
			$this->onError($exception);
		}
	}


}