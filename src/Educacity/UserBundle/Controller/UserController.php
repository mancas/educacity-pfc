<?php

namespace Educacity\UserBundle\Controller;

use Educacity\FrontendBundle\Controller\CustomController;
use Educacity\UserBundle\Form\Model\Registration;
use Educacity\UserBundle\Form\Type\RegistrationType;

class UserController extends CustomController
{
    public function registerAction()
    {
        $registration = new Registration();
        $form = $this->createForm(new RegistrationType(), $registration);
        return $this->render('UserBundle:Commons:registration.html.twig', array('form' => $form->createView()));
    }
}
