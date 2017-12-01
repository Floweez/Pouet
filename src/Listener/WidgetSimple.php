<?php

namespace App\Listener;

use Symfony\Component\Workflow\Event\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class WidgetSimple
 * @package App\Listener
 */
class WidgetSimple implements EventSubscriberInterface
{
    /**
     * @param Event $event
     */
    public function transitionConfirmCart(Event $event)
    {
        /** @var \App\Entity\Widget $widget */
        $widget = $event->getSubject();
        dump('Inside '.__FUNCTION__.' -> '. $widget->getCurrentPlace());
    }

    /**
     * @param Event $event
     */
    public function transitionModifyCart(Event $event)
    {
        /** @var \App\Entity\Widget $widget */
        $widget = $event->getSubject();
        dump('Inside '.__FUNCTION__.' -> '. $widget->getCurrentPlace());
    }

    /**
     * @param Event $event
     */
    public function transitionConfirmAttendee(Event $event)
    {
        /** @var \App\Entity\Widget $widget */
        $widget = $event->getSubject();
        dump('Inside '.__FUNCTION__.' -> '. $widget->getCurrentPlace());
    }

    /**
     * @param Event $event
     */
    public function transitionModifyAttendee(Event $event)
    {
        /** @var \App\Entity\Widget $widget */
        $widget = $event->getSubject();
        dump('Inside '.__FUNCTION__.' -> '. $widget->getCurrentPlace());
    }

    /**
     * @param Event $event
     */
    public function transitionConfirmPayment(Event $event)
    {
        /** @var \App\Entity\Widget $widget */
        $widget = $event->getSubject();
        dump('Inside '.__FUNCTION__.' -> '. $widget->getCurrentPlace());
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'workflow.widget_simple.transition.confirm_cart' => 'transitionConfirmCart',
            'workflow.widget_simple.transition.modify_cart' => 'transitionModifyCart',
            'workflow.widget_simple.transition.confirm_attendee' => 'transitionConfirmAttendee',
            'workflow.widget_simple.transition.modify_attendee' => 'transitionModifyAttendee',
            'workflow.widget_simple.transition.confirm_payment' => 'transitionConfirmPayment',
        ];
    }
}