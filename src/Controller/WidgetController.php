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
     * @param Widget $widget
     * @return Response
     */
    public function indexAction(Registry $workflows, Request $request, Widget $widget)
    {
        $currentWorkflow = $request->get('workflow', 'widget_simple');
        $workflow = $workflows->get($widget, $currentWorkflow);

        return $this->render('widget/index.html.twig', [
            'header' => "Sélection de tickets",
            'currentWorkflow' => $workflow->getName(),
            'transitions' => $workflow->getEnabledTransitions($widget),
            'currentPlace' => $widget->getCurrentPlace(),
            'widget' => $widget
        ]);
    }

    /**
     * @Route("/widget/transition", name="process_transition")
     * @param Registry $workflows
     * @param Request $request
     * @param Widget $widget
     * @return Response
     */
    public function processTransition(Registry $workflows, Request $request, Widget $widget)
    {
        $currentWorkflow = $request->get('workflow', 'widget_simple');
        $currentPlace = $request->get('currentPlace');
        $workflow = $workflows->get($widget, $currentWorkflow);

        try {
            $widget->setCurrentPlace($currentPlace);
            $workflow->apply($widget, $request->get('transition'));
            return $this->render('widget/index.html.twig', [
                'header' => "Sélection de tickets",
                'currentWorkflow' => $workflow->getName(),
                'transitions' => $workflow->getEnabledTransitions($widget),
                'currentPlace' => $widget->getCurrentPlace(),
                'widget' => $widget
            ]);
        } catch (LogicException $e) {
            return new Response("C'est mort pour: $e");
        }
    }

}
