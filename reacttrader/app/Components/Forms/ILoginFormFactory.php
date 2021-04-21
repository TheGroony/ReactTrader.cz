<?php


namespace App\Components\Forms;


interface ILoginFormFactory
{
	/**
	 * @return LoginForm
	 */
	function create();
}