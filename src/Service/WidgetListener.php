<?php

namespace App\Service;

use Symfony\Component\Workflow\Event\GuardEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class WidgetListener
 * @package App\Service
 */
class WidgetListener implements EventSubscriberInterface
{
    /**
     * @param GuardEvent $event
     */
    public function guardConfirmCart(GuardEvent $event)
    {
        /** @var \App\Entity\Widget $widget */
        $widget = $event->getSubject();
//        $event->setBlocked(true);
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'workflow.widget_simple.guard.confirm_cart' => ['guardConfirmCart'],
        ];
    }
}