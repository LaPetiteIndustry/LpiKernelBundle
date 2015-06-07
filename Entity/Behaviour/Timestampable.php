<?php
/**
 * Created by IntelliJ IDEA.
 * User: david
 * Date: 07/06/2015
 * Time: 13:23
 */

namespace Lpi\KernelBundle\Entity\Trait;


trait Timestampable {

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