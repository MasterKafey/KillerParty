<?php

namespace AppBundle\Controller\Party;

use AppBundle\Entity\Party;
use AppBundle\Entity\Trial;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShowingController extends Controller
{
    public function showPartyAction(Party $party)
    {
        $trials = $this->getDoctrine()->getRepository(Trial::class)->getCurrentTrials($party);

        return $this->render('@Page/Party/Showing/show_party.html.twig', array(
            'party' => $party,
            'trials' => $trials,
        ));
    }
}