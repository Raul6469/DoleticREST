<?php

namespace KernelBundle\Repository;

/**
 * DivisionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DivisionRepository extends DoleticRepository
{
    public function getDivisionRepartition()
    {
        $em = $this->getEntityManager();
        $qb = $em->createQuery(
            'select d.label as name, count(u_p.id) as value from KernelBundle:UserPosition as u_p, KernelBundle:Position as p, KernelBundle:Division as d where u_p.position = p.id and p.division = d.id and d.label != \'Ancien\' group by d.label'
        );
        return $qb->getResult();
    }
}
