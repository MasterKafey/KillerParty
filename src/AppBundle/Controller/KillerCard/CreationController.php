<?php

namespace AppBundle\Controller\KillerCard;

use AppBundle\Entity\KillerCard;
use AppBundle\Form\Type\KillerCard\Creation\CreateKillerCardType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CreationController extends Controller
{
    public function createKillerCardAction(Request $request)
    {
        $killerCard = new KillerCard();
        $form = $this->createForm(CreateKillerCardType::class, $killerCard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($killerCard);
            $em->flush();
            return $this->redirectToRoute('app_killer_card_listing_list_killer_card');
        }

        return $this->render('@Page/KillerCard/Creation/create_killer_card.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}