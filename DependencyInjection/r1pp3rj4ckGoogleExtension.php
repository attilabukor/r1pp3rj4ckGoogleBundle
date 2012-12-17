<?php

namespace r1pp3rj4ck\GoogleBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class r1pp3rj4ckGoogleExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config        = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $container->setParameter('r1pp3rj4ck_google.app_name', $config['auth']['app_name']);
        $container->setParameter('r1pp3rj4ck_google.client_id', $config['auth']['client_id']);
        $container->setParameter('r1pp3rj4ck_google.client_secret', $config['auth']['client_secret']);
        $container->setParameter('r1pp3rj4ck_google.developer_key', $config['auth']['developer_key']);
        $container->setParameter('r1pp3rj4ck_google.route_name', $config['route']['name']);
        $container->setParameter('r1pp3rj4ck_google.route_params', $config['route']['params']);
    }
}
