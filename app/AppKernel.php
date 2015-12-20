<?php

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new AuthBucket\Bundle\OAuth2Bundle\AuthBucketOAuth2Bundle(),
            new AuthBucket\Bundle\PushBundle\AuthBucketPushBundle(),
        ];

        if (in_array($this->getEnvironment(), ['prod', 'dev', 'test'])) {
            $bundles[] = new Symfony\Bundle\TwigBundle\TwigBundle();
            $bundles[] = new Doctrine\Bundle\DoctrineBundle\DoctrineBundle();
            $bundles[] = new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle();
            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
            $bundles[] = new AuthBucket\Bundle\PushBundle\Tests\TestBundle\TestBundle();
        }

        return $bundles;
    }

    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
