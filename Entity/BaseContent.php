<?php

namespace Lpi\KernelBundle\Entity;

use Application\Lpi\KernelBundle\Entity\Zone;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="content")
 */
class Content {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50000)
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Lpi\KernelBundle\Entity\Zone")
     * @ORM\JoinColumn(name="zone_id", referencedColumnName="id", onDelete="CASCADE")
     **/
    private $zone;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

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
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
        return substr($this->getContent(),0, 50)."...";
    }


}