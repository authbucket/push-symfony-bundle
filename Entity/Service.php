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

use AuthBucket\Push\Model\ServiceInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\MappedSuperclass(repositoryClass="AuthBucket\Bundle\PushBundle\Entity\ServiceRepository")
 */
class Service implements ServiceInterface
{
    /**
     * @var string
     *
     * @ORM\Column(name="service_id", type="string", length=255)
     */
    protected $serviceId;

    /**
     * @var string
     *
     * @ORM\Column(name="service_type", type="string", length=255)
     */
    protected $serviceType;

    /**
     * @var string
     *
     * @ORM\Column(name="client_id", type="string", length=255)
     */
    protected $clientId;

    /**
     * @var array
     *
     * @ORM\Column(name="option", type="array")
     */
    protected $option;

    /**
     * Set serviceId
     *
     * @param string $serviceId
     *
     * @return Service
     */
    public function setServiceId($serviceId)
    {
        $this->serviceId = $serviceId;

        return $this;
    }

    /**
     * Get serviceId
     *
     * @return string
     */
    public function getServiceId()
    {
        return $this->serviceId;
    }

    /**
     * Set serviceType
     *
     * @param string $serviceType
     *
     * @return Service
     */
    public function setServiceType($serviceType)
    {
        $this->serviceType = $serviceType;

        return $this;
    }

    /**
     * Get serviceType
     *
     * @return string
     */
    public function getServiceType()
    {
        return $this->serviceType;
    }

    /**
     * Set clientId
     *
     * @param string $clientId
     *
     * @return Service
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * Get clientId
     *
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Set option
     *
     * @param array $option
     *
     * @return Service
     */
    public function setOption($option)
    {
        $this->option = $option;

        return $this;
    }

    /**
     * Get option
     *
     * @return array
     */
    public function getOption()
    {
        return $this->option;
    }
}
