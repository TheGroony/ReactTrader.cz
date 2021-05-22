<?php

namespace App\Models\Security;


use App\Orm\Entity\User;
use App\Orm\Orm;
use Nette\Security\Authenticator;
use Nette\Security\IIdentity;
use Nette\Security\Passwords;
use Nette\Security\SimpleIdentity;
use Nette\SmartObject;
use Nette\Security as NS;

class DatabaseAuthenticator implements Authenticator // Třída ověřující uživatele, zajišťuje login a registraci
{
	use SmartObject;
	/** @var Orm */
	protected $orm;

	public function __construct(Orm $orm) {
		$this->orm = $orm;
	}

	// login checknutí
	public function authenticate(string $email, string $password): SimpleIdentity
	{

		$row = $this->orm->users->getBy(["email" => $email]);

		if(!$row) {
			throw new NS\AuthenticationException('Uživatel nebyl nalezen.');
		}
		if(!NS\Passwords::verify($password, $row->password)) {
			throw new NS\AuthenticationException('Bylo zadáno špatné heslo.');
		}
		if($row->role == User::ROLE_WAITING) {
			throw new NS\AuthenticationException("Uživatel zatím není ověřený a nemá tak přístup k aplikaci");
		}

		return new SimpleIdentity($row->id, $row->role, ["id" => $row->id,"email" => $row->email, "name" => $row->name]);
	}

	/**
	 * Přidá nového uživatele do databáze skrze registrační formulář
	 *
	 * @param string $email
	 * @param string $name
	 * @param string $password
	 *
	 * @return \Nextras\Orm\Entity\IEntity|User
	 */
	public function registerUser(string $email, string $name, string $password) {

		$user = new User();

		$user->name = $name;
		$user->email = $email;
		$user->password = Passwords::hash($password);
		$user->role = USER::ROLE_WAITING;

		return $this->orm->persistAndFlush($user);
	}
}