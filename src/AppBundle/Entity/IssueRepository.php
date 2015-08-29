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

    public function findNbIssuesByWeek($year, $week)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('i.tracker, i.priority, s.name as software, count(i) AS count_i')
            ->from('AppBundle:Issue', 'i')
            ->join('AppBundle:software', 's')
            ->where('WEEK(i.creationDate) <= :week')
            ->andWhere('YEAR(i.creationDate) <= :year')
            ->andWhere('YEAR(i.resolvedDate) >= :year OR i.resolvedDate=0')
            ->andWhere('WEEK(i.resolvedDate) >= :week OR i.resolvedDate=0')
            ->addGroupBy('i.tracker')
            ->addGroupBy('i.priority')
            ->setParameter('week', $week)
            ->setParameter('year', $year);
        return $qb->getQuery()
            ->getResult();
    }

    public function getOldestIssueCreated()
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('i')
            ->from('AppBundle:Issue', 'i')
            ->orderBy('i.creationDate', 'ASC');

        return $qb->getQuery()
            ->setMaxResults(1)
            ->getSingleResult();
    }
}
