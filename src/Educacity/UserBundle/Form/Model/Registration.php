<?php

namespace Educacity\UserBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;
use Educacity\UserBundle\Entity\User;

class Registration
{
    /**
     * @Assert\Type("Educacity\UserBundle\Entity\User")
     */
    protected $user;

    /**
     * @Assert\NotBlank()
     * @Assert\True()
     */
    protected $termsAccepted;

    /**
     * @param mixed $termsAccepted
     */
    public function setTermsAccepted($termsAccepted)
    {
        $this->termsAccepted = $termsAccepted;
    }

    /**
     * @return mixed
     */
    public function getTermsAccepted()
    {
        return $this->termsAccepted;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }
}