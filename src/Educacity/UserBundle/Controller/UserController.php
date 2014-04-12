<?php

namespace Educacity\UserBundle\Controller;

use Educacity\FrontendBundle\Controller\CustomController;
use Educacity\UserBundle\Form\Model\Registration;
use Educacity\UserBundle\Form\Type\RegistrationType;
use Symfony\Component\HttpFoundation\Request;

class UserController extends CustomController
{
    public function registerAction(Request $request)
    {
        $registration = new Registration();
        $form = $this->createForm(new RegistrationType(), $registration);
        $formHandler = $this->get('user.create_user_form_handler');

        if ($formHandler->handle($form, $request)) {
            return $this->redirect($this->generateUrl('frontend_homepage'));
        }

        return $this->render('UserBundle:Commons:registration.html.twig', array('form' => $form->createView()));
    }
}
