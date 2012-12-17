<?php

namespace r1pp3rj4ck\GoogleBundle\Service;

use Symfony\Bundle\FrameworkBundle\Routing\Router;

class Calendar extends ApiClient
{
    public function __construct($applicationName, $clientId, $clientSecret, $developerKey, Router $router, $redirectRoute, array $redirectParams)
    {
        parent::__construct($applicationName, $clientId, $clientSecret, $developerKey, $router, $redirectRoute, $redirectParams);

        $this
            ->client
            ->addService('calendar');
    }
}