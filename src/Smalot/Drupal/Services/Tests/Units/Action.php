<?php

namespace Smalot\Drupal\Services\Tests\Units;

use mageekguy\atoum;

/**
 * Class Action
 *
 * @package Smalot\Drupal\Services\Tests\Units
 */
class Action extends atoum\test
{
    public function testGetters()
    {
        $module     = 'module';
        $operation  = 'operation';
        $parameters = array('foo', 'bar');
        $data       = array('date1', 'data2');
        $headers    = array('headers1', 'headers2');

        $action = new \Smalot\Drupal\Services\Action($module, $operation, $parameters, $data, $headers);
        $this->assert->string($action->getModule())->isEqualTo($module);
        $this->assert->string($action->getOperation())->isEqualTo($operation);
        $this->assert->array($action->getParameters())->isEqualTo($parameters);
        $this->assert->array($action->getData())->isEqualTo($data);
        $this->assert->array($action->getHeaders())->isEqualTo($headers);
    }

    public function testExecute()
    {
        $security      = new \Smalot\Drupal\Services\Security\Session(DRUPAL_LOGIN, DRUPAL_PASSWORD);
        $transport     = new \Smalot\Drupal\Services\Transport\Rest(DRUPAL_HOSTNAME);
        $remoteAdapter = new \Smalot\Drupal\Services\RemoteAdapter($security, $transport);

        $action = new \Smalot\Drupal\Services\Action('user', 'retrieve', array(1), array(), array(), $remoteAdapter);
        $user   = $action->execute();
        $this->assert->array($user)->hasKeys(array('uid', 'name', 'mail', 'created'));
        $this->assert->string($user['name'])->isEqualTo(DRUPAL_LOGIN);
    }

    public function testAddToQueue()
    {
        $security      = new \Smalot\Drupal\Services\Security\Session(DRUPAL_LOGIN, DRUPAL_PASSWORD);
        $transport     = new \Smalot\Drupal\Services\Transport\Rest(DRUPAL_HOSTNAME);
        $remoteAdapter = new \Smalot\Drupal\Services\RemoteAdapter($security, $transport);

        $queue = new \Smalot\Drupal\Services\MultiCallQueue($remoteAdapter);

        $action = new \Smalot\Drupal\Services\Action('user', 'retrieve', array(1), array(), array(), $remoteAdapter);
        $result = $action->addToQueue($queue);
        $this->assert->object($result)->isInstanceOf('\Smalot\Drupal\Services\MultiCallQueue');
        $this->assert->integer($result->count())->isEqualTo(1);
    }
}
