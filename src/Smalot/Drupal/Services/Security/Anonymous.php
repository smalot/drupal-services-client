<?php

namespace Smalot\Drupal\Services\Security;

use Smalot\Drupal\Services\Transport\TransportInterface;

/**
 * Class Anonymous
 *
 * @package Smalot\Drupal\Services\Security
 */
class Anonymous implements SecurityInterface
{
    /**
     * @return bool
     */
    public function isLogged()
    {
        return false;
    }

    /**
     * @param TransportInterface $transport
     *
     * @return mixed
     */
    public function login(TransportInterface $transport)
    {
        return true;
    }

    /**
     * @param TransportInterface $transport
     *
     * @return mixed
     */
    public function logout(TransportInterface $transport)
    {
        return true;
    }
}
