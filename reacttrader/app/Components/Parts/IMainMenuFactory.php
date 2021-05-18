<?php


namespace App\Components\Parts;


interface IMainMenuFactory // továrna na hlavní menu
{
	/**
	 * @return MainMenu
	 */
	function create();
}