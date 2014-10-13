<?php

/**
 * This file is part of the authbucket/push-symfony-bundle package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Bundle\PushBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class AuthBucketPushExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(
            new Configuration(),
            $configs
        );

        $loader = new Loader\YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );

        $loader->load('services.yml');

        $driver = $config['driver'] ?: 'in_memory';
        if (in_array($driver, array('in_memory', 'orm'))) {
            $loader->load(sprintf('%s.yml', $driver));
        }
        unset($config['driver']);

        $userProvider = $config['user_provider'] ?: null;
        if ($userProvider) {
            $container->getDefinition('authbucket_push.grant_handler.factory')
                ->replaceArgument(6, new Reference($userProvider));
        }
        unset($config['user_provider']);

        foreach (array_filter($config) as $key => $value) {
            $container->setParameter('authbucket_push.'.$key, $value);
        }
    }

    public function getAlias()
    {
        return 'authbucket_push';
    }
}
