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
          ->hasMessage('Not Found');

        $error = $rest->getLastError();
        $this->assert->string($error[0])->isEqualTo('Not Found');

        $security      = new \Smalot\Drupal\Services\Security\Session(DRUPAL_LOGIN, DRUPAL_PASSWORD);
        $transport     = new \Smalot\Drupal\Services\Transport\Rest('http://test.local');
        $remoteAdapter = new \Smalot\Drupal\Services\RemoteAdapter($security, $transport);
        $this->assert->exception(function () use ($remoteAdapter) {
            $remoteAdapter->login();
        })->isInstanceOf('\Smalot\Drupal\Services\Transport\TransportException')
          ->hasMessage('Invalid endpoint, the request never reaches the server.');
    }

    protected function getUsername()
    {
        $random = rand(1, 10000);

        return 'user_test' . $random;
    }

    /**
     * Use User module.
     */
    public function testUser()
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
    }
}
