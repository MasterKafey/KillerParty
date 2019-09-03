<?php

namespace AppBundle\Controller\User;

use AppBundle\Entity\User;
use AppBundle\Form\Type\User\Defining\DefinePasswordType;
use AppBundle\Form\Type\User\Registration\RegisterUserType;
use AppBundle\Service\Business\UserBusiness;
use AppBundle\Service\Mailer\User\DefinePasswordMailer;
use AppBundle\Service\Messenger\User\PhoneVerificationMessenger;
use AppBundle\Service\Util\Console\Console;
use AppBundle\Service\Util\Console\Model\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends Controller
{
    public function registerAction(Request $request, UserBusiness $userBusiness, Console $console, DefinePasswordMailer $mailer, PhoneVerificationMessenger $messenger)
    {
        $user = new User();
        $form = $this->createForm(RegisterUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userBusiness->generatePasswordToken($user, false);
            $userBusiness->generatePhoneToken($user, true);

            $mailer->sendPasswordDefinitionMail($user);
            $messenger->sendPhoneVerificationMessage($user);
            $console->add('Un email de confirmation a été envoyé à ' . $user->getEmail(), Message::TYPE_INFO);
            $console->add('Un code de vérification a été envoyé au ' . $user->getPhoneNumber(), Message::TYPE_INFO);
        }

        return $this->render('@Page/User/Registration/register.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function definePasswordAction(Request $request, Console $console, UserBusiness $userBusiness, User $user, $tokenPassword)
    {
        if ($tokenPassword !== $user->getPasswordToken()) {
            $console->add('Lien expiré : générez une nouvelle requête de réinitialisation de mot de passe', Message::TYPE_WARNING);

            return $this->redirectToRoute('app_user_authentication_authenticate');
        }

        $phoneToken = $user->getPhoneToken();
        $user->setPhoneToken(null);
        $form = $this->createForm(DefinePasswordType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($user->getPhoneToken() !== $phoneToken) {
                $console->add('Le code de vérification est invalide', Message::TYPE_DANGER);
            } else {
                $userBusiness->hashPassword($user);
                $user->setPasswordToken(null);
                $user->setPhoneToken(null);

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                $userBusiness->authenticateUser($user);
                return $this->redirectToRoute('app_home');
            }
        }

        return $this->render('@Page/User/Registration/define_password.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
