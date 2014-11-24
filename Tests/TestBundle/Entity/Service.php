<?php

/**
 * This file is part of the authbucket/push-symfony-bundle package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Bundle\PushBundle\Tests\TestBundle\Entity;

use AuthBucket\Bundle\PushBundle\Entity\Service as AbstractService;
use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table(name="authbucket_push_service")
 * @ORM\Entity(repositoryClass="AuthBucket\Bundle\PushBundle\Tests\TestBundle\Entity\ServiceRepository")
 */
class Service extends AbstractService
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
