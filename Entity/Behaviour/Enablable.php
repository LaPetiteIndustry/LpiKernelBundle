<?php

namespace Lpi\KernelBundle\Entity\Behaviour;

use Doctrine\ORM\Mapping as ORM;

trait Enablable
{
    /**
     * @ORM\Column(type="boolean")
     */
    protected $isEnabled = false;

    /**
     * @return boolean
     */
    public function isIsEnabled()
    {
        return $this->isEnabled;
    }

    /**
     * @param boolean $isEnabled
     */
    public function setIsEnabled($isEnabled)
    {
        $this->isEnabled = $isEnabled;
    }

}