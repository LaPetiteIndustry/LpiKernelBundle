<?php

namespace Lpi\KernelBundle\Entity\Behaviour;

trait Enablable
{
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