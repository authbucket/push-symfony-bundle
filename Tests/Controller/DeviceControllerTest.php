<?php

/**
 * This file is part of the authbucket/push-symfony-bundle package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Bundle\PushBundle\Tests\Controller;

use AuthBucket\Bundle\PushBundle\Tests\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class DeviceControllerTest extends WebTestCase
{
    public function testCreateActionJson()
    {
        $deviceToken = md5(uniqid(null, true));
        $server = array(
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        );
        $content = $this->get('serializer')->encode(array(
            'deviceToken' => $deviceToken,
            'serviceId' => 'f2ee1d163e9c9b633efca95fb9733f35',
            'username' => 'demousername1',
            'scope' => array(
                'demoscope1',
                'demoscope2',
                'demoscope3',
            ),
        ), 'json');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/dummy/v1.0/device.json', array(), array(), $server, $content);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals($deviceToken, $response['deviceToken']);
    }

    public function testCreateActionXml()
    {
        $deviceToken = md5(uniqid(null, true));
        $server = array(
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        );
        $content = $this->get('serializer')->encode(array(
            'deviceToken' => $deviceToken,
            'serviceId' => 'f2ee1d163e9c9b633efca95fb9733f35',
            'username' => 'demousername1',
            'scope' => array(
                'demoscope1',
                'demoscope2',
                'demoscope3',
            ),
        ), 'xml');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/dummy/v1.0/device.xml', array(), array(), $server, $content);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals($deviceToken, $response['deviceToken']);
    }

    public function testReadActionJson()
    {
        $server = array(
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        );
        $client = $this->createClient();
        $crawler = $client->request('GET', '/dummy/v1.0/device/1.json', array(), array(), $server);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals('0027956241e3ca5090de548fe468334d', $response['deviceToken']);
    }

    public function testReadActionXml()
    {
        $server = array(
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        );
        $client = $this->createClient();
        $crawler = $client->request('GET', '/dummy/v1.0/device/1.xml', array(), array(), $server);
        $response = simplexml_load_string($client->getResponse()->getContent());
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals('0027956241e3ca5090de548fe468334d', $response['deviceToken']);
    }

    public function testUpdateActionJson()
    {
        $deviceToken = md5(uniqid(null, true));
        $server = array(
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        );
        $content = $this->get('serializer')->encode(array(
            'deviceToken' => $deviceToken,
            'serviceId' => 'f2ee1d163e9c9b633efca95fb9733f35',
            'username' => 'demousername1',
            'scope' => array(
                'demoscope1',
                'demoscope2',
                'demoscope3',
            ),
        ), 'json');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/dummy/v1.0/device.json', array(), array(), $server, $content);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals($deviceToken, $response['deviceToken']);

        $id = $response['id'];
        $deviceTokenUpdated = md5(uniqid(null, true));
        $content = $this->get('serializer')->encode(array('deviceToken' => $deviceTokenUpdated), 'json');
        $client = $this->createClient();
        $crawler = $client->request('PUT', "/dummy/v1.0/device/${id}.json", array(), array(), $server, $content);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals($deviceTokenUpdated, $response['deviceToken']);

        $client = $this->createClient();
        $crawler = $client->request('GET', "/dummy/v1.0/device/${id}.json", array(), array(), $server);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals($deviceTokenUpdated, $response['deviceToken']);
    }

    public function testUpdateActionXml()
    {
        $deviceToken = md5(uniqid(null, true));
        $server = array(
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        );
        $content = $this->get('serializer')->encode(array(
            'deviceToken' => $deviceToken,
            'serviceId' => 'f2ee1d163e9c9b633efca95fb9733f35',
            'username' => 'demousername1',
            'scope' => array(
                'demoscope1',
                'demoscope2',
                'demoscope3',
            ),
        ), 'xml');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/dummy/v1.0/device.xml', array(), array(), $server, $content);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals($deviceToken, $response['deviceToken']);

        $id = $response['id'];
        $deviceTokenUpdated = md5(uniqid(null, true));
        $content = $this->get('serializer')->encode(array('deviceToken' => $deviceTokenUpdated), 'xml');
        $client = $this->createClient();
        $crawler = $client->request('PUT', "/dummy/v1.0/device/${id}.xml", array(), array(), $server, $content);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals($deviceTokenUpdated, $response['deviceToken']);

        $client = $this->createClient();
        $crawler = $client->request('GET', "/dummy/v1.0/device/${id}.xml", array(), array(), $server);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals($deviceTokenUpdated, $response['deviceToken']);
    }

    public function testDeleteActionJson()
    {
        $deviceToken = md5(uniqid(null, true));
        $server = array(
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        );
        $content = $this->get('serializer')->encode(array(
            'deviceToken' => $deviceToken,
            'serviceId' => 'f2ee1d163e9c9b633efca95fb9733f35',
            'username' => 'demousername1',
            'scope' => array(
                'demoscope1',
                'demoscope2',
                'demoscope3',
            ),
        ), 'json');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/dummy/v1.0/device.json', array(), array(), $server, $content);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals($deviceToken, $response['deviceToken']);

        $id = $response['id'];
        $client = $this->createClient();
        $crawler = $client->request('DELETE', "/dummy/v1.0/device/${id}.json", array(), array(), $server);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals(null, $response['id']);
        $this->assertEquals($deviceToken, $response['deviceToken']);

        $client = $this->createClient();
        $crawler = $client->request('GET', "/dummy/v1.0/device/${id}.json", array(), array(), $server);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals(null, $response);
    }

    public function testDeleteActionXml()
    {
        $deviceToken = md5(uniqid(null, true));
        $server = array(
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        );
        $content = $this->get('serializer')->encode(array(
            'deviceToken' => $deviceToken,
            'serviceId' => 'f2ee1d163e9c9b633efca95fb9733f35',
            'username' => 'demousername1',
            'scope' => array(
                'demoscope1',
                'demoscope2',
                'demoscope3',
            ),
        ), 'xml');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/dummy/v1.0/device.xml', array(), array(), $server, $content);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals($deviceToken, $response['deviceToken']);

        $id = $response['id'];
        $client = $this->createClient();
        $crawler = $client->request('DELETE', "/dummy/v1.0/device/${id}.xml", array(), array(), $server);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals(null, $response['id']);
        $this->assertEquals($deviceToken, $response['deviceToken']);

        $client = $this->createClient();
        $crawler = $client->request('GET', "/dummy/v1.0/device/${id}.xml", array(), array(), $server);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals(null, $response);
    }

    public function testListActionJson()
    {
        $server = array(
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        );
        $client = $this->createClient();
        $crawler = $client->request('GET', '/dummy/v1.0/device.json', array(), array(), $server);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'json');
        $this->assertEquals('0027956241e3ca5090de548fe468334d', $response[0]['deviceToken']);
    }

    public function testListActionXml()
    {
        $server = array(
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        );
        $client = $this->createClient();
        $crawler = $client->request('GET', '/dummy/v1.0/device.xml', array(), array(), $server);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'xml');
        $this->assertEquals('0027956241e3ca5090de548fe468334d', $response[0]['deviceToken']);
    }
}