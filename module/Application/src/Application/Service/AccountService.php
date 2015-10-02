<?php

namespace Application\Service;

use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Result;
use Zend\Crypt\Password\Bcrypt;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject;

use Application\Entity\Account;
use Application\Entity\Credentials;
use Application\Entity\Contact;
use Application\Entity\Person;
use Application\Entity\PhoneNumber;
use Application\Entity\EMailAddress;

/**
 * Authentication service.
 */

class AccountService
{
	private static $BCRYPT;
	private $objectManager;
	private $authenticationService;

	public function __construct (ObjectManager $objectManager, AuthenticationService $authenticationService)
    {
    	$this->objectManager = $objectManager;
    	$this->authenticationService = $authenticationService;
    	static::$BCRYPT = new Bcrypt ( );
    }

    public static function hashPassword ($plainText)
    {
    	return static::$BCRYPT->create($plainText);
    }

    /**
     * Used outside of scope of the class.
     */
    public static function checkPassword ($plainText, $storedHash)
    {
    	return static::$BCRYPT->verify($plainText, $storedHash);
    }
    
    /**
     * Creates new account if username is not taken yet.
     * Tries to authenticate the user
     * if username is already taken.
     * @param string $username login of the user
     * @param string $password plain text password
     * @throws \Exception
     */

    public function create ($username, $password)
    {
    	$account = $this->objectManager->getRepository('Application\Entity\Account')->findBy(array('username' => $username));
    	if ($account != null)
    	{
    		return $this->authenticate($username, $password);
    	}
    	try
    	{
    		try
    		{
		    	$account = new Account ( );
		    	$passwordHash = static::hashPassword($password);
		    	$email = new EMailAddress ( );
		    	$person = new Person ( );
		    	$credentials = new Credentials( );
		    	$credentials->setOwner($person);
		    	$credentials->setNameFirst($username);
		    	$person->addCredential($credentials);
		    	$email->setValue($username)->setOwner($person);
		    	$person->addEmailAddress($email);

		    	$account->setUsername($username)->setPassword($passwordHash);
		    	$account->setPerson($person);
				$this->objectManager->persist($email);
				$this->objectManager->persist($credentials);
				$this->objectManager->persist($person);
				$this->objectManager->persist($account);
				$this->objectManager->flush( );
				$success = true;
    		} catch (\Exception $e) {
    			throw new \Exception ("Failed to write data to the database.", 500, $e);
    			$success = false;
    		}
    		return $this->authenticate($username, $password);
    	} catch (\Exception $e) {
    		throw new \Exception ("Failed to create an account due to unknown internal server error.", 500, $e);
    	}
    }
    
    /**
     * Retrieves instance of an account by username and password.
     * If usrename is not registered withing the system,
     * attempts to create an account.
     * @param string $username login of the user
     * @param string $password plain text password
     * @throws \Exception
     */

	public function authenticate ($username, $password)
	{
		$adapter = $this->authenticationService->getAdapter( );
		$adapter->setIdentityValue($username);
		$adapter->setCredentialValue($password);
		$result = $this->authenticationService->authenticate( );

		if ($result->isValid( ))
		{
			return $result->getIdentity( );
		} else {
			$code = $result->getCode( );	
			switch ($code) 
			{
			    case Result::FAILURE_IDENTITY_NOT_FOUND:
					return $this->create($username, $password);
			        break;

			    case Result::FAILURE_CREDENTIAL_INVALID:
					throw new \Exception ("Provided password is invalid.");
			        break;
			    default:
					throw new \Exception ("Failed to authenticate an account due to unknown internal server error.");
			}
		}
	}

	/**
	 * Retrieves authenticated account from the storage.
	 */

	public function retrieve ( )
	{
		$account = $this->authenticationService->getIdentity( );
		if ($account)
		{
			return $account;
		}
		//throw new \Exception ("Failed to retrieve an account due to internal server error.");
	}

	public function invalidateSession ( )
	{
		$this->authenticationService->clearIdentity( );
	}

	public function isAuthenticated ( )
	{
		return $this->authenticationService->hasIdentity( );
	}
}