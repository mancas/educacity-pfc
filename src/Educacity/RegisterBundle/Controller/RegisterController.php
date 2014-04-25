<?php

namespace Educacity\RegisterBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RegisterController extends FOSRestController
{
    //curl -v -H "Accept: application/json" -H "Content-type: application/json" -X POST -d '{"user":{"email": "foo@example.org", "password": "hahaha"}}' educacity.me/app_dev.php/register-from-app >> error.html
    public function registerAction(Request $request)
    {
        try {
            $user = $this->get('user.handler')->post($request);
            $jsonResponse = json_encode(array('ok' => $user->getEmail()));
            $response = new \Symfony\Component\HttpFoundation\Response($jsonResponse);
            $response->headers->set('Content-Type', 'application/json');

            return $response;
        } catch (InvalidFormException $exception) {
            return $exception->getForm();
        }
    }
}
