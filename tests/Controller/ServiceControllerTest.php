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

class ServiceControllerTest extends WebTestCase
{
    public function testCreateActionJson()
    {
        $serviceId = md5(uniqid(null, true));
        $server = [
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        ];
        $content = $this->get('serializer')->encode([
            'serviceId' => $serviceId,
            'serviceType' => 'apns',
            'clientId' => '6b44c21ef7bc8ca7380bb5b8276b3f97',
            'options' => [],
        ], 'json');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/dummy/v1.0/service.json', [], [], $server, $content);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'json');
        $this->assertSame($serviceId, $response['serviceId']);
    }

    public function testCreateActionXml()
    {
        $serviceId = md5(uniqid(null, true));
        $server = [
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        ];
        $content = $this->get('serializer')->encode([
            'serviceId' => $serviceId,
            'serviceType' => 'apns',
            'clientId' => '6b44c21ef7bc8ca7380bb5b8276b3f97',
            'options' => [],
        ], 'xml');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/dummy/v1.0/service.xml', [], [], $server, $content);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'xml');
        $this->assertSame($serviceId, $response['serviceId']);
    }

    public function testReadActionJson()
    {
        $server = [
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        ];
        $client = $this->createClient();
        $crawler = $client->request('GET', '/dummy/v1.0/service/1.json', [], [], $server);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'json');
        $this->assertSame('f2ee1d163e9c9b633efca95fb9733f35', $response['serviceId']);
    }

    public function testReadActionXml()
    {
        $server = [
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        ];
        $client = $this->createClient();
        $crawler = $client->request('GET', '/dummy/v1.0/service/1.xml', [], [], $server);
        $response = simplexml_load_string($client->getResponse()->getContent());
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'xml');
        $this->assertSame('f2ee1d163e9c9b633efca95fb9733f35', $response['serviceId']);
    }

    public function testUpdateActionJson()
    {
        $serviceId = md5(uniqid(null, true));
        $server = [
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        ];
        $content = $this->get('serializer')->encode([
            'serviceId' => $serviceId,
            'serviceType' => 'apns',
            'clientId' => '6b44c21ef7bc8ca7380bb5b8276b3f97',
            'options' => [],
        ], 'json');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/dummy/v1.0/service.json', [], [], $server, $content);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'json');
        $this->assertSame($serviceId, $response['serviceId']);

        $id = $response['id'];
        $serviceIdUpdated = md5(uniqid(null, true));
        $content = $this->get('serializer')->encode(['serviceId' => $serviceIdUpdated], 'json');
        $client = $this->createClient();
        $crawler = $client->request('PUT', "/dummy/v1.0/service/${id}.json", [], [], $server, $content);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'json');
        $this->assertSame($serviceIdUpdated, $response['serviceId']);

        $client = $this->createClient();
        $crawler = $client->request('GET', "/dummy/v1.0/service/${id}.json", [], [], $server);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'json');
        $this->assertSame($serviceIdUpdated, $response['serviceId']);
    }

    public function testUpdateActionXml()
    {
        $serviceId = md5(uniqid(null, true));
        $server = [
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        ];
        $content = $this->get('serializer')->encode([
            'serviceId' => $serviceId,
            'serviceType' => 'apns',
            'clientId' => '6b44c21ef7bc8ca7380bb5b8276b3f97',
            'options' => [],
        ], 'xml');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/dummy/v1.0/service.xml', [], [], $server, $content);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'xml');
        $this->assertSame($serviceId, $response['serviceId']);

        $id = $response['id'];
        $serviceIdUpdated = md5(uniqid(null, true));
        $content = $this->get('serializer')->encode(['serviceId' => $serviceIdUpdated], 'xml');
        $client = $this->createClient();
        $crawler = $client->request('PUT', "/dummy/v1.0/service/${id}.xml", [], [], $server, $content);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'xml');
        $this->assertSame($serviceIdUpdated, $response['serviceId']);

        $client = $this->createClient();
        $crawler = $client->request('GET', "/dummy/v1.0/service/${id}.xml", [], [], $server);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'xml');
        $this->assertSame($serviceIdUpdated, $response['serviceId']);
    }

    public function testDeleteActionJson()
    {
        $serviceId = md5(uniqid(null, true));
        $server = [
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        ];
        $content = $this->get('serializer')->encode([
            'serviceId' => $serviceId,
            'serviceType' => 'apns',
            'clientId' => '6b44c21ef7bc8ca7380bb5b8276b3f97',
            'options' => [],
        ], 'json');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/dummy/v1.0/service.json', [], [], $server, $content);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'json');
        $this->assertSame($serviceId, $response['serviceId']);

        $id = $response['id'];
        $client = $this->createClient();
        $crawler = $client->request('DELETE', "/dummy/v1.0/service/${id}.json", [], [], $server);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'json');
        $this->assertSame(null, $response['id']);
        $this->assertSame($serviceId, $response['serviceId']);

        $client = $this->createClient();
        $crawler = $client->request('GET', "/dummy/v1.0/service/${id}.json", [], [], $server);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'json');
        $this->assertSame(null, $response);
    }

    public function testDeleteActionXml()
    {
        $serviceId = md5(uniqid(null, true));
        $server = [
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        ];
        $content = $this->get('serializer')->encode([
            'serviceId' => $serviceId,
            'serviceType' => 'apns',
            'clientId' => '6b44c21ef7bc8ca7380bb5b8276b3f97',
            'options' => [],
        ], 'xml');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/dummy/v1.0/service.xml', [], [], $server, $content);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'xml');
        $this->assertSame($serviceId, $response['serviceId']);

        $id = $response['id'];
        $client = $this->createClient();
        $crawler = $client->request('DELETE', "/dummy/v1.0/service/${id}.xml", [], [], $server);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'xml');
        $this->assertSame(null, $response['id']);
        $this->assertSame($serviceId, $response['serviceId']);

        $client = $this->createClient();
        $crawler = $client->request('GET', "/dummy/v1.0/service/${id}.xml", [], [], $server);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'xml');
        $this->assertSame(null, $response);
    }

    public function testListActionJson()
    {
        $server = [
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        ];
        $client = $this->createClient();
        $crawler = $client->request('GET', '/dummy/v1.0/service.json', [], [], $server);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'json');
        $this->assertSame('f2ee1d163e9c9b633efca95fb9733f35', $response[0]['serviceId']);
    }

    public function testListActionXml()
    {
        $server = [
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        ];
        $client = $this->createClient();
        $crawler = $client->request('GET', '/dummy/v1.0/service.xml', [], [], $server);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'xml');
        $this->assertSame('f2ee1d163e9c9b633efca95fb9733f35', $response[0]['serviceId']);
    }
}
