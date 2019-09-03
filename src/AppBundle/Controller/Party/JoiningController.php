<?php

namespace AppBundle\Controller\Party;

use AppBundle\Entity\Party;
use AppBundle\Entity\Player;
use AppBundle\Service\Util\Console\Console;
use AppBundle\Service\Util\Console\Model\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class JoiningController extends Controller
{
    public function joinPartyAction(Party $party, Console $console)
    {
        if($party->getStarted()) {
            $console->add('Vous ne pouvez pas rejoindre une partie déjà commencé', Message::TYPE_WARNING);
            return $this->redirectToRoute('app_party_showing_show_party', array(
                'id' => $party->getId(),
            ));
        }

        $player = $this->getDoctrine()->getRepository(Player::class)->findOneBy(array(
            'party' => $party,
            'user' => $this->getUser(),
        ));

        if(null === $player) {
            $player = new Player();
            $player
                ->setParty($party)
                ->setUser($this->getUser())
            ;
            $party->addPlayer($player);

            $em = $this->getDoctrine()->getManager();
            $em->persist($player);
            $em->persist($party);
            $em->flush();
        }

        return $this->redirectToRoute('app_party_showing_show_party', array(
            'id' => $party->getId(),
        ));
    }
}
