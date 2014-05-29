<?php

namespace Smalot\Drupal\Security;

use Smalot\Drupal\Transport\TransportInterface;

/**
 * Class Anonymous
 *
 * @package Smalot\Drupal\Security
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
