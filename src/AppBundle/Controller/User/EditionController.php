<?php

namespace AppBundle\Controller\User;

use AppBundle\Entity\User;
use AppBundle\Form\Type\User\Edition\EditUserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EditionController extends Controller
{
    public function editUserAction(Request $request, User $user)
    {
        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('app_user_listing_list');
        }

        return $this->render('@Page/User/Edition/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
