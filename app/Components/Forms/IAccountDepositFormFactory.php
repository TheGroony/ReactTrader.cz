<?php


namespace App\Components\Forms;


interface IAccountDepositFormFactory // Továrna na komponentu
{
	/**
	 * @return AccountDepositForm
	 */
	function create();
}