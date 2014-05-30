<?php

namespace Smalot\Drupal\Services\Transport;

/**
 * Interface RequestInterface
 *
 * @package Smalot\Drupal\Services\Transport
 */
interface RequestInterface
{
    /**
     * @return \Smalot\Drupal\Services\ActionInterface
     */
    public function getAction();

    /**
     * @return \Smalot\Drupal\Services\Security\SecurityInterface
     */
    public function getSecurity();
}
