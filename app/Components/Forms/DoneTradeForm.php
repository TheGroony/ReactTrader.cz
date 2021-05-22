<?php

namespace App\Components\Forms;

use App\Models\TradeManager;
use Nette;
use Nette\Application\UI\Form;
use Nette\Security\User;

class DoneTradeForm extends BasicForm // Komponenta formuláře pro zadání hotového obchodu do db
{

	/** @var TradeManager */
	protected $tradeManager;

	public function __construct(TradeManager $tradeManager)
	{
		$this->tradeManager = $tradeManager; // předání modelu pro práci s obchody této třídě
	}

	protected $customTemplate = "DoneTradeForm"; // vlastní šablona


	public function render()
	{ // render šablony
		$template = $this->template;
		$template->setFile(__DIR__ . sprintf($this->templateDir, $this->customTemplate));
		$template->render();
	}

	public function createComponentForm()
	{

		$strategies = [
			"Debit spread" => "Debit spread", // dostupné strategie
			"Credit spread" => "Credit spread",
			"Put" => "Put",
			"Call" => "Call"
		];

		$form = new Form; // kompletní vytvoření formu a přidělení jeho inputů v následujících řádcích

		$form->setHtmlAttribute("class", "doneTrade");

		$form->addText("ticker", "TICKER")
			->setRequired()
			->setHtmlAttribute("placeholder", "TICKER")
			->setHtmlAttribute("class", "tickerInput")
			->setHtmlAttribute("id", "tickerInput");

		$form->addText("from", "OD")
			->setRequired()
			->setHtmlAttribute("onfocus", "(this.type='date')")
			->setHtmlAttribute("placeholder", "OD")
			->setHtmlAttribute("class", "fromInput");

		$form->addText("to", "DO")
			->setRequired()
			->setHtmlAttribute("onfocus", "(this.type='date')")
			->setHtmlAttribute("placeholder", "DO")
			->setHtmlAttribute("class", "tillInput");

		$form->addButton("direction", "LONG")
			->setHtmlAttribute("type", "button")
			->setHtmlAttribute("class", "direction")
			->setHtmlAttribute("id", "directionButton");

		$form->addCheckbox("isShort", "isShort")
			->setHtmlAttribute("id", "isShort");

		$form->addSelect("strategy", "Strategie", $strategies);

		$form->addInteger("maxProfit", "maxProfit")
			->setHtmlAttribute("placeholder", "MP")
			->setRequired()
			->setHtmlAttribute("class", "maxProfit")
			->setHtmlAttribute("step", ".01");

		$form->addInteger("maxLoss", "maxLoss")
			->setHtmlAttribute("placeholder", "ML")
			->setRequired()
			->setHtmlAttribute("class", "maxLoss")
			->setHtmlAttribute("step", ".01");

		$form->addInteger("openingIv", "openingIv")
			->setHtmlAttribute("placeholder", "IV")
			->setRequired()
			->setHtmlAttribute("class", "openingIv")
			->setHtmlAttribute("step", ".01");

		$form->addInteger("closingIv", "closingIv")
			->setHtmlAttribute("placeholder", "CIV")
			->setRequired()
			->setHtmlAttribute("class", "closingIv")
			->setHtmlAttribute("step", ".01");

		$form->addInteger("realisedPl", "realisedPl")
			->setHtmlAttribute("placeholder", "P/L")
			->setRequired()
			->setHtmlAttribute("class", "realisedPl")
			->setHtmlAttribute("step", ".01");

		$form->addSubmit("send", "->");

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
	{
		$this->tradeManager->addDoneTrade($values); // přidání obchodu do db skrze model
		$this->presenter->redirect("this"); // reload stránky
	}


}