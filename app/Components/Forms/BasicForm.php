<?php


namespace App\Components\Forms;


use Nette;
use Nette\Application\UI\Form;

abstract class BasicForm extends \Nette\Application\UI\Control // Společné prvky pro většinu form komponent
{
	/** @var callable */
	public $onError;
	/** @var callable */
	public $onSuccess;
	/** @var string */
	protected $customTemplate = "";
	protected $templateDir = "/../templates/Forms/%s.latte";
}