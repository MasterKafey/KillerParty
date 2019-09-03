<?php

namespace AppBundle\Service\Messenger\User;

use AppBundle\Entity\User;
use AppBundle\Service\Messenger\AbstractMessenger;

class PhoneVerificationMessenger extends AbstractMessenger
{
    public function sendPhoneVerificationMessage(User $user)
    {
        $this->send($user->getPhoneNumber(), '@Message/User/Verification/phone_verification_message.html.twig', array(
            'user' => $user,
        ));
    }
}
