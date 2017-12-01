<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Workflow\Registry;
use App\Entity\Widget;
use Symfony\Component\Workflow\Exception\LogicException;

/**
 * Class WidgetController
 * @package App\Controller
 */
class WidgetController extends Controller
{
    /**
     * @Route("/widget", name="process_transition")
     * @param Registry $workflows
     * @param Request $request
     * @param Widget $widget
     * @return Response
     */
    public function processTransition(Registry $workflows, Request $request, Widget $widget = null)
    {
        if (!$widget) {
            $widget = new Widget();
        }
        dump('A');
        $currentWorkflow = $request->get('workflow', 'widget_simple');
        dump('B');
        $workflow = $workflows->get($widget, $currentWorkflow);
        dump('C');
        $enabledTransitions = $workflow->getEnabledTransitions($widget);
        dump('D');
        $currentPlace = $request->get('currentPlace', $widget->getCurrentPlace());
        dump('E');
        $transition = $request->get('transition');
        dump('F');

        try {
            if ($transition) {
                dump('G');
                $widget->setCurrentPlace($currentPlace);
                dump('H');
                $workflow->apply($widget, $request->get('transition'));
                dump('I');
                $enabledTransitions = $workflow->getEnabledTransitions($widget);
                dump('J');
            }

            return $this->render('widget/index.html.twig', [
                'header' => "Workflow : " . $workflow->getName(),
                'transitions' => $enabledTransitions,
                'currentPlace' => $widget->getCurrentPlace(),
                'currentWorkflow' => $workflow->getName(),
                'widget' => $widget
            ]);
        } catch (LogicException $e) {
            return new Response("C'est mort pour: $e");
        }
    }
}
