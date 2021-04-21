<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Components\Forms\ILoginFormFactory;
use App\Components\Forms\IRegisterFormFactory;
use App\Components\Forms\LoginForm;
use App\Components\Forms\RegisterForm;

class LoginPresenter extends BasePresenter
{
	/** @var ILoginFormFactory @inject */
	public $loginFormFactory;

	/** @var IRegisterFormFactory @inject */
	public $registerFormFactory;

	public function createComponentLoginForm(): LoginForm {
		return $this->loginFormFactory->create();
	}

	public function createComponentRegisterForm(): RegisterForm {
		return $this->registerFormFactory->create();
	}
}