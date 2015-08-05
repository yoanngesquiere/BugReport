<?php

namespace BugReport\Bundle\AppBundle\Entity;
use Doctrine\ORM\EntityRepository;

class IssueRepository extends EntityRepository
{

    public function getNbIssuesByPriorityTrackerForAnAppAndDate($app, $date)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('i.tracker, count(i)')
            ->from('BugReportAppBundle:Issue', 'i')
            ->where('i.software = :app')
            ->addGroupBy('i.tracker')
            ->addGroupBy('i.priority')
            ->setParameter('app', $app);
        return $qb->getQuery()
            ->getResult();
    }

}
