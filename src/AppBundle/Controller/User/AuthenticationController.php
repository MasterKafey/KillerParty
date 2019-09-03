<?php

namespace AppBundle\Controller\User;


use AppBundle\Entity\User;
use AppBundle\Form\Type\User\Authentication\AuthenticateUserType;
use AppBundle\Service\Business\UserBusiness;
use AppBundle\Service\Util\Console\Console;
use AppBundle\Service\Util\Console\Model\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Translation\TranslatorInterface;

class AuthenticationController extends Controller
{
    public function authenticateAction(Request $request, AuthenticationUtils $utils, Console $console, TranslatorInterface $translator)
    {
        $form = $this->createForm(AuthenticateUserType::class);
        $error = $utils->getLastAuthenticationError();

        if ($error !== null) {
            $console->add($translator->trans($error->getMessage(), array(), 'console'), Message::TYPE_DANGER);
        }

        $lastUsername = $utils->getLastUsername();
        $form->get('_username')->setData($lastUsername);
        $form->get('_csrf_token')->setData(
            $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue()
        );

        if (null !== $request->query->get('referer')) {
            $form->get('_target_path')->setData($request->query->get('referer'));
        }

        return $this->render('@Page/User/Authentication/authenticate.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function authenticateAsUserAction(User $user, UserBusiness $userBusiness)
    {
        $userBusiness->authenticateUser($user);

        return $this->redirectToRoute('app_user_listing_list');
    }

    public function checkAction()
    {
        throw new \RuntimeException('Should never be called');
    }

    public function logoutAction()
    {
        throw new \RuntimeException('Should never be called');
    }
}
