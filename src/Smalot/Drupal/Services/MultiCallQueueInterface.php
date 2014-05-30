<?php

namespace Smalot\Drupal\Services;

/**
 * Interface MultiCallQueueInterface
 *
 * @package Smalot\Drupal\Services
 */
interface MultiCallQueueInterface extends \ArrayAccess, \Iterator, \Countable
{
    /**
     * @param ActionInterface $action
     * @param callable        $callback
     *
     * @return MultiCallQueueInterface
     */
    public function addAction(ActionInterface $action, $callback = null);

    /**
     * @return $this
     */
    public function flush();

    /**
     * @return array
     */
    public function execute();
}
