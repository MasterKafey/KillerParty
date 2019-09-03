<?php

namespace AppBundle\Controller\Player;

use AppBundle\Entity\Party;
use AppBundle\Form\Model\Player\Killing\KillPlayerModel;
use AppBundle\Form\Type\Player\Killing\KillPlayerType;
use AppBundle\Service\Business\PartyBusiness;
use AppBundle\Service\Business\PlayerBusiness;
use AppBundle\Service\Messenger\Player\Killing\KillPlayerMessenger;
use AppBundle\Service\Util\Console\Console;
use AppBundle\Service\Util\Console\Model\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class KillerController extends Controller
{
    public function killPlayerByGameMasterAction(Request $request, Party $party, PlayerBusiness $playerBusiness, PartyBusiness $partyBusiness, KillPlayerMessenger $killPlayerMessenger, Console $console)
    {
        if (!$party->getStarted()) {
            return $this->redirectToRoute('app_party_showing_show_party', array(
                'id' => $party->getId(),
            ));
        }
        if (!$partyBusiness->isUserOwner($party, $this->getUser())) {
            return $this->redirectToRoute('app_party_showing_show_party', array(
                'id' => $party->getId(),
            ));
        }
        $players = $party->getPlayers();
        $count = 0;
        foreach ($players as $player) {
            if (!$player->getGameMaster() && !$playerBusiness->isPlayerDead($player)) {
                ++$count;
            }
        }

        if ($count < 3) {
            $console->add('Impossible de tuer quelqu\'un avec moins de 3 joueurs', Message::TYPE_WARNING);
            return $this->redirectToRoute('app_party_showing_show_party', array(
                'id' => $party->getId(),
            ));
        }
        $killPlayerModel = new KillPlayerModel();
        $players = [];
        foreach ($party->getPlayers() as $player) {
            if($player->getGameMaster() || $playerBusiness->isPlayerDead($player)) {
                continue;
            }

            $players[] = $player;
        }
        $form = $this->createForm(KillPlayerType::class, $killPlayerModel, array(
            'party' => $party,
            'players' => $players,
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $victim = $killPlayerModel->getPlayer();
            $playerBusiness->killPlayerByGameMaster($victim);
            $killPlayerMessenger->sendKillPlayerMessage($victim, $partyBusiness->getGameMaster($party));

            return $this->redirectToRoute('app_party_showing_show_party', array(
                'id' => $victim->getParty()->getId(),
            ));
        }

        return $this->render('@Page/Player/Killing/kill_player.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
