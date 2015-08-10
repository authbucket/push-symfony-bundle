<?php

/**
 * This file is part of the authbucket/push-symfony-bundle package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Bundle\PushBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class WebTestCase extends KernelTestCase
{
    public function setUp()
    {
        static::bootKernel();
    }

    public function createClient(array $server = array())
    {
        $client = static::$kernel->getContainer()->get('test.client');
        $client->setServerParameters($server);

        return $client;
    }

    public function set($id, $service)
    {
        return static::$kernel->getContainer()->set($id, $service);
    }

    public function get($id)
    {
        return static::$kernel->getContainer()->get($id);
    }
}
