<?php

namespace Smalot\Drupal\Services\Tests\Units\Transport;

use mageekguy\atoum;

/**
 * Class Request
 *
 * @package Smalot\Drupal\Services\Tests\Units\Transport
 */
class Request extends atoum\test
{
    public function testGetter()
    {
        $security      = new \Smalot\Drupal\Services\Security\Session(DRUPAL_LOGIN, DRUPAL_PASSWORD);
        $transport     = new \Smalot\Drupal\Services\Transport\Rest(DRUPAL_HOSTNAME);
        $remoteAdapter = new \Smalot\Drupal\Services\RemoteAdapter($security, $transport);

        $action  = new \Smalot\Drupal\Services\Action('user', 'retrieve', array(1), array(), array(), $remoteAdapter);
        $request = new \Smalot\Drupal\Services\Transport\Request($action, $security);

        $this->assert->object($request->getAction())->isIdenticalTo($action);
        $this->assert->object($request->getSecurity())->isIdenticalTo($security);
    }
}
