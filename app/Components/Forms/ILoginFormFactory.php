<?php


namespace App\Components\Forms;


interface ILoginFormFactory // Továrna na komponentu
{
	/**
	 * @return LoginForm
	 */
	function create();
}