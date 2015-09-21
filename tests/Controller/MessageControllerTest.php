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

class MessageControllerTest extends WebTestCase
{
    public function testCreateActionJson()
    {
        $messageId = md5(uniqid(null, true));
        $server = [
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        ];
        $content = $this->get('serializer')->encode([
            'messageId' => $messageId,
            'clientId' => '6b44c21ef7bc8ca7380bb5b8276b3f97',
            'username' => 'demousername1',
        ], 'json');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/dummy/v1.0/message.json', [], [], $server, $content);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'json');
        $this->assertSame($messageId, $response['messageId']);
    }

    public function testCreateActionXml()
    {
        $messageId = md5(uniqid(null, true));
        $server = [
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        ];
        $content = $this->get('serializer')->encode([
            'messageId' => $messageId,
            'clientId' => '6b44c21ef7bc8ca7380bb5b8276b3f97',
            'username' => 'demousername1',
        ], 'xml');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/dummy/v1.0/message.xml', [], [], $server, $content);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'xml');
        $this->assertSame($messageId, $response['messageId']);
    }

    public function testReadActionJson()
    {
        $server = [
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        ];
        $client = $this->createClient();
        $crawler = $client->request('GET', '/dummy/v1.0/message/1.json', [], [], $server);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'json');
        $this->assertSame('4ac2842c963da2983a83e91c2a59f0b1', $response['messageId']);
    }

    public function testReadActionXml()
    {
        $server = [
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        ];
        $client = $this->createClient();
        $crawler = $client->request('GET', '/dummy/v1.0/message/1.xml', [], [], $server);
        $response = simplexml_load_string($client->getResponse()->getContent());
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'xml');
        $this->assertSame('4ac2842c963da2983a83e91c2a59f0b1', $response['messageId']);
    }

    public function testUpdateActionJson()
    {
        $messageId = md5(uniqid(null, true));
        $server = [
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        ];
        $content = $this->get('serializer')->encode([
            'messageId' => $messageId,
            'clientId' => '6b44c21ef7bc8ca7380bb5b8276b3f97',
            'username' => 'demousername1',
        ], 'json');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/dummy/v1.0/message.json', [], [], $server, $content);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'json');
        $this->assertSame($messageId, $response['messageId']);

        $id = $response['id'];
        $messageIdUpdated = md5(uniqid(null, true));
        $content = $this->get('serializer')->encode(['messageId' => $messageIdUpdated], 'json');
        $client = $this->createClient();
        $crawler = $client->request('PUT', "/dummy/v1.0/message/${id}.json", [], [], $server, $content);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'json');
        $this->assertSame($messageIdUpdated, $response['messageId']);

        $client = $this->createClient();
        $crawler = $client->request('GET', "/dummy/v1.0/message/${id}.json", [], [], $server);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'json');
        $this->assertSame($messageIdUpdated, $response['messageId']);
    }

    public function testUpdateActionXml()
    {
        $messageId = md5(uniqid(null, true));
        $server = [
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        ];
        $content = $this->get('serializer')->encode([
            'messageId' => $messageId,
            'clientId' => '6b44c21ef7bc8ca7380bb5b8276b3f97',
            'username' => 'demousername1',
        ], 'xml');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/dummy/v1.0/message.xml', [], [], $server, $content);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'xml');
        $this->assertSame($messageId, $response['messageId']);

        $id = $response['id'];
        $messageIdUpdated = md5(uniqid(null, true));
        $content = $this->get('serializer')->encode(['messageId' => $messageIdUpdated], 'xml');
        $client = $this->createClient();
        $crawler = $client->request('PUT', "/dummy/v1.0/message/${id}.xml", [], [], $server, $content);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'xml');
        $this->assertSame($messageIdUpdated, $response['messageId']);

        $client = $this->createClient();
        $crawler = $client->request('GET', "/dummy/v1.0/message/${id}.xml", [], [], $server);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'xml');
        $this->assertSame($messageIdUpdated, $response['messageId']);
    }

    public function testDeleteActionJson()
    {
        $messageId = md5(uniqid(null, true));
        $server = [
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        ];
        $content = $this->get('serializer')->encode([
            'messageId' => $messageId,
            'clientId' => '6b44c21ef7bc8ca7380bb5b8276b3f97',
            'username' => 'demousername1',
        ], 'json');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/dummy/v1.0/message.json', [], [], $server, $content);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'json');
        $this->assertSame($messageId, $response['messageId']);

        $id = $response['id'];
        $client = $this->createClient();
        $crawler = $client->request('DELETE', "/dummy/v1.0/message/${id}.json", [], [], $server);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'json');
        $this->assertSame(null, $response['id']);
        $this->assertSame($messageId, $response['messageId']);

        $client = $this->createClient();
        $crawler = $client->request('GET', "/dummy/v1.0/message/${id}.json", [], [], $server);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'json');
        $this->assertSame(null, $response);
    }

    public function testDeleteActionXml()
    {
        $messageId = md5(uniqid(null, true));
        $server = [
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        ];
        $content = $this->get('serializer')->encode([
            'messageId' => $messageId,
            'clientId' => '6b44c21ef7bc8ca7380bb5b8276b3f97',
            'username' => 'demousername1',
        ], 'xml');
        $client = $this->createClient();
        $crawler = $client->request('POST', '/dummy/v1.0/message.xml', [], [], $server, $content);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'xml');
        $this->assertSame($messageId, $response['messageId']);

        $id = $response['id'];
        $client = $this->createClient();
        $crawler = $client->request('DELETE', "/dummy/v1.0/message/${id}.xml", [], [], $server);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'xml');
        $this->assertSame(null, $response['id']);
        $this->assertSame($messageId, $response['messageId']);

        $client = $this->createClient();
        $crawler = $client->request('GET', "/dummy/v1.0/message/${id}.xml", [], [], $server);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'xml');
        $this->assertSame(null, $response);
    }

    public function testListActionJson()
    {
        $server = [
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        ];
        $client = $this->createClient();
        $crawler = $client->request('GET', '/dummy/v1.0/message.json', [], [], $server);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'json');
        $this->assertSame('4ac2842c963da2983a83e91c2a59f0b1', $response[0]['messageId']);
    }

    public function testListActionXml()
    {
        $server = [
            'HTTP_Authorization' => 'Bearer 18cdaa6481c0d5f323351ea1029fc065',
        ];
        $client = $this->createClient();
        $crawler = $client->request('GET', '/dummy/v1.0/message.xml', [], [], $server);
        $response = $this->get('serializer')->decode($client->getResponse()->getContent(), 'xml');
        $this->assertSame('4ac2842c963da2983a83e91c2a59f0b1', $response[0]['messageId']);
    }
}
