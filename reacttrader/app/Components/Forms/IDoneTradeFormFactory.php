<?php


namespace App\Components\Forms;


interface IDoneTradeFormFactory // Továrna na komponentu
{
	/**
	 * @return DoneTradeForm
	 */
	function create();
}