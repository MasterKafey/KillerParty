<?php

namespace AppBundle\Controller\User;

use AppBundle\Entity\User;
use AppBundle\Service\Util\SearchEngine;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ListingController extends Controller
{
    public function listUserAction()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('@Page/User/Listing/list.html.twig', array(
            'users' => $users,
        ));
    }
}
