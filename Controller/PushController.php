<?php

/**
 * This file is part of the authbucket/push-php package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Bundle\PushBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PushController extends Controller
{
    public function registerAction(Request $request)
    {
        return $this->get('authbucket_push.push_controller')->registerAction($request);
    }

    public function unregisterAction(Request $request)
    {
        return $this->get('authbucket_push.push_controller')->unregisterAction($request);
    }

    public function sendAction(Request $request)
    {
        return $this->get('authbucket_push.push_controller')->sendAction($request);
    }
}
