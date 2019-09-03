<?php

namespace AppBundle\Controller\Contract;

use AppBundle\Entity\Contract;
use AppBundle\Form\Type\Contract\Edition\EditContractType;
use AppBundle\Service\Business\PartyBusiness;
use AppBundle\Service\Business\PlayerBusiness;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EditionController extends Controller
{
    public function editContractAction(Request $request, Contract $contract, PartyBusiness $partyBusiness, PlayerBusiness $playerBusiness)
    {
        $party = $contract->getTarget()->getParty();
        if (!$partyBusiness->getUserPlayer($party, $this->getUser())->getGameMaster()) {
            return $this->redirectToRoute('app_party_showing_show_party', array(
                'id' => $party->getId(),
            ));
        }

        $players = [];
        foreach ($party->getPlayers() as $player) {
            if($player->getGameMaster() || $player === $contract->getOwner() || $playerBusiness->isPlayerDead($player)) {
                continue;
            }

            $players[] = $player;
        }
        $form = $this->createForm(EditContractType::class, $contract, array(
            'party' => $party,
            'players' => $players,
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contract);
            $em->flush();

            return $this->redirectToRoute('app_party_showing_show_party', array(
                'id' => $party->getId(),
            ));
        }

        return $this->render('@Page/Contract/Edition/edit_contract.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
