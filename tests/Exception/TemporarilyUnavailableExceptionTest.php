<?php

/**
 * This file is part of the authbucket/push-symfony-bundle package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Bundle\PushBundle\Tests\Exception;

use AuthBucket\Push\Exception\TemporarilyUnavailableException;

/**
 * Test temporarily unavailable exception.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
class TemporarilyUnavailableExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \AuthBucket\Push\Exception\TemporarilyUnavailableException
     */
    public function testTemporarilyUnavailableException()
    {
        throw new TemporarilyUnavailableException();
    }
}
