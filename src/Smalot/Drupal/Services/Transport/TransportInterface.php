<?php

namespace Smalot\Drupal\Services\Transport;

/**
 * Interface TransportInterface
 *
 * @package Smalot\Drupal\Services\Transport
 */
interface TransportInterface
{
    /**
     * @param RequestInterface $request
     *
     * @return mixed
     */
    public function call(RequestInterface $request);

    /**
     * @param RequestInterface $request
     *
     * @return mixed
     */
    public function multiCall(RequestInterface $request);
}
