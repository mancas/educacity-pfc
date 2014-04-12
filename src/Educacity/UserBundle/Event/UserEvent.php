<?php

namespace Educacity\UserBundle\Event;

use Educacity\UserBundle\Entity\User;
use Symfony\Component\EventDispatcher\Event;

class UserEvent extends Event
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User $user
     */
    public function getUser()
    {
        return $this->user;
    }
}