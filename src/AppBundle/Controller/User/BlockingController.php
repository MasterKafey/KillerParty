<?php

namespace AppBundle\Controller\User;

use AppBundle\Entity\User;
use AppBundle\Service\Util\Console\Console;
use AppBundle\Service\Util\Console\Model\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlockingController extends Controller
{
    public function blockUserAction(User $user, Console $console)
    {
        $user->setBlocked(true);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        $console->add('Utilisateur bloqué avec succès', Message::TYPE_SUCCESS);

        return $this->redirectToRoute('app_user_listing_list');
    }

    public function unblockUserAction(User $user, Console $console)
    {
        $user->setBlocked(false);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        $console->add('Utilisateur débloqué avec succès', Message::TYPE_SUCCESS);

        return $this->redirectToRoute('app_user_listing_list');
    }
}
