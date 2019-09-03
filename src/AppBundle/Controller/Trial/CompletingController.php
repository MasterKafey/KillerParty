<?php

namespace AppBundle\Controller\Trial;


use AppBundle\Entity\Trial;
use AppBundle\Service\Business\PartyBusiness;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CompletingController extends Controller
{
    public function completedTrialAction(Trial $trial, PartyBusiness $partyBusiness)
    {
        $party = $trial->getContract()->getOwner()->getParty();
        if($partyBusiness->getGameMaster($party)->getUser() !== $this->getUser()) {
            return $this->redirectToRoute('app_party_showing_show_party', array(
                'id' => $party->getId(),
            ));
        }

        $trial->setCompleted(true);
        $em = $this->getDoctrine()->getManager();
        $em->persist($trial);
        $em->flush();

        return $this->redirectToRoute('app_party_showing_show_party', array(
            'id' => $party->getId(),
        ));
    }
}
