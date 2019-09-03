<?php

namespace AppBundle\Service\Business;

use AppBundle\Entity\User;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

/**
 * Class UserBusiness
 * @package AppBundle\Service\Business
 */
class UserBusiness
{
    /**
     * @var TokenGeneratorInterface
     */
    private $tokenGenerator;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var RegistryInterface
     */
    private $registry;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    public function __construct(TokenGeneratorInterface $tokenGenerator, RegistryInterface $registry, TokenStorageInterface $tokenStorage, RequestStack $requestStack, EncoderFactoryInterface $encoderFactory)
    {
        $this->tokenGenerator = $tokenGenerator;
        $this->registry = $registry;
        $this->tokenStorage = $tokenStorage;
        $this->session = $requestStack->getMasterRequest()->getSession();
        $this->encoderFactory = $encoderFactory;
    }

    /**
     * Generate a new token for a defined User
     *
     * @param User $user : User to change the token from
     * @param bool $persist : Should changes be persisted ?
     *
     * @return string : Generated token
     */
    public function generatePasswordToken(User $user, $persist = true)
    {
        $token = $this->tokenGenerator->generateToken();
        $user->setPasswordToken($token);
        if ($persist) {
            $em = $this->registry->getManager();
            $em->persist($user);
            $em->flush();
        }
        return $token;
    }

    public function generatePhoneToken(User $user, $persist = true)
    {
        $token = rand(100000, 999999);
        $user->setPhoneToken($token);
        if($persist) {
            $em = $this->registry->getManager();
            $em->persist($user);
            $em->flush();
        }

        return $token;
    }

    /**
     * Authenticate current user as the defined User
     *
     * @param User $user : User to authenticate as
     */
    public function authenticateUser(User $user)
    {
        $token = new UsernamePasswordToken($user, null, 'secured_area', $user->getRoles());
        $this->tokenStorage->setToken($token);
        $this->session->set('_security_secured_area', serialize($token));
    }

    /**
     * Hash a password with hash strategy defined in security
     *
     * @param User $user
     *
     * @return string
     * @throws \Exception
     */
    public function hashPassword(User $user)
    {
        if (null === $user->getPlainPassword()) {
            throw new \Exception('Plain password can\'t be null');
        }
        $encoder = $this->encoderFactory->getEncoder($user);
        $password = $encoder->encodePassword($user->getPlainPassword(), $user->getSalt());
        $user->setPassword($password);
        return $password;
    }

    /**
     * Get current authenticated user
     *
     * @return User
     */
    public function getCurrentUser()
    {
        $user = $this->tokenStorage->getToken()->getUser();
        if ($user instanceof User) {
            return $user;
        }
        return null;
    }
    // -------------------------------------------------- //
    // ---------------------- Tests --------------------- //
    // -------------------------------------------------- //

    /**
     * Check if the password is valid
     *
     * @param User $user : Owner
     * @param string $password : Password to check
     *
     * @return bool
     */
    public function isPasswordValid(User $user, $password)
    {
        $encoder = $this->encoderFactory->getEncoder($user);
        return $encoder->isPasswordValid($user->getPassword(), $password, $user->getSalt());
    }

    /**
     * Is user password defined.
     *
     * @param User $user
     *
     * @return bool
     */
    public function isUserPasswordDefined(User $user)
    {
        return (null !== $user->getPassword());
    }
}