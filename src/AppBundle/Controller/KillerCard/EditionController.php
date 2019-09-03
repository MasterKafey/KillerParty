<?php

namespace AppBundle\Controller\KillerCard;

use AppBundle\Entity\KillerCard;
use AppBundle\Form\Type\KillerCard\Edition\EditKillerCardType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EditionController extends Controller
{
    public function editKillerCardAction(Request $request, KillerCard $killerCard)
    {
        $form = $this->createForm(EditKillerCardType::class, $killerCard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($killerCard);
            $em->flush();

            return $this->redirectToRoute('app_killer_card_listing_list_killer_card');
        }

        return $this->render('@Page/KillerCard/Edition/edit_killer_card.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}