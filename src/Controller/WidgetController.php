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

    /**
     * @Route("/widget/form")
     * @param Registry $workflows
     * @param string $workflowToUse
     */
    public function selectCartAction(Registry $workflows, Request $request, Widget $widget)
    {
        $currentWorkflow = $request->get('workflow') ? : 'widget_simple';
        $workflow = $workflows->get($widget, $currentWorkflow);

        try {
            $workflow->apply($widget, 'select_cart');

            // Get les formulaires associés au cart submitted et render

            return $this->render('widget/form.html.twig', [
                'header' => "Formulaire participants",
                'currentWorkflow' => $workflow->getName(),
                'transitions' => $workflow->getEnabledTransitions($widget),
                'currentPlace' => $widget->currentPlace,
                'widget' => $widget
            ]);
        } catch (LogicException $e) {
            return new Response('
                <html>
                    <body>
                        Tu peux pas transitionner comme ça: '.$e->getMessage().' <br>
                        -> CurrentPlace : '.$widget->currentPlace.'
                    </body>
                </html>
            ');
            // ... if the transition is not allowed
        }
    }

    /**
     * @Route("/widget/payment")
     * @param Registry $workflows
     * @param Request $request
     * @return Response
     */
    public function confirmAttendeeAction(Registry $workflows, Request $request, Widget $widget)
    {
        $currentWorkflow = $request->get('workflow') ? : 'widget_simple';
        $workflow = $workflows->get($widget, $currentWorkflow);

        try {
            $workflow->apply($widget, 'confirm_attendee');

            // Get les formulaires associés au cart submitted et render

            return $this->render('widget/payment.html.twig', [
                'header' => "Payment",
                'currentWorkflow' => $workflow->getName(),
                'transitions' => $workflow->getEnabledTransitions($widget),
                'currentPlace' => $widget->currentPlace
            ]);
        } catch (LogicException $e) {
            return new Response('
                <html>
                    <body>
                        Tu peux pas transitionner comme ça: '.$e->getMessage().' <br>
                        -> CurrentPlace : '.$widget->currentPlace.'
                    </body>
                </html>
            ');
            // ... if the transition is not allowed
        }
    }

    /**
     * @Route("/widget/{whatever}")
     */
    public function pouetAction($whatever)
    {
        return new Response(
            '<html><body>Nope: '.$whatever.'</body></html>'
        );
    }
}
