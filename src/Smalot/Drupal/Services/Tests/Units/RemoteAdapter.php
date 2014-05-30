<?php

namespace Smalot\Drupal\Services\Tests\Units;

use mageekguy\atoum;
use Smalot\Drupal\Services\Modules\Core\User;

/**
 * Class RemoteAdapter
 *
 * @package Smalot\Drupal\Services\Tests\Units
 */
class RemoteAdapter extends atoum\test
{
    public function testLogin()
    {
        // Check wrong account.
        $security      = new \Smalot\Drupal\Services\Security\Session('xxxx', 'xxxx');
        $transport     = new \Smalot\Drupal\Services\Transport\Rest(DRUPAL_HOSTNAME);
        $remoteAdapter = new \Smalot\Drupal\Services\RemoteAdapter($security, $transport);
        $this->assert->exception(
          function () use ($remoteAdapter) {
              $remoteAdapter->login();
          }
        )->isInstanceOf('\Smalot\Drupal\Services\Transport\TransportException')
          ->hasMessage('Wrong username or password.');

        // Check valid account.
        $security      = new \Smalot\Drupal\Services\Security\Session(DRUPAL_LOGIN, DRUPAL_PASSWORD);
        $transport     = new \Smalot\Drupal\Services\Transport\Rest(DRUPAL_HOSTNAME);
        $remoteAdapter = new \Smalot\Drupal\Services\RemoteAdapter($security, $transport);
        $login         = $remoteAdapter->login();
        $this->assert->boolean($login)->isEqualTo(true);
    }

    public function testLogout()
    {
        $security      = new \Smalot\Drupal\Services\Security\Session(DRUPAL_LOGIN, DRUPAL_PASSWORD);
        $transport     = new \Smalot\Drupal\Services\Transport\Rest(DRUPAL_HOSTNAME);
        $remoteAdapter = new \Smalot\Drupal\Services\RemoteAdapter($security, $transport);

        // Check logout before login
        $logout        = $remoteAdapter->logout();
        $this->assert->boolean($logout)->isEqualTo(false);

        // Check logout after login
        $remoteAdapter->login();
        $logout = $remoteAdapter->logout();
        $this->assert->boolean($logout)->isEqualTo(true);
    }

    public function testCall()
    {
        $security      = new \Smalot\Drupal\Services\Security\Session(DRUPAL_LOGIN, DRUPAL_PASSWORD);
        $transport     = new \Smalot\Drupal\Services\Transport\Rest(DRUPAL_HOSTNAME);
        $remoteAdapter = new \Smalot\Drupal\Services\RemoteAdapter($security, $transport);

        $module = new User($remoteAdapter);
        // Admin account.
        $action = $module->retrieve(1);

        $user = $remoteAdapter->call($action);
        $this->assert->array($user)->hasKeys(array('uid', 'name', 'mail', 'created'));
        $this->assert->string($user['name'])->isEqualTo(DRUPAL_LOGIN);

        // Check missing account with exception.
        $action = $module->retrieve(2);
        $this->assert->exception(
          function () use ($remoteAdapter, $action) {
              $remoteAdapter->call($action);
          }
        )->isInstanceOf('\Smalot\Drupal\Services\Transport\TransportException')
          ->hasMessage('There is no user with ID 2.');

        // Check missing account without exception.
        $action = $module->retrieve(2);
        $user = $remoteAdapter->call($action, false);
        $this->assert->boolean($user)->isEqualTo(false);
    }
}
