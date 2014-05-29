<?php

namespace Smalot\Drupal;

/**
 * Interface RemoteAdapterInterface
 *
 * @package Smalot\Drupal
 */
interface RemoteAdapterInterface
{
    /**
     * @param ActionInterface $action
     * @param bool            $throwsException
     *
     * @return array
     * @throws \Exception
     */
    public function call(ActionInterface $action, $throwsException = true);

    /**
     * @param MultiCallQueueInterface $queue
     * @param bool                    $throwsException
     *
     * @return array
     * @throws \Exception
     */
    public function multiCall(MultiCallQueueInterface $queue, $throwsException = false);
}
