<?php

/**
 * This file is part of the authbucket/oauth2-symfony-bundle package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Bundle\PushBundle;

use AuthBucket\Bundle\PushBundle\DependencyInjection\AuthBucketPushExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AuthBucketPushBundle extends Bundle
{
    public function __construct()
    {
        $this->extension = new AuthBucketPushExtension();
    }
}
