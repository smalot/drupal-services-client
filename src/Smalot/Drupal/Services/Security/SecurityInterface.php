<?php

namespace Smalot\Drupal\Services\Security;

use Smalot\Drupal\Services\Transport\TransportInterface;

/**
 * Interface SecurityInterface
 *
 * @package Smalot\Drupal\Services\Security
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
