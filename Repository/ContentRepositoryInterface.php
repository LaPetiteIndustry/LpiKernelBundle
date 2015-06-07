<?php

namespace Lpi\KernelBundle\Repository;

use Doctrine\Common\Persistence\ObjectRepository;

interface ContentRepositoryInterface extends ObjectRepository {

    public function findContentInZone($zoneSlug);
}