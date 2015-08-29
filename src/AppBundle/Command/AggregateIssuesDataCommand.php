<?php

namespace AppBundle\Command;

use AppBundle\Entity\IssueAggregation;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class AggregateIssuesDataCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('issues:aggregate')
            ->setDescription('Aggregate issues to have statistics by month')
            ->addOption(
                'year',
                null,
                InputOption::VALUE_OPTIONAL,
                'year to process'
            )
            ->addOption(
                'week',
                null,
                InputOption::VALUE_OPTIONAL,
                'week to process'
            )
            ->setHelp('Example: <info>app/console issues:aggregate --year=2015 --week=32</info>');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Get options from the command line
        $inputWeek = $input->getOption('week');
        $inputYear = $input->getOption('year');

        $entityManager = $this->getContainer()->get('doctrine')->getManager();
        $issueRepository = $entityManager->getRepository('AppBundle:Issue');
        $oldestIssue = $issueRepository->getOldestIssueCreated();
        $year = $oldestIssue->getCreationDate()->format('Y');

        for ($year;$year <= date('Y'); $year++) {
            if ($inputYear && $inputYear != $year) {
                continue;
            }
            for ($week = 0; $week <=53; $week++) {
                if ($inputWeek && $inputWeek != $week) {
                    continue;
                }
                $results = $issueRepository->findNbIssuesByWeek($year, $week);

                foreach ($results as $result) {
                    $aggregation = new IssueAggregation();
                    $aggregation->setYear($year);
                    $aggregation->setWeek($week);
                    $aggregation->setTotalIssues($result['count_i']);
                    $aggregation->setTracker($result['tracker']);
                    $aggregation->setPriority($result['priority']);
                    $aggregation->setSoftware($result['software']);
                    $entityManager->persist($aggregation);
                }
            }
        }
        $entityManager->flush();
    }
}
