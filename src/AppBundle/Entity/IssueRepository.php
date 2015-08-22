<?php

namespace AppBundle\Entity;
use Doctrine\ORM\EntityRepository;

class IssueRepository extends EntityRepository
{

    public function findNbIssuesByPriorityTrackerForAnAppAndDate($software, $date)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('i.tracker, i.priority, count(i) AS count_i')
            ->from('AppBundle:Issue', 'i')
            ->where('i.software = :software')
            ->addGroupBy('i.tracker')
            ->addGroupBy('i.priority')
            ->setParameter('software', $software);
        return $qb->getQuery()
            ->getResult();
    }
}
