<?php

declare(strict_types=1);

namespace App\Presenters;


use App\Components\Forms\ContactForm;
use App\Components\Forms\IContactFormFactory;

final class HomepagePresenter extends BasePresenter // presenter hlavní stránky
{
  	/** @var IContactFormFactory @inject */
	public $contactFormFactory;

	// komponenta kontaktního formuláře
	public function createComponentContactForm(): ContactForm {
		return $this->contactFormFactory->create();
	}
}
