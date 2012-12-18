<?php

namespace r1pp3rj4ck\GoogleBundle\Client;

use GoogleApi\Client,
    GoogleApi\Auth\AssertionCredentials;

use Symfony\Bundle\FrameworkBundle\Routing\Router;

abstract class ApiClient
{
    protected $client;

    protected $router;

    public function __construct($applicationName, $clientId, $clientSecret, $developerKey, Router $router, $redirectRoute, array $redirectParams)
    {
        if ($this->client instanceof Client) {
            return true;
        }
        $this->router = $router;
        $this->client = new Client();
        $this
            ->setApplicationName($applicationName)
            ->setClientId($clientId)
            ->setClientSecret($clientSecret)
            ->setRedirectUri($redirectRoute, $redirectParams)
            ->setDeveloperKey($developerKey);

        return $this->client;
    }

    public function setDeveloperKey($developerKey)
    {
        $this->client->setDeveloperKey($developerKey);
        return $this;
    }

    public function setRedirectUri($redirectRoute, array $redirectParams = array())
    {
        try {
            $uri = $this->router->generate($redirectRoute, $redirectParams, true);
        } catch (\Exception $e) {
            $uri = $redirectRoute;
        }
        $this->client->setRedirectUri($uri);
        return $this;
    }

    public function setClientSecret($clientSecret)
    {
        $this->client->setClientSecret($clientSecret);
        return $this;
    }

    public function setClientId($clientId)
    {
        $this->client->setClientId($clientId);
        return $this;
    }

    public function setApplicationName($applicationName)
    {
        $this->client->setApplicationName($applicationName);
        return $this;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function authenticate()
    {
        return $this->client->authenticate();
    }

    public function getAccessToken()
    {
        return $this->client->getAccessToken();
    }

    public function createAuthUrl()
    {
        return $this->client->createAuthUrl();
    }

    public function getAuth()
    {
        return $this->client->getAuth();
    }

    public function getCache()
    {
        return $this->client->getCache();
    }

    public function getIo()
    {
        return $this->client->getIo();
    }

    public function prepareService()
    {
        return $this->client->prepareService();
    }

    public function setAccessToken($accessToken)
    {
        $this->client->setAccessToken($accessToken);
        return $this;
    }

    public function setAuthClass($authClassName)
    {
        $this->client->setAuthClass($authClassName);
        return $this;
    }

    public function setState($state)
    {
        $this->client->setState($state);
        return $this;
    }

    public function setAccessType($accessType)
    {
        $this->client->setAccessType($accessType);
        return $this;
    }

    public function setApprovalPrompt($approvalPrompt)
    {
        $this->client->setApprovalPrompt($approvalPrompt);
        return $this;
    }

    public function refreshToken($refreshToken)
    {
        $this->client->refreshToken($refreshToken);
        return $this;
    }

    public function revokeToken($token = null)
    {
        return $this->client->revokeToken($token);
    }

    public function verifyIdToken($token = null)
    {
        return $this->client->verifyIdToken($token = null);
    }

    public function setAssertionCredentials(AssertionCredentials $creds)
    {
        $this->client->setAssertionCredentials($creds);
        return $this;
    }

    public function setScopes($scopes)
    {
        $this->client->setScopes($scopes);
        return $this;
    }

    public function setUseObjects($useObjects)
    {
        $this->client->setUseObjects($useObjects);
        return $this;
    }

    public function setUseBatch($useBatch)
    {
        $this->client->setUseBatch($useBatch);
        return $this;
    }
}