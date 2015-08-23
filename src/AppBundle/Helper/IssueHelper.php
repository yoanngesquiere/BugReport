<?php

namespace AppBundle\Helper;

class IssueHelper
{

    private $priorityGroups;

    public function __construct($priorityGroups)
    {
        $this->priorityGroups = $priorityGroups;
    }

    public function groupPriorities(array $results, $priorityField ='priority')
    {
        $resultsUpdated = array();
        foreach ($results as $result) {
            foreach ($this->priorityGroups as $priorityGroup) {
                $matchFound = false;
                if (in_array($result[$priorityField], $priorityGroup['values'])) {
                    foreach ($resultsUpdated as $key => $resultUpdatedNode) {
                        if ($resultUpdatedNode['tracker'] == $result['tracker']
                            && $resultUpdatedNode[$priorityField] == $priorityGroup['use_value']
                        ) {
                            $matchFound = true;
                            $resultsUpdated[$key]['count_i'] += $result['count_i'];
                        }
                    }
                    if (!$matchFound) {
                        $result[$priorityField] = $priorityGroup['use_value'];
                    }
                }
            }
            if (!$matchFound) {
                $resultsUpdated[] = $result;
            }
        }
        return $resultsUpdated;
    }

    public function formatTotalsBy(array $results, $countColumnName, array $criteriaList, $totalsColumnName='all')
    {
        $totals = array();
        foreach ($criteriaList as $criteria) {
            $totals[$criteria] = array();
        }
        $totals[$totalsColumnName] = 0;

        foreach ($results as $result) {
            foreach ($criteriaList as $criteria) {
                if (!isset($totals[$criteria][$result[$criteria]])) {
                    $totals[$criteria][$result[$criteria]] = 0;
                }
                $totals[$criteria][$result[$criteria]] += $result[$countColumnName];
            }
            $totals[$totalsColumnName] += $result[$countColumnName];
        }
        return $totals;
    }
}
