<?php

namespace AppBundle\Service\Mailer\User;


use AppBundle\Entity\User;
use AppBundle\Service\Mailer\AbstractMailer;

class RequestPasswordMailer extends AbstractMailer
{
    public function sendRequestPasswordMail(User $user)
    {
        $template = '@Mail/User/ForgotPassword/request.html.twig';
        $context = array(
            'user' => $user,
        );
        $this->sendMail($template, $context, $user->getEmail());
    }
}
