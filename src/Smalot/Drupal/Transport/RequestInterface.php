<?php

namespace Smalot\Drupal\Transport;

/**
 * Interface RequestInterface
 *
 * @package Smalot\Drupal\Transport
 */
interface RequestInterface
{
    /**
     * @return \Smalot\Drupal\ActionInterface
     */
    public function getAction();

    /**
     * @return \Smalot\Drupal\Security\SecurityInterface
     */
    public function getSecurity();
}
