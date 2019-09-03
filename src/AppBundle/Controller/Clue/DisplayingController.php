<?php

namespace AppBundle\Controller\Clue;

use AppBundle\Entity\Clue;
use AppBundle\Resources\views\Message\DisplayedClueMessenger;
use AppBundle\Service\Business\PartyBusiness;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DisplayingController extends Controller
{
    public function displayClueAction(Clue $clue, PartyBusiness $partyBusiness, DisplayedClueMessenger $messenger)
    {
        $party = $clue->getTrial()->getContract()->getOwner()->getParty();
        if ($partyBusiness->getGameMaster($party)->getUser() !== $this->getUser()) {
            return $this->redirectToRoute('app_party_showing_show_party', array(
                'id' => $party->getId(),
            ));
        }

        $clue->setDisplayed(true);
        $em = $this->getDoctrine()->getManager();
        $em->persist($clue);
        $em->flush();
        $messenger->sendDisplayedClueMessage($clue);
        
        return $this->redirectToRoute('app_party_showing_show_party', array(
            'id' => $party->getId(),
        ));
    }

    public function hideClueAction(Clue $clue, PartyBusiness $partyBusiness)
    {
        $party = $clue->getTrial()->getContract()->getOwner()->getParty();
        if ($partyBusiness->getGameMaster($party)->getUser() !== $this->getUser()) {
            return $this->redirectToRoute('app_party_showing_show_party', array(
                'id' => $party->getId(),
            ));
        }

        $clue->setDisplayed(false);
        $em = $this->getDoctrine()->getManager();
        $em->persist($clue);
        $em->flush();

        return $this->redirectToRoute('app_party_showing_show_party', array(
            'id' => $party->getId(),
        ));
    }

}
