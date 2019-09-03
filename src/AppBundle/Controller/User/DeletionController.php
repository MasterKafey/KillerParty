<?php

namespace AppBundle\Controller\User;

use AppBundle\Entity\User;
use AppBundle\Service\Util\Console\Console;
use AppBundle\Service\Util\Console\Model\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DeletionController extends Controller
{
    public function deleteUserAction(User $user, Console $console)
    {
        if($user->getPassword() === null) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
            $console->add( 'L\'utilisateur a été supprimé avec succès', Message::TYPE_SUCCESS);
        } else {
            $console->add('L\'utilisateur ne peut pas être supprimé', Message::TYPE_WARNING);
        }

        return $this->redirectToRoute('app_user_listing_list');
    }
}
