<?php

namespace AppBundle\Service\Messenger;


use AppBundle\Service\API\PushBulletAPI;

class AbstractMessenger
{
    private $pushBulletAPI;

    private $twig;

    public function __construct(PushBulletAPI $pushBulletAPI, \Twig_Environment $twig)
    {
        $this->pushBulletAPI = $pushBulletAPI;
        $this->twig = $twig;
    }

    protected function send($recipientPhoneNumber, $template, $context)
    {
        $message = $this->twig->render($template, $context);

        $this->pushBulletAPI->sendMessage($recipientPhoneNumber, $message);
    }
}
