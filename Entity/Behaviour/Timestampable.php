<?php

namespace Lpi\KernelBundle\Entity\Behaviour;

trait Timestampable
{
    private $createdAt;
    private $updatedAt;

    public function prePersist()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    public function preUpdate()
    {
        $this->updatedAt = new \DateTime();
    }

}