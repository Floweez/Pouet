<?php

namespace App\Entity;

use Symfony\Component\Workflow\Marking;
use Symfony\Component\Workflow\MarkingStore\MarkingStoreInterface;
use Symfony\Component\Workflow\Workflow;

/**
 * Class Widget
 * @package App\Entity
 */
class Widget implements MarkingStoreInterface
{
    private $currentPlace;
    private $workflow;
    private $expositionMethod;

    /**
     * @return mixed
     */
    public function getExpositionMethod()
    {
        return $this->expositionMethod;
    }

    /**
     * @param mixed $expositionMethod
     */
    public function setExpositionMethod($expositionMethod)
    {
        $this->expositionMethod = $expositionMethod;
    }

    /**
     * @return mixed
     */
    public function getWorkflow()
    {
        return $this->workflow;
    }

    /**
     * @param mixed $workflow
     */
    public function setWorkflow($workflow)
    {
        $this->workflow = $workflow;
    }

    /**
     * @return mixed
     */
    public function getCurrentPlace()
    {
        return $this->currentPlace;
    }

    /**
     * @param mixed $currentPlace
     */
    public function setCurrentPlace($currentPlace)
    {
        $this->currentPlace = $currentPlace;
    }

    public function getMarking($subject)
    {
        // TODO: Implement getMarking() method.
    }

    public function setMarking($subject, Marking $marking)
    {
        // TODO: Implement setMarking() method.
    }
}