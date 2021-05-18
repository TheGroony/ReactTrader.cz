<?php

namespace App\Components\Forms;

use App\Models\TradeManager;
use App\Orm\Entity\Deposit;
use App\Orm\Orm;
use Nette;
use Nette\Application\UI\Form;
use Nette\Security\User;
use Nextras\Dbal\Utils\DateTimeImmutable;

class AccountDepositForm extends BasicForm
{

	/** @var TradeManager */
	protected $tradeManager;

	protected $customTemplate = "AccountDepositForm";

	public function __construct(TradeManager $tradeManager)
	{
		$this->tradeManager = $tradeManager;
	}

	// Funkce na render šablony
	public function render()
	{
		$template = $this->template;
		$template->setFile(__DIR__ . sprintf($this->templateDir, $this->customTemplate));
		$template->render();
	}

	// Vytvoří form komponentu do šablony (Nette)
	public function createComponentForm()
	{

		// Vytvoření formuláře a přiřazení jeho prvků včetně tříd
		$form = new Form;

		$form->setHtmlAttribute("class", "accountDeposit");

		$form->addText("depositName", "depositName")
			->setRequired()
			->setHtmlAttribute("placeholder", "Název vkladu/výběru")
			->setHtmlAttribute("class", "depositName");

		$form->addText("from", "DATUM")
			->setRequired()
			->setHtmlAttribute("onfocus", "(this.type='date')")
			->setHtmlAttribute("placeholder", "DATUM")
			->setHtmlAttribute("class", "fromInput");

		$form->addInteger("amount", "amount")
			->setHtmlAttribute("placeholder", "ČÁSTKA ($)")
			->setRequired()
			->setHtmlAttribute("class", "amount");

		$form->addSubmit("send", "->");

		$form->onSuccess[] = [$this, "processForm"];
		return $form;
	}

	/**
	 * Při úspěšném odeslání formu se přidá deposit do db
	 * @param Form $form
	 * @param \stdClass $values
	 * $
	 * @return void
	 */
	public function processForm(Form $form, \stdClass $values)
	{
		// Přidání depositu a znovunačtení stránky
		$this->tradeManager->addDeposit($values->depositName, $values->from, $values->amount);
		$this->presenter->redirect("this");
	}


}