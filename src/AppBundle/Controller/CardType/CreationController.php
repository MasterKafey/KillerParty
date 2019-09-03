<?php

namespace AppBundle\Controller\CardType;

use AppBundle\Entity\CardType;
use AppBundle\Form\Type\CardType\Creation\CreateCardTypeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CreationController extends Controller
{
    public function createCardTypeAction(Request $request)
    {
        $cardType = new CardType();
        $form = $this->createForm(CreateCardTypeType::class, $cardType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cardType);
            $em->flush();
            return $this->redirectToRoute('app_card_type_listing_list_card_type');
        }

        return $this->render('@Page/CardType/Creation/create_card_type.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}