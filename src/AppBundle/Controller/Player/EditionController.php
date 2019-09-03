<?php

namespace AppBundle\Controller\Player;

use AppBundle\Entity\Player;
use AppBundle\Form\Type\Player\Edition\EditContractType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EditionController extends Controller
{
    public function editPlayerAction(Request $request, Player $player)
    {
        $form = $this->createForm(EditContractType::class, $player, array('party' => $player->getParty()));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($player);
            $em->flush();

            return $this->redirectToRoute('app_party_showing_show_party', array(
                'id' => $player->getParty()->getId(),
            ));
        }

        return $this->render('@Page/Player/Edition/edit_player.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
