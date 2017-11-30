<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Workflow\Registry;
use App\Entity\Widget;
use Symfony\Component\Workflow\Exception\LogicException;


class WidgetController extends Controller
{
    /**
     * @Route("/widget")
     * @param Registry $workflows
     * @param Request $request
     * @return Response
     *
     * Instanciate a new widget
     */
    public function indexAction(Registry $workflows, Request $request, Widget $widget)
    {
        $currentWorkflow = $request->get('workflow') ? : 'widget_simple';
        $workflow = $workflows->get($widget, $currentWorkflow);

        // Get la liste des tarifs et render

        return $this->render('widget/index.html.twig', [
            'header' => "Sélection de tickets",
            'currentWorkflow' => $workflow->getName(),
            'transitions' => $workflow->getEnabledTransitions($widget),
            'currentPlace' => $widget->currentPlace
        ]);
    }

}
