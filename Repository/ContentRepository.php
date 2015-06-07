<?php
namespace Lpi\KernelBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ContentRepository extends EntityRepository implements ContentRepositoryInterface {

    public function findContentInZone($zoneSlug)
    {
        $response = $this->createQueryBuilder('content')
            ->join('content.zone','zone')
            ->where('zone.slug = :zoneSlug')
            ->setParameter('zoneSlug',$zoneSlug)->getQuery()->getOneOrNullResult();

        if(null !== $response){
            return $response->getContent();
        }

        return null;
    }
}