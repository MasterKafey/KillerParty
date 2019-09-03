<?php

namespace AppBundle\Form\Model\User;

class RequestPasswordModel
{
    /**
     * @var string
     */
    private $email;

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set email.
     *
     * @param string $email
     * @return RequestPasswordModel
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
}
