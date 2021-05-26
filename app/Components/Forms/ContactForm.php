<?php

namespace App\Components\Forms;

use Nette;
use Nette\Application\UI\Form;

class ContactForm extends BasicForm // Komponenta kontaktního formuláře na HP
{

	protected $customTemplate = "ContactForm"; // Název vlastní šablony

	public function render()
	{
		$template = $this->template;
		$template->setFile(__DIR__ . sprintf($this->templateDir, $this->customTemplate));
		$template->render();
	}

	public function createComponentForm()
	{
		$form = new Form;
		$form->addText("jmeno", "Jméno")
			->setHtmlAttribute("placeholder", "Vaše jméno")
			->setRequired();
		$form->addText("email", "E-mail")
			->setHtmlAttribute("placeholder", "Vaše e-mailová adresa")
			->setRequired();
		$form->addTextArea("zprava", "Vaše zpráva")
			->setHtmlAttribute("class", "textAreaClass")
			->setHtmlAttribute("placeholder", "Vaše zpráva")
			->setRequired();
		$form->addSubmit("send", "ODESLAT");

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
	{   // Odeslání zprávy z HP na nastavený mail
		try {
			$mail = new Nette\Mail\Message;
			$mail->setFrom($values->email)
				->addTo("jiri.strzelecki@creativehill.cz")
				->setSubject("Zpráva z kontaktního formuláře ReactTrader.cz - {$values->jmeno}")
				->setBody($values->zprava);

			$mailer = new Nette\Mail\SendmailMailer;
			$mailer->send($mail);
			$this->presenter->redirect("Thanks:default");
		} catch (\Exception $exception) {
			$this->onError($exception);
		}
	}


}