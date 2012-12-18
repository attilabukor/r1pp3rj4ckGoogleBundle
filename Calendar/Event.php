<?php

namespace r1pp3rj4ck\GoogleBundle\Calendar;

use GoogleApi\Contrib\Event as GoogleEvent,
    GoogleApi\Contrib\EventDateTime;

class Event
{
    private $googleEvent;

    public function __construct($event = null)
    {
        if ($event) {
            $this->setEvent($event);
        } else {
            $this->setEvent(new GoogleEvent());
        }
    }

    public function setEvent($event)
    {
        if (is_array($event)) {
            $this->googleEvent = new GoogleEvent($event);
        } else if ($event instanceof GoogleEvent) {
            $this->googleEvent = $event;
        } else {
            throw new \Exception('Event must be an array or a GoogleApi\Contrib\Event intance');
        }
    }

    public function getEvent()
    {
        return $this->googleEvent;
    }

    public function getId()
    {
        return $this->googleEvent->getId();
    }

    public function setStart(\DateTime $start)
    {
        $eventStart = new EventDateTime();
        $eventStart->setTimeZone($start->getTimezone()->getName());
        $eventStart->setDateTime($start->format("c"));
//        $eventStart->setDate($start->format("Y-m-d"));
        $this->googleEvent->setStart($eventStart);
        return $this;
    }

    public function getStart()
    {
        $start = $this->googleEvent->getStart();
        return new \DateTime($start['dateTime']);
    }

    public function setEnd(\DateTime $end)
    {
        $eventEnd = new EventDateTime();
        $eventEnd->setTimeZone($end->getTimezone()->getName());
        $eventEnd->setDateTime($end->format("c"));
//        $eventEnd->setDate($end->format("Y-m-d"));
        $this->googleEvent->setEnd($eventEnd);
        return $this;
    }

    public function getEnd()
    {
        $end = $this->googleEvent->getEnd();
        return new \DateTime($end['dateTime']);
    }

    public function setSummary($summary)
    {
        return $this->googleEvent->setSummary($summary);
    }

    public function getSummary()
    {
        return $this->googleEvent->getSummary();
    }
}