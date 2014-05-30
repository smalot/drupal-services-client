<?php

namespace Smalot\Drupal\Services\Tests\Units\Modules\Core;

use mageekguy\atoum;

/**
 * Class User
 *
 * @package Smalot\Drupal\Services\Tests\Units\Modules\Core
 */
class User extends atoum\test
{
    protected function getUsername()
    {
        $random = rand(1, 10000);

        return 'user_test' . $random;
    }

    public function testCalls()
    {
        $security      = new \Smalot\Drupal\Services\Security\Session(DRUPAL_LOGIN, DRUPAL_PASSWORD);
        $transport     = new \Smalot\Drupal\Services\Transport\Rest(DRUPAL_HOSTNAME);
        $remoteAdapter = new \Smalot\Drupal\Services\RemoteAdapter($security, $transport);

        $module = new \Smalot\Drupal\Services\Modules\Core\User($remoteAdapter);

        $username = $this->getUsername();
        $user     = array(
          'name' => $username,
          'pass' => 'user_pass',
          'mail' => $username . '@example.local',
        );

        // Create username.
        $result = $module->create($user)->execute();
        $this->assert->array($result)->hasKeys(array('uid', 'uri'))->hasSize(2);
        $uid = $result['uid'];

        // Create duplicate username.
        $this->assert->exception(
          function () use ($module, $user) {
              $module->create($user)->execute();
          }
        )->isInstanceOf('\Smalot\Drupal\Services\Transport\TransportException')
          ->hasMessage('Not Acceptable: Form errors.');

        // Retrieve user.
        $user = $module->retrieve($uid)->execute();
        $this->assert->array($user)->hasKeys(array('uid', 'name', 'mail', 'created'));
        $this->assert->string($user['name'])->isEqualTo($username);
        $this->assert->string($user['mail'])->isEqualTo($username . '@example.local');

        // Update user.
        $user['mail'] = 'foo@bar.local';
        $result       = $module->update($user)->execute();
        $this->assert->array($result);
        $this->assert->string($result['mail'])->isEqualTo('foo@bar.local');

        // Delete user.
        $result = $module->delete($uid)->execute();
        $this->assert->array($result)->isEqualTo(array(array(true)));

        // Delete missing user.
        $this->assert->exception(
          function () use ($module, $uid) {
              $module->delete($uid)->execute();
          }
        )->isInstanceOf('\Smalot\Drupal\Services\Transport\TransportException')
          ->hasMessage('There is no user with ID ' . $uid . '.');

        // Retrieve users.
        $users = $module->index()->execute();
        $this->assert->array($users);
        $this->assert->array($users[0])->hasKeys(array('uid', 'name', 'mail', 'created'));

        // Logout.
        $result = $module->logout()->execute();
        $this->assert->array($result)->isEqualTo(array(array(true)));

        // Register user.
        $this->assert->exception(
          function () use ($module) {
              $module->register(array())->execute();
          }
        )->isInstanceOf('\Smalot\Drupal\Services\Transport\TransportException')
          ->hasMessage('Missing required argument account');

        $username = $this->getUsername();
        $user     = array(
          'name' => $username,
          'pass' => 'user_pass',
          'mail' => $username . '@example.local',
        );
        $result   = $module->register($user)->execute();
        $this->assert->array($result)->hasKeys(array('uid', 'uri'))->hasSize(2);
    }
}
