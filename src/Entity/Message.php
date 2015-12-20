<?php

/**
 * This file is part of the authbucket/push-symfony-bundle package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Bundle\PushBundle\Entity;

use AuthBucket\Push\Model\MessageInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Message.
 *
 * @ORM\MappedSuperclass(repositoryClass="AuthBucket\Bundle\PushBundle\Entity\MessageRepository")
 */
abstract class Message implements MessageInterface
{
    /**
     * @var string
     *
     * @ORM\Column(name="message_id", type="string", length=255)
     */
    protected $messageId;

    /**
     * @var string
     *
     * @ORM\Column(name="client_id", type="string", length=255)
     */
    protected $clientId;

    /**
     * @var array
     *
     * @ORM\Column(name="username", type="string", length=255)
     */
    protected $username;

    /**
     * @var array
     *
     * @ORM\Column(name="scope", type="array")
     */
    protected $scope;

    /**
     * @var array
     *
     * @ORM\Column(name="payload", type="array")
     */
    protected $payload;

    /**
     * Set messageId.
     *
     * @param string $messageId
     *
     * @return Message
     */
    public function setMessageId($messageId)
    {
        $this->messageId = $messageId;

        return $this;
    }

    /**
     * Get messageId.
     *
     * @return string
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * Set clientId.
     *
     * @param string $clientId
     *
     * @return Message
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * Get clientId.
     *
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Set username.
     *
     * @param string $username
     *
     * @return Message
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set scope.
     *
     * @param array $scope
     *
     * @return Message
     */
    public function setScope($scope)
    {
        $this->scope = $scope;

        return $this;
    }

    /**
     * Get scope.
     *
     * @return array
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * Set payload.
     *
     * @param array $payload
     *
     * @return Message
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;

        return $this;
    }

    /**
     * Get payload.
     *
     * @return array
     */
    public function getPayload()
    {
        return $this->payload;
    }
}
