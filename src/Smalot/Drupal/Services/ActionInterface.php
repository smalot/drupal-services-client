<?php

namespace Smalot\Drupal\Services;

/**
 * Interface ActionInterface
 *
 * @package Smalot\Drupal\Services
 */
interface ActionInterface
{
    /**
     * @return string
     */
    public function getModule();

    /**
     * @return string
     */
    public function getOperation();

    /**
     * @return array
     */
    public function getParameters();

    /**
     * @return array
     */
    public function getData();

    /**
     * @return array
     */
    public function getHeaders();

    /**
     * @return array
     */
    public function execute();

    /**
     * @param MultiCallQueueInterface $queue
     * @param callable                $callback
     *
     * @return mixed
     */
    public function addToQueue(MultiCallQueueInterface $queue, $callback = null);
}
