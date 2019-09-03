<?php

namespace AppBundle\Controller\CardType;

use AppBundle\Entity\CardType;
use AppBundle\Form\Type\CardType\Edition\EditCardTypeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EditionController extends Controller
{
    public function editCardTypeAction(Request $request, CardType $cardType)
    {
        $form = $this->createForm(EditCardTypeType::class, $cardType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($cardType);
            $em->flush();

            return $this->redirectToRoute('app_card_type_listing_list_card_type');
        }

        return $this->render('@Page/CardType/Edition/edit_card_type.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}