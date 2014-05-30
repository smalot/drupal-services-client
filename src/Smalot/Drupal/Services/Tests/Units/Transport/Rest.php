<?php

namespace Smalot\Drupal\Services\Tests\Units\Transport;

use mageekguy\atoum;
use Smalot\Drupal\Services\Modules\Core\User;

/**
 * Class Rest
 *
 * @package Smalot\Drupal\Services\Tests\Units\Transport
 */
class Rest extends atoum\test
{
    public function testCall()
    {
        $security      = new \Smalot\Drupal\Services\Security\Session(DRUPAL_LOGIN, DRUPAL_PASSWORD);
        $transport     = new \Smalot\Drupal\Services\Transport\Rest(DRUPAL_HOSTNAME);
        $remoteAdapter = new \Smalot\Drupal\Services\RemoteAdapter($security, $transport);

        // Manual login.
        $remoteAdapter->login();

        $action   = new \Smalot\Drupal\Services\Action('user', 'retrieve', array(1), array(), array(), $remoteAdapter);
        $request  = new \Smalot\Drupal\Services\Transport\Request($action, $security);
        $rest     = new \Smalot\Drupal\Services\Transport\Rest(DRUPAL_HOSTNAME);
        $response = $rest->call($request);
        $this->assert->array($response);

        $action  = new \Smalot\Drupal\Services\Action('unknown_method', 'retrieve', array(1), array(), array(), $remoteAdapter);
        $request = new \Smalot\Drupal\Services\Transport\Request($action, $security);
        $rest    = new \Smalot\Drupal\Services\Transport\Rest(DRUPAL_HOSTNAME);
        $this->assert->exception(
          function () use ($rest, $request) {
              $rest->call($request);
          }
        )->isInstanceOf('\Smalot\Drupal\Services\Transport\TransportException')
          ->hasMessage('Unknown error.');
    }
}
