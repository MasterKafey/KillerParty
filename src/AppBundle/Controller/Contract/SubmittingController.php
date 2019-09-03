<?php

namespace AppBundle\Controller\Contract;

use AppBundle\Entity\Contract;
use AppBundle\Entity\Player;
use AppBundle\Service\Business\ContractBusiness;
use AppBundle\Service\Business\PartyBusiness;
use AppBundle\Service\Messenger\Contract\Completting\CompletedContractMessenger;
use AppBundle\Service\Messenger\Contract\Submitting\SubmitContractMessenger;
use AppBundle\Service\Messenger\Contract\Submitting\UnsubmitContractMessenger;
use AppBundle\Service\Messenger\Player\Killing\KillPlayerMessenger;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SubmittingController extends Controller
{
    public function submitContractAction(Contract $contract, SubmitContractMessenger $contractMessenger)
    {
        if ($contract->getOwner()->getUser() === $this->getUser()) {
            $contract->setSubmitted(true);
            $em = $this->getDoctrine()->getManager();
            $em->persist($contract);
            $em->flush();
            $contractMessenger->sendSubmittedContract($contract);
        }

        return $this->redirectToRoute('app_party_showing_show_party', array(
            'id' => $contract->getOwner()->getParty()->getId(),
        ));
    }

    public function unsubmitContractAction(Contract $contract, PartyBusiness $partyBusiness, UnsubmitContractMessenger $contractMessenger)
    {
        if ($partyBusiness->getUserPlayer($contract->getOwner()->getParty(), $this->getUser())->getGameMaster()) {
            $contract->setSubmitted(false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($contract);
            $em->flush();
            $contractMessenger->sendUnsubmittedContract($contract);
        }

        return $this->redirectToRoute('app_party_showing_show_party', array(
            'id' => $contract->getOwner()->getParty()->getId(),
        ));
    }

    public function completedContractAction(Contract $contract, PartyBusiness $partyBusiness, KillPlayerMessenger $killPlayerMessenger, ContractBusiness $contractBusiness)
    {
        if ($partyBusiness->getUserPlayer($contract->getOwner()->getParty(), $this->getUser())->getGameMaster()) {
            $newContract = $contractBusiness->getNextContract($contract);
            $contract->setCompleted(true);
            $em = $this->getDoctrine()->getManager();
            $em->persist($contract);
            $em->persist($newContract);
            $em->flush();

            $killPlayerMessenger->sendKillPlayerMessage($contract->getTarget(), $contract->getOwner());
        }

        return $this->redirectToRoute('app_party_showing_show_party', array(
            'id' => $contract->getOwner()->getParty()->getId(),
        ));
    }
}
