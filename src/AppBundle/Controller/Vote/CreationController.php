<?php

namespace AppBundle\Controller\Vote;

use AppBundle\Entity\Player;
use AppBundle\Entity\Trial;
use AppBundle\Entity\Vote;
use AppBundle\Form\Type\Vote\Creation\CreateVoteType;
use AppBundle\Service\Business\PartyBusiness;
use AppBundle\Service\Business\PlayerBusiness;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CreationController extends Controller
{
    public function createVoteAction(Request $request, Trial $trial, PartyBusiness $partyBusiness, PlayerBusiness $playerBusiness)
    {
        $party = $trial->getContract()->getOwner()->getParty();
        $currentPlayer = $partyBusiness->getUserPlayer($party, $this->getUser());
        if($currentPlayer->getGameMaster() || $playerBusiness->isPlayerDead($currentPlayer)) {
            return $this->redirectToRoute('app_party_showing_show_party', array(
                'id' => $party->getId(),
            ));
        }
        $vote = new Vote();
        $vote
            ->setOwner($currentPlayer)
            ->setTrial($trial)
            ;
        foreach ($trial->getVotes() as $currentVote) {
            if ($currentVote->getOwner() === $currentPlayer) {
                $vote = $currentVote;
            }
        }

        $players = $this->getDoctrine()->getRepository(Player::class)->findBy(array(
            'party' => $party,
            'isGameMaster' => false,
        ));

        $votingPlayers = [];
        foreach ($players as $player) {
            if ($player === $currentPlayer || $playerBusiness->isPlayerDead($player)) {
                continue;
            }

            $votingPlayers[] = $player;
        }

        $form = $this->createForm(CreateVoteType::class, $vote, array(
            'players' => $votingPlayers,
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($vote);
            $em->flush();

            return $this->redirectToRoute('app_party_showing_show_party', array(
                'id' => $party->getId(),
            ));
        }

        return $this->render('@Page/Vote/Creation/create_vote.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
