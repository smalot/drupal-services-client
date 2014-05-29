<?php

namespace Smalot\Drupal\Security;

use Smalot\Drupal\Transport\TransportInterface;

/**
 * Interface SecurityInterface
 *
 * @package Smalot\Drupal\Security
 */
interface SecurityInterface
{
    /**
     * @return bool
     */
    public function isLogged();

    /**
     * @param TransportInterface $transport
     *
     * @return mixed
     */
    public function login(TransportInterface $transport);

    /**
     * @param TransportInterface $transport
     *
     * @return mixed
     */
    public function logout(TransportInterface $transport);
}
