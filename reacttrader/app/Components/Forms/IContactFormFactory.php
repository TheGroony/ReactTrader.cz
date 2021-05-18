<?php


namespace App\Components\Forms;


interface IContactFormFactory // Továrna na komponentu
{
	/**
	 * @return ContactForm
	 */
	function create();
}