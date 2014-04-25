<?php

namespace Educacity\UserBundle\Form\Handler;

use Educacity\UserBundle\Entity\User;
use Educacity\UserBundle\Form\Type\UserRestType;
use Symfony\Component\Form\FormInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\BrowserKit\Request;
use Educacity\UserBundle\Entity\UserRepository;

class UserHandler
{
    private $em;
    private $factory;
    private $encoderFactory;

    public function __construct(EntityManager $em, FormFactoryInterface $formFactory, EncoderFactory $encoderFactory)
    {
        $this->em = $em;
        $this->factory = $formFactory;
        $this->encoderFactory = $encoderFactory;
    }

    public function get($id)
    {
        return $this->em->getRepository('UserBundle:User')->findOneById($id);
    }

    /**
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     * @param int $orderBy default order
     *
     * @return array
     */
    public function all($limit = 20, $offset = 0, $orderBy = null)
    {
        return $this->em->getRepository('UserBundle:User')->findBy(array(), $orderBy, $limit, $offset);
    }

    /**
     * Create a new User.
     *
     * @param $request
     *
     * @return User
     */
    public function post($request)
    {
        $user = new User();

        return $this->processForm($user, $request, 'POST');
    }

    /**
     * @param User $user
     * @param $request
     *
     * @return User
     */
    public function put(User $user, $request)
    {
        return $this->processForm($user, $request);
    }

    /**
     * @param User $user
     * @param $request
     *
     * @return User
     */
    public function patch(User $user, $request)
    {
        return $this->processForm($user, $request, 'PATCH');
    }

    /**
     * @param User $user
     *
     * @return User
     */
    public function delete(User $user)
    {
        $this->em->remove($user);
        $this->em->flush($user);
    }

    /**
     * Processes the form.
     *
     * @param User $user
     * @param array $request
     * @param String $method
     *
     * @return User
     *
     * @throws \Exception
     */
    private function processForm(User $user, $request, $method = "PUT")
    {
        $form = $this->factory->create(new UserRestType(), $user, array('method' => $method));
        $form->handleRequest($request);
        if (!$form->getErrors()) {
            $req = $request->request->get('user');

            if ($req['password']!= "") {
                $user->setPassword($req['password']);
                $encoder = $this->encoderFactory->getEncoder($user);
                $passwordEncoded = $encoder->encodePassword($user->getPassword(), $user->getSalt());
                $user->setPassword($passwordEncoded);
            }
            $this->em->persist($user);
            $this->em->flush($user);

            return $user;
        }

        throw new \Exception('Invalid submitted data');
    }
}

