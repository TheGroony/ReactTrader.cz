<?php


namespace App\Components\Forms;


interface ILogoutFormFactory // Továrna na komponentu
{
	/**
	 * @return LogoutForm
	 */
	function create();
}