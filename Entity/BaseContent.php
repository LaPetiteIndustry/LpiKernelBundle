<?php

namespace Lpi\KernelBundle\Entity;

use Application\Lpi\KernelBundle\Entity\Zone;
use Lpi\KernelBundle\Entity\Behaviour\Timestampable;

abstract class BaseContent {

    use Timestampable;

    private $content;

    private $zone;

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return Zone
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @param mixed $zone
     */
    public function setZone(Zone $zone)
    {
        $this->zone = $zone;
    }

    public function getExtrait() {
        return substr($this->getContent(),0, 50).'...';
    }


    public function __toString(){
        return $this->getExtrait();
    }

}