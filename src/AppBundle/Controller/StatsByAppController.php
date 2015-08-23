<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\IssueType;
use AppBundle\Helper\IssueHelper;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Issue;

/**
 * Class StatsByAppController
 * @package AppBundle\Controller
 * @Route("/statsbyapp");
 */
class StatsByAppController extends Controller
{
    /**
     * @Route("/", name="statsbyapp_homepage")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new Issue();
        $form = $this->createForm(new IssueType(), $entity, array(
            'action' => $this->generateUrl('statsbyapp_homepage'),
            'method' => 'POST',
        ))->add('submit', 'submit', array('label' => 'Search'));

        $software = 0;
        $form->handleRequest($request);
        if ($form->isValid()) {
            $software = $entity->getSoftware()->getId();
        }

        $stats = $em->getRepository('AppBundle:Issue')->findNbIssuesByPriorityTrackerForAnAppAndDate($software, null);
        $helper = new IssueHelper($this->getParameter('priority_groups'));
        $stats = $helper->groupPriorities($stats);
        $totals = $helper->formatTotalsBy($stats, 'count_i', array('tracker', 'priority'), 'all');

        return array(
            'stats'         => $stats,
            'app_selector'  => $form->createView(),
            'software'      => $entity->getSoftware(),
            'totals'        => $totals
        );
    }
}
