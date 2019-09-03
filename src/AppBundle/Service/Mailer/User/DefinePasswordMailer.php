<?php

namespace AppBundle\Service\Mailer\User;


use AppBundle\Entity\User;
use AppBundle\Service\Mailer\AbstractMailer;

class DefinePasswordMailer extends AbstractMailer
{
    /**
     * Send password definition mail.
     *
     * @param User $user
     */
    public function sendPasswordDefinitionMail(User $user)
    {
        $template = '@Mail/User/Registration/define_password.html.twig';
        $context = array(
            'user' => $user,
        );
        $this->sendMail($template, $context, $user->getEmail());
    }
}
