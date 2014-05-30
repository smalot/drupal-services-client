<?php

namespace Smalot\Drupal\Services\Tests\Units\Security;

use mageekguy\atoum;

/**
 * Class Session
 *
 * @package Smalot\Drupal\Services\Tests\Units\Security
 */
class Session extends atoum\test
{
    public function testIsLogged()
    {
        $security      = new \Smalot\Drupal\Services\Security\Session(DRUPAL_LOGIN, DRUPAL_PASSWORD);
        $transport     = new \Smalot\Drupal\Services\Transport\Rest(DRUPAL_HOSTNAME);
        $remoteAdapter = new \Smalot\Drupal\Services\RemoteAdapter($security, $transport);

        $this->assert->boolean($security->isLogged())->isEqualTo(false);
        $remoteAdapter->login();
        $this->assert->boolean($security->isLogged())->isEqualTo(true);
        $remoteAdapter->logout();
        $this->assert->boolean($security->isLogged())->isEqualTo(false);
    }

    public function testGetUser()
    {
        $security      = new \Smalot\Drupal\Services\Security\Session(DRUPAL_LOGIN, DRUPAL_PASSWORD);
        $transport     = new \Smalot\Drupal\Services\Transport\Rest(DRUPAL_HOSTNAME);
        $remoteAdapter = new \Smalot\Drupal\Services\RemoteAdapter($security, $transport);

        $user = $security->getUser();
        $this->assert->variable($user)->isNull();

        $remoteAdapter->login();

        $user = $security->getUser();
        $this->assert->array($user)->hasKeys(array('uid', 'name', 'mail', 'created'));
        $this->assert->string($user['name'])->isEqualTo(DRUPAL_LOGIN);
    }

    public function testGetter()
    {
        $security      = new \Smalot\Drupal\Services\Security\Session(DRUPAL_LOGIN, DRUPAL_PASSWORD);
        $transport     = new \Smalot\Drupal\Services\Transport\Rest(DRUPAL_HOSTNAME);
        $remoteAdapter = new \Smalot\Drupal\Services\RemoteAdapter($security, $transport);

        $this->assert->string($security->getSessionId())->isEqualTo('');
        $this->assert->string($security->getCsrfToken())->isEqualTo('');

        $remoteAdapter->login();

        $this->assert->string($security->getSessionId())->hasLengthGreaterThan(5)->contains('=');
        $this->assert->string($security->getCsrfToken())->hasLengthGreaterThan(5);
    }
}
