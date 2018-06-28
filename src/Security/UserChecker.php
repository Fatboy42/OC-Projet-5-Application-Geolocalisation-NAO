<?php 

namespace App\Security;

use App\Exception\AccountUnvalidatedException;
use App\Exception\DeletedAccountException;
use App\Entity\AppUsers as AppUser;
//use Symfony\Component\Security\Core\Exception\AccountExpiredException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{
	public function checkPreAuth(UserInterface $user)
	{
		

		if (!$user instanceof AppUser) 
		{
			return;
		}

		if ($user->getMailValidationDate() === null) 
		{
			throw new AccountUnvalidatedException();	
		}

		if (null === $user->getMail()) 
		{
			throw new DeletedAccountException();
		}

		if (false === $user->getIsActive()) 
		{
			throw new DeletedAccountException();
		}


	}

	public function checkPostAuth(UserInterface $user)
	{

	}
}