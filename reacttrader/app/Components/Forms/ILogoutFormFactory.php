<?php


namespace App\Components\Forms;


interface ILogoutFormFactory
{
	/**
	 * @return LogoutForm
	 */
	function create();
}