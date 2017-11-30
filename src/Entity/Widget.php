<?php

namespace App\Entity;

use Symfony\Component\Workflow\Marking;
use Symfony\Component\Workflow\MarkingStore\MarkingStoreInterface;

/**
 * Class Widget
 * @package App\Entity
 */
class Widget implements MarkingStoreInterface
{
    public $currentPlace;

    public function getMarking($subject)
    {
        // TODO: Implement getMarking() method.
    }

    public function setMarking($subject, Marking $marking)
    {
        // TODO: Implement setMarking() method.
    }
}