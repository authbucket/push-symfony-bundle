<?php

/**
 * This file is part of the authbucket/push-symfony-bundle package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Doctrine\Common\Annotations\AnnotationRegistry;

// See http://symfony.com/doc/current/cookbook/testing/bootstrap.html
if (isset($_ENV['BOOTSTRAP_ENV'])) {
    passthru(sprintf(
        'php "%s/console" cache:clear --env=%s -q --no-warmup',
        __DIR__,
        $_ENV['BOOTSTRAP_ENV']
    ));

    passthru(sprintf(
        'php "%s/console" doctrine:schema:drop --env=%s -q --force',
        __DIR__,
        $_ENV['BOOTSTRAP_ENV']
    ));

    passthru(sprintf(
        'php "%s/console" doctrine:schema:create --env=%s -q',
        __DIR__,
        $_ENV['BOOTSTRAP_ENV']
    ));

    passthru(sprintf(
        'php "%s/console" doctrine:fixtures:load --env=%s -q --no-interaction --purge-with-truncate',
        __DIR__,
        $_ENV['BOOTSTRAP_ENV']
    ));
}

$loader = require __DIR__.'/../vendor/autoload.php';

AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

return $loader;
