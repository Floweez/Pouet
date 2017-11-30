<?php

namespace App\Service;

use Symfony\Component\Workflow\Event\GuardEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class WidgetListener implements EventSubscriberInterface
{
    public function guardConfirmCart(GuardEvent $event)
    {
        /** @var \App\Entity\Widget $widget */
        $widget = $event->getSubject();
//        $event->setBlocked(true);
    }

    public static function getSubscribedEvents()
    {
        return [
            'workflow.widget_simple.guard.confirm_cart' => array('guardConfirmCart'),
        ];
    }
}