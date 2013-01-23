<?php

namespace r1pp3rj4ck\GoogleBundle\Calendar;

use Symfony\Bundle\FrameworkBundle\Routing\Router;

use GoogleApi\Contrib\apiCalendarService,
    GoogleApi\Contrib\Event as GoogleEvent,
    r1pp3rj4ck\GoogleBundle\Calendar\Event,
    r1pp3rj4ck\GoogleBundle\Client\ApiClient;

class Calendar extends ApiClient
{
    protected $calendar;

    protected $calendarId;

    public function __construct($applicationName, $clientId, $clientSecret, $developerKey, Router $router, $redirectRoute, array $redirectParams)
    {
        parent::__construct($applicationName, $clientId, $clientSecret, $developerKey, $router, $redirectRoute, $redirectParams);

        $this
            ->client
            ->addService('calendar');

        if (!$this->calendar) {
            $this->calendar = new apiCalendarService($this->getClient());
        }
    }

    public function setCalendar($calendarId)
    {
        $this->calendarId = $calendarId;
    }

    public function getCalendarList(array $optParams = array())
    {
        return $this->calendar->calendarList->listCalendarList($optParams);
    }

    public function getEvents($calendarId = '', array $optParams = array())
    {
        if (!$calendarId && !$this->calendarId) {
            throw new \Exception('Missing Calendar ID');
        } else if (!$calendarId) {
            $calendarId = $this->calendarId;
        }
        $googleEvents = $this->calendar->events->listEvents($calendarId, $optParams);
        $events = array();
        if (array_key_exists('items', $googleEvents)) {
            foreach ($googleEvents['items'] as $event) {
                $events[] = new Event($event);
            }
        }
        return $events;
    }

    public function getEvent($eventId, $calendarId = '', array $optParams = array())
    {
        if (!$calendarId && !$this->calendarId) {
            throw new \Exception('Missing Calendar ID');
        } else if (!$calendarId) {
            $calendarId = $this->calendarId;
        }
        try {
            $event = $this->calendar->events->get($calendarId, $eventId, $optParams);
        } catch (\Exception $e) {
            return null;
        }
        if (!$event) {
            return null;
        } else {
            return new Event($event);
        }
    }

    public function addEvent($event, $calendarId = '', array $optParams = array())
    {
        if (!$calendarId && !$this->calendarId) {
            throw new \Exception('Missing Calendar ID');
        } else if (!$calendarId) {
            $calendarId = $this->calendarId;
        }

        if (is_array($event) || $event instanceof GoogleEvent) {
            $event = new Event($event);
        }
        $event = $this->calendar->events->insert($calendarId, $event->getEvent(), $optParams);
        if (!$event) {
            throw new \Exception('Event has failed to be updated');
        } else {
            return new Event($event);
        }
    }

    public function updateEvent($eventId, $event, $calendarId = '', array $optParams = array())
    {
        if (!$calendarId && !$this->calendarId) {
            throw new \Exception('Missing Calendar ID');
        } else if (!$calendarId) {
            $calendarId = $this->calendarId;
        }

        if (is_array($event) || $event instanceof GoogleEvent) {
            $event = new Event($event);
        }
        $event = $this->calendar->events->update($calendarId, $eventId, $event->getEvent(), $optParams);
        if (!$event) {
            throw new \Exception('Event has failed to be updated');
        } else {
            return new Event($event);
        }
    }
}
