<?php

namespace AppBundle\Controller\User;

use AppBundle\Entity\User;
use AppBundle\Form\Model\User\RequestPasswordModel;
use AppBundle\Form\Type\User\Defining\DefinePasswordType;
use AppBundle\Form\Type\User\Requesting\RequestPasswordType;
use AppBundle\Form\Type\User\Resetting\ResetPasswordType;
use AppBundle\Service\Business\UserBusiness;
use AppBundle\Service\Mailer\User\RequestPasswordMailer;
use AppBundle\Service\Util\Console\Console;
use AppBundle\Service\Util\Console\Model\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ForgotPasswordController extends Controller
{
    public function requestPasswordAction(Request $request, RequestPasswordMailer $mailer, Console $console, UserBusiness $userBusiness)
    {
        $requestPasswordModel = new RequestPasswordModel();
        $form = $this->createForm(RequestPasswordType::class, $requestPasswordModel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository(User::class)->findOneBy(array(
                'email' => $requestPasswordModel->getEmail(),
            ));
            $userBusiness->generatePasswordToken($user);
            if (null !== $user) {
                $mailer->sendRequestPasswordMail($user);
            }

            $console->add('Un email de réinitialisation à été envoyé si l\'adresse mail est correct', Message::TYPE_SUCCESS);
        }

        return $this->render('@Page/User/ForgotPassword/request_password.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function resetAction(Request $request, User $user, Console $console, UserBusiness $userBusiness, $tokenPassword)
    {
        if ($tokenPassword !== $user->getPasswordToken()) {
            $console->add('Lien expiré : générez une nouvelle requête de réinitialisation de mot de passe', Message::TYPE_WARNING);

            return $this->redirectToRoute('app_user_authentication_authenticate');
        }

        $form = $this->createForm(ResetPasswordType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userBusiness->hashPassword($user);
            $user->setPasswordToken(null);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $userBusiness->authenticateUser($user);
            $console->add('Votre mot de passe à correctement été mis à jour', Message::TYPE_SUCCESS);
            return $this->redirectToRoute('app_home');
        }

        return $this->render('@Page/User/ForgotPassword/reset.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
