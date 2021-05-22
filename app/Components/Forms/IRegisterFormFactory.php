<?php


namespace App\Components\Forms;


interface IRegisterFormFactory // Továrna na komponentu
{
	/**
	 * @return RegisterForm
	 */
	function create();
}