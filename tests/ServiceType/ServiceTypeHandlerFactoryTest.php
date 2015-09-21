<?php

/**
 * This file is part of the authbucket/push-symfony-bundle package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Bundle\PushBundle\Tests\ServiceType;

use AuthBucket\Bundle\PushBundle\Tests\WebTestCase;
use AuthBucket\Push\ServiceType\ServiceTypeHandlerFactory;

class ServiceTypeHandlerFactoryTest extends WebTestCase
{
    /**
     * @expectedException \AuthBucket\Push\Exception\UnsupportedServiceTypeException
     */
    public function testNonExistsServiceTypeHandler()
    {
        $classes = ['foo' => 'AuthBucket\\Bundle\\PushBundle\\Tests\\ServiceType\\NonExistsServiceTypeHandler'];
        $factory = new ServiceTypeHandlerFactory(
            $this->get('security.context'),
            $this->get('validator'),
            $this->get('authbucket_push.model_manager.factory'),
            $classes
        );
    }

    /**
     * @expectedException \AuthBucket\Push\Exception\UnsupportedServiceTypeException
     */
    public function testBadAddServiceTypeHandler()
    {
        $classes = ['foo' => 'AuthBucket\\Bundle\\PushBundle\\Tests\\ServiceType\\FooServiceTypeHandler'];
        $factory = new ServiceTypeHandlerFactory(
            $this->get('security.context'),
            $this->get('validator'),
            $this->get('authbucket_push.model_manager.factory'),
            $classes
        );
    }

    /**
     * @expectedException \AuthBucket\Push\Exception\UnsupportedServiceTypeException
     */
    public function testBadGetServiceTypeHandler()
    {
        $classes = ['bar' => 'AuthBucket\\Bundle\\PushBundle\\Tests\\ServiceType\\BarServiceTypeHandler'];
        $factory = new ServiceTypeHandlerFactory(
            $this->get('security.context'),
            $this->get('validator'),
            $this->get('authbucket_push.model_manager.factory'),
            $classes
        );
        $handler = $factory->getServiceTypeHandler('foo');
    }

    public function testGoodGetServiceTypeHandler()
    {
        $classes = ['bar' => 'AuthBucket\\Bundle\\PushBundle\\Tests\\ServiceType\\BarServiceTypeHandler'];
        $factory = new ServiceTypeHandlerFactory(
            $this->get('security.context'),
            $this->get('validator'),
            $this->get('authbucket_push.model_manager.factory'),
            $classes
        );
        $handler = $factory->getServiceTypeHandler('bar');
        $this->assertSame($factory->getServiceTypeHandlers(), $classes);
    }
}
