<?php

namespace AppBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 */
class User implements UserInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $plainPassword;

    /**
     * @var array
     */
    private $roles;

    /**
     * @var bool
     */
    private $blocked;

    /**
     * @var string
     */
    private $passwordToken;

    /**
     * @var string
     */
    private $phoneNumber;

    /**
     * @var string
     */
    private $phoneToken;

    /**
     * @var string
     */
    private $salt;

    /**
     * @var Player[]
     */
    private $players;

    public function __construct()
    {
        $this->roles = array('ROLE_USER');
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $this->blocked = false;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->getEmail();
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set plainPassword
     *
     * @param string $plainPassword
     *
     * @return User
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * Get plainPassword
     *
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * Set roles
     *
     * @param array $roles
     *
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Set blocked
     *
     * @param boolean $blocked
     *
     * @return User
     */
    public function setBlocked($blocked)
    {
        $this->blocked = $blocked;

        return $this;
    }

    /**
     * Get blocked
     *
     * @return bool
     */
    public function getBlocked()
    {
        return $this->blocked;
    }

    /**
     * Set passwordToken
     *
     * @param string $passwordToken
     *
     * @return User
     */
    public function setPasswordToken($passwordToken)
    {
        $this->passwordToken = $passwordToken;

        return $this;
    }

    /**
     * Get passwordToken
     *
     * @return string
     */
    public function getPasswordToken()
    {
        return $this->passwordToken;
    }

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }
    
    /**
     * Erase credentials.
     */
    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    /**
     * Get phone number.
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set phone number.
     *
     * @param $phoneNumber
     * @return $this
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get token phone.
     *
     * @return string
     */
    public function getPhoneToken()
    {
        return $this->phoneToken;
    }

    /**
     * Set token phone.
     *
     * @param string $phoneToken
     * @return User
     */
    public function setPhoneToken($phoneToken)
    {
        $this->phoneToken = $phoneToken;

        return $this;
    }

    /**
     * Get players.
     *
     * @return Player[]
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * Set players.
     *
     * @param Player[] $players
     *
     * @return User
     */
    public function setPlayers($players)
    {
        $this->players = $players;

        return $this;
    }
}
