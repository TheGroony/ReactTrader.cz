<?php


namespace App\Components\Forms;


interface IRegisterFormFactory
{
	/**
	 * @return RegisterForm
	 */
	function create();
}