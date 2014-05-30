<?php

namespace Smalot\Drupal\Services\Tests\Units;

use mageekguy\atoum;

/**
 * Class MultiCallQueue
 *
 * @package Smalot\Drupal\Services\Tests\Units
 */
class MultiCallQueue extends atoum\test
{
    public function testGetters()
    {
        $security      = new \Smalot\Drupal\Services\Security\Session(DRUPAL_LOGIN, DRUPAL_PASSWORD);
        $transport     = new \Smalot\Drupal\Services\Transport\Rest(DRUPAL_HOSTNAME);
        $remoteAdapter = new \Smalot\Drupal\Services\RemoteAdapter($security, $transport);

        $action = new \Smalot\Drupal\Services\Action('user', 'retrieve', array(1), array(), array(), $remoteAdapter);
        $queue  = new \Smalot\Drupal\Services\MultiCallQueue($remoteAdapter);
        $action->addToQueue($queue);
        $action->addToQueue($queue);

        $this->assert->integer($queue->count())->isEqualTo(2);
        $count = 0;
        foreach ($queue as $action) {
            $this->assert->array($action)->hasSize(2);
            $this->assert->object($action['action'])->isInstanceOf('\Smalot\Drupal\Services\Action');
            $this->assert->integer($queue->key())->isEqualTo($count);
            $count++;
        }
        $this->assert->integer($count)->isEqualTo(2);

        $this->assert->boolean(isset($queue[1]))->isEqualTo(true);
        unset($queue[1]);
        $this->assert->integer($queue->count())->isEqualTo(1);
        $this->assert->boolean(isset($queue[1]))->isEqualTo(false);

        $this->assert->array($queue[0])->hasSize(2);
        $this->assert->object($queue[0]['action'])->isInstanceOf('\Smalot\Drupal\Services\Action');

        $queue[] = $queue[0];
        $this->assert->integer($queue->count())->isEqualTo(2);

        $queue->flush();
        $this->assert->integer($queue->count())->isEqualTo(0);
    }

    public function testExecute()
    {
//        $security      = new \Smalot\Drupal\Services\Security\Session(DRUPAL_LOGIN, DRUPAL_PASSWORD);
//        $transport     = new \Smalot\Drupal\Services\Transport\Rest(DRUPAL_HOSTNAME);
//        $remoteAdapter = new \Smalot\Drupal\Services\RemoteAdapter($security, $transport);
//
//        $action = new \Smalot\Drupal\Services\Action('user', 'retrieve', array(1), array(), array(), $remoteAdapter);
//
//        $user = $action->execute();
//        $this->assert->array($user)->hasKeys(array('uid', 'name', 'mail', 'created'));
//        $this->assert->string($user['name'])->isEqualTo(DRUPAL_LOGIN);
    }
}
